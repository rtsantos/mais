<?php

    /**
     * Classe de mapeamento do registro da tabela cv_log_pedido
     */
    class Vendas_Model_LogPedido_Mapper extends Vendas_Model_LogPedido_Crud_Mapper {

        /**
         *
         * @var Vendas_Model_LogPedido_Mapper 
         */
        public static $_instance = null;

        public static function log($id, $message) {
            if (self::$_instance == null) {
                self::$_instance = new Vendas_Model_LogPedido_Mapper();
            }
            self::$_instance->newRow();
            self::$_instance->setIdPedido($id)
                    ->setDhLog(ZendT_Type_Date::nowDateTime())
                    ->setMensagem(substr($message, 0, 999))
                    ->insert();
            return true;
        }

    }

?>