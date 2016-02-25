<?php

    /**
     * Classe de mapeamento do registro da tabela tl_log_erro
     */
    class Tools_Model_LogErro_Mapper extends Tools_Model_LogErro_Crud_Mapper {

        /**
         *
         * @var Tools_Model_LogErro_Mapper 
         */
        public static $_instance = null;

        public static function log($proc, $message) {
            if (self::$_instance == null) {
                self::$_instance = new Tools_Model_LogErro_Mapper();
            }
            self::$_instance->newRow();
            self::$_instance->setProcedimento($proc)
                    ->setDhLog(ZendT_Type_Date::nowDateTime())
                    ->setMensagem(substr($message, 0, 999))
                    ->insert();
            return true;
        }

    }

?>