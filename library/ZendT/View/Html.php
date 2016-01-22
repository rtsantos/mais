<?php

/**
 * Class para renderizar comandos HTML
 * 
 * @package ZendT
 * @subpackage ZendT_Html
 * @category Html
 * @author rsantos 
 */
class ZendT_View_Html extends Zend_View_Helper_HtmlElement {

    /**
     *
     * @var string
     */
    protected $_elementName;

    /**
     *
     * @var array
     */
    protected $_attribs;

    /**
     *
     * @var array
     */
    protected $_elementSigle;

    /**
     *
     * @param string $elementName
     * @param array $attribs 
     */
    public function __construct($elementName, $attribs = null) {
        $this->_elementName = strtolower($elementName);
        $this->_elementSigle['br'] = 'br';
        $this->_elementSigle['input'] = 'input';
        $this->_elementSigle['img'] = 'img';
        if (is_array($attribs)) {
            $this->setAttribs($attribs);
        }
    }

    /**
     * Retrieve view object
     *
     * If none registered, attempts to pull from ViewRenderer.
     *
     * @return Zend_View_Interface|null
     */
    public function getView() {
        if (null === $this->view) {
            //$this->view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
            //require_once 'Zend/Controller/Action/HelperBroker.php';
            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
            $this->setView($viewRenderer->view);
        }
        return $this->view;
    }

    /**
     * Configura os atributos
     * 
     * @param array $attribs
     * @return \ZendT_Html 
     */
    public function setAttribs($attribs) {
        if (is_array($attribs)) {
            foreach ($attribs as $name => $value) {
                $this->setAttr($name, $value);
            }
        }
        return $this;
    }

    /**
     * Retorna os atributos
     * 
     * @return array
     */
    public function getAttribs() {
        return $this->_attribs;
    }

    /**
     * Configura um atributo
     * 
     * @param string $name
     * @param string $value
     * @return \ZendT_Html 
     */
    public function setAttr($name, $value) {
        if ($name == 'id') {
            $value = $this->_normalizeId($value);
        }
        $this->_attribs[$name] = $value;
        return $this;
    }

    /**
     * Retorna o atributo
     * 
     * @param string $name
     * @return string
     */
    public function getAttr($name) {
        return $this->_attribs[$name];
    }

    /**
     * Adiciona uma valor a um atribulto
     * 
     * @param string $name
     * @param string $value
     * @return \ZendT_View_Html 
     */
    public function addAttr($name, $value) {
        $this->_attribs[$name].= $value;
        return $this;
    }

    /**
     * Adiciona uma classe no elemento class
     * 
     * @param string $name
     * @return \ZendT_Html 
     */
    public function addClass($name) {
        $class = $this->_attribs['class'];
        $classes = explode(' ', $class);
        $add = true;
        foreach ($classes as $class) {
            if ($class == $name) {
                $add = false;
            }
        }
        if ($add) {
            if ($this->_attribs['class']) {
                $this->_attribs['class'].= ' ' . $name;
            } else {
                $this->_attribs['class'] = $name;
            }
        }
        return $this;
    }

    /**
     * Remove uma classe do elemento class
     * 
     * @param string $name
     * @return \ZendT_Html 
     */
    public function removeClass($name) {
        $class = $this->_attribs['class'];
        $classes = explode(' ', $class);
        $newClass = '';
        foreach ($classes as $class) {
            if ($class != $name) {
                $newClass.= ' ' . $class;
            }
        }
        $newClass = substr($newClass, 1);
        $this->_attribs['class'] = $newClass;
        return $this;
    }

    /**
     * Adiciona um estilo ao objeto
     * 
     * @param string $name
     * @param value $value
     * @return \ZendT_View_Html 
     */
    public function addStyle($name, $value) {
        $class = $this->_attribs['style'];
        $classes = explode(';', $class);
        $add = true;
        foreach ($classes as $class) {
            $aux = explode(':', $class);
            if ($aux[0] == $name) {
                $add = false;
            }
        }
        if ($add) {
            $this->_attribs['style'].= $name . ':' . $value . ';';
        }
        return $this;
    }

