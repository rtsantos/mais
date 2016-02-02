<?php
    class Vendas_Form_Pagamento_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/pagamento/retrieve',
  'insert' => '/vendas/pagamento/insert',
  'update' => '/vendas/pagamento/update',
  'delete' => '/vendas/pagamento/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_pagto_pedido');
            
    
            $model = new Vendas_Form_Pagamento_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_pedido');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('vlr_total');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('vlr_pago');
            $this->addElement($element);

            
            $element = $model->getElement('per_acre');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_parc');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_a_pagar');
            $this->addElement($element);

            
            $element = $model->getElement('per_desc');
            $this->addElement($element);

            
            $element = $model->getElement('nro_comprov');
            $this->addElement($element);

            
            $element = $model->getElement('id_forma_pagto');
            $this->addElement($element);

            
            $element = $model->getElement('id_parcela');
            $this->addElement($element);

            
            $element = $model->getElement('dt_venc_parc');
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