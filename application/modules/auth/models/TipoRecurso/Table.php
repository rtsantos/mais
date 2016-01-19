<?php
/**
 * Classe de mapeamento da tabela tipo_recurso
 */
class Auth_Model_TipoRecurso_Table extends Auth_Model_TipoRecurso_Crud_Table{
    /**
     * Pega os dados para executar o grid
     * 
     * @param ZendT_Db_Where|ZendT_Db_Where_Group $where;
     * @param array $postData;
     * @return ZendT_Grid_Data
     */
    public function getDataGrid($where,$postData){
        $cmdWhere = $where->getSqlWhere();
        $binds = $where->getBinds();
        /**
         * Retorna os dados através do objeto Data
         * para facilar a codificação na action
         */
        
        /**
         * Através dos dados postados adquire as informações
         * para paginar os dados e ordená-los
         */
        $pager = new ZendT_Grid_Paginator($postData);
        /**
         * SQL base
         */
        $sqlBase = " FROM ".$this->getTableName()." tipo_recurso
                     WHERE ".$cmdWhere;

        /**
         * Pega o número de registro para paginação
         */
        $sql = "SELECT COUNT(*) as total ".$sqlBase;
        $numRows = $this->getAdapter()->fetchOne($sql,$binds);
        
        
        /**
         * Coloca as colunas que serão retornadas
         */
        $sql = "SELECT   tipo_recurso.* ";
        $sql.= $sqlBase;
        /**
         * Configura a coluna de ordenação
         */
        $sql.= "ORDER BY ".$pager->getOrderBy();
        /**
         * Configura o range de dados que será buscado
         */
        if (!isset($postData['noPage'])) {
            $sql = $this->getAdapter()->limit($sql,$pager->getLimitCount(),$pager->getLimitOffset());
        }
        /**
         * Pega os dados
         */
        $stmt = $this->getAdapter()->query($sql,$binds);
         /**
          * Retorna os dados através do objeto Data          
*          * para facilar a codificação na action          */
         $data = new ZendT_Grid_Data($stmt,$this->_columnMappers);
                 
         

        $data->setNumRows($numRows);
         $data->setNumPage($pager->getNumPage());
        return $data;
    }
}
?>