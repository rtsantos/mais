<?php
    class Cms_Form_PrivConteudo_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Cms_Form_PrivConteudo_Elements();
            
            $element = $model->getElement('id_conteudo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_papel');
            $this->addElement($element);

            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('env_email');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usuario');
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