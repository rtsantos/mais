<?php
/**
 * 
 *
 * @author rsantos
 */
class ZendT_Acl_User {
    /**
     *
     * @param type $adapter
     */
    public static function factory($adapter){
        /*
         * Cria uma instância do adaptador da classe
         */
        $classAdapter = new $adapter();
        /*
         * Verifica se o objeto implementa da interface ZendT_Acl_User_Interface
         */
        if (!$classAdapter instanceof ZendT_Acl_User_Interface) {
            /**
             * @see Zend_Db_Exception
             */
            require_once 'Zend/Db/Exception.php';
            throw new Zend_Db_Exception("O adaptador '$classAdapter' não implementa a interface ZendT_Acl_User_Interface");
        }

        return $classAdapter;
    }
}
?>
