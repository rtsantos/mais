<?php

   class Sync_TableController extends ZendT_Controller_Action {

       public function init() {
           $this->_init();
           $this->_startupAcl();
       }

       public function formAction() {
           $_form = new Sync_Form_Table();
           $_form->loadElements();

           $this->view->form = $_form;
       }

       public function mirrorAction() {
           $this->_disableRender();
           $_json = new ZendT_Json_Result();
           try {
               $adapter = $this->getRequest()->getParam('adapter');
               $adapterMirror = $this->getRequest()->getParam('adapter_mirror');
               $table = $this->getRequest()->getParam('table');
               $where = $this->getRequest()->getParam('where');

               $_table = new Sync_Model_Table();
               $result = $_table->mirror($table, $adapter, $adapterMirror, $where);

               $_json->setResult('Sincronizado!');
           } catch (Exception $ex) {
               $_json->setException($ex);
           }

           echo $_json->render();
       }

   }

?>
