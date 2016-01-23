<?php
    class Ca_Form_Contrato_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Ca_Form_Contrato_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dt_vig_ini');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dt_vig_fim');
            $this->addElement($element);

            
            $element = $model->getElement('id_cliente');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
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