<?php
    class Ca_Form_Endereco_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/ca/endereco/retrieve',
  'insert' => '/ca/endereco/insert',
  'update' => '/ca/endereco/update',
  'delete' => '/ca/endereco/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_ca_endereco');
            
    
            $model = new Ca_Form_Endereco_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $this->addElement($element);

            
            $element = $model->getElement('logradouro');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('numero');
            $this->addElement($element);

            
            $element = $model->getElement('complemento');
            $this->addElement($element);

            
            $element = $model->getElement('bairro');
            $this->addElement($element);

            
            $element = $model->getElement('id_cidade');
            $this->addElement($element);

            
            $element = $model->getElement('cep');
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('cidade');
            $this->addElement($element);

            
            $element = $model->getElement('uf');
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