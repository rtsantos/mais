<?php
/**
 * Interface para tratar os privilégios de acesso
 * 
 * @package ZendT
 * @subpackage ZendT_Acl
 * @author jcarlos
 */
interface ZendT_Acl_Privilege_Interface {
    /**
     * Retorna os privilégios de acesso
     * 
     * @param string $moduleName
     * @return ZendT_Acl_Privilege_Row[]
     */
    public function getPrivileges( $moduleName );
}
?>
