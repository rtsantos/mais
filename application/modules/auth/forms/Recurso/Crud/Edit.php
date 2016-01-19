<?php
    class Auth_Form_Recurso_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Auth_Form_Recurso_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_tipo_recurso');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_aplicacao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_recurso_pai');
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('hierarquia');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('icone');
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
            $element = $model->getElement('ordem');
            $this->addElement($element);

            
            $element = $model->getElement('nivel');
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