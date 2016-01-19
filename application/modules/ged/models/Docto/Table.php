<?php
    /**
     * Classe de mapeamento da tabela img_docto
     */
    class Ged_Model_Docto_Table extends Ged_Model_Docto_Crud_Table{
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