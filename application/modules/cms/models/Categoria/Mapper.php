<?php

   /**
    * Classe de mapeamento do registro da tabela cms_categoria
    */
   class Cms_Model_Categoria_Mapper extends Cms_Model_Categoria_Crud_Mapper {

       public function setThumbnail($value, $options = array()) {
           $options+= array('prop_docto_name' => 'CMS_CATEGORIA_THUMBNAIL');
           $this->_data['thumbnail'] = $this->_setFileSystem($value, $options);
           return $this;
       }

       private function _parentKey($id) {
           $_categoria = new Cms_Model_Categoria_Mapper();
           $_categoria->setId($id)->retrieve();

           $result[] = $_categoria->getDescricao(true)->get();

           $parent = $_categoria->getIdCategoriaPai(true)->toPhp();
           $recursive = array();
           if ($parent) {
               $recursive = $this->_parentKey($parent);
           }
           return array_merge($result, $recursive);
       }

       public function _beforeSave() {
           parent::_beforeSave();
           if ($this->_action == 'delete') {
               //throw new ZendT_Exception("Não é possível excluir uma categoria.<br/>Para esse efeito, inative o registro.");
           } else {
               $parent = $this->getIdCategoriaPai(true)->toPhp();
               $recursive = array();
               if ($parent) {
                   $recursive = $this->_parentKey($parent);
                   $recursive = array_reverse($recursive);
               }
               $recursive[] = $this->getDescricao(true)->get();
               $chave = implode('_', $recursive);
               //throw new ZendT_Exception($chave);

               $this->setChave($chave);

               if ($this->_action == 'insert') {
                   if (!$this->getPublico(true)->toPhp()) {
                       $this->setPublico('S');
                   }
                   if (!$this->getStatus(true)->toPhp()) {
                       $this->setStatus('A');
                   }
                   if (!$this->getMenu(true)->toPhp()) {
                       $this->setMenu('N');
                   }
                   /* if ($this->getDhIniPub()->toPhp() <= $now->toPhp()) {
                     throw new ZendT_Exception("Data/Hora início da publicação deve ser maior que a data/hora atual!");
                     } */
               }

               $urlMacro = $this->getUrlMacro(true)->get();
               if ($urlMacro) {
                   $data = $this->getData();

                   preg_match_all("/\{(.*?)\}/", $urlMacro, $replace);
                   foreach ($replace[1] as $field) {
                       if ($field == 'baseUrl') {
                           continue;
                       }
                       if (isset($data[$field])) {
                           $field = trim($field);
                           $valueField = $data[$field]->toPhp();
                           $urlMacro = str_replace('{' . $field . '}', $valueField, $urlMacro);
                       }
                   }
                   //$url = str_replace(array('/', '\\', '|', ' '), '-', $urlMacro);
                   //$url = ZendT_Url::formatUrl($url);
                   $this->setUrl($urlMacro);
               }
           }
       }

       public function _afterSave() {
           parent::_afterSave();
           if ($this->_action == 'insert') {
               /*$_privCateg = new Cms_Model_PrivCateg_Mapper();
               $_privCateg->addPrivCateg($this->getId(), '', 'A');*/
           }
       }

       public function getIdByDescricao($descricao) {
           $this->newRow();
           $this->setMenu('N');
           $this->setDescricao($descricao);
           if (!$this->exists()) {
               throw new ZendT_Exception("Categoria {$descricao} não encontrada!");
           }
           $id = $this->retrieve()->getId()->toPhp();
           return $id;
       }

       public function delete($where = null) {
           $_categoria = new Cms_DataView_Categoria_MapperView();
           $_categoria->populate($this->getData())->findAll(null, '*');
           while ($_categoria->fetch()) {
               $_privCateg = new Cms_Model_PrivCateg_Mapper();
               $_privCateg->setIdCategoria($_categoria->getId())->delete();
               $_categoria2 = new Cms_DataView_Categoria_MapperView();
               if ($_categoria2->newRow()->setIdCategoriaPai($_categoria->getId())->exists()) {
                   $_categoria2->delete();
               }
           }

           /* $_categoria->newRow()->setId($this->getId())->retrieve();
             $idCategoriaPai = $_categoria->getIdCategoriaPai();
             $result = parent::delete($where);
             if ($result) {
             if ($_categoria->newRow()->setId($idCategoriaPai)->exists()) {
             $_categoria->delete();
             }
             }
             return $result; */
           return parent::delete($where);
       }

       public function findCategoria($idCategoria = '', $idCategoriaPai = '', $orderBy = '', $_where = '') {
           if (!$orderBy) {
               $orderBy = 'id';
           }
           if (!($_where instanceof ZendT_Db_Where)) {
               $_where = new ZendT_Db_Where();
           }
           if ($idCategoria) {
               $_where->addFilter("cms_categoria.id", $idCategoria);
           }
           if ($idCategoriaPai) {
               $_where->addFilter("cms_categoria.id_categoria_pai", $idCategoriaPai);
           }
           $_where->addFilter("cms_categoria.status", "A");
           $_categoria = new Cms_DataView_Categoria_MapperView();
           $_categoria->findAll($_where, "*", $orderBy);
           return $_categoria;
       }

   }

?>