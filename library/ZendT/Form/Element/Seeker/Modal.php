<?php

    class ZendT_Form_Element_Seeker_Modal {

        private $_width;
        private $_height;
        private $_typeModal;

        public function setTypeModal($value) {
            $this->_typeModal = $value;
            return $this;
        }

        public function setWidth($value) {
            $this->_width = $value;
            return $this;
        }

        public function setHeight($value) {
            $this->_height = $value;
            return $this;
        }

        public function getHeight() {
            return $this->_height;
        }

        public function getWidth() {
            return $this->_width;
        }

        public function getTypeModal() {
            return $this->_typeModal;
        }

        public function toArray() {
            $aRetorno = array();
            if ($this->_width) {
                $aRetorno['width'] = $this->_width;
            } else {
                $aRetorno['width'] = 800;
            }
            if ($this->_height) {
                $aRetorno['height'] = $this->_height;
            } else {
                $aRetorno['height'] = 400;
            }
            if ($this->_typeModal) {
                $aRetorno['type'] = $this->_typeModal;
            } else {
                $aRetorno['type'] = 'WINDOW';
            }
            return $aRetorno;
        }

    }