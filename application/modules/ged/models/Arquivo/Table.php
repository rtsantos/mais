<?php
    /**
     * Classe de mapeamento da tabela img_arquivo
     */
    class Ged_Model_Arquivo_Table extends Ged_Model_Arquivo_Crud_Table{
        /**
        * Define novo adapter
        * 
        * @param string $db
        * @return \Frota_Model_Veiculo_Table 
        */
        public function setAdapter($db) {
            $this->_adapter = $db;
            return $this;
        }
    }
?>