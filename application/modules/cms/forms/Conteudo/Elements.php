<?php

    /**
     * Classe de mapeamento dos pontos de entrada da tabela cms_conteudo
     */
    class Cms_Form_Conteudo_Elements extends Cms_Form_Conteudo_Crud_Elements {

        public function getIdCategoria() {
            $element = parent::getIdCategoria();
            $element->setFieldLevel('nivel');
            $element->setFieldOrder('cms_categoria.chave');
            $element->enableAutoComplete();
            return $element;
        }

        public function getIdConteudoPai() {
            $element = parent::getIdConteudoPai();
            $element->enableAutoComplete();
            return $element;
        }

        public function getCorpo() {
            $element = parent::getCorpo();
            $element->enableEditorHtml();
            return $element;
        }

        public function getArquivo() {
            $element = new ZendT_Form_Element_FileUpload('arquivo');
            $element->setLabel($this->_translate->_('cms_conteudo.arquivo') . ':');
            $element->enableMultiple(false);
            $element->setLoadId(true);
            return $element;
        }

        public function getThumbnail() {
            $element = new ZendT_Form_Element_FileUpload('thumbnail');
            $element->setLabel($this->_translate->_('cms_conteudo.thumbnail') . ':');
            $element->enableMultiple(false);
            $element->setLoadId(true);
            return $element;
        }

        public function getBanner() {
            $element = new ZendT_Form_Element_FileUpload('banner');
            $element->setLabel($this->_translate->_('cms_conteudo.banner') . ':');
            $element->enableMultiple(false);
            $element->setLoadId(true);
            return $element;
        }
        
        public function getIdFilial() {
            $element = parent::getIdFilial();
            $_filial = new Ca_DataView_Filial_MapperView();
            $_where = $_filial->getWhereSeeker();
            $element->setWhere($_where);
            return $element;
        }

    }

?>