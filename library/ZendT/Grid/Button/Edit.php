<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */

class ZendT_Grid_Button_Edit extends ZendT_Grid_Button implements ZendT_JS_Interface {

    /**
     *
     * @var type string
     */
    private $_url;
    /**
     * Seta a URL de retorno dos dados para edição no formulário
     * 
     * @var type 
     */
    private $_urlRetrive;
    /**
     *
     * @var type numeric
     */
    private $_windowHeight = 520;

    /**
     *
     * @var type numeric
     */
    private $_windowWidth = 720;

    /**
     * 
     * @var type function
     */
    private $_onAfterLoad;

    /**
     *
     * @var type string
     */
    private $_modal = 'true';

    /**
     *
     * @var type string
     */
    private $_type = 'WINDOW';

    public function __construct($id=null) {
        parent::__construct($id);
    }

    public function getUrl() {
        return $this->_url;
    }

    public function setUrl($url) {
        $this->_url = $url;
        return $this;
    }
    
    public function getUrlRetrive() {
        return $this->_urlRetrive;
    }
    /**
     * 
     * @return string
     */
    public function getUrlRetrieve() {
        return $this->_urlRetrive;
    }

    /**
     * 
     * @param string $url
     * @return \ZendT_Grid_Button_Edit
     */
    public function setUrlRetrive($url) {
        return $this->setUrlRetrieve($url);
    }
    /**
     * 
     * @param string $url
     * @return \ZendT_Grid_Button_Edit
     */
    public function setUrlRetrieve($url) {
        $this->_urlRetrive = $url;
        return $this;
    }

    public function getWindowHeight() {
        return $this->_windowHeight;
    }

    public function setWindowHeight($windowHeight) {
        $this->_windowHeight = $windowHeight;
        return $this;
    }

    public function getWindowWidth() {
        return $this->_windowWidth;
    }

    public function setWindowWidth($windowWidth) {
        $this->_windowWidth = $windowWidth;
        return $this;
    }

    public function getOnAfterLoad() {
        return $this->_onAfterLoad;
    }

    public function setOnAfterLoad($onAfterLoad) {
        $this->_onAfterLoad = $onAfterLoad;
        return $this;
    }

    public function getModal() {
        return $this->_modal;
    }

    public function setModal($modal) {
        $this->_modal = $modal;
        return $this;
    }

    public function getType() {
        return $this->_type;
    }

    public function setType($type) {
        $this->_type = $type;
        return $this;
    }
    
    public function setAfterLoad($value){
        $this->_afterLoad = $value;
        return $this;
    }
    
    public function getAfterLoad(){
        return $this->_afterLoad;
    }
    
    public function createJS() {
        $clickFunction = '
            function (){
                jQuery.gridButtonEdit({
                    idGrid: "' . $this->getIdGrid() . '",
                    url: "' . $this->getUrl() . '",
                    urlRetrive: "' . $this->getUrlRetrieve() . '",
                    windowHeight: ' . $this->getWindowHeight() . ',
                    windowWidth: ' . $this->getWindowWidth() . ',
                    afterLoad: '.($this->getAfterLoad()?'true':'false').',
                    modal:"' . $this->getModal() . '",
                    type: "' . $this->getType() . '"
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

}

?>
