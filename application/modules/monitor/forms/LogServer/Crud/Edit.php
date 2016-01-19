<?php
    class Monitor_Form_LogServer_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Monitor_Form_LogServer_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('dh_log');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('total_accesses');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('total_traffic');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('cpu_usage');
            $this->addElement($element);

            
            $element = $model->getElement('cpu_load');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('total_requests');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mem_total');
            $this->addElement($element);

            
            $element = $model->getElement('mem_used');
            $this->addElement($element);

            
            $element = $model->getElement('mem_cached');
            $this->addElement($element);

            
            $element = $model->getElement('swap_total');
            $this->addElement($element);

            
            $element = $model->getElement('swap_used');
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