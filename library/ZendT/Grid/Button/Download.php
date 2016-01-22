<?php
/*
 * @category    ZendT
 * @author      rsantos
 * 
 */
class ZendT_Grid_Button_Download extends ZendT_Grid_Button implements ZendT_JS_Interface {

    /**
     *
     * @var type string
     */
    private $_url;
    /**
     * 
     * @var type function
     */
    private $_onAfterLoad;
    
    /**
     *
     * @param type $id 
     */
    public function __construct($id=null){
        parent::__construct($id);
    }
    /**
     *
     * @return string 
     */
    public function getUrl() {
        return $this->_url;
    }
    /**
     *
     * @param type $url
     * @return \ZendT_Grid_Button_Download 
     */
    public function setUrl($url) {
        $this->_url = $url;
        return $this;
    }
    /**
     * 
     */
    public function createJS(){
        $clickFunction = '
            function(){
                jQuery.gridButtonDownload({
                    idGrid : "' . $this->getIdGrid() . '",
                    url : "' . $this->getUrl() . '"
                });
            }
        ';
        return $clickFunction;
    }
    /**
     * Renderiza o botão
     * 
     * @return method 
     */
    public function render(){
        return parent::render();
    }

    public function getOnAfterLoad() {
        return $this->_onAfterLoad;
    }

    public function setOnAfterLoad($onAfterLoad) {
        $this->_onAfterLoad = $onAfterLoad;
        return $this;
    }
}
?>
