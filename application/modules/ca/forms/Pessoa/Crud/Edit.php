<?php
    class Ca_Form_Pessoa_Crud_Edit extends ZendT_Form {
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
            $this->setName('frm_ca_pessoa');
            
    
            $model = new Ca_Form_Pessoa_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('apelido');
            $this->addElement($element);

            
            $element = $model->getElement('codigo');
            $this->addElement($element);

            
            $element = $model->getElement('email');
            $this->addElement($element);

            
            $element = $model->getElement('id_pessoa_resp');
            $this->addElement($element);

            
            $element = $model->getElement('telefone');
            $this->addElement($element);

            
            $element = $model->getElement('celular');
            $this->addElement($element);

            
            $element = $model->getElement('fax');
            $this->addElement($element);

            
            $element = $model->getElement('ed_logr');
            $this->addElement($element);

            
            $element = $model->getElement('ed_numero');
            $this->addElement($element);

            
            $element = $model->getElement('ed_compl');
            $this->addElement($element);

            
            $element = $model->getElement('ed_bairro');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cidade');
            $this->addElement($element);

            
            $element = $model->getElement('ed_estado');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cep');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_logr');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_numero');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_compl');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_bairro');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_cidade');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_estado');
            $this->addElement($element);

            
            $element = $model->getElement('ed_cob_cep');
            $this->addElement($element);

            
            $element = $model->getElement('papel_cliente');
            $this->addElement($element);

            
            $element = $model->getElement('papel_funcionario');
            $this->addElement($element);

            
            $element = $model->getElement('papel_usuario');
            $this->addElement($element);

            
            $element = $model->getElement('papel_empresa');
            $this->addElement($element);

            
            $element = $model->getElement('registro');
            $this->addElement($element);

            
            $element = $model->getElement('id_empresa');
            $this->addElement($element);

            
            $element = $model->getElement('email_cob');
            $this->addElement($element);

            
            $element = $model->getElement('hierarquia');
            $this->addElement($element);

            
            $element = $model->getElement('papel_contato');
            $this->addElement($element);

            
            $element = $model->getElement('id_cargo');
            $this->addElement($element);

            
            $element = $model->getElement('papel_fornecedor');
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