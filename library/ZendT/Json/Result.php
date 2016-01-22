<?php
/**
 * Classe criada para renderizar JSON em uma action
 * depois colocá-la em um helper para facilitar
 *
 * @author rsantos
 */
class ZendT_Json_Result {
    /**
     *
     * @var array
     */
    private $_data;
    /**
     *
     * @var bool 
     */
    private $_error;
    /**
     * Construtor da classe  ZendT_Json_Result
     */
    public function __construct() {
        Zend_Layout::getMvcInstance()->disableLayout();
        $this->_error = false;
    }
    /**
     * Array de dados que serão transformados em JSON
     * 
     * @param array $data 
     */
    public function setResult($data){
        $this->_data = $data;
        $this->_error = false;
    }
    /**
     * Captura a exceção gerada e trata o retorno para JSON
     * 
     * @param Exception $ex 
     */
    public function setException($ex){        
        $this->_error = true;
        $this->_data = array();
        $this->_data['error'] = true;
        @$this->_data['exception']['code'] = $ex->getCode();
        $this->_data['exception']['message'] = $ex->getMessage();
        @$this->_data['exception']['notification'] = $ex->getNotification();
        if ($this->_data['exception']['notification'] == ''){
            $this->_data['exception']['notification'] = 'Error';
        }
    }
    /**
     * Renderiza os dados para JSON 
     */
    public function render($quotes=true){
        return ZendT_JS_Json::encode($this->_data,$quotes);
    }
    /**
     * Renderiza os dados para JSON no formato RPC
     * 
     * @return string
     */
    public function toRpc($id=''){
        //{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}
        $jsonrpc = array('jsonrpc' => '2.0','id' => $id,'error'=>array());
        if ($this->_error === true){
            $jsonrpc['error']['code'] = $this->_data['exception']['code'];
            $jsonrpc['error']['message'] = $this->_data['exception']['message'];
            $jsonrpc['error']['notification'] = $this->_data['exception']['notification'];
        }else{
            $jsonrpc['result'] = $this->_data;
        }
        return ZendT_JS_Json::encode($jsonrpc);
    }
    
    public function toArray(){
        return $this->_data;
    }
}

?>
