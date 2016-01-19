<?php
    class Monitor_Form_LogServerRequest_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Monitor_Form_LogServerRequest_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_log_server');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('srv');
            $this->addElement($element);

            
            $element = $model->getElement('pid');
            $this->addElement($element);

            
            $element = $model->getElement('acc');
            $this->addElement($element);

            
            $element = $model->getElement('m');
            $this->addElement($element);

            
            $element = $model->getElement('cpu');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('ss');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('req');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('conn');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('child');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('slot');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('client');
            $this->addElement($element);

            
            $element = $model->getElement('vhost');
            $this->addElement($element);

            
            $element = $model->getElement('request');
            $this->addElement($element);

            
            $element = $model->getElement('perc_cpu');
            $this->addElement($element);

            
            $element = $model->getElement('perc_mem');
            $this->addElement($element);

            
            $element = $model->getElement('time');
            $this->addElement($element);

            
            $element = $model->getElement('system');
            $this->addElement($element);

            
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