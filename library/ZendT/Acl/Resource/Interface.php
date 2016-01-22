<?php
/**
 *
 * @author rsantos
 */
interface ZendT_Acl_Resource_Interface {
    /**
     * Retorna o menu da aplicação
     * 
     * @return ZendT_Acl_RowMenu
     */
    public function getMenu($moduleName);
    /**
     * Retorna os recursos da aplicação
     * 
     * @return ZendT_Acl_Row
     */    
    public function getResources( $moduleName );
}
?>
