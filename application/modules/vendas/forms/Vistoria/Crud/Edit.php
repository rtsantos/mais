<?php
    class Vendas_Form_Vistoria_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/vistoria/retrieve',
  'insert' => '/vendas/vistoria/insert',
  'update' => '/vendas/vistoria/update',
  'delete' => '/vendas/vistoria/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_vistoria');
            
    
            $model = new Vendas_Form_Vistoria_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_pedido');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_veiculo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('sinistro');
            $this->addElement($element);

            
            $element = $model->getElement('numero');
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
            $element = $model->getElement('dt_emis');
            $this->addElement($element);

            
            $element = $model->getElement('local');
            $this->addElement($element);

            
            $element = $model->getElement('laudo');
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