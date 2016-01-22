<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    class ZendT_Form_Element_Textarea extends ZendT_Form_Element {

        public $helper = "Textarea";
        /**
         *
         * @var bool
         */
        private $_isEditorHtml = false;
        /**
         * 
         * @param bool $value
         * @return \ZendT_Form_Element_Textarea
         */
        public function enableEditorHtml($value=true){
            $this->setAttribBox('css-clear', 'both');
            $this->setAttrib('editor-html', 'full');
            return $this->_setEditor($value);
        }
        
        /**
         * 
         * @param bool $value
         * @return \ZendT_Form_Element_Textarea
         */
        public function editorHtml($value='basic'){
            $this->setAttrib('editor-html', $value);
            return $this->_setEditor($value);
        }
        /**
         * 
         * @return boolean
         */
        public function isEditorHtml(){
            return $this->_isEditorHtml;
        }
        /**
         * 
         * @return array
         */
        protected function _getEditor(){
            $editor = $this->getAttrib('editor');
            if (!$editor){
                $editor = array(
                   'listBox' => array(),
                   'buttons' => array(),
                   'height' => 268,
                   'width' => 730
                );
            }
            return $editor;
        }
        /**
         * 
         * @param bool|array $value
         * @return \ZendT_Form_Element_Textarea
         */
        protected function _setEditor($value){
            if ($value){
                if (!is_array($value)){
                    $value = $this->_getEditor();
                }
                $this->setAttrib('editor', $value);
                $this->_isEditorHtml = true;
            }else{
                $this->setAttrib('editor', false);
                $this->_isEditorHtml = false;
            }
            return $this;
        }
        /**
         * 
         * @param string $name
         * @param array $itens
         * @return \ZendT_Form_Element_Textarea
         */
        public function addListBox($name,$itens){
            $editor = $this->_getEditor();
            $editor['listBox'][$name] = $itens;
            return $this->_setEditor($editor);
        }
        /**
         * 
         * @param array $value
         * @return \ZendT_Form_Element_Textarea
         */
        public function setListBox($value){
            $editor = $this->_getEditor();
            $editor['listBox'] = $value;
            return $this->_setEditor($editor);
        }
        /**
         * 
         * @param string $name
         * @param string $label
         * @param string $icon
         * @param string $command
         * @return \ZendT_Form_Element_Textarea
         */
        public function addButton($name,$label,$icon,$command){
            $editor = $this->_getEditor();
            $button = array(
               'label' => $label,
               'icon' => $icon,
               'command' => $command,
            );
            $editor['buttons'][$name] = $button;
            return $this->_setEditor($editor);
        }
        /**
         * 
         * @param string $name
         * @return string
         */
        public function makeCommandButtonSession($name){
            $command = '
                editor.focus();
                var textSelect = editor.selection.getContent();
                if (textSelect != ""){
                    editor.selection.setContent("{begin'.$name.'}"+ textSelect +"{end'.$name.'}");
                }';
            return $command;
        }
        /**
         * 
         * @param string $name
         * @return string
         */
        public function makeCommandButtonTag($name){
            $command = '
                editor.focus();
                var textSelect = editor.selection.getContent();
                if (textSelect != ""){
                    editor.selection.setContent("<'.$name.'>"+ textSelect +"</'.$name.'>");
                }';
            return $command;
        }
        /**
         * 
         * @return array
         */
        public function getListBox(){
            $editor = $this->_getEditor();
            return $editor['listBox'];
        }
        /**
         * 
         * @param int $value
         * @return \ZendT_Form_Element_Textarea
         */
        public function setWidth($value){
            $editor = $this->_getEditor();
            $editor['width'] = $value;
            return $this->_setEditor($editor);
        }
        /**
         * 
         * @return int
         */
        public function getWidth(){
            $editor = $this->_getEditor();
            return $editor['width'];
        }
        /**
         * 
         * @param int $value
         * @return \ZendT_Form_Element_Textarea
         */
        public function setHeight($value){
            $editor = $this->_getEditor();
            $editor['height'] = $value;
            return $this->_setEditor($editor);
        }
        /**
         * 
         * @return int
         */
        public function getHeight(){
            $editor = $this->_getEditor();
            return $editor['height'];
        }

    }

?>
