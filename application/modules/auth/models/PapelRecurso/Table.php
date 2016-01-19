<?php

    /**
     * Classe de mapeamento da tabela papel_recurso
     */
    class Auth_Model_PapelRecurso_Table extends Auth_Model_PapelRecurso_Crud_Table implements ZendT_Acl_Privilege_Interface {

        /**
         * Busca os privilégios de acesso
         * 
         * @param string $moduleName
         * @return ZendT_Acl_Privilege_Row[] 
         */
        public function getPrivileges($moduleName) {
            $sql = "
         SELECT ppl.nome AS papel, rsu.nome AS recurso, pplRsu.acesso
           FROM papel_recurso pplRsu
           JOIN papel ppl ON (pplRsu.Id_papel = ppl.id)
           JOIN recurso rsu ON (pplRsu.Id_recurso = rsu.id)
           JOIN aplicacao app ON (rsu.id_aplicacao = app.id)
          WHERE app.sigla = :module
            AND rsu.status = 'A' ";

            $rows = $this->getAdapter()
                    ->fetchAll(
                    $sql, array(
                'module' => strtoupper($moduleName)
                    )
            );
            $result = array();
            foreach ($rows as $row) {
                $privilege = new ZendT_Acl_Privilege_Row();
                $privilege->setRole($row['papel'])
                        ->setResource($row['recurso'])
                        ->setAccess(($row['acesso'] == 'P') ? 'A' : 'D');
                $result[] = $privilege;
            }

            return $result;
        }

        public function save($data, $event = 'insert', $where = null) {
            /* $sql = 'SELECT a.sigla
              FROM recurso r
              JOIN aplicacao a ON (r.id_aplicacao = a.id)
              WHERE r.id_recurso = :id_recurso ';
              $moduleName = $this->getAdapter()->fetchOne($sql, array('id_recurso' => $data['id_recurso']));
              $moduleName = strtolower($moduleName);
              ZendT_Acl::getInstance()->clearCache($moduleName); */

            return parent::save($data, $event, $where);
        }

    }

?>