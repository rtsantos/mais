<?php

    class Auth_UsuarioPapelController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Auth_Service_UsuarioPapel';
            $this->_formName = 'Auth_Form_UsuarioPapel_Edit';
            $this->_formSearchName = 'Auth_Form_UsuarioPapel_Search';
            $this->_mapper = new Auth_DataView_UsuarioPapel_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'usuariopapel';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function configGrid() {
            parent::configGrid();
            
            $idUsuario = $this->getRequest()->getParam('id_usuario');
            if ($idUsuario) {
                $this->getGrid()->setPostData(array('usuario-id' => $idUsuario));
            }
        }
    }

?>
