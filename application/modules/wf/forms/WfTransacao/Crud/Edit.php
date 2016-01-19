<?php
    class Wf_Form_WfTransacao_Crud_Edit extends ZendT_Form {
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
            $model = new Wf_Model_WfTransacao_Table();
            
            $element = $model->getElement('id_wf_fase');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_objeto');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('id_usuario_aloc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $element->setRequired(true);
            $this->addElement($element);

            
            $element = $model->getElement('observacao');
            $this->addElement($element);

            
                
            /*$element = new ZendT_Form_Element_SubmitAjax('Salvar');
            $this->addElement($element);*/
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