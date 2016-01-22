<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */
class ZendT_Grid_Button extends ZendT_View_Button {

    /**
     *
     * @var type string
     */
    private $_idGrid;

    /**
     * A descrição do botão.
     * É possível setá-la com vazia
     * 
     * @var type string
     */
    private $_caption;

    /**
     * É o ícone da UI provido do theme da UI setado.
     * Se esta opção estiver com 'none', somente o texto será exibido
     * 
     * @var type string
     */
    private $_buttonicon;

    /**
     * @var type array 
     */
    private $_functions;

    /**
     * Valores possíveis 'first' ou 'last'.
     * Posição onde o botão será adicionado
     * Antes ou depois dos botões padrões
     * 
     * @var type string
     */
    private $_position;

    /**
     * Tooltip do botão
     * 
     * @var type string
     */
    private $_title;

    /**
     * Determina como o cursor será exibido quando
     * passarmos o mouse sobre o elemento
     * 
     * @var type string
     * @default pointer
     */
    private $_cursor;

    /**
     * Opção opcional.
     * Se for setado, define o id do botão para futuras manipulações de dados
     * 
     * @var type string
     */
    private $_id;

    /**
     *
     * @var type 
     */
    private $_isToolbar = false;

    /**
     *
     * @var type 
     */
    private $_isNavigator = false;

    /**
     * @var type array
     */
    private $_options;

    /**
     *
     * @var type string
     */
    private $_typeModal;

    /**
     *
     * @var type string
     */
    private $_modal;

    public function __construct($id=null){
        if($id === null){
            $id = 'idButton_'.  rand(1, 9999999999);
        }
        parent::__construct($id);
        $this->setAttr('id', $id);
    }
    
    protected function _getFunctionName(){
        return 'onClickButton_'.$this->getId();
    }

    public function getButtonIcon() {
        return $this->getIcon();
    }

    public function setButtonIcon($buttonicon) {
        $this->setIcon($buttonicon);
        $this->_buttonicon = $buttonicon;
        return $this;
    }

    public function getFunctions() {
        return $this->_functions;
    }

    public function setFunctions( $functions ) {
        $this->_functions = $functions;
        $this->_options['functions'] = $functions;
        return $this;
    }

    public function setFunction( $key, $function ){
        $this->_functions[$key] = $function;
        $this->_options['functions'] = $this->getFunctions();
        return $this;
    }

    public function getFunction( $key ){
        return $this->_options[$key];
    }

    public function getIdGrid() {
        return $this->_idGrid;
    }

    public function setIdGrid($idGrid) {
        $this->_idGrid = $idGrid;
        return $this;
    }

    public function isToolbar() {
        return $this->_isToolbar;
    }

    public function setToolbar($isToolbar) {
        $this->_isToolbar = $isToolbar;
        return $this;
    }

    public function isNavigator() {
        return $this->_isNavigator;
    }

    public function setNavigator($isNavigator) {
        $this->_isNavigator = $isNavigator;
        return $this;
    }

    public function getOptions() {
        return $this->_options;
    }

    public function setOptions($options) {
        $this->_options = $options;
        return $this;
    }

    public function getPosition() {
        return $this->_position;
    }

    public function setPosition($position) {
        $this->_position = $position;
        $this->_options['position'] = $position;
        return $this;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function setTitle($title) {
        $this->_title = $title;
        $this->_options['title'] = $title;
        $this->setAttr('popover-title', $title);
        return $this;
    }

    public function getCursor() {
        return $this->_cursor;
    }

    public function setCursor($cursor) {
        $this->_cursor = $cursor;
        $this->_options['cursor'] = $cursor;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        $this->_options['id'] = $id;
        return $this;
    }

    public function getJS() {
        return $this->_js;
    }

    public function setJS($js) {
        $this->_js = $js;
        return $this;
    }

    public function getTypeModal() {
        return $this->_typeModal;
    }

    public function setTypeModal($typeModal) {
        $this->_typeModal = $typeModal;
        return $this;
    }

    public function getModal() {
        return $this->_modal;
    }

    public function setModal($modal) {
        $this->_modal = $modal;
        return $this;
    }

    /*public function create(){
        if( $this->isNavigator() ){
            return $this->createNavButtonAddMethodJS();
        } else if ( $this->isToolbar() ) {
            return $this->createTollbarButtonAddMethodJS();
        }
    }*/

    public function createNavButtonAddMethodJS(){
        /*$js =   '.navButtonAdd("#pager-' . $this->getIdGrid() . '",{';
                    foreach( $this->getOptions() as $key => $option ){
                        if(is_array($option)){
                            foreach( $option as $index => $item ){                                
                                $js .= $index . ':' . $item . ',';
                            }
                        } else {
                            $js .= $key . ':"' . $option . '",';
                        }
                    }
                    $js = rtrim($js,',');
        $js .=   '})';

        return $js;*/
        
        $js = ".appendToolbar('" . $this->getIdGrid() . "','".str_replace(array(chr(10),chr(13)),array('',''),$button->render())."')";
        return $js;
    }

    public function createTollbarButtonAddMethodJS(){
        $js = ".appendToolbar('" . $this->getIdGrid() . "','".str_replace(array(chr(10),chr(13)),array('',''),$button->render())."')";
        return $js;
        
        /*$js =   '.toolbarButtonAdd("' . $this->getIdGrid() . '",{';
                    foreach( $this->getOptions() as $key => $option ){
                        if(is_array($option)){
                            foreach( $option as $index => $item ){                                
                                $js .= $index . ':' . $item . ',';
                            }
                        } else {
                            $js .= $key . ':"' . $option . '",';
                        }
                    }
                    $js = rtrim($js,',');
        $js .=   '})';

        return $js;*/
    }
    /**
     *
     * @param string $function
     * @return \ZendT_Grid_Button 
     */
    public function setOnClick($function){
        $this->_onClick = $function;
        return $this;
    }
    /**
     *
     * @return string
     */
    public function getOnClick(){
        return $this->_onClick;
    }
    /**
     *
     * @return string
     */
    public function createJS(){
        return $this->getOnClick();
    }
    /**
     *
     * @return string
     */
    public function render(){
        //$js = ".appendToolbar('" . $this->getIdGrid() . "',{id:'".$this->getId()."',onClick:".$this->createJS().",html:'".str_replace(array(chr(10),chr(13)),array('',''),  parent::render())."'})";
        $js = ".appendToolbar('".str_replace(array(chr(10),chr(13)),array('',''),  parent::render())."')";
        return $js;
    }
    /**
     * Renderiza o botão apenas usando o Html
     * 
     * @return string
     */
    public function renderHtml(){
        //$param['onClick'] = new ZendT_JS_Command();
        $js = $this->createJS();
        $js = str_replace('function', 'function ' . $this->getId(), $js);
        parent::setOnClick($this->getId().'();');
        
        //$this->cli
        $this->addHeadScript($this->getId(), $js);
        //$this->addHeadScriptFile(ZendT_Url::getBaseDiretoryPublic().'/scripts/jquery/widget/TButton.js');
        return parent::render();
    }
}
?>
