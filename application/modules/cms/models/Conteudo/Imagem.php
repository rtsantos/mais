<?php

    class Cms_Model_Conteudo_Imagem extends ZendT_Db_Mapper {

        /**
         *
         * @var \ZendT_Type_FileSystem
         */
        protected $_image;

        /**
         * 
         * @param type $value
         * @param type $type
         * @return \Cms_Model_Imagem_Mapper
         */
        public function setImage($value, $type = 'GRA') {
            $options = array('prop_docto_name' => 'CMS_CONTEUDO_IMG_' . $type);
            $this->_image = $this->_setFileSystem($value, $options);
            return $this;
        }

        /**
         * 
         * @return \ZendT_Type_FileSystem
         */
        public function getImage() {
            return $this->_image;
        }

    }
    