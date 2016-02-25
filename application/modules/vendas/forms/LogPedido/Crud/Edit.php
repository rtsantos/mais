<?php
    class Vendas_Form_LogPedido_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/log-pedido/retrieve',
  'insert' => '/vendas/log-pedido/insert',
  'update' => '/vendas/log-pedido/update',
  'delete' => '/vendas/log-pedido/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_log_pedido');
            
    
            $model = new Vendas_Form_LogPedido_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_pedido');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_log');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('mensagem');
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