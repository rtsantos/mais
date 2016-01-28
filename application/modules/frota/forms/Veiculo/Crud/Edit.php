<?php
    class Frota_Form_Veiculo_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/frota/veiculo/retrieve',
  'insert' => '/frota/veiculo/insert',
  'update' => '/frota/veiculo/update',
  'delete' => '/frota/veiculo/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_fr_veiculo');
            
    
            $model = new Frota_Form_Veiculo_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_modelo');
            $this->addElement($element);

            
            $element = $model->getElement('placa');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('chassi');
            $this->addElement($element);

            
            $element = $model->getElement('renavam');
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
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