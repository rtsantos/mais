<?php
    class Profile_Form_ObjectViewPriv_Edit extends Profile_Form_ObjectViewPriv_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
            
            $filterJson = Zend_Controller_Front::getInstance()->getRequest()->getParam('filter_json');
            if ($filterJson){
                $where = ZendT_Db_Where::fromJson($filterJson);
                $filter = $where->getFilter('profile_object_view_priv.id_profile_object_view');
                
                $_mapper = new Profile_Model_ObjectView_Mapper();
                $_mapper->setId($filter['value'])
                        ->retrive();                
                $row = $_mapper->getData();
                $this->getElement('id_profile_object_view')->setValue($row);
                
                $tipo = $filter = $where->getFilter('profile_object_view_priv.tipo');
                if ($tipo){
                    $this->getElement('tipo')
                         ->setValue($tipo);
                         //->setDecorators(array(new ZendT_Form_Decorator_Hidden()));
                }
            }
        }
    }
?>