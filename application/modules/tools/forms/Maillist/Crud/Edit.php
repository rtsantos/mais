<?php
    class Tools_Form_Maillist_Crud_Edit extends ZendT_Form {
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
            $model = new Tools_Model_Maillist_Table();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('mail_from');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mail_to');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mail_subject');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mail_cc');
            $this->addElement($element);

            
            $element = $model->getElement('mail_bcc');
            $this->addElement($element);

            
            $element = $model->getElement('mail_alert');
            $this->addElement($element);

            
            $element = $model->getElement('send_alert');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('html');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('ntry');
            $this->addElement($element);

            
            $element = $model->getElement('life_time');
            $this->addElement($element);

            
            $element = $model->getElement('dh_send');
            $this->addElement($element);

            
            $element = $model->getElement('dh_request');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('discard_attachment');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('attachment');
            $this->addElement($element);

            
            $element = $model->getElement('mail_body');
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