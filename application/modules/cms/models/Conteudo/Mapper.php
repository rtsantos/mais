<?php

    /**
     * Classe de mapeamento do registro da tabela cms_conteudo
     */
    class Cms_Model_Conteudo_Mapper extends Cms_Model_Conteudo_Crud_Mapper {

        public function setArquivo($value, $options = array()) {
            $options+= array('prop_docto_name' => 'CMS_CONTEUDO_ARQUIVO');
            $this->_data['arquivo'] = $this->_setFileSystem($value, $options);
            return $this;
        }

        public function setThumbnail($value, $options = array()) {
            $options+= array('prop_docto_name' => 'CMS_CONTEUDO_THUMBNAIL');
            $this->_data['thumbnail'] = $this->_setFileSystem($value, $options);
            return $this;
        }

        public function setBanner($value, $options = array()) {
            $options+= array('prop_docto_name' => 'CMS_CONTEUDO_BANNER');
            $this->_data['banner'] = $this->_setFileSystem($value, $options);
            return $this;
        }

        protected function _beforeSave() {
            parent::_beforeSave();

            if ($this->_action == 'insert') {
                /*if (!$this->getIdStatus(true)->toPhp()) {
                    $this->setIdStatus(1);
                }*/

                if (!$this->getChaveMacro(true)->toPhp()) {
                    $this->setChaveMacro('{dh_ini_pub}_{titulo}');
                }

                if (!$this->getIdUsuarioInc(true)->toPhp()) {
                    $idUsuario = Zend_Auth::getInstance()->getStorage()->read()->getId();
                    $this->setIdUsuarioInc($idUsuario);
                }
                if (!$this->getDhIniPub(true)->toPhp()) {
                    $this->setDhIniPub('SYSDATE');
                }
                if (!$this->getPublico(true)->toPhp()) {
                    $this->setPublico('S');
                }
                if (!$this->getTitulo(true)->toPhp()) {
                    $titulo = html_entity_decode(substr(strip_tags(str_replace("\n", " ", $this->getCorpo(true)->get())), 0, 40)) . "...";
                    $this->setTitulo($titulo);
                }
                if (!$this->getIdFilial(true)->toPhp()) {
                    $idFilial = $_SESSION['logon']['filial']['id'];
                    $this->setIdFilial($idFilial);
                }
                $now = ZendT_Type_Date::nowDateTime();

                $_categoria = new Cms_Model_Categoria_Mapper();
                $_categoria->setId($this->getIdCategoria(true)->toPhp())->retrieve();
                $chaveCategoria = $_categoria->getChave(true)->toPhp();
                if (strpos($chaveCategoria, 'fale-com-a-diretoria') !== false) {
                    $_usuario = new Auth_Model_Usuario_Mapper();
                    $_usuario->setId($this->getIdUsuarioInc())->retrieve();
                    if (trim(strtolower($_usuario->getEmail()->toPhp())) != trim(strtolower($this->getSubTitulo()->toPhp()))) {
                        $this->setIdUsuarioInc(1);
                    }
                }
            }
            if ($this->_action != 'delete') {
                $dh_fim_pub = $this->getDhFimPub(true)->toPhp();
                if ($dh_fim_pub && $dh_fim_pub < $this->getDhIniPub()->toPhp()) {
                    throw new ZendT_Exception("Data/Hora fim da publicação deve ser maior ou igual a data/hora início da publicação!");
                }

                $this->setCorpoUrl($this->getCorpoUrl(true)->get());

                $uri = $this->getCorpoUrl(true)->get();
                //$uri = filter_var($uri, FILTER_VALIDATE_URL);
                if (strlen($uri) >= 10) {
                    $sub = "&";
                    if (strpos($uri, "?") === false) {
                        $sub = "?";
                    }
                    $uri .= $sub . "no_location=1&__idUserToken__=7148540&__codeToken__=102122";
                    $uri = ZendT_Url::formatUrl('{host}' . $uri);
                    $client = new Zend_Http_Client($uri, array('timeout' => '60'));
                    $response = $client->request();
                    $corpo = $response->getBody();
                    $this->setCorpo($corpo);
                } else {
                    $this->setCorpoUrl(NULL);
                }

                $chaveMacro = $this->getChaveMacro(true)->get();
                if ($chaveMacro) {
                    $data = $this->getData();
                    $_categoria = new Cms_Model_Categoria_Mapper();
                    $_categoria->setId($this->getIdCategoria()->toPhp())->retrieve();
                    $data['chave_categoria'] = $_categoria->getChave();

                    preg_match_all("/\{(.*?)\}/", $chaveMacro, $replace);
                    foreach ($replace[1] as $field) {
                        $field = trim($field);
                        $valueField = $data[$field]->get();
                        $chaveMacro = str_replace('{' . $field . '}', $valueField, $chaveMacro);
                    }
                    $chave = str_replace(array('/', '\\', '|', ' '), '-', $chaveMacro);
                    $this->setChave($chave);
                }

                $_status = new Cms_Model_Status_Mapper();
                $_status->setId($this->getIdStatus(true))->retrieve();
                $acao = $_status->getAcao(true)->toPhp();
                if ($acao == 'C' || $acao == 'F') {
                    $this->setDhFimPub('SYSDATE');
                }
            }
            $this->setCurrentChave();
        }

        public function _afterSave() {
            parent::_afterSave();
            if ($this->_action == 'insert') {
                /* $_privConteudo = new Cms_Model_PrivConteudo_Mapper();
                  $_privConteudo->addPrivConteudo($this->getId(), '', 'A'); */
            }

            if ($this->getCorpoUrl() == '') {
                if ($this->_action == 'insert' || $this->_action == 'update') {
                    $_notificacao = new Cms_Model_Notificacao_Mapper();
                    $_notificacao->insert($this->getId());
                }
            }
        }

        public function afterCommit() {
            parent::afterCommit();
            $this->updateParentCorpoUrl();
        }

        public function setCurrentChave() {
            if (!$this->_currentChave) {
                $idCategoria = $this->getIdCategoria(true)->toPhp();
                if (!$idCategoria) {
                    $_conteudo = new Cms_Model_Conteudo_Mapper();
                    $_conteudo->setId($this->getId())->retrieve();
                    $idCategoria = $_conteudo->getIdCategoria();
                }
                $_categoria = new Cms_Model_Categoria_Mapper();
                $_categoria->setId($idCategoria)->retrieve();
                $this->_currentChave = $_categoria->getChave()->toPhp();
            }
        }

        public function updateParentCorpoUrl() {
            if ($this->_currentChave) {
                $_where = new ZendT_Db_Where();
                $_where->addFilter('cms_conteudo.chave', $this->_currentChave);
                $_where->addFilter('cms_conteudo.corpo_url', "", "!NULL");
                $_conteudo = new Cms_DataView_Conteudo_MapperView();
                $_conteudo->findAll($_where, '*');
                while ($_conteudo->fetch()) {
                    $_conteudo->update();
                }
            }
        }

        public function delete($where = null) {
            $_conteudo = new Cms_DataView_Conteudo_MapperView();
            $_conteudo->populate($this->getData())->findAll(null, '*');
            while ($_conteudo->fetch()) {
                $_privConteudo = new Cms_Model_PrivConteudo_Mapper();
                $_privConteudo->setIdConteudo($_conteudo->getId())->delete();
                $_conteudo2 = new Cms_DataView_Conteudo_MapperView();
                $_conteudo2->newRow()->setIdConteudoPai($_conteudo->getId())->findAll(null, '*');
                while($_conteudo2->fetch()){
                    $_conteudo2->delete();
                }
            }
            return parent::delete($where);
        }

        public function populateConteudo($idCategoria, $idConteudoPai, $idUsuario = '') {
            $this->newRow()->setIdCategoria($idCategoria)->setIdConteudoPai($idConteudoPai);
            if ($idUsuario) {
                $this->setIdUsuarioInc($idUsuario);
            }
            $this->setTitulo("like-" . $this->getIdUsuarioInc(true)->toPhp());
            return $this;
        }

        public function isValidLastTime($hours = 0, $minutes = 0, $seconds = 0) {
            $_conteudo = new Cms_DataView_Conteudo_MapperView();
            $_conteudo->setIdCategoria($this->getIdCategoria())->setIdConteudoPai($this->getIdConteudoPai())->setIdUsuarioInc($this->getIdUsuarioInc())->findAll(null, '*', 'dh_ini_pub desc');
            if (!$_conteudo->exists()) {
                return true;
            }
            $_conteudo->fetch();
            $hours *= (60 * 60);
            $minutes *= 60;
            $total = $hours + $minutes + $seconds;

            $now = ZendT_Type_Date::nowDateTime()->toPhp();
            $last = $_conteudo->getDhIniPub()->toPhp();
            $last += $total;

            if ($now > $last) {
                return true;
            }
            return false;
        }

        public static function getUrlView($idConteudo, $idCategoria = "", $includeHost = false) {
            $url = '';
            if ($includeHost) {
                $url .= ZendT_Url::getHostName();
            }
            $url .= ZendT_Url::getBaseUrl() . "/cms/conteudo/view/id/" . $idConteudo;
            if ($idCategoria) {
                $url .= "/categoria/{$idCategoria}";
            }
            return $url;
        }

        protected function _getIdCategoria($value) {
            if (!is_numeric($value)) {
                $_categoria = new Cms_Model_Categoria_Mapper();
                $_categoria->setChave($value)->retrieve();
                $value = $_categoria->getId();
            }

            return $value;
        }

        public function getIdCategoriaByDesc($value) {
            return $this->_getIdCategoria($value);
        }
        
        protected function _getIdStatus($value) {
            if (!is_numeric($value)) {
                $_status = new Cms_Model_Status_Mapper();
                $_status->setDescricao($value)->retrieve();
                $value = $_status->getId();
            }

            return $value;
        }

        public function like($idConteudo, $onlyLoad = false) {
            if (!$onlyLoad) {
                if (Auth_Session_User::getInstance()->authenticated()) {
                    $idUsuario = Auth_Session_User::getInstance()->getId();
                    $this->populateConteudo($this->_getIdCategoria('like'), $idConteudo, $idUsuario);
                    $this->setIdStatus($this->_getIdStatus('like'));
                    if (!$this->exists()) {
                        $this->insert();
                    }
                } else {
                    throw new ZendT_Exception("Apenas usuários autenticados podem curtir os conteúdos!");
                }
            }
            return true;
        }

        public function comment($idConteudo, $corpo, $onlyLoad = false) {
            if (!$onlyLoad) {
                if (Auth_Session_User::getInstance()->authenticated()) {
                    $corpo = strip_tags(trim($corpo));
                    if ($corpo) {
                        $idUsuario = Auth_Session_User::getInstance()->getId();

                        $this->populateConteudo($this->_getIdCategoria('comment'), $idConteudo, $idUsuario);
                        $this->setIdStatus($this->_getIdStatus('comment'));
                        $this->setTitulo(md5($corpo));

                        if (!$this->exists()) {
                            $this->setCorpo($corpo);
                            $this->insert();
                        }
                    } else {
                        throw new ZendT_Exception("Favor preencher o comentário!");
                    }
                } else {
                    throw new ZendT_Exception("Apenas usuários autenticados podem comentar os conteúdos!");
                }
            }
            return true;
        }

    }

?>