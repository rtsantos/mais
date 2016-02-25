<?php
    class Tools_Form_Job_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected $_multiple;
        /**
         * @var array
         */
        protected $_url = array (
  'retrieve' => '/tools/job/retrieve',
  'insert' => '/tools/job/insert',
  'update' => '/tools/job/update',
  'delete' => '/tools/job/delete',
);
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='insert') {
            $this->setName('frm_tl_job');
            
    
            $model = new Tools_Form_Job_Elements();
            
            $element = $model->getElement('id');
            $element->setRequired(true);
            $element->addDecorator(new ZendT_Form_Decorator_Hidden());
            $element->setRequired(false);
                    
            $this->addElement($element);

            
            $element = $model->getElement('descricao');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_ini_exec');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_ult_exec');
            $this->addElement($element);

            
            $element = $model->getElement('dh_fim_exec');
            $this->addElement($element);

            
            $element = $model->getElement('tp_frequencia');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('num_frequencia');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('forma_exec');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('procedimento');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('parametro');
            $this->addElement($element);

            
            $element = $model->getElement('tempo_ul_exec');
            $this->addElement($element);

            
            $element = $model->getElement('dh_pro_exec');
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