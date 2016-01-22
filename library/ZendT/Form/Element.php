<?php

   /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */

   class ZendT_Form_Element extends ZendT_Form_Element_UiWidget {

       const POSITION_PREFIX = 0;
       const POSITION_SUFIX = 1;

       /**
        *
        * @param string $spec
        * @param array $options 
        */
       public function __construct($spec, $options = null) {
           parent::__construct($spec, $options);
           $decorators = array(new ZendT_Form_Decorator_Default());
           $this->setDecorators($decorators);
       }
       /**
        * 
        * @param string $name
        * @return \ZendT_Form_Element
        * @throws Zend_Form_Exception
        */
       public function setName($name) {
           $name = $name;
           if ('' === $name) {
               require_once 'Zend/Form/Exception.php';
               throw new Zend_Form_Exception('Invalid name provided; must contain only valid variable characters and be non-empty');
           }

           $this->_name = $name;
           return $this;
       }
       
       /**
        * 
        * @param string $name
        * @return \ZendT_Form_Element
        * @throws Zend_Form_Exception
        */
       public function setId($name) {
           $name = $this->filterName($name,false);
           if ('' === $name) {
               require_once 'Zend/Form/Exception.php';
               throw new Zend_Form_Exception('Invalid name provided; must contain only valid variable characters and be non-empty');
           }

           $this->setAttrib('id', $name);
           return $this;
       }

       /**
        * Retorna os atributos do elemento tratado
        * 
        * @return array 
        */
       public function getAttribs() {
           $attribs = parent::getAttribs();
           $name = $this->getBelongsTo();
           if ($name) {
               $attribs['name'] = $name . '[' . $this->getName() . ']';
           }
           if (!isset($attribs['id'])) {
               $attribs['id'] = $this->getId();
           }
           if (!$attribs['name']) {
               $attribs['name'] = $id;
           }
           $attribs['caption'] = $this->getLabel();
           #$attribs['value'] = (string) $this->getValue();
           $attribs['value'] = $this->getValue();
           $attribs['belongsTo'] = $this->getBelongsTo();
           if (!$attribs['required']) {
               unset($attribs['required']);
           }
           return $attribs;
       }

       /**
        * Configura um atributo do Box (div que fecha o elemento)
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element 
        */
       public function setAttribBox($name, $value) {
           $box = $this->getAttrib('box');
           $box[$name] = $value;
           $this->setAttrib('box', $box);
           return $this;
       }

       /**
        * Retorna valor do atributo do Box (div que fecha o elemento)
        *
        * @param string $name
        * @param string $value
        * @return \ZendT_Form_Element 
        */
       public function getAttribBox($name) {
           $box = $this->getAttrib('box');
           return $box[$name];
       }

       /**
        * Altera o helpder de renderização do elemento
        *
        * @param string $name
        * @return \ZendT_Form_Element 
        */
       public function setHelper($name) {
           $this->helper = $name;
           return $this;
       }

       /**
        * Retrieve separator
        *
        * @return mixed
        */
       public function getSeparator() {
           return '';
       }

       /**
        * Avaliar se o elemento é um Hidden
        * 
        * @return boolean 
        */
       public function isHidden() {
           $hidden = false;
           $decorators = $this->getDecorators();
           foreach ($decorators as $decorator) {
               if ($decorator instanceof ZendT_Form_Decorator_Hidden) {
                   $hidden = true;
                   break;
               }
           }
           return $hidden;
       }

       /**
        *
        * @param string $name
        * @param string $object
        * @param string $position
        * @return \ZendT_Form_Element 
        */
       public function addObject($name, $object, $position = ZendT_Form_Element::POSITION_PREFIX) {

           return $this;
       }

   }
   