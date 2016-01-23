<?php
    class Vendas_Form_Pedido_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            
    
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

            
            $element = $model->getElement('vlr_total');
            $this->addElement($element);

            
            $element = $model->getElement('pagamento');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_pago');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_desc');
            $this->addElement($element);

            
            $element = $model->getElement('nro_parc');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_parc');
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