<?php
    class ZendT_Profile_FieldsForm{
        /**
         *
         * @param type $viewName 
         * @return array
         */
        public static function getProfile($formName){
            $config = array();
            $row = false;
            
            $_profile = new Profile_DataView_ObjectView_MapperView();
            $session = Zend_Auth::getInstance()->getStorage()->read();
            $login = '';
            if ($session !== null){
                $login = $session->getLogin();
            }
            $idProfile = '';
            if (isset($_COOKIE['profile-'.$formName])){
                $idProfile = $_COOKIE['profile-'.$formName];
            }
            
            if ($idProfile){
                $_where = new ZendT_Db_Where();
                $_where->addFilter('id', $idProfile);
                $row = $_profile->retriveRow($_where);
            }
            
            if ($login && !$row){
                $_where = new ZendT_Db_Where();
                $_where->addFilter('login', $login);
                $_where->addFilter('objeto', $formName);
                $_where->addFilter('tipo', 'F');
                $_where->addFilter('padrao', 'S');
                $_where->addFilter('publico', 'N');
                $row = $_profile->retriveRow($_where);
            }       
            if (!$row){
                $_where = new ZendT_Db_Where();
                $_where->addFilter('publico', 'S');
                $_where->addFilter('objeto', $formName);
                $_where->addFilter('tipo', 'F');
                $_where->addFilter('padrao', 'S');
                $row = $_profile->retriveRow($_where);
            }
            if ($row){
                $config = unserialize($row['config']->get());
                $config['grouds'] = ZendT_Sort::sortArray($config['grouds'],'order');
                $config['id'] = $row['id']->get();
            }
            return $config;
        }
        /**
         * Retorna a lista de Profile para o Formulário
         * 
         * @param string $formName
         * @return array
         */
        public function getListProfile($formName){
            $listProfile = array();
            
            $_profile = new Profile_DataView_ObjectView_MapperView();
            
            $session = Zend_Auth::getInstance()->getStorage()->read();
            $login = '';
            if ($session !== null){
                $login = $session->getLogin();
                $_where = new ZendT_Db_Where();
                $_where->addFilter('login', $login);
                $_where->addFilter('objeto', $formName);
                $_where->addFilter('tipo', 'F');
                $_where->addFilter('publico', 'N');
                
                
                
                $_profile->findAll($_where,array('id','nome'),array('2'));
                while($_profile->fetch()){
                    $key = $_profile->getId()->get();
                    $value = $_profile->getNome()->get();
                    $listProfile[$key] = $value;
                }
            }
            $_where = new ZendT_Db_Where();
            $_where->addFilter('objeto', $formName);
            $_where->addFilter('tipo', 'F');
            $_where->addFilter('publico', 'S');
            
            $_profile->findAll($_where,array('id','nome'),array('2'));
            while($_profile->fetch()){
                $key = $_profile->getId()->get();
                $value = $_profile->getNome()->get();
                $listProfile[$key] = $value;
            }
            
            return $listProfile;
        }
    }
?>
