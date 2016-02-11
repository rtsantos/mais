<?php
    class Ged_Form_Arquivo_Crud_Edit extends ZendT_Form {
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
            $this->setName('frm_img_arquivo');
            
    
            $model = new Ged_Form_Arquivo_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('hashcode');
            $this->addElement($element);

            
            $element = $model->getElement('conteudo');
            $this->addElement($element);

            
            $element = $model->getElement('id_prop_docto');
            $this->addElement($element);

            
            $element = $model->getElement('path_arq');
            $this->addElement($element);

            
            $element = $model->getElement('dt_expira');
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