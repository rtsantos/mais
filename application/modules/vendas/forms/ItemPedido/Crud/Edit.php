<?php
    class Vendas_Form_ItemPedido_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/item-pedido/retrieve',
  'insert' => '/vendas/item-pedido/insert',
  'update' => '/vendas/item-pedido/update',
  'delete' => '/vendas/item-pedido/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_item_pedido');
            
    
            $model = new Vendas_Form_ItemPedido_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_pedido');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_produto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_alt');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('qtd_item');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_item');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_desc');
            $this->addElement($element);

            
            $element = $model->getElement('calculo');
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