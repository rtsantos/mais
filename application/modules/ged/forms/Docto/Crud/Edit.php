<?php
    class Ged_Form_Docto_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Ged_Form_Docto_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_tipo_docto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_prop_relac');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_inclusao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_incl');
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $this->addElement($element);

            
            $element = $model->getElement('id_arquivo');
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