<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */
class ZendT_Grid_Methods implements ZendT_JS_Interface{

    /**
     * @var integer
     */
    private $_idGrid;

    /**
     *
     * @var array 
     */
    private $_postDataMethods=array();

    /**
     * @var type 
     */
    private $_js;

    public function __construct( $id ){
        $this->_postDataMethods = array();
        $this->setIdGrid($id);
    }

    public function getIdGrid() {
        return $this->_idGrid;
    }

    public function setIdGrid($idGrid) {
        $this->_idGrid = $idGrid;
        return $this;
    }

    public function getPostData() {
        return $this->_postDataMethods;
    }

    public function setPostData($postData) {
        $this->_postDataMethods = $postData;
        return $this;
    }

    public function setMethodPostData( $key, $value = null ){
        if( $value ) {
            $this->_postDataMethods[$key] = $value;
        } else {
            $this->_postDataMethods[$key];
        }
        return $this;
    }

    public function getJs() {
        return $this->_js;
    }

    public function setJs($js) {
        $this->_js = $js;
        return $this;
    }

    
    public function createJS() {
        ob_start();        
        foreach( $this->getPostData() as $key => $value ){
            if($value){
                echo '$("#' . $this->getIdGrid() . '").' . $key . '(' . $value . ');';
            } else {
                echo '$("#' . $this->getIdGrid() . '").' . $key . '(' . $value . ')';
            }
        }
        return ob_get_clean();
    }

    public function render() {
        $this->setJs($this->createJS());
        return $this->getJs();
    }
}
?>