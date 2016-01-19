<?php

    class Cms_NotificacaoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Cms_Service_Notificacao';
            $this->_formName = 'Cms_Form_Notificacao_Edit';
            $this->_formSearchName = 'Cms_Form_Notificacao_Search';
            $this->_mapper = new Cms_DataView_Notificacao_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'notificacao';
            $this->setGrid(new ZendT_Grid('grid_' . $name));
        }

        public function listAction() {
            $this->_disableRender();
            $json = new ZendT_Json_Result();
            try {
                $_notificacao = $this->getMapper();
                if ($this->getRequest()->getParam('count')) {
                    $result = array('qtd'=>$_notificacao->count());
                } else {
                    $arrayResult = $_notificacao->feeds();

                    $result = Cms_Helper_Feeds::feeds($arrayResult);
                    if(!$result){
                        $result = "Você não possui nenhuma notificação!";
                    }
                }
                $json->setResult($result);
            } catch (Exception $ex) {
                $json->setException($ex);
            }
            echo $json->render();
        }

        public function deleteAction() {
            $this->_disableRender();
            if ($this->getRequest()->getParam('all')) {
                $json = new ZendT_Json_Result();
                try {
                    if (!$this->getRequest()->getParam('confirmacao')) {
                        $form = new ZendT_Form();
                        $form->setAction(ZendT_Url::getUri());
                        $params = $this->getRequest()->getParams();
                        $params['confirmacao'] = '1';
                        foreach ($params as $key => $val) {
                            $element = new ZendT_Form_Element_Hidden($key);
                            $element->setValue($val);
                            $form->addElement($element);
                        }
                        $msg = "Deseja remover todas as notificações?";
                        throw new ZendT_Exception_Confirm($msg . $form->render());
                    } else {
                        if (Auth_Session_User::getInstance()->authenticated()) {
                            $this->getMapper()->setIdUsuario(Zend_Auth::getInstance()->getStorage()->read()->getId())->delete();
                        }
                        $json->setResult(true);
                    }
                } catch (Exception $ex) {
                    $json->setException($ex);
                }
                echo $json->render();
            } else {
                parent::deleteAction();
            }
        }

    }

?>
