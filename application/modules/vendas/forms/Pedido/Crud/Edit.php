<?php
    class Vendas_Form_Pedido_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/vendas/pedido/retrieve',
  'insert' => '/vendas/pedido/insert',
  'update' => '/vendas/pedido/update',
  'delete' => '/vendas/pedido/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_cv_pedido');
            
    
            $model = new Vendas_Form_Pedido_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('numero');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_alt');
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_funcionario');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_cliente');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_cont_cli_resp');
            $this->addElement($element);

            
            $element = $model->getElement('id_cont_cli_vend');
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_cliente_con');
            $this->addElement($element);

            
            $element = $model->getElement('sinistro');
            $this->addElement($element);

            
            $element = $model->getElement('id_veiculo');
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $this->addElement($element);

            
            $element = $model->getElement('dt_emis');
            $this->addElement($element);

            
            $element = $model->getElement('id_endereco');
            $this->addElement($element);

            
            $element = $model->getElement('telefone');
            $this->addElement($element);

            
            $element = $model->getElement('status_edi');
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