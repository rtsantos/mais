<?php

class Profile_JobController extends ZendT_Controller_ActionCrud {

    public function init() {
        $this->_init();
        //$this->_startupAcl();
        $this->_serviceName = 'Profile_Service_Job';
        $this->_formName = 'Profile_Form_Job_Edit';
        $this->_formSearchName = 'Profile_Form_Job_Search';
        $this->_mapper = new Profile_DataView_Job_MapperView();
        /**
         * Configuração do Grid
         */
        $name = $this->getRequest()->getParam('name');
        if (!$name)
            $name = 'job';
        $this->setGrid(new ZendT_Grid('grid_' . $name));
    }

    public function runAction() {

        $_job = new Profile_Model_Job_Mapper();
        $_job->setId($this->getRequest()->getParam('id'))
                ->retrive()
                ->setDhUltExec("SYSDATE")
                ->update();

        $_view = new Profile_DataView_Job_Users();
        $where = new ZendT_Db_Where();
        $where->addFilter('profile_job.id', $this->getRequest()->getParam('id'));
        $where->addFilter('usuario.email', "", "!NULL");
        $data = $_view->recordset($where);
        while ($row = $data->getRow()) {
            try {
                $uri = $row['uri']->get();
                if ($uri == '') {
                    $uri = ZendT_Lib::convertObjectToUri($row['objeto']->get());
                }
                $uriOriginal = $uri . '/dynamic/profile/' . $row['id_profile']->get();
                $uri.= '/found/profile/' . $row['id_profile']->get() . '/no_location/1?' . $row['uri_token']->get();
                $client = new Zend_Http_Client($uri, array('timeout' => '80'));
                $response = $client->request();
                if ($response->getBody() == 'OK') {
                    $mail = new ZendT_Mail();
                    $mail->addTo($row['email_usuario']->get(), $row['nome_usuario']->get());
                    $mail->addFrom('no-reply@tanet.com.br', 'Transportadora Americana');
                    $mail->setTitle($row['nome']->get());
                    $mail->setSubject($row['nome']->get());

                    $comment = $row['observacao']->get();
                    if (!$comment) {
                        $comment = $row['nome']->get();
                    }
                    $comment.= '<br><br>Para acessar o relatório clique <a href = "' . str_replace(array('/found/', '/no_location/1'), array('/dynamic/', ''), $uri) . '">aqui</a>';
                    $mail->setComment($comment);

                    $body = '<br>';

                    $user = array();
                    $user['id'] = $row['id_usuario']->get();
                    $user['role'] = $row['nome_papel']->get();

                    $listProfile = ZendT_Profile::listProfile($row['objeto']->get(), '', $user);

                    if (count($listProfile) > 0) {
                        $body.= '<style type="text/css">';
                        $body.= '    <!--';
                        $body.= '    td {';
                        $body.= '            font-family: Arial, Helvetica, sans-serif;';
                        $body.= '            font-size: 12px;';
                        $body.= '    }';
                        $body.= '    .TitleTable {';
                        $body.= '            font-weight: bold;';
                        $body.= '            border-bottom: 0px;';
                        $body.= '    }';
                        $body.= '    .viewTitle {';
                        $body.= '            background-color: #F9F9F9;';
                        $body.= '            font-weight: bold;';
                        $body.= '    }';
                        $body.= '    .viewTable {';
                        $body.= '            border:1px solid #CCCCCC;';
                        $body.= '    }';
                        $body.= '    -->';
                        $body.= '</style>';
                        $body.= '<table width="100%" border="0" cellpadding="5" cellspacing="0" class="viewTable">';
                        $body.= '	<tr >';
                        $body.= '		<td class="viewTitle">Visões Disponíveis</td>';
                        $body.= '	</tr>';
                        $body.= '	<tr>';
                        $body.= '		<td>';
                        $body.= '			<table width="100%" border="0" cellpadding="5" cellspacing="0">';
                        $body.= '				<tr>';
                        $body.= '					<td class="TitleTable">Tipo</td>';
                        $body.= '					<td class="TitleTable">Visão</td>';
                        $body.= '					<td class="TitleTable">Observação</td>';
                        $body.= '				</tr>';

                        foreach ($listProfile as $profile => $detailProfile) {
                            $uri = ZendT_Lib::convertObjectToUri($row['objeto']->get()) . '/found/profile/' . $profile . '?' . $row['uri_token']->get();

                            $body.= '				<tr>';
                            $body.= '					<td>' . $detailProfile['tipoDescricao'] . '</td>';
                            $body.= '					<td><a href = "' . str_replace('/found/', '/dynamic/', $uri) . '">' . $detailProfile['nome'] . '</a></td>';
                            $body.= '					<td>' . $detailProfile['observacao'] . '</td>';
                            $body.= '				</tr>';
                        }

                        $body.= '			</table>';
                        $body.= '		</td>';
                        $body.= '	</tr>';
                        $body.= '</table>';
                    }

                    $mail->setBody($body);
                    $mail->save();
                }
            } catch (Exception $ex) {
                $mail = new ZendT_Mail();
                /* $mail->addTo("rafael.santos@tanet.com.br"); */
                $mail->addTo("erro.sistemas@tanet.com.br");
                $mail->addFrom('no-reply@tanet.com.br', 'Transportadora Americana');
                $mail->setTitle('Erro no envio de e-mail pelo agendamento de tarefa');
                $mail->setSubject($mail->getTitle());
                $comment = $row['nome']->get() . '<br><br>Para acessar o relatório clique <a href = "' . $uriOriginal . '">aqui</a>';
                $mail->setComment($comment);
                $mail->setBody($ex->getMessage());
                $mail->save();
                /*echo 'Erro';
                exit;*/
            }
        }
        echo 'Processado';
        exit;
    }

}

?>
