<?php

   /**
    * Classe de mapeamento da tabela at_privilegio
    */
   class Auth_Model_Privilegio_Table extends Auth_Model_Privilegio_Crud_Table implements ZendT_Acl_Privilege_Interface{

       /**
        * Busca os privilégios de acesso
        * 
        * @param string $moduleName
        * @return ZendT_Acl_Privilege_Row[] 
        */
       public function getPrivileges($moduleName) {
           $moduleName = strtolower($moduleName);
           $sql = "SELECT conta.hierarquia AS papel, 
                          recurso.hierarquia AS recurso, 
                          privilegio.acesso
                     FROM " . Auth_Model_Privilegio_Mapper::$table . " privilegio
                     JOIN " . Auth_Model_Conta_Mapper::$table . " conta ON (privilegio.Id_papel = conta.id)
                     JOIN " . Auth_Model_Recurso_Mapper::$table . " recurso ON (privilegio.Id_recurso = recurso.id)
                    WHERE recurso.hierarquia LIKE '" . $moduleName . "%'
                      AND recurso.status = 'A'
                    ORDER BY conta.hierarquia DESC, recurso.hierarquia DESC ";

           $rows = $this->getAdapter()->fetchAll($sql);
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

   }

?>