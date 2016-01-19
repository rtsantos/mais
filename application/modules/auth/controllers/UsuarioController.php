<?php

   class Auth_UsuarioController extends ZendT_Controller_ActionCrud {

       public function init() {
           $this->_init();
           //$this->_startupAcl();
           $this->_serviceName = 'Auth_Service_Usuario';
           $this->_formName = 'Auth_Form_Usuario_Edit';
           $this->_formSearchName = 'Auth_Form_Usuario_Search';
           $this->_mapper = new Auth_DataView_Usuario_MapperView();
           /**
            * Configuração do Grid
            */
           $name = $this->getRequest()->getParam('name');
           if (!$name)
               $name = 'usuario';
           $this->setGrid(new ZendT_Grid('grid_' . $name));
       }

       public function formAction() {

           $buttons = $this->getRequest()->getParam('buttons');
           if (!$buttons) {
               $_buttons = array();
               $_buttons['Salvar']['icon'] = 'ui-icon-disk';
               $_buttons['Salvar']['onClick'] = 'function(){saveProfile();}';
               $this->getRequest()->setParam('buttons', $_buttons);
           }

           parent::formAction();
       }

       public function configGrid() {
           parent::configGrid();

           $idPapel = $this->getRequest()->getParam('id_papel');
           if ($idPapel) {
               $_papel = new Auth_Model_Papel_Mapper();
               $_papel->setId($idPapel)->retrive();
               $this->getGrid()->setPostData(array('papel-nome' => $_papel->getNome()->toPhp(), 'usuario-status' => 'A'));
           }
       }

   }

?>
