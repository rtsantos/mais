<?php
    class Monitor_Form_LogServerProcess_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Monitor_Form_LogServerProcess_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_log_server');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('pid');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('cpu');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mem');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('men_vsz');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('men_rss');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('time_min');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('program');
            $element->setRequired(true);
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