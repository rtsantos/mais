<?php

    /**
     * Zend Framework
     *
     * LICENSE
     *
     * This source file is subject to the new BSD license that is bundled
     * with this package in the file LICENSE.txt.
     * It is also available through the world-wide-web at this URL:
     * http://framework.zend.com/license/new-bsd
     * If you did not receive a copy of the license and are unable to
     * obtain it through the world-wide-web, please send an email
     * to license@zend.com so we can send you a copy immediately.
     *
     * @category    ZendX
     * @package     ZendX_JQuery
     * @subpackage  View
     * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
     * @license     http://framework.zend.com/license/new-bsd     New BSD License
     * @version     $Id: UiWidget.php 20165 2010-01-09 18:57:56Z bkarwin $
     */
    require_once "ZendX/JQuery/Form/Element/UiWidget.php";

    /**
     * Base Form Element for jQuery View Helpers
     *
     * @package    ZendX_JQuery
     * @subpackage Form
     * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
     * @license    http://framework.zend.com/license/new-bsd     New BSD License
     */
    class ZendT_Form_Element_UiWidget extends ZendX_JQuery_Form_Element_UiWidget {

        private $_extra = array();

        public function __construct($spec, $options = null) {
            parent::__construct($spec, $options);
        }

        /**
         * Load default decorators
         *
         * @return void
         */
        public function loadDefaultDecorators() {
            if ($this->loadDefaultDecoratorsIsDisabled()) {
                return;
            }

            $decorators = $this->getDecorators();
            if (empty($decorators)) {
                $this->addDecorator('UiWidgetElement')
                        ->addDecorator('Errors')
                        ->addDecorator('Description', array('tag' => 'div', 'class' => 'description'))
                        ->addDecorator('HtmlTag', array('tag' => 'li'))
                        ->addDecorator('Label', array('tag' => 'li'));
            }
        }

        /**
         * Adiciona uma classe no elemento class
         * 
         * @param string $name
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function addClass($name) {
            $attrClass = $this->getAttrib('class');
            $classes = explode(' ', $attrClass);
            $add = true;
            foreach ($classes as $class) {
                if ($class == $name) {
                    $add = false;
                }
            }
            if ($add) {
                if ($attrClass) {
                    $attrClass.= ' ' . $name;
                } else {
                    $attrClass = $name;
                }
                $this->setAttrib('class', $attrClass);
            }
            return $this;
        }

        /**
         * Remove uma classe do elemento class
         * 
         * @param string $name
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function removeClass($name) {
            $attrClass = $this->getAttrib('class');
            $classes = explode(' ', $attrClass);
            $newClass = '';
            foreach ($classes as $class) {
                if ($class != $name) {
                    $newClass.= ' ' . $class;
                }
            }
            $this->setAttrib('class', substr($newClass, 1));
            return $this;
        }

        /**
         * Adiciona um estilo ao objeto
         * 
         * @param string $name
         * @param value $value
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function addStyle($name, $value) {
            $attrStyle = $this->getAttrib('style');
            $classes = explode(';', $attrStyle);
            $add = true;
            foreach ($classes as $class) {
                $aux = explode(':', $class);
                if ($aux[0] == $name) {
                    $replace = $name . ':' . $value;
                    $attrStyle = str_replace($class, $replace, $attrStyle);
                    $add = false;
                }
            }
            if ($add) {
                $attrStyle .= $name . ':' . $value . ';';
            }
            $this->setAttrib('style', $attrStyle);
            return $this;
        }

        /**
         * Remove um estilo do objeto
         *
         * @param string $name
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function removeStyle($name) {
            $attrStyle = $this->getAttrib('style');
            $styles = explode(';', $attrStyle);
            $newStyle = '';
            foreach ($styles as $style) {
                $aux = explode(':', $style);
                if ($aux[0] != $name) {
                    $newStyle.= $style . ';';
                }
            }
            $this->setAttrib('style', $newStyle);
            return $this;
        }

        /**
         * Troca um valor de um estilo
         *
         * @param string $name
         * @param string $value 
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function replaceStyle($name, $value) {
            $this->removeStyle($name);
            $this->addStyle($name, $value);
            return $this;
        }

        /**
         * Set the view object
         *
         * Ensures that the view object has the jQuery view helper path set.
         *
         * @param  Zend_View_Interface $view
         * @return ZendX_JQuery_Form_Element_UiWidget
         */
        public function setView(Zend_View_Interface $view = null) {
            if (null !== $view) {
                if (false === $view->getPluginLoader('helper')->getPaths('ZendT_View_Helper')) {
                    $view->addHelperPath('ZendT/View/Helper', 'ZendT_View_Helper');
                }
            }
            return parent::setView($view);
        }

        /**
         * 
         * @return \ZendT_Form_Element_UiWidget_UiWidget 
         */
        public function setRequired($value = true) {
            if ($value) {
                $this->addClass('required');
            } else {
                $this->removeClass('required');
            }
            $this->setAttrib('required', $value);
            return parent::setRequired($value);
        }

        /**
         * Adiciona um atributo ao objeto html
         *
         * @param string $name
         * @param string $value
         * @return \ZendT_Form_Element_UiWidget_UiWidget 
         */
        public function setAttrib($name, $value) {
            if (substr($name, 0, 4) == 'css-') {
                $this->addStyle(substr($name, 4), $value);
            } else {
                return parent::setAttrib($name, $value);
            }
            return $this;
        }

        public function addValidator($validator, $breakChainOnFailure = false, $options = array()) {
            $validatorComparador = strtolower($validator);
            if ($validatorComparador == 'time' && !in_array('time', $classExp)) {
                $validator = new ZendT_Form_Validator_Time();
                $this->addClass('time');
            } else if ($validatorComparador == 'date' && !in_array('date', $classExp)) {
                $validator = new ZendT_Form_Validator_Date();
                $this->addClass('date');
            } else if ($validatorComparador) {
                $this->addClass($validatorComparador);
            }
            return parent::addValidator($validator, $breakChainOnFailure, $options);
        }

        /**
         *
         * @param type $name
         * @param type $value
         * @return \ZendT_Form_Element_UiWidget 
         */
        public function addAttr($name, $value) {
            $this->setAttrib($name, $value);
            return $this;
        }

        /**
         * Adiciona um item extra para o elemento
         * 
         * 
         * @param string $key
         * @param string $valor 
         * 
         * 
         */
        public function addExtra($key, $valor) {
            $this->_extra[$key] = $valor;
        }

        /**
         * Adiciona varios itens extras para o elemento de uma vez
         * 
         * 
         * @param array $arrayParam 
         */
        public function addExtras($arrayParam) {
            $this->_extra = array_merge($this->_extra, $arrayParam);
        }

        /**
         * Retorno o atributo da propriedade de id do elemento
         *
         * @return string 
         */
        public function getId() {
            $id = parent::getId();
            if (!$id) {
                $this->setAttrib('id', $this->getName());
                $id = parent::getId();
            }
            return $id;
        }

    }