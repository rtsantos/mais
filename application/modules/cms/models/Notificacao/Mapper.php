<?php

    /**
     * Classe de mapeamento do registro da tabela cms_notificacao
     */
    class Cms_Model_Notificacao_Mapper extends Cms_Model_Notificacao_Crud_Mapper {

        private function _getPrivileges($idConteudo, $idConteudoPai = '') {
            $sqlPai = "";
            if($idConteudoPai){
                $sqlPai = "/* usuário de inclusão do conteúdo pai */
                            SELECT us.id AS id_usuario,
                                    us.nome AS nome_usuario,
                                    us.email AS email_usuario,
                                    'S' env_email /*,  'SOLICITANTE - CONTEUDO PAI' as papel,  'CONTEUDO' as origem*/
                              FROM cms_conteudo ct
                              JOIN prouser.usuario us
                                ON (ct.id_usuario_inc = us.id)
                             WHERE (ct.id = $idConteudoPai /*OR ct.id_conteudo_pai = $idConteudoPai*/)
                               AND us.status = 'A'
                            UNION";
            }
            $sql = "SELECT id_usuario, nome_usuario, email_usuario, MAX(env_email) AS env_email
                      FROM (
                            /* usuário de inclusão do conteúdo */
                            SELECT us.id AS id_usuario,
                                    us.nome AS nome_usuario,
                                    us.email AS email_usuario,
                                    'S' env_email /*,  'SOLICITANTE' as papel,  'CONTEUDO' as origem*/
                              FROM cms_conteudo ct
                              JOIN prouser.usuario us
                                ON (ct.id_usuario_inc = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            {$sqlPai}
                            /* usuário aprovador do conteúdo */
                            SELECT us.id AS id_usuario,
                                    us.nome AS nome_usuario,
                                    us.email AS email_usuario,
                                    'S' env_email /*,  'APROVADOR' as papel,  'CONTEUDO' as origem*/
                              FROM cms_conteudo ct
                              JOIN prouser.usuario us
                                ON (ct.id_usuario_aprov = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado ao conteúdo */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  'USUARIO' as papel,  'CONTEUDO' as origem*/
                              FROM cms_priv_conteudo pc
                              JOIN cms_conteudo ct
                                ON (pc.id_conteudo = ct.id)
                              JOIN prouser.usuario us
                                ON (pc.id_usuario = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado ao conteúdo através do papel secundário */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  pa.nome as papel,  'CONTEUDO' as origem*/
                              FROM cms_priv_conteudo pc
                              JOIN cms_conteudo ct
                                ON (pc.id_conteudo = ct.id)
                              JOIN prouser.papel pa
                                ON (pc.id_papel = pa.id)
                              JOIN prouser.papel pu
                                ON (pu.nome LIKE pa.nome || '%')
                              JOIN prouser.usuario_papel up
                                ON (up.id_papel = pu.id)
                              JOIN prouser.usuario us
                                ON (up.id_usuario = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado ao conteúdo através do papel primário */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  pa.nome as papel,  'CONTEUDO' as origem*/
                              FROM cms_priv_conteudo pc
                              JOIN cms_conteudo ct
                                ON (pc.id_conteudo = ct.id)
                              JOIN prouser.papel pa
                                ON (pc.id_papel = pa.id)
                              JOIN prouser.papel pu
                                ON (pu.nome LIKE pa.nome || '%')
                              JOIN prouser.usuario us
                                ON (us.id_papel = pu.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado a categoria, usando hierarquia */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  'USUARIO' as papel,  'CATEGORIA' as origem*/
                              FROM cms_priv_categ pc
                              JOIN cms_categoria ctp
                                ON (pc.id_categoria = ctp.id)
                              JOIN cms_categoria ctc /*ON (ctc.id = ctp.id)*/
                                ON (ctc.chave LIKE ctp.chave || '%')
                              JOIN cms_conteudo ct
                                ON (ct.id_categoria = ctc.id)
                              JOIN prouser.usuario us
                                ON (pc.id_usuario = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado a categoria através do papel secundário, usando hierarquia */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  pa.nome as papel,  'CATEGORIA' as origem*/
                              FROM cms_priv_categ pc
                              JOIN cms_categoria ctp
                                ON (pc.id_categoria = ctp.id)
                              JOIN cms_categoria ctc /*ON (ctc.id = ctp.id)*/
                                ON (ctc.chave LIKE ctp.chave || '%')
                              JOIN cms_conteudo ct
                                ON (ct.id_categoria = ctc.id)
                              JOIN prouser.papel pa
                                ON (pc.id_papel = pa.id)
                              JOIN prouser.papel pu
                                ON (pu.nome LIKE pa.nome || '%')
                              JOIN prouser.usuario_papel up
                                ON (up.id_papel = pu.id)
                              JOIN prouser.usuario us
                                ON (up.id_usuario = us.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A'
                            UNION
                            /* usuário relacionado a categoria através do papel primário, usando hierarquia */
                            SELECT us.id        AS id_usuario,
                                    us.nome      AS nome_usuario,
                                    us.email     AS email_usuario,
                                    pc.env_email /*,  pa.nome as papel,  'CATEGORIA' as origem*/
                              FROM cms_priv_categ pc
                              JOIN cms_categoria ctp
                                ON (pc.id_categoria = ctp.id)
                              JOIN cms_categoria ctc /*ON (ctc.id = ctp.id)*/
                                ON (ctc.chave LIKE ctp.chave || '%')
                              JOIN cms_conteudo ct
                                ON (ct.id_categoria = ctc.id)
                              JOIN prouser.papel pa
                                ON (pc.id_papel = pa.id)
                              JOIN prouser.papel pu
                                ON (pu.nome LIKE pa.nome || '%')
                              JOIN prouser.usuario us
                                ON (us.id_papel = pu.id)
                             WHERE (ct.id = $idConteudo OR ct.id_conteudo_pai = $idConteudo)
                               AND us.status = 'A')
                   GROUP BY id_usuario, nome_usuario, email_usuario";
            #echo $sql;die;
            $result = $this->getModel()->getAdapter()->fetchAll($sql);
            return $result;
        }

        public function insert($idConteudo = '') {
            if ($idConteudo) {
                $_conteudo = new Cms_Model_Conteudo_Mapper();
                $_conteudo->setId($idConteudo)->retrieve();
                $_conteudoPai = new Cms_Model_Conteudo_Mapper();
                $idCategoria = $_conteudo->getIdCategoria(true);
                $idCategoriaLike = $_conteudo->getIdCategoriaByDesc('like');
                if ($idCategoria->get() != $idCategoriaLike->get()) {

                    /* Se houver um conteúdo pai, considera o ID da categoria deste */
                    $idConteudoPai = $_conteudo->getIdConteudoPai(true)->get();
                    if ($idConteudoPai) {
                        $_conteudoPai->setId($idConteudoPai)->retrieve();
                        if ($_conteudoPai->getId(true)->get()) {
                            $idCategoria = $_conteudoPai->getIdCategoria(true)->get();
                        }
                    }

                    /* Busca a categoria pai, caso exista */
                    $_categoria = new Cms_Model_Categoria_Mapper();
                    $_categoria->setId($idCategoria)->retrieve();
                    $_categoriaPai = new Cms_Model_Categoria_Mapper();
                    if ($_categoria->getIdCategoriaPai(true)->get()) {
                        $_categoriaPai->setId($_categoria->getIdCategoriaPai(true))->retrieve();
                    }

                    $_usuario = new Auth_Model_Usuario_Mapper();
                    $usuarios = $this->_getPrivileges($idConteudo, $idConteudoPai);
                    #var_dump($usuarios);die;
                    /*$usuarios = array_merge($usuarios, array(
                        array('id_usuario' => '16524', 'email_usuario' => 'tiego.silva@tanet.com.br', 'env_email' => 'S'),
                        array('id_usuario' => '391', 'email_usuario' => 'rafael.santos@tanet.com.br', 'env_email' => 'S'),
                        array('id_usuario' => '27705', 'email_usuario' => 'patrick.reis@tanet.com.br', 'env_email' => 'S'),
                        array('id_usuario' => '6253', 'email_usuario' => 'luiz.botardo@tanet.com.br', 'env_email' => 'S')
                    ));*/
                    foreach ($usuarios as $usuario) {
                        $idMailList = NULL;
                        if ($usuario['env_email'] == 'S') {
                            if (!$usuario['email_usuario']) {
                                continue;
                            }
                            $mail = new ZendT_Mail();
                            $mail->addTo($usuario['email_usuario']);
                            $_usuarioInc = new Auth_Model_Usuario_Mapper();
                            $_usuarioInc->setId($_conteudo->getIdUsuarioInc(true)->get())->retrieve();
                            if ($_usuarioInc->getId(true)->get() == 1) {
                                $mail->addFrom('no-reply@tanet.com.br', 'Transportadora Americana');
                            } else {
                                $mail->addFrom($_usuarioInc->getEmail(true)->get(), $_usuarioInc->getNome(true)->get());
                            }

                            $tituloEmail = '';
                            if ($_categoriaPai->getId(true)->get()) {
                                $tituloEmail = $_categoriaPai->getDescricao()->get() . ' - ';
                            }
                            $tituloEmail .= $_categoria->getDescricao()->get();
                            $tituloEmail .= " ({$idConteudo})";
                            $mail->setTitle($tituloEmail)->setSubject($tituloEmail);

                            $url = Cms_Model_Conteudo_Mapper::getUrlView($idConteudo, false, true);
                            $titulo = '';
                            if (!$_conteudo->getIdConteudoPai(true)->get()) {
                                $titulo = $_conteudo->getTitulo()->get();
                            } else {
                                $titulo = $_conteudoPai->getTitulo(true)->get();
                            }
                            if ($titulo) {
                                $titulo .= '<br/><br/>';
                            }
                            //$remetente = $_conteudo->getSubTitulo()->get();

                            $comment = $titulo . 'Para acessar esse conteúdo, clique <a href = "' . $url . '">aqui</a>';
                            $mail->setComment($comment);
                            $body = $_conteudo->getCorpo()->get();
                            if ($_conteudoPai->getId(true)->get()) {
                                $body .= "<br/><hr/>" . $_conteudoPai->getCorpo()->get();
                            }
                            if ($body) {
                                $body .= "<br/></hr>";
                            } else {
                                $body = " ";
                            }
                            $mail->setBody($body);
                            $idMailList = $mail->save();
                        }
                        /* @todo: Remover - IF temporário */
                        if ($usuario['env_email'] == 'S') {
                            $this->setIdConteudo($idConteudo);
                            $this->setIdUsuario($usuario['id_usuario']);
                            if ($this->exists() && $idMailList) {
                                $this->delete();
                            }
                            $this->setIdMaillist($idMailList);
                            if (!$this->exists()) {
                                $this->insert();
                            }
                            $this->getModel()->getAdapter()->commit();
                        }
                    }
                }
            } else {
                parent::insert();
            }
        }

        public function remove($idConteudo, $idUsuario = '', $deleteFilhos = true) {
            if (!$idUsuario) {
                $idUsuario = Zend_Auth::getInstance()->getStorage()->read()->getId();
            }
            $this->setIdConteudo($idConteudo)->setIdUsuario($idUsuario)->delete(null);
            if ($deleteFilhos) {
                $_conteudo = new Cms_DataView_Conteudo_MapperView();
                $_where = new ZendT_Db_Where();
                $_where->addFilter("cms_conteudo.id_conteudo_pai", $this->getIdConteudo(true)->get());
                $_conteudo->findAll($_where, '*');
                while ($_conteudo->fetch()) {
                    $this->remove($_conteudo->getId());
                }
            }
        }

    }

?>