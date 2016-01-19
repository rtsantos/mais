<?php

   /**
    * Classe de mapeamento dos pontos de entrada da tabela cms_categoria
    */
   class Cms_Form_Categoria_Elements extends Cms_Form_Categoria_Crud_Elements {

       public function getIdCategoriaPai() {
           $element = parent::getIdCategoriaPai();
           $element->enableAutoComplete();
           return $element;
       }

       public function getThumbnail() {
           $element = new ZendT_Form_Element_FileUpload('thumbnail');
           $element->setLabel($this->_translate->_('cms_conteudo.thumbnail') . ':');
           $element->enableMultiple(false);
           $element->setLoadId(true);
           return $element;
       }

   }

?>