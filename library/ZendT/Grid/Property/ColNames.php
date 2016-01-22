<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */
class ZendT_Grid_Property_ColNames implements ZendT_JS_Interface {

    /**
     *
     * @var type string[]
     */
    private $_names;

    /**
     *
     * @var type string
     */
    private $_js;

    public function __construct(){
        
    }

    public function getNames() {
        return $this->_names;
    }

    public function setNames( $colunas ) {
        foreach( $colunas as $coluna ){
            $this->_names[] = $coluna->getHeaderName();
        }
        return $this;
    }

    public function setName( $value ){
        $this->_names[] = $value;
    }

    public function getJS() {
        return $this->_js;
    }

    public function setJS($js) {
        $this->_js = $js;
    }

    public function createJS(){
        $js = '';

        foreach( $this->getNames() as $name ){
            $js .= "'" . $name . "',";
        }
        $js = rtrim($js,',');
        return $js;
    }

    public function render(){
        $this->setJS($this->createJS());
        return $this->getJS();
    }

}
?>
