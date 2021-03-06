<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resource
 *
 * @author rsantos
 */
class ZendT_Acl_Resource {
    /**
     *
     * @param string $adapter
     * @return \ZendT_Acl_Resource_Interface
     * @throws Zend_Db_Exception 
     */
    public static function factory( $adapter ){
        /*
         * Cria uma instância do adaptador da classe
         */
        $classAdapter = new $adapter();

        /*
         * Verifica se o objeto implementa da interface ZendT_Acl_Resource_Interface
         */
        if (!$classAdapter instanceof ZendT_Acl_Resource_Interface) {
            /**
             * @see Zend_Db_Exception
             */
            require_once 'Zend/Db/Exception.php';
            throw new Zend_Db_Exception("O adaptador '" . get_class($classAdapter) . "' não implementa a interface ZendT_Acl_Role_Interface");
        }

        return $classAdapter;
    }
}

?>
