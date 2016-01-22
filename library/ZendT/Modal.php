<?php
/**
 * Classe usada para configurar as abertura de janela modal no
 * html, classe será muita usada em botões que abrem janelas
 * modais.
 *
 * @author rsantos
 */
class ZendT_Modal implements ZendT_JS_Interface{
    /**
     * Largura da janela modal
     * @var int
     */
    private $_width;
    /**
     * Altura da janela modal
     * @var int 
     */
    private $_height;
    /**
     * Função JavaScript para ser executada pelo browser
     * @var String
     */
    private $_onAfterLoad;
    /**
     * Função JavaScript para ser executada pelo browser
     * @var String
     */    
    private $_onBeforeClose;
    /**
     * Função JavaScript para ser executada pelo browser
     * @var String
     */        
    private $_onAfterClose;
    /**
     *
     * @var bool 
     */
    private $_modal;
    /**
     *
     * @var array
     */
    private $_param;
    /**
     *
     * @var string 
     */
    private $_method;
    /**
     *
     * @var string
     */
    private $_type;
    /**
     *
     * @var string
     */
    private $_id;
    /**
     *
     * @var array
     */
    private $_buttons;
    /**
     * Configura a largura da tela Modal
     * @param int $value 
     */
    public function setWidth($value){
        $this->_width = $value;
    }
    /**
     * Configura a altura da tela Modal
     * @param int $value 
     */
    public function setHeight($value){
        $this->_height = $value;
    }
    /**
     * Passa a função JavaScript para ser executada pelo browser
     * 
     * @param string $function
     */
    public function setOnAfterLoad($function){
        $this->_onAfterLoad = $function;
    }
    /**
     * Passa a função JavaScript para ser executada pelo browser
     * 
     * @param string $function
     */
    public function setOnBeforeClose($function){
        $this->_onBeforeClose = $function;
    }
    /**
     * Passa a função JavaScript para ser executada pelo browser
     * 
     * @param string $function
     */
    public function setOnAfterClose($function){
        $this->_onAfterClose = $function;
    }
    /**
     * Configura se a Janela deve ser bloqueada como modal
     * 
     * @param bool $function
     */
    public function setModal($value){
        $this->_modal = $value;
    }    
    /**
     * @param array $values
     */
    public function setParam($values){
        $this->_param = $values;
    }
    /**
     * Configura o método de requisição
     * @example POST, GET
     * 
     * @param string $value
     */
    public function setMethod($value){
        $this->_method = $value;
    }
    /**
     * Configura o tipo da Janela
     * @example AJAX, WINDOW, IFRAME
     * 
     * @param string $value
     */
    public function setType($value){
        $this->_type = $value;
    }
    /**
     * Configura a URL de requisição
     * 
     * @param string $value 
     */
    public function setUrl($value){
        $this->_url = $value;
    }
    /**
     * Configura a identificação da Janela no html/css
     * 
     * @param string $value 
     */
    public function setId($value){
        $this->_id = $value;
    }
    /**
     * Configura os botões de navegação da janela
     * @example array('Salvar'=>'function(){alert('salvei');}')
     *
     * @param array $values 
     */
    public function setButtons($values){
        $this->_buttons = $values;
    }
    /**
     * Configura os botões de navegação da janela
     * @example 'Salvar','function(){alert('salvei');}'
     *
     * @param string $name 
     * @param string $function 
     */
    public function addButton($name,$function){
        $this->_buttons[$name] = $function;
    }
    /**
     * Renderiza o comando JavaScript
     * @return string 
     */
    public function createJS(){
        foreach ($this->_param as $field=>$value){
            $param.= '&'.$field.'='.$value;
        }
        $param = substr($param,1);
        foreach ($this->_buttons as $name=>$function){
            $buttons.= ",'".$name."':".$function;
        }
        $buttons = substr($buttons,1);
        return "
            $('#".$this->_id."').TWindow({
		         url: '{$this->_url}'
		       ,type: '{$this->_type}'
                     ,method: '{$this->_method}'
		      ,param: '{$param}'
		     ,height: {$this->_height}
		      ,width: {$this->_width}
		,onAfterLoad: {$this->_onAfterLoad}
		,beforeClose: {$this->_onBeforeClose}
                      ,close: {$this->_onAfterClose}
		    ,buttons: {{$buttons}}
	              ,modal: {$this->_modal}
            });
        ";
    }
    /**
     * Renderiza o comando JavaScript
     * @return string 
     */
    public function createParamJS(){
        foreach ($this->_param as $field=>$value){
            $param.= '&'.$field.'='.$value;
        }
        $param = substr($param,1);
        foreach ($this->_buttons as $name=>$function){
            $buttons.= ",'".$name."':".$function;
        }
        $buttons = substr($buttons,1);
        return "{url: '{$this->_url}'
               ,type: '{$this->_type}'
             ,method: '{$this->_method}'
	      ,param: '{$param}'
	     ,height: {$this->_height}
	      ,width: {$this->_width}
	,onAfterLoad: {$this->_onAfterLoad}
	,beforeClose: {$this->_onBeforeClose}
              ,close: {$this->_onAfterClose}
	    ,buttons: {{$buttons}}
	      ,modal: {$this->_modal}}";
    }
    public function createHtml(){
        return "<div id=\"{$this->_id}\"></div>";
    }
    /**
     *
     * @return type 
     */
    public function render(){
        return $this->createHtml().'<script>'.$this->createJS().'</script>';
    }
}

?>
