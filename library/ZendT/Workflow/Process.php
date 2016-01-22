<?php
/**
 * Process do workflow
 *
 * @author ksantoja
 */
class ZendT_Workflow_Process {
    /**
     *
     * @param string $adapter
     * @return \ZendT_Workflow_Process_Interface
     * @throws Zend_Db_Exception 
     */
    public static function factory( $adapter ){
        /*
         * Cria uma instância do adaptador da classe
         */
        $classAdapter = new $adapter();
        /*
         * Verifica se o objeto implementa da interface ZendT_Workflow_Process_Interface
         */
        if (!$classAdapter instanceof ZendT_Workflow_Process_Interface) {
            /**
             * @see Zend_Db_Exception
             */
            require_once 'Zend/Db/Exception.php';
            throw new Zend_Db_Exception("O adaptador " . get_class($classAdapter) . " não implementa a interface ZendT_Workflow_Process_Interface");
        }

        return $classAdapter;
    }
}
?>
