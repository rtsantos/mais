<?php
    class Cms_Form_Cardapio_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Cms_Form_Cardapio_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('dt_exibe');
            $this->addElement($element);

            
            $element = $model->getElement('pt_principal');
            $this->addElement($element);

            
            $element = $model->getElement('opcao');
            $this->addElement($element);

            
            $element = $model->getElement('guarnicao');
            $this->addElement($element);

            
            $element = $model->getElement('arroz_feijao');
            $this->addElement($element);

            
            $element = $model->getElement('salada');
            $this->addElement($element);

            
            $element = $model->getElement('sobremesa');
            $this->addElement($element);

            
            $element = $model->getElement('suco');
            $this->addElement($element);

            
            $element = $model->getElement('pt_light');
            $this->addElement($element);

            
            $element = $model->getElement('id_filial');
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