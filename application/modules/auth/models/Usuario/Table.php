<?php

    /**
     * Classe de mapeamento da tabela usuario
     */
    class Auth_Model_Usuario_Table extends Auth_Model_Papel_Table implements ZendT_Acl_User_Interface {

        public function getApps($id) {
            $sql = "SELECT aplicacao.descricao, aplicacao.observacao, aplicacao.hierarquia
                      FROM prouser.recurso aplicacao
                      JOIN prouser.tipo_recurso tipo_recurso ON (aplicacao.id_tipo_recurso = tipo_recurso.id)
                     WHERE tipo_recurso.nome = 'MODULE'
                       AND aplicacao.status = 'A'
                       AND EXISTS (
                              SELECT 1
                                FROM papel_recurso 
                                JOIN papel ON (papel_recurso.id_papel = papel.id)
                                JOIN recurso ON (papel_recurso.id_recurso = recurso.id)
                                JOIN papel_rel ON (papel_rel.id_papel = :id_usuario)
                                JOIN papel papel_usu ON (papel_rel.id_papel_rel = papel_usu.id)
                               WHERE recurso.status = 'A'
                                 AND papel_recurso.acesso = 'P'
                                 AND papel.status = 'A'
                                 AND papel.hierarquia LIKE {$this->getAdapter()->concat(array("papel_usu.hierarquia", "'%'"))}
                                 AND recurso.hierarquia LIKE {$this->getAdapter()->concat(array("aplicacao.hierarquia", "'%'"))}
                         ) ORDER BY aplicacao.descricao ";
            $rows = $this->getAdapter()->fetchAll($sql, array('id_usuario' => $id));
            $baseUrl = ZendT_Url::getBaseUrl();
            if ($rows) {
                foreach ($rows as &$row) {
                    $row['observacao'] = str_replace('{baseUrl}', $baseUrl, $row['observacao']);
                }
            }
            return $rows;
        }

        /**
         *
         * @param int $id
         * @return \ZendT_Acl_User_Row 
         */
        public function getRowSession($id) {
            $sql = "SELECT usr.id, 
                       usr.nome as login, 
                       usr.descricao as nome, 
                       usr.email, 
                       ppl.nome as papel, 
                       usr.id as chapa,
                       usr.avatar
                   FROM prouser.papel usr
                   LEFT JOIN prouser.papel ppl ON (usr.id_papel_pai = ppl.id) 
                 WHERE usr.id = :id_usuario";

            $stmt = $this->getAdapter()->query($sql, array('id_usuario' => $id));

            $row = $stmt->fetch();

            $_fileSystem = new Ged_Model_Arquivo_FileSystem();
            if (!$row['avatar']) {
                $_auth = new Auth_Model_Usuario_Mapper();
                $_auth->setLogin('GUEST')->retrieve();
                $row['avatar'] = $_auth->getAvatar();
            }
            $row['avatar'] = $_fileSystem->getDirectoryAdress($row['avatar']);

            $apps = $this->getApps($row['id']);

            $user = new ZendT_Acl_User_Row();
            $user
                    ->setId($row['id'])
                    ->setLogin($row['login'])
                    ->setRole($row['papel'])
                    ->setEmail($row['email'])
                    ->setName($row['nome'])
                    ->setAvatar($row['avatar'])
                    ->setChapa($row['chapa'])
                    ->setApps($apps);

            return $user;
        }

        public function getIdEmpresaUsuario($id) {
            $sql = "SELECT pe.id_empresa
                      FROM prouser.papel_empresa pe
                     WHERE pe.id_papel = :id_usuario
                       AND pe.padrao = 'S' ";
            $rows = $this->getAdapter()->fetchCol($sql, array('id_usuario' => $id));
            return $rows;
        }

        public function getIdEmpresasUsuario($id) {
            $sql = "SELECT pe.id_empresa
                      FROM prouser.papel_empresa pe
                     WHERE pe.id_papel = :id_usuario";
            $row = $this->getAdapter()->fetchOne($sql, array('id_usuario' => $id));
            return $row;
        }

    }
    