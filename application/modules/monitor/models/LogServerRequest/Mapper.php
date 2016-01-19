<?php
/**
 * Classe de mapeamento do registro da tabela log_server_request
 */
class Monitor_Model_LogServerRequest_Mapper extends Monitor_Model_LogServerRequest_Crud_Mapper
{
    /**
     * 
     */
    private $_psAux;
    
    /*
     * 
     */
    public function setPsAux() {
        $result = shell_exec('ps aux');
        $result = explode("\n", $result);
        
        foreach($result as $key => &$value){
            $value = explode(" ",$value);
            $newValue = array();
            
            foreach($value as $content){
                if ($content !== ''){
                    $newValue[] = $content;
                }
            }
            
            $value = $newValue;
        }
        
        $this->_psAux = $result;
    }
    
    /**
     * 
     */
    private function _time2Sec($value) {
        $value = explode(':', $value);
        $value = ($value[0] * 60) + $value[1];
        return $value;
    }
    
    /**
     * 
     */
    public function getPsAux($pId) {
        $return = array();
        
        if (!$pId) {
            $return = $this->_psAux;
        } else {
            foreach ($this->_psAux as $line) {
                if ($line[1] == $pId) {
                    $return['perc_cpu'] = str_replace(".",",",$line[2]); #%CPU
                    $return['perc_mem'] = str_replace(".",",",$line[3]); #%MEM
                    $return['time'] = $this->_time2Sec($line[9]); #TIME
                }
            }
        }
        
        return $return;
    }
    
    /**
      * 
      */
    private function _parseGeneral($general) {
        $return = array();

        foreach ($general as $value) {
            $params = array('total_accesses' => array('Total accesses:')
                            ,'total_traffic' => array('Total Traffic:', 'GB')
                            ,'cpu_usage' => array('CPU Usage:')
                            ,'cpu_load' => array('CPU load', '%')
                            ,'total_requests' => array('Total requests:'));

            foreach ($params as $field => $texts) {
                foreach ($texts as $text) {
                    if ((string)strpos($value, $text) != '') {
                        $value = str_replace($text, '', $value);
                        $value = trim($value);                        
                        $return[$field] = $value;
                    }
                }
            }
        }

        return $return;
    }
    
    /**
     * 
     */
    private function _parseRequest($value) {
        $value = str_replace('POST ', '', $value);
        $value = str_replace('GET ', '', $value);
        $value = explode('/', $value);
        
        if ($value[1] == 'sistemas') {
            $return = $value[2];
        } else if (in_array ($value[1], array('AppTA', 'Application'))) {
            if ($value[2] == 'index.php') {
                $return = $value[3];
            }
        } else {
            $return = null;
        }
        
        return $return;
    }

    /**
      * 
      */
    private function _getParseServerStatus($url) {
        $serverStatus = array();

        $error_message1 = " Favor informar a URL.";
        $error_message2 = " Não foi possível realizar o parse do resultado da URL.";
        $error_message3 = " Erro na requisição com o servidor WEB.";

        if (empty($url)) {
            throw new ZendT_Exception_Alert($error_message1);
        }

        if(false == ($str = file_get_contents($url))) {
            throw new ZendT_Exception_Alert($error_message3);
        }
        
        $this->setPsAux();

        $str = str_replace("\r", "", $str);
        $str = str_replace("\n", "", $str);

        $reg = '~<tr><td><b>(.*)<\/b><\/td><td>(.*)<\/td><td>(.*)<\/td>';
        $reg.= '<td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td>';
        $reg.= '<td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td>';
        $reg.= '<td nowrap>(.*)<\/td><td nowrap>(.*)<\/td><\/tr>~Ui';
        preg_match_all($reg, $str, $matches);

        $reg_raw = '~<dt>(.*)</dt>~Ui';
        preg_match_all($reg_raw, $str, $matches_raw);

        $c = count($matches[0]);
        if($c == 0) {
            throw new ZendT_Exception_Alert($error_message2);
        }

        for($i = 1; $i < $c; $i++) {
            $pId = str_replace('-', '', $matches[2][$i]);

            if ($pId) {
                $serverStatus['requests'][$i]['srv'] = $matches[1][$i];
                $serverStatus['requests'][$i]['pid'] = $pId;
                $serverStatus['requests'][$i]['acc'] = $matches[3][$i];
                $serverStatus['requests'][$i]['m'] = str_replace('<b>', '', str_replace('</b>', '', $matches[4][$i]));
                $serverStatus['requests'][$i]['cpu'] = str_replace(".",",",$matches[5][$i]);
                $serverStatus['requests'][$i]['ss'] = $matches[6][$i];
                $serverStatus['requests'][$i]['req'] = $matches[7][$i];
                $serverStatus['requests'][$i]['conn'] = $matches[8][$i];
                $serverStatus['requests'][$i]['child'] = str_replace(".",",",$matches[9][$i]);
                $serverStatus['requests'][$i]['slot'] = str_replace(".",",",$matches[10][$i]);
                $serverStatus['requests'][$i]['client'] = $matches[11][$i];
                $serverStatus['requests'][$i]['vhost'] = $matches[12][$i];
                $serverStatus['requests'][$i]['request'] = $matches[13][$i];
                $serverStatus['requests'][$i]['system'] = $this->_parseRequest($serverStatus['requests'][$i]['request']);

                $psAux = $this->getPsAux($pId);

                $serverStatus['requests'][$i]['perc_cpu'] = $psAux['perc_cpu'];
                $serverStatus['requests'][$i]['perc_mem'] = $psAux['perc_mem'];
                $serverStatus['requests'][$i]['time'] = $psAux['time'];

                $serverStatus['counts']['vhosts'][$matches[12][$i]]++;
                $serverStatus['counts']['clients'][$matches[11][$i]]++;
                $serverStatus['counts']['requests'][$matches[13][$i]]++;
            }
        }

        arsort($serverStatus['counts']['vhosts']);
        arsort($serverStatus['counts']['clients']);
        arsort($serverStatus['counts']['requests']);

        $general = array();
        foreach ($matches_raw['1'] as $value) {
            $value = explode(' - ', $value);

            foreach ($value as $value) {                    
                $general[] = $value;
            }
        }
        $general[] = 'Total requests: '.count($serverStatus['requests']);

        $serverStatus['generalFull'] = $general;
        $serverStatus['general'] = $this->_parseGeneral($general);

        return $serverStatus;
    }

