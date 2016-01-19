<?php
    class Profile_Form_Job_Edit extends Profile_Form_Job_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            parent::loadElements($action);
            
            $filterJson = Zend_Controller_Front::getInstance()->getRequest()->getParam('filter_json');
            if ($filterJson){
                $where = ZendT_Db_Where::fromJson($filterJson);
                $filter = $where->getFilter('profile_job.id_profile_object_view');
                $_mapper = new Profile_Model_ObjectView_Mapper();
                $_mapper->setId($filter['value'])
                        ->retrive();                
                $row = $_mapper->getData();
                $this->getElement('id_profile_object_view')->setValue($row);
            }
            
            $this->removeElement('dh_ult_exec');
        }
    }
?>