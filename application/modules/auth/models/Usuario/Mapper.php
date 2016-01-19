<?php

    /**
     * Classe de mapeamento do registro da tabela usuario
     */
    class Auth_Model_Usuario_Mapper extends Auth_Model_Usuario_Crud_Mapper {

        public function setAvatar($value, $options = array()) {
            $options+= array('prop_docto_name' => 'USUARIO_AVATAR');
            $this->_data['avatar'] = $this->_setFileSystem($value, $options);
            return $this;
        }

        /**
         *
         * @param string $chapaUsuario
         * @return string
         * @throws ZendT_Exception_Alert 
         */
        public function getIdUsuarioColetor($chapaUsuario) {

            /**
             * Recupera o ID do Conferente
             */
            $chapaUsuario = substr($chapaUsuario, 3);
            $usuario = new Auth_Model_Usuario_LoginColetorMapperView();
            $where = new ZendT_Db_Where();
            $where->addFilter('usuario.chapa', $chapaUsuario);
            $dadosUsuario = $usuario->getDataGrid($where, null)->getRow();

            if (!$dadosUsuario) {
                throw new ZendT_Exception_Alert('Usuário não encontrado!');
            }

            return $dadosUsuario['id']->get();
        }

        public function getUsuariosPapel($papel, $field = 'id', $notInclude = array()) {
            $result = array();
            $_papel = new Auth_DataView_Papel_MapperView();
            $_usuario = new Auth_DataView_Usuario_MapperView();
            if (is_numeric($papel)) {
                $papel = $_papel->setId($papel)->retrieve()->getNome();
            }
            if ($papel) {
                $_where = new ZendT_Db_Where();
                $_where->addFilter("papel.nome", $papel, "?%");
                foreach ($notInclude as $value) {
                    $_where->addFilter("papel.nome", $value, "!=");
                }
                $_papel->findAll($_where, array('id'));
                while ($_papel->fetch()) {
                    $_where = new ZendT_Db_Where();
                    $_where->addFilter("usuario.id_papel", $_papel->getId()->get(), "=");
                    $_where->addFilter("usuario.status", 'A', "=");
                    $_usuario->findAll($_where, "*");
                    while ($_usuario->fetch()) {
                        if (!is_array($field)) {
                            $result[] = $_usuario->getData($field)->get();
                        } else {
                            $results = array();
                            foreach ($field as $f) {
                                $results[$f] = $_usuario->getData($f)->get();
                            }
                            $result[] = $results;
                        }
                    }
                }
            }
            return $result;
        }

        public function getNomeFormatado($empresa = true, $filial = true, $primeiroUltimo = false) {
            $result = "";
            if ($this->getId(true)->toPhp()) {
                $empresa_filial = "";
                if ($empresa) {
                    $_empresa = new Ca_Model_Empresa_Mapper();
                    $_empresa->setId($this->getIdEmpresa())->retrieve();
                    $empresa = $_empresa->getSigla(true)->get();
                    $empresa_filial .= $empresa;
                }
                if ($filial) {
                    $_filial = new Ca_Model_Filial_Mapper();
                    $_filial->setId($this->getIdFilial())->retrieve();
                    $filial = $_filial->getSigla(true)->get();
                    if ($filial == 'MAT') {
                        $filial = 'AMR';
                    }
                    $empresa_filial .= ($empresa_filial ? " / " . $filial : $filial);
                }
                if ($empresa_filial) {
                    $empresa_filial = " - " . $empresa_filial;
                }
                $nome = ucwords(strtolower($this->getNome()->get()));
                if ($primeiroUltimo) {
                    $nomes = explode(" ", $nome);
                    $nome = $nomes[0] . " " . end($nomes);
                }
                $result = $nome . $empresa_filial;
            }
            return $result;
        }

        /**
         * Método que obtêm informações adicionais do usuário.
         * 
         * @param string $user
         * @return type
         */
        public function getInfoAdic($user) {
            $db = Zend_Registry::get('db.prouser');
            $pHtml = 'N';
            $sql = "DECLARE
                        v_ret        PLS_INTEGER; 
                        field        VARCHAR2(30);
                        desc_field   VARCHAR2(100);
                    BEGIN
                        :v_ret  := auth_ptk_pkg.get_inf_adic(p_username   => :p_username,
                                                             p_html       => :p_html,    
                                                             p_field_name => :field,
                                                             p_label_text => :desc_field);
                                       
                    END;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':p_username', $user);
            $stmt->bindParam(':p_html', $pHtml);
            $stmt->bindParam(':field', $field, null, 30);
            $stmt->bindParam(':desc_field', $descField, null, 100);
            $stmt->bindParam(':v_ret', $code, null, 10);

            $stmt->execute();
            return array(
                'field' => $field,
                'desc' => utf8_encode($descField));
        }

        /**
         * Função Responsável por realizar a autenticação do Usuário.
         * 
         * @param string $usuario Login do Usuário.
         * @param string $senha Senha.
         * @param string $campoAdicional Campo adicional utilizado para validação.
         * @param string $valor Valor do campo Adicional.
         */
        public function authenticateUser($usuario, $senha, $campoAdicional, $valor) {
            $db = Zend_Registry::get('db.prouser');

            $sql = "DECLARE

                    p_id_usuario NUMBER(10);
                    p_message    VARCHAR2(100);
                    v_ret        PLS_INTEGER;

                 BEGIN
                    :v_ret := auth_ptk_pkg.logon(p_username   => :p_username
                                               ,p_password    => :p_password
                                               ,p_id_usuario  => :p_id_usuario
                                               ,p_message     => :p_message
                                               ,p_field_valid => :p_field_valid
                                               ,p_value_valid => :p_value_valid);
                 END;  ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':p_username', $usuario);
            $stmt->bindParam(':p_password', $senha);
            $stmt->bindParam(':p_field_valid', $campoAdicional);
            $stmt->bindParam(':p_value_valid', $valor);
            $stmt->bindParam(':p_id_usuario', $idUsuario, null, 10);
            $stmt->bindParam(':p_message', $msg, null, 100);
            $stmt->bindParam(':v_ret', $code, null, 1);
            $stmt->execute();
            //@todo: na proxima versão alterarei na pkg, quando utilizamos a senha t@ na informação adicional ele retorna null.
            $code = $code ? $code : 0;
            $json = new ZendT_Json_Result();
            switch ($code) {
                case 8:
                    $dados = $this->getInfoAdic($usuario);
                    $json->setResult(array('code' => $code, 'message' => utf8_encode($msg), "field" => $dados['field'], "desc" => ($dados['desc'])));
                    break;
                case 9:
                    $json->setResult(array('code' => $code, 'message' => utf8_encode($msg)));
                    break;
                default :
                    $json->setResult(array('code' => $code, 'message' => utf8_encode($msg)));
            }

            return $json->render();
        }

        /**
         * Função que altera a senha o Usuário.
         * 
         * @param string $usuario Login do Usuário.
         * @param string $senha Senha Anterior.
         * @param string $novaSenha Nova senha.
         * @param string $senhaConfirmada Confirmação da Nova Senha.
         */
        public function changePsw($usuario, $senha, $novaSenha, $senhaConfirmada) {
            $db = Zend_Registry::get('db.prouser');
            $code = null;
            //@TODO: por enquanto essa validação esta sendo realizada aqui. Aguardando definições do FSPIGOLON para o novo metodo de trocar senha.
            if ($senha && $novaSenha && ($novaSenha <> $senhaConfirmada)) {
                $code = 1;
                $msg = "Nova Senha e Confirmação devem ser idênticas!";
            }
            if ($code != 1) {

                $this->setLogin($usuario)->retrieve();
                $idUser = $this->getId()->get();
                $sql = "
                      DECLARE
                        v_ret  INTEGER;
                        message varchar(150);
                      BEGIN
                        :v_ret := app_pkg.change_password(pidusuario => :pidusuario,
                                                          psenhaatual => :psenhaatual,
                                                          psenhanova => :psenhanova,
                                                          message => :message);
                      END;";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':pidusuario', $idUser);
                $stmt->bindParam(':psenhaatual', $senha);
                $stmt->bindParam(':psenhanova', $novaSenha);
                $stmt->bindParam(':v_ret', $code, null, 1);
                $stmt->bindParam(':message', $msg, null, 150);
                $stmt->execute();
            }

            $json = new ZendT_Json_Result();
            $json->setResult(array('code' => $code, 'message' => $msg));
            return $json->render();
        }

        public function changeSolicInf($usuario, $infAdic) {
            $this->setLogin($usuario)->retrieve();
            $this->setSolicInfoAdic($infAdic)->update();
            $json = new ZendT_Json_Result();
            $json->setResult(array('message' => "OK"));
            return $json->render();
        }

        public function _afterSave() {
            parent::_afterSave();
            if (Auth_Session_User::getInstance()->getLogin() == $this->getLogin()->get()) {
                Auth_Session_User::refresh($this->getLogin()->get());
            }
        }

    }

?>