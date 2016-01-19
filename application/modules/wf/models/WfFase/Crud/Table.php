<?php
/**
 * Classe de mapeamento da tabela wf_fase
 */
class Wf_Model_WfFase_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'WF_FASE';
    protected $_sequence = 'SID_WF_FASE';
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','ID_WF_PROCESSO','VALOR','DESCRICAO','PROC_PROX_FASE','PROC_PROX_USUARIO','PROC_NOTIF');
    protected $_search = 'valor';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array(
                'Wf_Model_WfTransacao_Table',
                'Sales_Model_ClienteNegociacao_Table');
    protected $_referenceMap = array(
                'IdWfProcesso' => array(
                    'columns' => 'ID_WF_PROCESSO',
                    'refTableClass' => 'Wf_Model_WfProcesso',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Wf_Model_WfFase_Mapper';
    protected $_element = 'Wf_Model_WfFase_Element';
    protected $_columnMappers = array('default'=>array('mapper'=>'Wf_Model_WfFase_Mapper'),
                                  'descricao_wf_processo'=>array('mapper'=>'Wf_Model_WfProcesso_Mapper','column'=>'descricao'),
                );
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Wf_Model_WfFase_Element
     */
    public function getElement($columnName){
        $_element = new Wf_Model_WfFase_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Wf_Model_WfFase_Mapper
     */
    public function getMapper(){    
        $mapper = new Wf_Model_WfFase_Mapper();
        return $mapper;
    }
}
?>