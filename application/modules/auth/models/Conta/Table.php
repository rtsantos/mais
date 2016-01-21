<?php

    /**
     * Classe de mapeamento da tabela papel
     */
    class Auth_Model_Conta_Table extends Auth_Model_Conta_Crud_Table implements ZendT_Acl_Role_Interface, ZendT_Acl_User_Interface {

        /**
         * Busca os papeis para montagem do ZendT_Acl
         * 
         * @return \ZendT_Acl_Role_Row[]
         */
        public function getRoles() {
            $sql = "SELECT ppl.nome as papel, pplSup.nome AS papel_pai
                      FROM papel ppl
                      LEFT JOIN Papel pplSup ON (ppl.id_papel_pai = pplSup.Id)
                     ORDER BY ppl.hierarquia";

            $result = $this->getAdapter()->fetchAll($sql);

            $roles = array();
            foreach ($result as $item) {
                $role = new ZendT_Acl_Role_Row();
                $role->setName($item['papel'])
                        ->setParent($item['papel_pai']);
                $roles[] = $role;
            }


            return $roles;
        }

        /**
         * Retorna os usuários de um determinado papel
         * 
         * @param ZendT_Db_Where|array $where 
         */
        public function getUsuarios($where) {
            if (is_array($where)) {
                $newWhere = new ZendT_Db_Where();
                foreach ($where as $column => $value) {
                    $newWhere->addFilter($column, $value);
                }
                $where = $newWhere;
            }
            if ($where instanceof ZendT_Db_Where) {
                $cmdWhere = $where->getSqlWhere();
                $binds = $where->getBinds();
            }
            $sql = 'SELECT usuario.* 
                      FROM prouser.papel papel
                      JOIN prouser.papel_rel papel_rel ON (papel_rel.id_papel_rel = papel.id)
                      JOIN prouser.papel usuario ON (papel_rel.id_papel = usuario.id)
                     WHERE ' . $cmdWhere;
            return $this->getAdapter()->fetchAll($sql, $binds);
        }

        public function getWhereSeekerSearch($value, $field = '') {
            $where = new ZendT_Db_Where('AND');
            $result = array();
            $result['column'] = '';
            $result['operation'] = '';
            $result['mapper'] = $this->getMapperName();

            if (count($this->_primary) == 1) {
                if (is_numeric($value)) {
                    $result['column'] = $this->_name . "." . $this->_primary[0];
                    $result['operation'] = '=';
                }
            }

            if ($field == 'id') {
                $result['column'] = $this->_name . ".id";
                $result['operation'] = '=';
            }

            if ($result['column'] == '') {
                $_usuario = new Auth_DataView_Usuario_MapperView();
                $where = new ZendT_Db_Where('AND');
                $where->addFilter('papel.descricao'
                        , $value
                        , '?%'
                        , 'Auth_Model_Conta_Mapper');
                $data = $_usuario->getDataGrid($where, array())

                ;
                $row = $data->getRow();
                if ($row) {
                    $result['column'] = $this->_name . ".descricao";
                    $result['operation'] = '?%';
                } else {
                    $result['column'] = $this->_name . "." . $this->_search;
                    $result['operation'] = '?%';
                }
            }

            if ($value) {
                $where = new ZendT_Db_Where('AND');
                $where->addFilter($result['column']
                        , $value
                        , $result['operation']
                        , $result['mapper']);
            }
            return $where;
        }

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
                $_auth = new Auth_Model_Conta_Mapper();
                $_auth->setNome('GUEST')->retrieve();
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
    