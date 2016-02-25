<?php
    class Tools_Form_LogErro_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/tools/log-erro/retrieve',
  'insert' => '/tools/log-erro/insert',
  'update' => '/tools/log-erro/update',
  'delete' => '/tools/log-erro/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_tl_log_erro');
            
    
            $model = new Tools_Form_LogErro_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('procedimento');
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