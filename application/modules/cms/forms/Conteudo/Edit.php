<?php

    class Cms_Form_Conteudo_Edit extends Cms_Form_Conteudo_Crud_Edit {

        protected $_formNome = 'form_conteudo';

        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action = 'insert', $newAction = '') {
            parent::loadElements($action);
            $this->setName($this->_formNome);

            if ($newAction) {
                $this->setAction(ZendT_Url::getUri(true) . "/" . $newAction);
            }

            $filterJson = Zend_Controller_Front::getInstance()->getRequest()->getParam('filter_json');
            if ($filterJson) {
                $where = ZendT_Db_Where::fromJson($filterJson);
                $filter = $where->getFilter('id');
                $_mapper = new Cms_Model_Conteudo_Mapper();
                $_mapper->setId($filter['value'][0])->retrive();
                $row = $_mapper->getData();
                unset($row['thumbnail']);
                unset($row['banner']);
                unset($row['arquivo']);
                $this->populate($row);
            }

            $this->loadButtons();
        }

        public function loadButtons() {
            $buttons = Zend_Controller_Front::getInstance()->getRequest()->getParam('buttons');
            if (!count($buttons)) {
                $buttons = array();
            }
            if (!$buttons['Salvar']) {
                $edit = Zend_Controller_Front::getInstance()->getRequest()->getParam('edit');
                $success = "";
                if (!$edit) {
                    $success = "location.reload();";
                } else {
                    $success = "window.location.href = $('#content-button-edit').attr('href');";
                }
                $onClick = "function(){
                                var form = jQuery('#" . $this->_formNome . "');
                                jQuery.AjaxT.submitJson({
                                    selector: form,
                                    success: function(result){
                                        {$success}
                                    }
                                });
                            }";
                $_button = new ZendT_Form_Element_Button('salvar-dynamic');
                $_button->setIcon('ui-icon-check');
                $_button->addClass('btn btn-primary');
                $_button->setLabel('Salvar');
                $_button->setAttrib('onClick', new ZendT_JS_Command($onClick));
                $_button->addDecorator(new ZendT_Form_Decorator_Button());
                $_button->addStyle('float', 'right');
                $this->addElement($_button);

                /* $buttons['Salvar'] = $_button;
                  Zend_Controller_Front::getInstance()->getRequest()->setParam('buttons', $buttons); */
            }
        }

    }

?>