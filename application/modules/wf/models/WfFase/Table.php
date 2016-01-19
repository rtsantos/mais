<?php
/**
 * Classe de mapeamento da tabela wf_fase
 */
class Wf_Model_WfFase_Table extends Wf_Model_WfFase_Crud_Table implements ZendT_Workflow_Fase_Interface{
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
        $sqlBase = " FROM ".$this->getTableName()." wf_fase
                      JOIN projta.wf_processo wf_processo ON (wf_fase.id_wf_processo = wf_processo.id) 
                     WHERE ".$cmdWhere;

        /**
         * Pega o número de registro para paginação
         */
        $sql = "SELECT COUNT(*) as total ".$sqlBase;
        $numRows = $this->getAdapter()->fetchOne($sql,$binds);
        
        
        /**
         * Coloca as colunas que serão retornadas
         */
        $sql = "SELECT   wf_fase.* ";
        $sql.= "     , wf_processo.descricao as descricao_wf_processo";
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
    /**
     *
     * @param int $processId
     * @param string $value 
     * @return ZendT_Workflow_Fase_Row;
     */
    public function getFase($processId, $value) {
        $where = new ZendT_Db_Where();
        $where->addFilter('id_wf_processo', $processId);
        
        $where->addFilter('valor', $value);
        $rows = $this->getRows($where);
        $fase = new ZendT_Workflow_Fase_Row();
        $fase->setDescription($rows[0]['descricao']);
        $fase->setNotification($rows[0]['proc_notif']);
        return $fase;
    }
}
?>