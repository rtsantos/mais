<?php
    class Ca_Form_Cidade_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/ca/cidade/retrieve',
  'insert' => '/ca/cidade/insert',
  'update' => '/ca/cidade/update',
  'delete' => '/ca/cidade/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_ca_cidade');
            
    
            $model = new Ca_Form_Cidade_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('polo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('classificacao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_estado');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('cod_ibge');
            $this->addElement($element);

            
            $element = $model->getElement('aliq_iss');
            $this->addElement($element);

            
            $element = $model->getElement('cep');
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