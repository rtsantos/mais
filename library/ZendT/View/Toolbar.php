<?php
/**
 * Cria um objeto do Toolbar
 * 
 * @package ZendT
 * @subpackage Toolbar
 * @category View
 *  
 */
class ZendT_View_Toolbar extends ZendT_View_Html {

    /**
     * Botões da Toolbar
     * 
     * @var ZendT_View_Button[] 
     */
    private $_buttons;

    /**
     *
     * @var string
     */
    private $_float;

    /**
     * Construtor da classe de criação de Toolbar
     *
     * @param string $name Identificação da Toolbar
     * @param array $attribs 
     */
    public function __construct($name, $attribs = null) {
        if (!is_array($attribs)) {
            $attribs = array();
        }
        $attribs['id'] = $name;
        $attribs['class'] = 'ui-group ui-menu-fluig';
        $attribs['width'] = '100%';
        //$attribs['style'] = 'margin-bottom: 5px;';
        //$attribs['style'] = 'padding: 2px; height: 36px;';
        $this->_float = 'left';
        parent::__construct('div', $attribs);
    }

    /**
     * Adiciona um botão na Toolbar
     * 
     * @param ZendT_View_Button $button 
     * @param string $name
     * @return \ZendT_View_Toolbar
     */
    public function addButton(ZendT_View_Button $button, $name = null) {
        if ($name == null) {
            $name = $button->getId();
        }
        $button->addClass('item');
        $this->_buttons[$name] = $button;
        $this->_buttonsOrder[] = $name;
        return $this;
    }
    /**
     * 
     * @param ZendT_View_Html $object
     * @param string $name
     * @return \ZendT_View_Toolbar
     */
    public function addObject(ZendT_View_Html $object, $name=null){
        if ($name == null) {
            $name = $object->getId();
        }
        $object->addClass('item');
        $this->_buttons[$name] = $object;
        $this->_buttonsOrder[] = $name;
        return $this;
    }
    /**
     *
     * @param ZendT_View $object
     * @param string $name 
     */
    public function add($object,$name=''){
        if ($name == null) {
            $name = $object->getId();
        }
        $object->addClass('item');
        $this->_object[$name] = $object;
        $this->_objectOrder[] = $name;
    }
    /**
     * Retorna o botão
     * 
     * @param string $name
     * @return ZendT_View_Button 
     */
    public function getButton($name) {
        return $this->_buttons[$name];
    }

    /**
     * Retorna para qual posição os botões da toolbar vai flutuar
     * @return type 
     */
    public function getFloat() {
        return $this->_float;
    }

    /**
     * Configura para qual posição os botões da toolbar vai flutuar
     *
     * @param string $value @example left|right
     * @return \ZendT_View_Toolbar 
     */
    public function setFloat($value) {
        $this->_float = $value;
        return $this;
    }

    /**
     * Renderiza o objeto para uma string html
     */
    public function render() {
        $this->_attribs['value'] = '';
        

        if ($this->_object){
            foreach($this->_object as $name => $value){
                $this->_attribs['value'].= $value->render();
            }
        }
        
        
        for ($i = 0; $i < count($this->_buttons); $i++) {
            $name = $this->_buttonsOrder[$i];
            if ($this->_float)
                $this->_buttons[$name]->addStyle('float', $this->_float);
            $this->_attribs['value'].= $this->_buttons[$name]->render();
        }

        return parent::render() . '<div style="clear: both;"></div>';
    }

}
?>