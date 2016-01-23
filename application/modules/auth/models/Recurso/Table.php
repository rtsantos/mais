<?php

    /**
     * Classe de mapeamento da tabela recurso
     */
    class Auth_Model_Recurso_Table extends Auth_Model_Recurso_Crud_Table implements ZendT_Acl_Resource_Interface {

        /**
         * Busca a linha do recurso passando uma condição Where
         * 
         * @param int|array $where
         * @return array
         */
        public function getResource($where) {
            if (is_numeric($where)) {
                $where = array('id' => $id);
            }

            $sql = "SELECT * FROM " . $this->_name . "  WHERE 1 = 1 ";

            foreach ($where as $key => &$value) {
                $sql.= " AND " . $key . " = :" . $key . " ";
            }

            $result = $this->getAdapter()->query($sql, $where);

            return get_object_vars($result);
        }

        /**
         * Retorna os recurso ordenado de forma hierarquica
         * 
         * @param string $moduleName
         * @return ZendT_Acl_Resource_Row[]
         */
        public function getResources($moduleName) {
            $moduleName = strtolower($moduleName);

            $sql = "SELECT rsu.id, rsu.hierarquia as recurso, rsuPai.hierarquia AS recurso_pai
                      FROM ".Auth_Model_Recurso_Mapper::$table." rsu
                      LEFT JOIN ".Auth_Model_Recurso_Mapper::$table." rsuPai ON (rsu.id_recurso_pai = rsuPai.Id)
                     WHERE rsu.Status = 'A'
                       AND rsu.hierarquia LIKE '" . $moduleName . "%'
                     ORDER BY rsu.hierarquia";

            $result = $this->getAdapter()->fetchAll($sql);
            
            $resources = array();
            foreach ($result as $item) {
                $resource = new ZendT_Acl_Resource_Row();
                $resource
                        ->setName($item['recurso'])
                        ->setParent($item['recurso_pai']);
                $resources[] = $resource;
            }

            return $resources;
        }

        /**
         * 
         * @param string $moduleName
         * 
         * @return ZendT_Acl_Resource_RowMenu[]
         */
        public function getMenu($moduleName) {
            $moduleName = strtoupper($moduleName);

            $sql = "SELECT rsu.hierarquia AS recurso, rsu.descricao, rsuPai.hierarquia AS recurso_pai,rsu.nivel
                      FROM recurso rsu
                      JOIN tipo_recurso tpRsu ON (rsu.id_tipo_recurso = tpRsu.Id)
                      LEFT JOIN recurso rsuPai ON (rsu.id_recurso_pai = rsuPai.Id)
                     WHERE tpRsu.Nome = 'MENU'
                       AND rsu.status = 'A'
                       AND rsuPai.hierarquia LIKE '" . $moduleName . "%'
                     ORDER BY rsuPai.hierarquia, rsu.ordem, rsu.hierarquia, rsu.descricao";

            $rows = $this->getAdapter()->fetchAll($sql);

            $result = array();
            foreach ($rows as $row) {
                $menu = new ZendT_Acl_Resource_RowMenu();
                $menu
                        ->setDescription(utf8_encode($row['descricao']))
                        ->setUrl($row['recurso']);

                $result[$row['recurso_pai']][] = $menu;
            }
            return $result;
        }

        public function saveByLote($data) {
            $_aplicacao = new Auth_Model_Aplicacao_Table();
            $_tipoRecurso = new Auth_Model_TipoRecurso_Table();

            foreach ($data as $recurso) {
                $_recurso = $this->retrive(array('nome' => $recurso['name']), null, false);
                $idRecurso = $_recurso['id'];

                $tipoRecurso = $_tipoRecurso->retrive(array('nome' => $recurso['type']), null, false);
                $idTipoRecurso = $tipoRecurso['id'];

                $aplicacao = $_aplicacao
                        ->retrive(
                        array(
                    'sigla' => strtoupper($recurso['module'])
                        )
                        , null
                        , false
                );
                $idAplicacao = $aplicacao['id'];
                if (!$idAplicacao) {
                    throw new ZendT_Exception('Aplicação ' . $recurso['module'] . ' não cadastrada!');
                }

                $recursoPai = $this
                        ->retrive(
                        array(
                    'nome' => $recurso['parent']
                        )
                        , null
                        , false
                );

                $rowRecurso = $this->getResource(
                        array(
                            'nome' => $recurso['name']
                        )
                );

                $rowRecurso['id'] = $idRecurso;
                $rowRecurso['nome'] = $recurso['name'];
                $rowRecurso['hierarquia'] = $recurso['name'];
                $rowRecurso['id_recurso_pai'] = $recursoPai['id'];
                $rowRecurso['id_aplicacao'] = $idAplicacao;
                $rowRecurso['id_tipo_recurso'] = $idTipoRecurso;
                $rowRecurso['status'] = 'A';
                if (!isset($rowRecurso['id'])) {
                    $rowRecurso['descricao'] = $recurso['name'];
                }

                try {
                    if ($rowRecurso['id']) {
                        $this->update($rowRecurso, array('id' => $idRecurso));
                    } else {
                        $this->save($rowRecurso);
                    }
                } catch (Exception $Ex) {
                    throw new ZendT_Exception($Ex->getMessage() . ' :: ' . var_export($rowRecurso, true));
                }
            }
            //$this->sortLevel();
        }

        public function getListHerdado() {
            return array(1 => 'Sim', 0 => 'Não');
        }

        public function save($data, $event = 'insert', $where = null) {
            /* $sql = 'SELECT a.sigla FROM aplicacao a WHERE a.id = :id_aplicacao ';
              $moduleName = $this->getAdapter()->fetchOne($sql, array('id_aplicacao' => $data['id_aplicacao']));
              $moduleName = strtolower($moduleName);
              ZendT_Acl::getInstance()->clearCache($moduleName); */
            return parent::save($data, $event, $where);
        }

    }
    