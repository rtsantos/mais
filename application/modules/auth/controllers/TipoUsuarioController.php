<?php

   class Auth_TipoUsuarioController extends ZendT_Controller_ActionCrud {

       public function init() {
           $this->_init();
           $this->_startupAcl();
           $this->_serviceName = 'Auth_Service_TipoUsuario';
           $this->_formName = 'Auth_Form_TipoUsuario_Edit';
           $this->_formSearchName = 'Auth_Form_TipoUsuario_Search';
           $this->_mapper = new Auth_DataView_TipoUsuario_MapperView();
           /**
            * Configuração do Grid
            */
           $name = $this->getRequest()->getParam('name');
           if (!$name)
               $name = 'tipousuario';
           $this->setGrid(new ZendT_Grid('grid_' . $name));
       }

   }

?>
