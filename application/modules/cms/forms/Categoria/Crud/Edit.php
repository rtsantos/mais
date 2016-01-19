<?php
    class Cms_Form_Categoria_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Cms_Form_Categoria_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_categoria_pai');
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('publico');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('menu');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
            $element = $model->getElement('ordem');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('thumbnail');
            $this->addElement($element);

            
            $element = $model->getElement('url');
            $this->addElement($element);

            
            $element = $model->getElement('chave');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('nivel');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('url_macro');
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