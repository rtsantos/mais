<?php

   /**
    * Classe de visão da tabela cms_notificacao
    */
   class Cms_DataView_Notificacao_MapperView extends Cms_DataView_Notificacao_Crud_MapperView {

       /**
        *
        * @var Auth_DataView_Usuario_MapperView 
        */
       protected $_usuario;

       /**
        *
        * @var Cms_DataView_Categoria_MapperView 
        */
       protected $_categoria;

       /**
        *
        * @var Cms_DataView_Conteudo_MapperView 
        */
       protected $_conteudo;

       /**
        * 
        * @return Auth_DataView_Usuario_MapperView
        */
       protected function _getUsuario() {
           if ($this->_usuario == null) {
               $this->_usuario = new Auth_DataView_Usuario_MapperView();
           }

           return $this->_usuario;
       }

       /**
        * 
        * @return Cms_DataView_Categoria_MapperView
        */
       protected function _getCategoria() {
           if ($this->_categoria == null) {
               $this->_categoria = new Cms_DataView_Categoria_MapperView();
           }

           return $this->_categoria;
       }

       /**
        * 
        * @return Cms_DataView_Conteudo_MapperView
        */
       protected function _getConteudo() {
           if ($this->_conteudo == null) {
               $this->_conteudo = new Cms_DataView_Conteudo_MapperView();
           }

           return $this->_conteudo;
       }

       /**
        * 
        */
       protected function _loadColumns() {
           parent::_loadColumns();
           $_string = new ZendT_Type_String(null);

           $this->_columns->add('nome_usuario_conteudo', 'usuario_conteudo', 'nome'
                 , $this->_getUsuario()->getNome(true)
                 , ZendT_Lib::translate('Nome do Usuário Conteúdo')
                 , 'String', '%?%');

           $this->_columns->add('id_conteudo', 'cms_conteudo', 'id'
                 , $this->_getConteudo()->getId(true)
                 , ZendT_Lib::translate('Id do Conteúdo')
                 , 'String', '%?%');
           
           $this->_columns->add('dh_ini_conteudo', 'cms_conteudo', 'dh_ini_pub'
                 , $this->_getConteudo()->getDhIniPub(true)
                 , ZendT_Lib::translate('Data da Publicação')
                 , 'String', '%?%');
           
           $this->_columns->add('titulo_conteudo', 'cms_conteudo', 'titulo'
                 , $this->_getConteudo()->getTitulo(true)
                 , ZendT_Lib::translate('Título do Conteúdo')
                 , 'String', '%?%');
           
           $this->_columns->add('corpo_conteudo', 'cms_conteudo', 'corpo'
                 , $this->_getConteudo()->getCorpo(true)
                 , ZendT_Lib::translate('Corpo do Conteúdo')
                 , 'String', '%?%');
           
           $this->_columns->add('id_conteudo_pai', 'cms_conteudo_pai', 'id'
                 , $this->_getConteudo()->getId(true)
                 , ZendT_Lib::translate('Id do Conteúdo Pai')
                 , 'String', '%?%');
           
           $this->_columns->add('titulo_conteudo_pai', 'cms_conteudo_pai', 'titulo'
                 , $this->_getConteudo()->getTitulo(true)
                 , ZendT_Lib::translate('Título do Conteúdo Pai')
                 , 'String', '%?%');

           $this->_columns->add('dh_conteudo', 'cms_conteudo', 'dh_ini_pub'
                 , $this->_getConteudo()->getDhIniPub(true)
                 , ZendT_Lib::translate('Título do Conteúdo')
                 , 'String', '%?%');

           $this->_columns->add('descricao_categoria', 'cms_categoria', 'descricao'
                 , $this->_getCategoria()->getDescricao(true)
                 , ZendT_Lib::translate('Descrição da Categoria')
                 , 'String', '%?%');

           $this->_columns->add('avatar_usuario_conteudo', 'usuario_conteudo', 'avatar'
                 , $this->_getUsuario()->getAvatar(true)
                 , ZendT_Lib::translate('Avatar do Usuário Conteúdo')
                 , 'String', '%?%');
       }

       /**
        * Retorna o SQL Base
        */
       protected function _getSqlBase() {
           $sql = parent::_getSqlBase();
           $sql.= " JOIN " . $this->_getConteudo()->getModel()->getTableName() . " cms_conteudo ON (cms_notificacao.id_conteudo = cms_conteudo.id)"
                 . " JOIN " . $this->_getCategoria()->getModel()->getTableName() . " cms_categoria ON (cms_conteudo.id_categoria = cms_categoria.id)"
                 . " JOIN " . $this->_getUsuario()->getModel()->getTableName() . " usuario_conteudo ON (cms_conteudo.id_usuario_inc = usuario_conteudo.id)"
                 . " LEFT JOIN " . $this->_getConteudo()->getModel()->getTableName() . " cms_conteudo_pai ON (cms_conteudo.id_conteudo_pai = cms_conteudo_pai.id)";
           return $sql;
       }

       public function count($idUsuario = '') {
           if (!$idUsuario) {
               $idUsuario = Auth_Session_User::getInstance()->getId();
           }
           $this->newRow()->setIdUsuario($idUsuario)->findAll(null);
           $count = 0;
           while ($this->fetch()) {
               $count++;
           }
           return $count;
       }

       public function feeds($idUsuario = '') {
           if (!$idUsuario) {
               $idUsuario = Auth_Session_User::getInstance()->getId();
           }
           $this->newRow()->setIdUsuario($idUsuario);

           $idCategoria = $this->_getCategoria()->getIdByDescricao("Para você");

           $where = $this->getWhere();
           $recorset = $this->recordset($where, false, false, 'dh_ini_conteudo');
           $result = array();
           while ($row = $recorset->getRow()) {
               $row['url'] = Cms_Model_Conteudo_Mapper::getUrlView($row['id_conteudo'], $idCategoria);
               $row['url_pai'] = Cms_Model_Conteudo_Mapper::getUrlView($row['id_conteudo_pai'], $idCategoria);
               $result[] = $row;
           }
           return $result;
       }

       public static function get($idUsuario = '', $format = true) {
           if (!$idUsuario) {
               $idUsuario = Auth_Session_User::getInstance()->getId();
           }
           $_notificacao = new Cms_DataView_Notificacao_MapperView();
           $_notificacao->setIdUsuario($idUsuario)->findAll(null, '*');
           if ($format) {
               $notificacoes = array();
               $_conteudo = new Cms_Model_Conteudo_Mapper();
               $_categoria = new Cms_Model_Categoria_Mapper();
               $_categoriaPai = new Cms_Model_Categoria_Mapper();
               while ($_notificacao->fetch()) {
                   $_conteudo->setId($_notificacao->getIdConteudo())->retrieve();
                   $_categoria->setId($_conteudo->getIdCategoria())->retrieve();
                   $conteudo = $_conteudo->getTitulo()->get();
                   if (strlen($conteudo) > 10) {
                       $conteudo = substr($conteudo, 1, 10) . "...";
                   }
                   $titulo = $_categoria->getDescricao()->get() . " (" . $conteudo . ")";
                   if ($_categoria->getIdCategoriaPai()->get()) {
                       $_categoriaPai->setId($_categoria->getIdCategoriaPai())->retrieve();
                       $titulo = $_categoriaPai->getDescricao()->get() . " - " . $titulo;
                   }
                   $url = Cms_Model_Conteudo_Mapper::getUrlView($_conteudo->getId()->get(), $_categoria->getIdByDescricao("Para você"));
                   $notificacoes [] = array('id' => $_conteudo->getId()->get(), 'titulo' => $titulo, 'url' => $url);
               }
               return $_notificacao->_getLayout($notificacoes);
           }
           return $_notificacao;
       }

       private function _getLayout($notificacoes) {
           $result = "";
           if (count($notificacoes)) {
               $result .= '<ul>';
               $qtd = 0;
               foreach ($notificacoes as $notificacao) {
                   if ($qtd) {
                       //$result .= '<li class="divider" role="separator"></li>';
                   }
                   $result .= '<li><a href="' . $notificacao["url"] . '">' . $notificacao["titulo"] . '</a></li>';
                   $qtd ++;
               }
               $result .= '<li class="divider" role="separator"></li>';
               $result .= '<li><a href ="javascript:clearNotifications();">>>> Limpar <<<</a></li>';
               $result .= '</ul>';
           }
           return $result;
       }

   }

?>