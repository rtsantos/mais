<?php
    class Vendas_Form_Produto_Crud_Edit extends ZendT_Form {
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
            $this->setName('frm_cv_produto');
            
    
            $model = new Vendas_Form_Produto_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('codigo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('apelido');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_venda');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('vlr_compra');
            $this->addElement($element);

            
            $element = $model->getElement('medida');
            $this->addElement($element);

            
            $element = $model->getElement('qtd_estoque');
            $this->addElement($element);

            
            $element = $model->getElement('id_cliente');
            $this->addElement($element);

            
            $element = $model->getElement('id_produto_resp');
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