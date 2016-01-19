<?php
    class Log_Form_Relatorio_Crud_Edit extends ZendT_Form {
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
            
    
            $model = new Log_Form_Relatorio_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('id_usuario');
            $this->addElement($element);

            
            $element = $model->getElement('sessao');
            $this->addElement($element);

            
            $element = $model->getElement('arquivo');
            $this->addElement($element);

            
            $element = $model->getElement('titulo');
            $this->addElement($element);

            
            $element = $model->getElement('dh_ini_exec');
            $this->addElement($element);

            
            $element = $model->getElement('dh_fim_exec');
            $this->addElement($element);

            
            $element = $model->getElement('dh_fim_relat');
            $this->addElement($element);

            
            $element = $model->getElement('qtd_reg');
            $this->addElement($element);

            
            $element = $model->getElement('impresso');
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