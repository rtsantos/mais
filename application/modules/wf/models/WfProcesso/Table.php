<?php
/**
 * Classe de mapeamento da tabela wf_processo
 */
class Wf_Model_WfProcesso_Table extends Wf_Model_WfProcesso_Crud_Table implements ZendT_Workflow_Process_Interface{
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
        $sqlBase = " FROM ".$this->getTableName()." wf_processo
                     LEFT JOIN prouser.aplicacao aplicacao ON (wf_processo.id_aplicacao = aplicacao.id) 
                     WHERE ".$cmdWhere;

        /**
         * Pega o número de registro para paginação
         */
        $sql = "SELECT COUNT(*) as total ".$sqlBase;
        $numRows = $this->getAdapter()->fetchOne($sql,$binds);
        
        
        /**
         * Coloca as colunas que serão retornadas
         */
        $sql = "SELECT   wf_processo.* ";
        $sql.= "     , aplicacao.sigla as sigla_aplicacao";
        $sql.= "     , aplicacao.nome as nome_aplicacao";
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
     * @param type $mapperName 
     * @return ZendT_Workflow_Process_Row[]
     */
    public function getProcess($mapperName) {
        $where = new ZendT_Db_Where();
        $where->addFilter('nome_modelo', $mapperName);        
        $rows = $this->getRows($where);
        
        $_process = array();
        $_iProcess = 0;
        foreach ($rows as $row){
            $_process[$_iProcess] = new ZendT_Workflow_Process_Row();
            $_process[$_iProcess]->setDescription($row['descricao']);            
            $_process[$_iProcess]->setColumn($row['coluna_filtro']);
            $_process[$_iProcess]->setId($row['id']);
            $_iProcess++;
        }
        return $_process;
    }
}
?>