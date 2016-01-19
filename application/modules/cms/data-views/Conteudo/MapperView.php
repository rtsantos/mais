<?php

    /**
     * Classe de visão da tabela cms_conteudo
     */
    class Cms_DataView_Conteudo_MapperView extends Cms_DataView_Conteudo_Crud_MapperView {

        private $_removeLob = true;

        protected function _getSettingsDefault() {
            $profile = parent::_getSettingsDefault();
            $profile['listOptions']['acao_status'] = $this->_getStatus()->getModel()->getListOptions('acao');
            $profile['hidden'] = array();
            $profile['remove'] = array();
            return $profile;
        }

        protected function _getWhere($postData = "") {
            $_where = new ZendT_Db_Where('OR');

            $idUsuario = Zend_Auth::getInstance()->getStorage()->read()->getId();
            $_where->addFilter("cms_conteudo.publico", "S");
            $_where->addFilter("cms_conteudo.id_usuario_inc", $idUsuario);
            $_where->addFilterExists($this->getFilterExists());
            return $_where;
        }

        public function getFilterExists($complement = "") {
            $idUsuario = Auth_Session_User::getInstance()->getId();

            return "(
                      /**
                      * privilégio por usuário no conteúdo
                      */
                      SELECT 1
                        FROM cms_priv_conteudo pc
                       WHERE pc.id_conteudo IN
                             (cms_conteudo.id, cms_conteudo.id_conteudo_pai)
                         " . $complement . "
                         AND pc.id_usuario = {$idUsuario}

                      UNION ALL

                      /**
                      * privilégio por papel no conteúdo
                      */
                      SELECT 1
                        FROM cms_priv_conteudo pc
                        JOIN prouser.papel pa
                          ON (pc.id_papel = pa.id)
                       WHERE pc.id_conteudo IN
                             (cms_conteudo.id, cms_conteudo.id_conteudo_pai)
                         " . $complement . "
                         AND EXISTS (SELECT 1
                                FROM prouser.usuario_papel up
                                JOIN prouser.papel pu
                                  ON (up.id_papel = pu.id)
                               WHERE up.id_usuario = {$idUsuario}
                                 AND pu.nome LIKE pa.nome || '%'
                              UNION ALL
                              SELECT 1
                                FROM prouser.usuario us
                                JOIN prouser.papel pu
                                  ON (us.id_papel = pu.id)
                               WHERE us.id = {$idUsuario}
                                 AND pu.nome LIKE pa.nome || '%')
                      UNION ALL
                      /**
                      * privilégio por usuário na categoria
                      */
                      SELECT 1
                        FROM cms_categoria ct
                        JOIN cms_categoria ct_pai
                          ON (ct.chave LIKE ct_pai.chave || '%')
                        JOIN cms_priv_categ pc
                          ON (pc.id_categoria = ct_pai.id)
                       WHERE ct.id = cms_conteudo.id_categoria
                         " . $complement . "
                         AND pc.id_usuario = {$idUsuario}
                      UNION ALL

                      /**
                      * privilégio por papel na categoria
                      */
                      SELECT 1
                        FROM cms_categoria ct
                        JOIN cms_categoria ct_pai
                          ON (ct.chave LIKE ct_pai.chave || '%')
                        JOIN cms_priv_categ pc
                          ON (pc.id_categoria = ct_pai.id)
                        JOIN prouser.papel pa
                          ON (pc.id_papel = pa.id)
                       WHERE ct.id = cms_conteudo.id_categoria
                         " . $complement . "
                         AND EXISTS (SELECT 1
                                FROM prouser.usuario_papel up
                                JOIN prouser.papel pu
                                  ON (up.id_papel = pu.id)
                               WHERE up.id_usuario = {$idUsuario}
                                 AND pu.nome LIKE pa.nome || '%'
                              UNION ALL
                              SELECT 1
                                FROM prouser.usuario us
                                JOIN prouser.papel pu
                                  ON (us.id_papel = pu.id)
                               WHERE us.id = {$idUsuario}
                                 AND pu.nome LIKE pa.nome || '%')
            )";
        }

        public function getWhereEdicao() {
            $_where = $this->getWhere();
            $_where->addFilterExists($this->getFilterExists("AND pc.tipo = 'A'"));
            return $_where;
        }

        public function getDataEdicao() {
            $id = $this->getId()->toPhp();
            $this->setId($id)->retrieve($this->getWhereEdicao());
            $row = $this->getData();
            return $row;
        }

        public function isEditEnabled() {
            if (count($this->getDataEdicao())) {
                return true;
            }
            return false;
        }

        protected function _loadColumns() {
            parent::_loadColumns();
            $this->_columns->add('chave_categoria', 'categoria', 'chave'
                    , $this->_getCategoria()->getChave(true)
                    , ZendT_Lib::translate('Chave da Categoria'), null, '?%');

            $this->_columns->add('acao_status', 'status', 'acao'
                    , $this->_getStatus()->getAcao(true)
                    , ZendT_Lib::translate('Ação do Estado'), '', '=');

            $this->_columns->add('avatar_usuario_inc', 'usuario_inc', 'avatar'
                    , $this->_getUsuario()->getAvatar(true)
                    , ZendT_Lib::translate('Avatar do Usuário'), null, '=');
        }

        /**
         *
         * @param array $row
         * @return array
         */
        public function getStylesRow(&$row, $profileId = 0, $subtotal = false) {
            $options = array();
            /* Downloads */
            if ($profileId == 956 || $profileId == 968) {
                $id = "";
                if ($row['id']) {
                    $id = $row['id']->get();
                }
                if ($id) {
                    $baseUrl = ZendT_Url::getBaseUrl() . '/cms/conteudo/view/categoria/para-voce/conteudo/' . $id;
                    $titulo = '<a href="' . $baseUrl . '">' . $row['titulo']->get() . '</a>';
                    $row['titulo']->set($titulo);
                }
            }
            return $options;
        }

        /* protected function _prepareSql(&$sql, &$binds, $type) {
          echo '<pre>';
          print_r($sql);
          print_r($binds);
          echo '</pre>';
          exit;
          } */

        /**
         * 
         * @param string|int $categoria
         * @param string $orderBy
         * @return array
         */
        protected function _list($categoria, $idConteudoPai = '', $orderBy = '') {
            $this->_removeLob = false;
            $_fileSystem = new Ged_Model_Arquivo_FileSystem();
            $idUsuario = Auth_Session_User::getInstance()->getId();

            $_auth = new Auth_Model_Usuario_Mapper();
            $_auth->setLogin('GUEST')->retrieve();
            $avatarGuest = $_auth->getAvatar(true)->toPhp();

            /**
             * caso seja uma string retorna o id
             */
            $idCategoria = $this->_getIdCategoria($categoria);

            if (!$orderBy) {
                $orderBy = 'cms_conteudo.dh_ini_pub';
            }

            $_whereGroup = new ZendT_Db_Where_Group('AND');

            $_where = new ZendT_Db_Where();
            $_where->addFilter("cms_conteudo.id_categoria", $idCategoria);
            if ($idConteudoPai) {
                $_where->addFilter("cms_conteudo.id_conteudo_pai", $idConteudoPai);
            }
            $_where->addFilter("cms_conteudo.dh_ini_pub", ZendT_Type_Date::nowDateTime(), "<=");
            $_where->addFilter("status.acao", "A");
            $_whereGroup->addWhere($_where);

            $_where = new ZendT_Db_Where('OR');
            $_where->addFilter("cms_conteudo.dh_fim_pub", ZendT_Type_Date::nowDateTime(), ">=");
            $_where->addFilter("cms_conteudo.dh_fim_pub", "", "NULL");

            $_whereGroup->addWhere($_where);

            //($where, $retrieve = false, $found = false, $orderBy='1')
            $_recordset = $this->recordset($_whereGroup, false, false, $orderBy);
            $data = array();
            $result = array();
            while ($data = $_recordset->getRow()) {
                $data['url'] = ZendT_Url::getBaseUrl() . '/cms/conteudo/view/id/' . $data['id']->toPhp();
                $thumbnail = $data['thumbnail']->toPhp();
                if (!$thumbnail) {
                    $_conteudo = new Cms_Model_Conteudo_Mapper();
                    $_conteudo->setChave('generic')->retrieve();
                    $thumbnail = $_conteudo->getThumbnail(true)->toPhp();
                }
                $data['thumbnail'] = $_fileSystem->getDirectoryAdress($thumbnail);
                $data['banner'] = $_fileSystem->getDirectoryAdress($data['banner']->toPhp());

                $avatar = $data['avatar_usuario_inc']->toPhp();
                if (!$avatar) {
                    $avatar = $avatarGuest; //avatar genérico
                }
                $data['avatar_usuario_inc'] = $_fileSystem->getDirectoryAdress($avatar);
                $data['html_like'] = Cms_Helper_Likes::button($data['id']);
                $data['html_comment'] = Cms_Helper_Feeds::button($data['id']);

                if ($data['id_usuario_inc']->toPhp() == $idUsuario) {
                    $data['nome_usuario_inc'] = 'Você';
                }
                $result[] = $data;
            }

            return $result;
        }

        public function getContents($categoria) {
            return $this->_list($categoria);
        }

        public function getLikes($id) {
            $result = $this->_list('like', $id);
            $newResult = array();
            foreach ($result as $data) {
                if ($data['nome_usuario_inc'] == 'Você') {
                    $newResult = array_merge(array($data), $newResult);
                } else {
                    $newResult[] = $data;
                }
            }
            return $newResult;
        }

        public function getComments($id) {
            return $this->_list('comment', $id);
        }

        public function getNews() {
            return $this->_list('noticias');
        }

        public function getBanners() {
            return $this->_list('banner');
        }

        public function getCounts() {
            $sql = "SELECT conteudo.id_conteudo_pai as id
                         ,categoria.chave as categoria
                         ,COUNT(*) AS count
                    FROM cms_conteudo conteudo
                    JOIN cms_categoria categoria
                      ON (conteudo.id_categoria = categoria.id)
                    JOIN cms_conteudo conteudo_pai
                      ON (conteudo.id_conteudo_pai = conteudo_pai.id)
                    JOIN cms_status status_pai
                      ON (conteudo_pai.id_status = status_pai.id)
                    JOIN cms_categoria categoria_pai
                      ON (conteudo_pai.id_categoria = categoria_pai.id)
                   WHERE categoria.chave IN ('like','comment')
                     /*AND categoria_pai.chave = 'noticias'*/
                     AND status_pai.acao = 'A'
                     AND SYSDATE BETWEEN SYSDATE AND nvl(conteudo_pai.dh_fim_pub,SYSDATE)
                   GROUP BY conteudo.id_conteudo_pai
                           ,categoria.chave
                   ORDER BY categoria.chave
                           ,conteudo.id_conteudo_pai";
            $rows = $this->getModel()->getAdapter()->fetchAll($sql);
            return $rows;
        }

    }

?>