    /**
     * Remove um estilo do objeto
     *
     * @param string $name
     * @return \ZendT_View_Html 
     */
    public function removeStyle($name) {
        $style = $this->_attribs['style'];
        $styles = explode(';', $class);
        $newStyle = '';
        foreach ($styles as $style) {
            $aux = explode(':', $style);
            if ($aux[0] != $name) {
                $newStyle.= $style . ';';
            }
        }
        $this->_attribs['style'] = $newStyle;
        return $this;
    }
    /**
     *
     * @param string $name
     * @return boolean 
     */
    public function getStyle($name){
        $style = $this->_attribs['style'];
        $styles = explode(';', $class);
        foreach ($styles as $style) {
            $aux = explode(':', $style);
            if ($aux[0] == $name) {
                return $aux[1];
            }
        }
        return false;
    }

    /**
     * Retorna a identificação do elemento html
     *
     * @param string $value
     * @return string
     */
    public function getId() {
        return $this->getAttr('id');
    }

    /**
     * Configura a identificação do elemento html
     * 
     * @param string $value
     * @return \ZendT_Html  
     */
    public function setId($value) {
        $this->setAttr('id', $value);
        return $this;
    }

    /**
     * Configura o JavaScript a ser executado no carregamento
     *
     * @param string $name
     * @param string $js
     * @return \ZendT_View_Html 
     */
    public function addOnLoad($name, $js) {
        $this->getView();
        $onLoad = $this->view->placeholder('onLoad')->getValue();
        $onLoad[$name] = $js;
        $this->view->placeholder('onLoad')->set($onLoad);
        return $this;
    }

    /**
     * Adiciona um script
     * 
     * @param string $path
     * @return \ZendT_View_Html 
     */
    public function addHeadScriptFile($path) {
        $this->getView();
        $appendScript = $this->view->placeholder('headScriptFile')->getValue();
        $appendScript[] = $path;
        $this->view->placeholder('headScriptFile')->set($appendScript);
        return $this;
    }

    /**
     * Adiciona um script
     * 
     * @param string $path
     * @return \ZendT_View_Html 
     */
    public function addHeadScript($name, $command) {
        $this->getView();
        $appendFunction = $this->view->placeholder('headScriptCommand')->getValue();
        $appendFunction[$name] = $command;
        $this->view->placeholder('headScriptCommand')->set($appendFunction);
        return $this;
    }

    /**
     * Renderiza o elemento em uma string html
     * 
     * @return string 
     */
    public function render() {
        $this->getView();
        $value = '';
        if (!isset($this->_elementSigle[$this->_elementName])) {
            $value = $this->_attribs['value'];
            unset($this->_attribs['value']);
        }
        $cmd = '<' . $this->_elementName;
        $cmd.= ' ' . $this->_htmlAttribs($this->_attribs);
        if (isset($this->_elementSigle[$this->_elementName])) {
            $cmd.= ' ' . $this->_closingBracket();
        } else {
            $cmd.= '>' . $value . '</' . $this->_elementName . '>';
        }
        return $cmd;
    }

    /**
     * Cria um elemento html
     * 
     * @param string $elementName
     * @param string $attribs
     * @return \ZendT_Html
     */
    public static function create($elementName, $id, $attribs = null) {
        if (is_array($attribs)) {
            $attribs['id'] = $id;
        } else {
            $attribs = array('id' => $id);
        }
        $element = new ZendT_Html($elementName, $attribs);
        return $element;
    }

    /**
     * Cria um elemento input com base no tipo passado
     * 
     * @param string $type @example text,button,password,
     * @param type $attribs
     * @return \ZendT_Html 
     */
    public static function input($type, $name, $attribs = null) {
        if (is_array($attribs)) {
            $attribs['type'] = $type;
            $attribs['name'] = $name;
            if (!$attribs['id']) {
                $attribs['id'] = $name;
            }
        } else {
            $attribs = array('type' => $type, 'name' => $name, 'id' => $name);
        }
        $element = new ZendT_Html($elementName, array('type' => $type) + $attribs);
        return $element;
    }

    /**
     * Sobrecarga para transformar o objeto em string
     * 
     * @return string
     */
    public function __toString() {
        return $this->render();
    }

}

?>
