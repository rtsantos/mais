<?php
    class Vendas_Form_PagtoLanc_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/pagto-lanc/retrieve',
  'insert' => '/vendas/pagto-lanc/insert',
  'update' => '/vendas/pagto-lanc/update',
  'delete' => '/vendas/pagto-lanc/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_pagto_lanc');
            
    
            $model = new Vendas_Form_PagtoLanc_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_pagto_pedido');
            $this->addElement($element);

            
            $element = $model->getElement('id_lancamento');
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