<?php
    class Financeiro_Form_Lancamento_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/financeiro/lancamento/retrieve',
  'insert' => '/financeiro/lancamento/insert',
  'update' => '/financeiro/lancamento/update',
  'delete' => '/financeiro/lancamento/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_fc_lancamento');
            
    
            $model = new Financeiro_Form_Lancamento_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('tipo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usu_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dt_lanc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('vlr_lanc');
            $this->addElement($element);

            
            $element = $model->getElement('vlr_saldo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('ultimo');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('status');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_favorecido');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_contrato');
            $this->addElement($element);

            
            $element = $model->getElement('id_forma_pagto');
            $this->addElement($element);

            
            $element = $model->getElement('pago');
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
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