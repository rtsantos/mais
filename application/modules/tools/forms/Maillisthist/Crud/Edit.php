<?php
    class Tools_Form_Maillisthist_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $model = new Tools_Model_Maillisthist_Table();
            
            $element = $model->getElement('id_maillist');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('action');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_action');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('err_msg');
            $this->addElement($element);

            
                
            /*$element = new ZendT_Form_Element_SubmitAjax('Salvar');
            $this->addElement($element);*/
        }
        /**
         * Configura uma coluna para ser multipla, ou seja,
         * transformar um dado em array
         *
         * @return void
         */        
        public function setMultiple($column,$numRepeat){
            $this->_multiple[$column] = $numRepeat;
        }
    }
?>