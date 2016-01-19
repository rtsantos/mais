<?php
    class Log_Form_LogEvento_Crud_Edit extends ZendT_Form {
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
            
            $element = new ZendT_Form_Element_Hidden('id');
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
            $this->addElement($element);
            
    
            $model = new Log_Form_LogEvento_Elements();
            
            $element = $model->getElement('id_log_objeto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_log_operac');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_objeto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usuario');
            $this->addElement($element);

            
            $element = $model->getElement('dh_evento');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('chave');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
            $element = $model->getElement('id_log_tabela');
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