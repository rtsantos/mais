<?php

    /**
     * Classe para tratar dados particulares
     * 
     * @author rsantos
     * @package ZendT
     * @subpackage ZendT_Lib
     * @version 1.0 
     */
    class ZendT_Lib {

        /**
         * Converte o nome de uma tabela em uma nome de classe do PHP
         * 
         * @param string $name
         * @return string
         */
        public static function convertTableNameToClassName($name) {
            $aux = explode('_', $name);
            $return = '';
            foreach ($aux as $thisName) {
                $return.= ucwords(strtolower($thisName));
            }
            return $return;
        }

        /**
         * Converte o nome de uma tabela para uma classe DbTable
         * 
         * @param string $moduleName
         * @param string $tableName
         * @return string
         */
        public static function convertTableNameToObjectName($moduleName, $tableName) {
            if ($moduleName == '')
                $moduleName = 'Application';
            return ucfirst($moduleName) . "_Model_" . ZendT_Tool_ModelTProvider::convertTableNameToClassName($tableName) . "_Crud";
        }

        public static function mapperViewToArrayUri($objectName) {
            list($module, $package, $name, $mapper) = explode('_', $objectName);

            $parts = array();
            $newName = '';
            for ($i = 0; $i < strlen($name); $i++) {
                $value = $name[$i];
                if ($value == strtoupper($value)) {
                    $value = '-' . strtolower($value);
                }
                $newName.= $value;
            }
            $newName = substr($newName, 1);

            return array('module' => strtolower($module), 'controller' => $newName);
        }

        public static function convertObjectToUri($objectName) {
            $itens = ZendT_Lib::mapperViewToArrayUri($objectName);
            $uri = ZendT_Url::getHostName() . ZendT_Url::getBaseUrl() . '/' . $itens['module'] . '/' . $itens['controller'];
            return $uri;
        }

        public static function getTmpDir() {
            foreach (array($_ENV, $_SERVER) as $tab) {
                foreach (array('TMPDIR', 'TEMP', 'TMP', 'windir', 'SystemRoot') as $key) {
                    if (isset($tab[$key])) {
                        if (($key == 'windir') or ( $key == 'SystemRoot')) {
                            $dir = realpath($tab[$key] . '\\temp');
                        } else {
                            $dir = realpath($tab[$key]);
                        }
                    }
                }
            }
            if ($dir == '/' || $dir == '') {
                $dir = '/tmp';
            }
            return $dir;
        }

        /**
         * Retorna a descriÃ§Ã£o do mÃ³dulo
         * 
         * @return string
         */
        public static function getModuleDesc() {
            $module = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $config = array();

            /* $moduleDesc = Zend_Registry::get('moduleDesc');
              if ($moduleDesc)
              return $moduleDesc; */

            $fileName = '../application/configs/modules/config.php';
            if (!file_exists($fileName)) {
                $fileName = 'application/configs/modules/config.php';
            }
            if (file_exists($fileName)) {
                $config = require $fileName;
            }

            if (!isset($config[$module])) {
                return 'Portal TA';
            } else {
                Zend_Registry::set('moduleDesc', $config[$module]);
                return $config[$module];
            }
        }

        /**
         * Retorna a descriÃ§Ã£o da tabela
         * 
         * @return string
         */
        public static function getTableDesc() {
            $module = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $tableName = str_replace("-", "_", Zend_Controller_Front::getInstance()->getRequest()->getControllerName());
            $config = array();

            /* $tableDesc = Zend_Registry::get('tableDesc');
              if ($tableDesc)
              return $tableDesc; */

            $fileName = '../application/configs/modules/' . $module . '/' . $tableName . '.php';
            if (!file_exists($fileName)) {
                $fileName = 'application/configs/modules/' . $module . '/' . $tableName . '.php';
            }
            if (file_exists($fileName)) {
                $config = require($fileName);
            }

            if (!isset($config['table']['description'])) {
                return '';
            } else {
                Zend_Registry::set('tableDesc', $config['table']['description']);
                return $config['table']['description'];
            }
        }

        /**
         * Remove os acentos de uma string
         * 
         * @param string $value
         * @return string
         */
        public static function removeAccent($value) {
            $mapping = array('á' => 'a',
                'à' => 'a',
                'ã' => 'a',
                'â' => 'a',
                'é' => 'e',
                'ê' => 'e',
                'í' => 'i',
                'ó' => 'o',
                'ô' => 'o',
                'õ' => 'o',
                'ú' => 'u',
                'ü' => 'u',
                'ç' => 'c',
                'Á' => 'A',
                'À' => 'A',
                'Ã' => 'A',
                'Â' => 'A',
                'É' => 'E',
                'Ê' => 'E',
                'Í' => 'I',
                'Ó' => 'O',
                'Ô' => 'O',
                'Õ' => 'O',
                'Ú' => 'U',
                'Ü' => 'U',
                'Ç' => 'C');
            return strtr($value, $mapping);
        }

        /**
         * Cria os diretÃ³rios de um pathBase nÃ£o existente, ou seja,
         * quebra os diretÃ³rios e a cada diretÃ³rio inexiste cria
         * 
         * @param string $pathBase
         * @param string $path 
         */
        public static function createDirectory($pathBase, $path) {
            $path = explode('/', str_replace($pathBase, '', $path));
            $pathFull = $pathBase;
            foreach ($path as $diretory) {
                if (!is_dir($pathFull . '/' . $diretory)) {
                    mkdir($pathFull . '/' . $diretory);
                }
                $pathFull = $pathFull . '/' . $diretory;
            }
        }

        public static function replaceFiles($pathBase, $strOld, $strNew, $filter = '*.*') {
            $pathBase = str_replace('\\', '/', $pathBase);

            $files = glob($pathBase . '/' . $filter);

            foreach ($files as $file) {
                file_put_contents($file, str_replace($strOld, $strNew, file_get_contents($file)));
            }

            @$myDirectory = opendir($pathBase);
            if ($myDirectory) {
                while ($dir = @readdir($myDirectory)) {
                    if ($dir != '.' && $dir != '..' && $dir != '.svn' && is_dir($pathBase . '/' . $dir)) {
                        ZendT_Lib::replaceFiles($pathBase . '/' . $dir, $strOld, $strNew, $filter);
                    }
                }
                closedir($myDirectory);
            }
        }

        /**
         *
         * @param type $string
         * @param type $length
         * @return type 
         */
        public static function checkFake($string, $length) {
            for ($i = 0; $i <= 9; $i++) {
                $fake = str_pad("", $length, $i);
                if ($string === $fake)
                    return(1);
            }
        }

        /**
         * Verifica se o CPF Ã© vÃ¡lido
         * 
         * @param string $cpf
         * @return boolean 
         */
        public static function checkCpf($cpf) {
            $cpf = str_replace(array('.', '/', '-'), '', $cpf);
            $cpf = trim($cpf);
            if (empty($cpf) || strlen($cpf) != 11)
                return FALSE;
            else {
                if (ZendT_Lib::checkFake($cpf, 11))
                    return FALSE;
                else {
                    $sub_cpf = substr($cpf, 0, 9);
                    for ($i = 0; $i <= 9; $i++) {
                        $dv += ($sub_cpf[$i] * (10 - $i));
                    }
                    if ($dv == 0)
                        return FALSE;
                    $dv = 11 - ($dv % 11);
                    if ($dv > 9)
                        $dv = 0;
                    if ($cpf[9] != $dv)
                        return FALSE;

                    $dv *= 2;
                    for ($i = 0; $i <= 9; $i++) {
                        $dv += ($sub_cpf[$i] * (11 - $i));
                    }
                    $dv = 11 - ($dv % 11);
                    if ($dv > 9)
                        $dv = 0;
                    if ($cpf[10] != $dv)
                        return FALSE;
                    return TRUE;
                }
            }
        }

        /**
         *
         * @param string $cnpj
         * @return boolean 
         */
        public static function checkCnpj($cnpj) {
            $cnpj = str_replace(array('.', '/', '-'), '', $cnpj);
            $cnpj = trim($cnpj);
            if (empty($cnpj) || strlen($cnpj) != 14)
                return FALSE;
            else {
                if (ZendT_Lib::checkFake($cnpj, 14))
                    return FALSE;
                else {
                    $rev_cnpj = strrev(substr($cnpj, 0, 12));
                    for ($i = 0; $i <= 11; $i++) {
                        $i == 0 ? $multiplier = 2 : $multiplier;
                        $i == 8 ? $multiplier = 2 : $multiplier;
                        $multiply = ($rev_cnpj[$i] * $multiplier);
                        $sum = $sum + $multiply;
                        $multiplier++;
                    }
                    $rest = $sum % 11;
                    if ($rest == 0 || $rest == 1)
                        $dv1 = 0;
                    else
                        $dv1 = 11 - $rest;

                    $sub_cnpj = substr($cnpj, 0, 12);
                    $rev_cnpj = strrev($sub_cnpj . $dv1);
                    unset($sum);
                    for ($i = 0; $i <= 12; $i++) {

                        $i == 0 ? $multiplier = 2 : $multiplier;
                        $i == 8 ? $multiplier = 2 : $multiplier;
                        $multiply = ($rev_cnpj[$i] * $multiplier);
                        $sum = $sum + $multiply;
                        $multiplier++;
                    }
                    $rest = $sum % 11;
                    if ($rest == 0 || $rest == 1)
                        $dv2 = 0;
                    else
                        $dv2 = 11 - $rest;

                    if ($dv1 == $cnpj[12] && $dv2 == $cnpj[13])
                        return TRUE;
                    else
                        return FALSE;
                }
            }
        }

        /**
         * Verifica se CNPJ ou Cpf Ã© VÃ¡lido
         *
         * @param string $value
         * @return bool
         */
        public static function checkCnpjCpf($value) {
            if (strlen($value) == 11) {
                return ZendT_Lib::checkCpf($value);
            } else {
                return ZendT_Lib::checkCnpj($value);
            }
        }

        /**
         * Devolve um filtro formatado para o getDataGrid.
         * O parametro $filters deve ser um array como o exemplo abaixo
         * 
         * $filters = array('id_teste'=>array('mapper'=>'Ca_Model_Teste_Mapper','op'=>'?%','value'=>20.'table'=>'teste));
         * 
         * 
         * @param array $filters 
         * @return array
         */
        public static function getDataForGridSearch(array $filters) {
            foreach ($filters as $campo => $filtro) {
                $filtroGrid['filter'][$campo]['field'][$campo . 'field'] = $filtro['table'] . '.' . $campo;
                $filtroGrid['filter'][$campo]['mapper'][$campo . 'mapper'] = $filtro['mapper'];
                $filtroGrid['filter'][$campo]['op'][$campo . 'op'] = $filtro['op'];
                $filtroGrid['filter'][$campo]['value'][$campo] = $filtro['value'];
            }
            $filtroGrid['idSearch'] = true;
            $filtroGrid['noPage'] = true;
            return $filtroGrid;
        }

        /**
         * Devolve apenas os numeros de uma string
         * 
         * @param string $value
         * @return string
         */
        public static function filterNumber($value) {
            return preg_replace('/[^0-9]/', '', $value);
        }

        /**
         * Devolve apenas os numeros de uma string
         * 
         * @param string $value
         * @return string
         */
        public static function translate($string, $moduleName = null) {
            if (Zend_Registry::isRegistered('module')) {
                $moduleName = Zend_Registry::get('module');
            }
            if ($moduleName == null) {
                @$moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            }
            
            if (!$moduleName){
                $moduleName = 'vendas';
            }

            if (Zend_Registry::isRegistered('translate_' . $moduleName)) {
                $_translate = Zend_Registry::get('translate_' . $moduleName);
            } else {
                $_translate = new Zend_Translate(
                        'array', APPLICATION_PATH . '/modules/' . $moduleName . '/languages/pt_BR.php', 'pt_BR'
                );

                Zend_Registry::set('translate_' . $moduleName, $_translate);
            }
            return $_translate->_($string);
        }

        /**
         * Converte o nome de um parâmetro em uma nome de método do PHP
         * 
         * @param string $name
         * @return string
         */
        public static function paramToMethod($name) {
            $names = explode('-', $name);
            foreach ($names as &$value) {
                $value = ucfirst($value);
            }
            $names[0] = strtolower(substr($names[0], 0, 1)) . substr($names[0], 1);
            return implode('', $names);
        }

    }

?>
