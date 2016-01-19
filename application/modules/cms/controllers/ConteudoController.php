<?php

    class Cms_ConteudoController extends ZendT_Controller_ActionCrud {

        public function init() {
            $this->_init();
            $this->_startupAcl();
            $this->_serviceName = 'Cms_Service_Conteudo';
            $this->_formName = 'Cms_Form_Conteudo_Edit';
            $this->_formSearchName = 'Cms_Form_Conteudo_Search';
            $this->_mapper = new Cms_DataView_Conteudo_MapperView();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'conteudo';
            $this->setGrid(new ZendT_Grid('grid_' . $name));

            $noLayout = $this->getRequest()->getParam('no_layout');
            if ($noLayout) {
                $this->_disableRender(true, false);
            }

            $_menu = new Cms_DataView_Menu_MapperView();
            $_menu->load(false);
        }

        public function configGrid() {
            parent::configGrid();

            $this->getGrid()->setOnSelectRow("function(){ selectedRowConteudo(); }");

            $idCategoria = $this->getRequest()->getParam('id_categoria');
            if ($idCategoria) {
                $add = $this->getGrid()->getToolbarButton('add');
                $add->setUrl($add->getUrl() . '&id_categoria=' . $idCategoria);
                $this->getGrid()->setPostData(array('cms_conteudo-id_categoria' => $idCategoria));
            }
        }

        public function updateChaveRegistrosAction() {
            $this->_disableRender();

            $_where = new ZendT_Db_Where();
            $_where->addFilter("cms_conteudo.id", "79", ">=");
            $_conteudo = new Cms_DataView_Conteudo_MapperView();
            $_conteudo->findAll($_where, '*');
            while ($_conteudo->fetch()) {
                echo $_conteudo->getId()->toPhp() . "<br>";
                $_conteudo->update();
            }

            $_where = new ZendT_Db_Where();
            $_where->addFilter("cms_categoria.id_categoria_pai", "24", "=");
            $_categoria = new Cms_DataView_Categoria_MapperView();
            $_categoria->findAll($_where, '*');
            while ($_categoria->fetch()) {
                echo $_categoria->getId()->toPhp() . "<br>";
                $_categoria->update();
            }
        }

        public function loadFilesFromPathAction() {
            $this->_disableRender();
            $path = "C:\\tmp_arquivos";
            $idCategoriaDownloads = "24";
            $onlyUpdate = $this->getRequest()->getParam('only_update');
            $db = $this->getModel()->getAdapter();
            $_categoria = new Cms_Model_Categoria_Mapper();
            $_conteudo = new Cms_DataView_Conteudo_MapperView();

            $sql = 'SELECT * FROM upload_arquivo WHERE aprovado = :aprovado';
            $bind = array('aprovado' => 'S');
            $dataArquivos = $db->fetchAll($sql, $bind);
            foreach ($dataArquivos as $fileData) {
                $fileDir = glob($path . "\\" . $fileData['id'] . ".*");
                if (count($fileDir)) {
                    $fileDir = $fileDir['0'];
                    $fileContent = file_get_contents($fileDir);
                    $fileName = end(explode("\\", $fileDir));
                    $_file = new ZendT_File($fileName, $fileContent);

                    if ($onlyUpdate) {
                        $_conteudo->newRow()->setArquivo(array('file' => $_file->toFilenameCrypt()))->findAll(null, '*');
                        while ($_conteudo->fetch()) {
                            $_conteudo->setIdUsuarioInc($fileData['id_usuario_inc']);
                            $_conteudo->update();
                        }
                        echo ">>> Arquivo {$fileData['id']} atualizado com sucesso!<br/>";
                    } else {
                        $sql = 'SELECT * FROM upload_assunto WHERE id = :id_upload_assunto';
                        $bind = array('id_upload_assunto' => $fileData['id_upload_assunto']);
                        $dataAssunto = $db->fetchRow($sql, $bind);
                        $_categoria->newRow()->setDescricao($dataAssunto['descricao'])->retrieve();
                        $idCategoria = $_categoria->getId();
                        if (!$idCategoria) {
                            $_categoria
                                    ->newRow()
                                    ->setIdCategoriaPai($idCategoriaDownloads)
                                    ->setDescricao($dataAssunto['descricao'])
                                    ->setTipo('A')
                                    ->insert();
                            $idCategoria = $_categoria->getId()->toPhp();
                        }
                        $subtitulo = substr(trim($fileData['observacao']), 0, 100);
                        $_conteudo->newRow()->setIdCategoria($idCategoria)->setTitulo($fileData['nome']);

                        if (!$_conteudo->exists()) {
                            $_conteudo->setSubTitulo($subtitulo)->setIdUsuarioInc($fileData['id_usuario_inc'])->setArquivo(array('file' => $_file->toFilenameCrypt()))->insert();
                            echo "+++ Arquivo {$fileData['id']} inserido com sucesso!<br/>";
                        } else {
                            echo ">>> Arquivo {$fileData['id']} jÃ¡ existe na base de dados!<br/>";
                        }
                    }
                } else {
                    echo "--- Arquivo {$fileData['name']} nÃ£o encontrado!<br/>";
                }
            }
        }

        public function corpoUrlAction() {
            $id_conteudo = $this->getRequest()->getParam('id_conteudo');
            if (!$id_conteudo) {
                $id_conteudo = $this->getRequest()->getParam('id');
            }
            $_where = new ZendT_Db_Where();
            if ($id_conteudo) {
                $_where->addFilter("cms_conteudo.id", $id_conteudo);
            }
            $_where->addFilter("cms_conteudo.corpo_url", "", "!NULL");
            $_conteudo = $this->getMapper();
            $_conteudo->findAll($_where, "*");
            $conteudos = array();
            $erros = array();
            while ($_conteudo->fetch()) {
                $uri = $_conteudo->getCorpoUrl()->get();
                $sub = "&";
                if (strpos($uri, "?") === false) {
                    $sub = "?";
                }
                $uri .= $sub . "no_location=1&__idUserToken__=7148540&__codeToken__=102122";
                $uri = ZendT_Url::formatUrl($uri);
                $base = $_conteudo->getId()->get() . ". " . $_conteudo->getTitulo()->get() . " - " . $uri;
                try {
                    $_conteudo->update();
                    $conteudos[] = $base;
                } catch (Exception $ex) {
                    $error = $ex->getMessage() . "<br />" . nl2br($ex->getTraceAsString());
                    $erros[] = $base . "<br/>" . $error;
                }
            }
            $this->view->conteudos = $conteudos;
            $this->view->erros = $erros;
        }

        public function viewAction() {
            $this->_defineLayout();
            $id = $this->getRequest()->getParam('id');
            $key = $this->getRequest()->getParam('key');
            $list = $this->getRequest()->getParam('list');
            $chaveCategoria = $this->getRequest()->getParam('chave_categoria');
            $select = $this->getRequest()->getParam('select');

            $sub = $this->getRequest()->getParam('sub');
            $edit = $this->getRequest()->getParam('edit');
            $editDisabled = $this->getRequest()->getParam('edit_disabled');
            $conteudo = $this->getRequest()->getParam('conteudo');
            $categoria = $this->getRequest()->getParam('categoria');
            $restringirUsuario = $this->getRequest()->getParam('ru');
            if ($restringirUsuario) {
                $idUsuario = Zend_Auth::getInstance()->getStorage()->read()->getId();
                $this->getRequest()->setParam('cms_conteudo-id_usuario_inc', $idUsuario);
            }
            $_conteudo = $this->getMapper();

            if (!$id) {
                $id = $conteudo;
            }

            if ($id && !is_numeric($id)) {
                $id = $_conteudo->newRow()->setChave($id)->retrieve()->getId(true)->toPhp();
                $_conteudo->newRow();
            }

            if ($key && !$id) {
                $id = $_conteudo->newRow()->setChave($key)->retrieve()->getId(true)->toPhp();
                $_conteudo->newRow();
            }
            $idCategoriaAtual = "";

            $_where = new ZendT_Db_Where();
            $_where->addFilter("cms_conteudo.id", $id);
            $data = $_conteudo->findAll($_where)->fetch();
            if ($data) {
                $_conteudo->setId($id)->retrieve();
                $_fileSystem = new Ged_Model_Arquivo_FileSystem();

                $thumbnail = $_conteudo->getThumbnail()->toPhp();
                if ($thumbnail) {
                    $imgUrl = $_fileSystem->getDirectoryAdress($thumbnail);
                    $this->view->img = $imgUrl;
                }
                $this->view->banner = $_conteudo->getBanner()->toPhp();
                if ($this->view->banner) {
                    $this->view->banner = $_fileSystem->getDirectoryAdress($this->view->banner);
                }

                $this->view->id = $id;
                $this->view->titulo = $_conteudo->getTitulo()->get();
                $this->view->subtitulo = $_conteudo->getSubtitulo()->get();
                $this->view->corpo = $_conteudo->getCorpo()->get();
                $this->view->corpoUrl = $_conteudo->getCorpoUrl()->get();
                $this->view->viewPdf = $this->getRequest()->getParam('pdf');
                $this->view->arquivo = $_conteudo->getArquivo(true)->toPhp();

                $_arquivo = $_conteudo->getArquivo(true);
                if ($_arquivo->toPhp() && !$this->view->viewPdf) {
                    $name = $_arquivo->getFile()->getName();
                    if (strpos(strtolower($name), '.pdf')) {
                        $this->view->viewPdf = 1;
                    } else {
                        $this->view->urlDownload = $_arquivo->getFile()->toUrlDownload(false);
                    }
                }

                $_categoria = new Cms_DataView_Categoria_MapperView();
                $_categoria->setId($_conteudo->getIdCategoria()->toPhp());
                $_categoria->retrieve();

                $idCategoriaPai = $_categoria->getIdCategoriaPai()->toPhp();

                if ($sub) {
                    $_categoria = new Cms_DataView_Categoria_MapperView();
                    $_categoria->setId($idCategoriaPai);
                    $_categoria->retrieve();
                    $idCategoriaPai = $_categoria->getIdCategoriaPai()->toPhp();
                }

                $idCategoriaAtual = $_conteudo->getIdCategoria()->toPhp();

                /* Painel da direita */
                $conteudosCategoria = $_conteudo->getContents($_conteudo->getIdCategoria()->toPhp());
                if ($conteudosCategoria) {
                    foreach ($conteudosCategoria as $index => $conteudo) {
                        if ($conteudo['id'] == $id || !isset($conteudo['id'])) {
                            unset($conteudosCategoria[$index]);
                        }
                    }
                    $this->view->painelDireita = $conteudosCategoria;
                }

                /* Painel central */
                $this->view->painelCentral = '';

                $this->view->editPermissao = false;
                if (!$editDisabled) {
                    $_conteudoMapperView = new Cms_DataView_Conteudo_MapperView();
                    $this->view->editPermissao = $_conteudoMapperView->setId($id)->isEditEnabled();
                    if ($edit) {
                        $this->getRequest()->setParam('edit', $this->view->editPermissao);
                    }
                    $edit = $this->getRequest()->getParam('edit');
                }

                if ($edit && $this->view->editPermissao) {
                    $_conteudoForm = new Cms_Form_Conteudo_Edit();
                    $_conteudoForm->loadElements();
                    $_profile = ZendT_Profile::get('Cms_Form_Conteudo_Edit', '', 'analise');
                    $_conteudoForm->loadProfile($_profile);
                    $_conteudoForm->loadButtons();

                    $_mapper = new Cms_DataView_Conteudo_MapperView();
                    $row = $_mapper->setId($id)->getDataEdicao();
                    if (count($row)) {
                        $_conteudoForm->populate($row);
                        $this->view->corpo = $_conteudoForm;
                    }
                }
                $this->view->comments = Cms_Helper_Comments::comments($id);
                if (!$this->view->corpoUrl && !$edit) {
                    $this->view->commentsForm = Cms_Helper_Comments::form($id);
                }
                $this->view->likes = Cms_Helper_Likes::button($id);

                $_notificacao = new Cms_Model_Notificacao_Mapper();
                $_notificacao->remove($id);
            } else if ($list) {
                $this->gridAction();

                $this->getGrid()->setBeforeRequest("function(){
                                                    $.gridResize({
                                                        idGrid: '" . $this->getGrid()->getID() . "'
                                                       ,width: function(){ return calcWidthGrid(); }
                                                     /*,height: function(){ return calcHeightGrid(); }*/
                                                    });
                                                    $(window).resize(function(){
                                                        $.gridResize({
                                                            idGrid: '" . $this->getGrid()->getID() . "'
                                                           ,width: function(){ return calcWidthGrid(); }
                                                         /*,height: function(){ return calcHeightGrid(); }*/
                                                        });
                                                    });
                                                }");
            } else {
                $this->view->msg = "Conteúdo não disponível ou requer autenticação!";
            }

            /* Painel da esquerda */
            $this->view->painelEsquerda = '';
            if ($categoria) {
                if (!is_numeric($categoria)) {
                    $_categoria = new Cms_Model_Categoria_Mapper();
                    $_categoria->setChave($categoria)->retrieve();
                    $categoria = $_categoria->getId(true)->toPhp();
                }
                if ($chaveCategoria) {
                    $_categoria = new Cms_Model_Categoria_Mapper();
                    $_categoria->setChave($chaveCategoria)->retrieve();
                    $idCategoriaAtual = $_categoria->getId(true)->toPhp();
                }
                if ($select) {
                    $_categoria = new Cms_Model_Categoria_Mapper();
                    $_categoria->setChave($select)->retrieve();
                    $idCategoriaAtual = $_categoria->getId(true)->toPhp();
                }
                $_sideBar = new Cms_DataView_Sidebar_MapperView();
                //$_sideBarHelper = new Cms_Helper_Sidebar();
                //$html = $_sideBarHelper->sidebar($_sideBar->getSidebar($categoria), $idCategoriaAtual);
                $this->view->categoria = $categoria;
                $this->view->painelEsquerda = $this->view->sidebar($_sideBar->getSidebar($categoria)
                        , 'menu-' . $idCategoriaAtual);
            }
        }

        public function countAction() {
            $this->_disableRender();
            $json = new ZendT_Json_Result();
            try {
                $_conteudo = $this->getMapper();
                $counts = $_conteudo->getCounts();
                $result = array();
                if ($counts) {
                    foreach ($counts as $count) {
                        $result[$count['id']][$count['categoria']] = $count['count'];
                    }
                }
                $json->setResult($result);
            } catch (Exception $ex) {
                $json->setException($ex);
            }
            echo $json->render();
        }

        public function likesAction() {
            $this->_disableRender();
            $_conteudo = $this->getMapper();

            $id = $this->getRequest()->getParam('id');
            echo Cms_Helper_Likes::likes($id);
        }

        public function likeAction() {
            $this->_disableRender();
            $json = new ZendT_Json_Result();
            try {
                $id = $this->getRequest()->getParam('id');
                $_conteudo = $this->getMapper();
                $result = $_conteudo->like($id
                        , $this->getRequest()->getParam('onlyLoad'));

                if ($result) {
                    $comments = $_conteudo->getLikes($id);
                }

                $qtd = count($comments);
                $html = Cms_Helper_Likes::likes($id);

                $json->setResult(array('qtd' => $qtd, 'html' => $html));
            } catch (Exception $ex) {
                $json->setException($ex);
            }
            echo $json->render();
        }

        public function commentsAction() {
            $typeModal = $this->getRequest()->getParam('typeModal');
            if ($typeModal == 'IFRAME') {
                $this->setLayout(self::LAYOUT_IFRAME);
                $frame = true;
            } else {
                $this->setLayout(self::LAYOUT_AJAX);
                $frame = false;
            }

            $_conteudo = $this->getMapper();

            $this->view->id = $this->getRequest()->getParam('id');
            $this->view->comments = Cms_Helper_Comments::comments($this->view->id);
            $this->view->commentsForm = Cms_Helper_Comments::form($this->view->id);
            $this->view->frame = $frame;
        }

        public function commentAction() {

            $this->_disableRender();
            $json = new ZendT_Json_Result();
            try {
                $_conteudo = $this->getMapper();
                $id = $this->getRequest()->getParam('id');
                $html = $this->getRequest()->getParam('html');
                if (!$id) {
                    $id = $this->getRequest()->getParam('id_conteudo_pai');
                }
                $result = $_conteudo->comment($id, $this->getRequest()->getParam('corpo'), $this->getRequest()->getParam('onlyLoad'));

                $json->setResult(array('result' => $result));
            } catch (Exception $ex) {
                $json->setException($ex);
            }
            echo $json->render();
        }

        public function sampleAction() {
            
        }

        public function bannerAction() {
            $this->view->banners = $this->getMapper()->getBanners();
        }

        public function newsAction() {
            $this->view->noticias = $this->getMapper()->getNews();
        }

        public function pdfAction() {
            $this->setLayout(ZendT_Controller_Action::LAYOUT_PDF);

            $id = $this->getRequest()->getParam('id');
            $key = $this->getRequest()->getParam('key');

            $_conteudo = $this->getMapper();

            if ($key && !$id) {
                $id = $_conteudo->setChave($key)->retrieve()->getId(true)->toPhp();
            }

            $_file = $_conteudo->setId($id)->retrieve()->getArquivo(true)->getFile();
            $this->view->content = $_file->getContent();
        }

        public function downloadAction() {
            
        }

        public function uploadImagemAction() {
            $file = $this->getRequest()->getParam('imagem');
            if (!$file) {
                $this->_defineLayout();
                #Zend_Layout::getMvcInstance()->setLayout('window');
                $form = new Cms_Form_Conteudo_UploadImagem();
                $form->loadElements();
                $this->view->form = $form->render();
            } else {
                $this->_disableRender();
                $json = new ZendT_Json_Result();
                try {
                    $size = $this->getRequest()->getParam('tamanho');
                    $_conteudo = new Cms_Model_Conteudo_Imagem();
                    $_fileSystem = new Ged_Model_Arquivo_FileSystem();
                    if (!$file['file']) {
                        throw new ZendT_Exception_Alert("Favor selecionar um arquivo!");
                    }
                    $files = array();
                    $files['file'] = explode(',', $file['file']);
                    $files['type'] = explode(',', $file['type']);
                    $files['name'] = explode(',', $file['name']);
                    $url = array();
                    for ($i = 0; $i < count($files['file']); $i++) {
                        $file['file'] = $files['file'][$i];
                        $file['type'] = $files['type'][$i];
                        $file['name'] = $files['name'][$i];
                        $_conteudo->setImage($file, $size);
                        $id = $_conteudo->getImage()->getValueToDb();
                        $url[] = $_fileSystem->getDirectoryAdress($id);
                    }
                    $json->setResult(array('url' => $url));
                } catch (Exception $ex) {
                    $json->setException($ex);
                }
                echo $json->render();
            }
        }

        protected function _prepareRetrieveRow(&$row) {
            if ($row['id_usuario_aprov'] == '') {
                unset($row['id_usuario_aprov']);
                unset($row['login_usuario_aprov']);
                unset($row['nome_usuario_aprov']);
            }
        }

    }

?>