    /**
      * 
      */
    public function log($url) {
        try {
            $_resource = new Monitor_Model_Resource_Mapper();
            
            
            $memory = $_resource->getMemoryTotal();
            $serverStatus = $this->_getParseServerStatus($url);
            
            //var_dump($serverStatus);
            
            //return true;

            $logServer = new Monitor_DataView_LogServer_MapperView();
            $logServer->setDhLog('SYSDATE');
            $logServer->setTotalAccesses($serverStatus['general']['total_accesses']);
            $logServer->setTotalTraffic(str_replace('.', ',', $serverStatus['general']['total_traffic']));
            $logServer->setCpuUsage($serverStatus['general']['cpu_usage']);
            $logServer->setCpuLoad(str_replace('.', ',', $serverStatus['general']['cpu_load']));
            $logServer->setTotalRequests($serverStatus['general']['total_requests']);
            $logServer->setMemTotal($memory['mem_total']);
            $logServer->setMemUsed($memory['mem_used']);
            $logServer->setMemCached($memory['mem_cached']);
            $logServer->setSwapTotal($memory['swap_total']);
            $logServer->setSwapUsed($memory['swap_used']);
            $logServer->insert();

            $idLogServer = $logServer->getId();

            foreach ($serverStatus['requests'] as $request) {
                $logServerRequest = new Monitor_DataView_LogServerRequest_MapperView();
                $logServerRequest->setIdLogServer($idLogServer);
                $logServerRequest->setSrv($request['srv']);
                $logServerRequest->setPid($request['pid']);
                $logServerRequest->setAcc(substr($request['acc'], 1, 12));
                $logServerRequest->setM($request['m']);
                $logServerRequest->setCpu(str_replace('.', ',', $request['cpu']));
                $logServerRequest->setSs($request['ss']);
                $logServerRequest->setReq($request['req']);
                $logServerRequest->setConn(str_replace('.', ',', $request['conn']));
                $logServerRequest->setChild(str_replace('.', ',', $request['child']));
                $logServerRequest->setSlot(str_replace('.', ',', $request['slot']));
                $logServerRequest->setClient($request['client']);
                $logServerRequest->setVhost($request['vhost']);
                $logServerRequest->setRequest($request['request']);
                $logServerRequest->setPercCpu($request['perc_cpu']);
                $logServerRequest->setPercMem($request['perc_mem']);
                $logServerRequest->setTime($request['time']);
                $logServerRequest->setSystem($request['system']);
                $logServerRequest->insert();
            }
            
            $process = $_resource->getProcess();
            $_process = new Monitor_DataView_LogServerProcess_MapperView();
            foreach ($process as $proc) {
                $_process->newRow();
                $_process->setIdLogServer($idLogServer);
                $_process->setPid($proc['pid']);
                $_process->setCpu($proc['cpu']);
                $_process->setMenVsz($proc['men_vsz']);
                $_process->setMenRss($proc['men_rss']);
                $_process->setTimeMin($proc['time_min']);
                $_process->setProgram($proc['program']);
                $_process->insert();
            }

            return "<div>Log registrado com sucesso!</div>";
        } catch(Exception $e) {
            $this->getModel()->getAdapter()->rollBack();
            return "<div class='error'>Alerta: " . $e->getMessage().'</div>';
        }
    }
}
?>