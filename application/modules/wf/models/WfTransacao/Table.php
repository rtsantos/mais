<?php
/**
 * Classe de mapeamento da tabela wf_transacao
 */
class Wf_Model_WfTransacao_Table extends Wf_Model_WfTransacao_Crud_Table{
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
        $sqlBase = " FROM ".$this->getTableName()." wf_transacao
                     JOIN projta.wf_fase wf_fase ON (wf_transacao.id_wf_fase = wf_fase.id) 
                     JOIN projta.wf_processo wf_processo ON (wf_fase.id_wf_processo = wf_processo.id) 
                     JOIN prouser.usuario usuario_aloc ON (wf_transacao.id_usuario_aloc = usuario_aloc.id) 
                     WHERE ".$cmdWhere;

        /**
         * Pega o número de registro para paginação
         */
        $sql = "SELECT COUNT(*) as total ".$sqlBase;
        $numRows = $this->getAdapter()->fetchOne($sql,$binds);
        
        
        /**
         * Coloca as colunas que serão retornadas
         */
        $sql = "SELECT wf_transacao.* ";
        $sql.= "     , wf_fase.descricao as descricao_wf_fase";
        $sql.= "     , usuario_aloc.nome as nome_usuario_aloc";
        $sql.= "     , wf_processo.descricao as descricao_processo";
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
        $this->_columnMappers['nome_usuario_aloc']=array('mapper'=>'Auth_Model_Usuario_Mapper','column'=>'nome');
        $this->_columnMappers['descricao_processo']=array('mapper'=>'Wf_Model_WfProcesso_Mapper','column'=>'descricao');
        
        $mapperObservacao = $this->getMapper()->getObservacao(true);        
        $mapperObservacao->addFilter('nl2br');
        $this->_columnMappers['observacao']=array('mapper'=>$mapperObservacao);
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