<?php
    class Profile_Form_ObjectView_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array();
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_pf_object_view');
            
    
            $model = new Profile_Form_ObjectView_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('padrao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('objeto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
            $element = $model->getElement('config');
            $this->addElement($element);

            
            $element = $model->getElement('id_usuario');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('uri');
            $this->addElement($element);

            
            $element = $model->getElement('chave');
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