<?php
    class ZendT_Profile_ColumnsView{
        /**
         *
         * @param type $viewName 
         * @return array
         */
        public function getProfile($viewName){
            $config = array();
            $row = false;
            
            $_profile = new Profile_DataView_User_MapperView();            
            $session = Zend_Auth::getInstance()->getStorage()->read();
            $login = '';
            if ($session !== null){
                $login = $session->getLogin();
            }
            $idProfile = Zend_Controller_Front::getInstance()->getParam('id_profile');
            
            if ($idProfile){
                $_where = new ZendT_Db_Where();
                $_where->addFilter('id', $idProfile);
                $row = $_profile->retriveRow($_where);
            }
            
            if ($login && !$row){
                $_where = new ZendT_Db_Where();
                $_where->addFilter('login', $login);
                $_where->addFilter('objeto', $viewName);
                $_where->addFilter('tipo', 'Grid');
                $_where->addFilter('padrao', 'S');
                $row = $_profile->retriveRow($_where);
            }       
            if (!$row){
                $login = 'CUSTOM';
                $_where = new ZendT_Db_Where();
                $_where->addFilter('login', $login);
                $_where->addFilter('objeto', $viewName);
                $_where->addFilter('tipo', 'Grid');
                $_where->addFilter('padrao', 'S');
                $row = $_profile->retriveRow($_where);
            }
            if (!$row){
                $login = 'DEVELOPER';
                $_where = new ZendT_Db_Where();
                $_where->addFilter('login', $login);
                $_where->addFilter('objeto', $viewName);
                $_where->addFilter('tipo', 'Grid');
                $_where->addFilter('padrao', 'S');
                $row = $_profile->retriveRow($_where);
            }
            if ($row){
                $config = unserialize($row['config']->get());
                $config['grouds'] = ZendT_Sort::sortArray($config['grouds'],'order');
            }
            return $config;
        }
    }
?>
