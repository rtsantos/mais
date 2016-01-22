<?php
    /**
     * Cria um objeto do tipo Botão
     * 
     * @package ZendT
     * @subpackage Button
     * @category View
     *  
     */
    class ZendT_View_Select extends ZendT_View_Html {

        /**
        * É o ícone da UI provido do theme da UI setado.
        * Se esta opção estiver com 'none', somente o texto será exibido
        * 
        * @var string string
        */
        private $_options;
        
        private $_value;

        /**
        *
        * @param string $id
        * @param string $caption
        * @param string $onClick 
        */
        public function __construct($id, $value, $options=null, $attribs=array()) {
            $this->_options = $options;
            $this->_value = $value;
            $attribs['id'] = $id;
            $attribs['name'] = $id;
            parent::__construct('select',$attribs);
        }
        /**
        * Renderiza o botão da Toolbar
        * 
        * @return string
        */
        public function render() {
            $options = '';
            if (count($this->_options) > 0){
                foreach($this->_options as $key=>$value){
                    if ($this->_value == $key){
                        $options.= '<option value="'.$key.'" selected>'.$value.'</option>';
                    }else{
                        $options.= '<option value="'.$key.'">'.$value.'</option>';
                    }
                }
            }
            $this->setAttr('value', $options);            
            return parent::render();
        }
    }

?>
