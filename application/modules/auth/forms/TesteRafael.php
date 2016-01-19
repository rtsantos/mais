<?php
    class Auth_Form_TesteRafael extends ZendT_Form {
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
            $model = new Auth_Model_TesteRafael();
            
            $element = $model->getElement('id');
            $this->addElement($element);

            
            $element = $model->getElement('nome');
            $this->addElement($element);

            
            $element = $model->getElement('dt_emissao');
            $this->addElement($element);

            
            $element = $model->getElement('dh_inc');
            $this->addElement($element);

            
            $element = $model->getElement('valor');
            $this->addElement($element);

            
            $element = $model->getElement('aliq');
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