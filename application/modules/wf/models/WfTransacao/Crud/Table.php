<?php
/**
 * Classe de mapeamento da tabela wf_transacao
 */
class Wf_Model_WfTransacao_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'WF_TRANSACAO';
    protected $_sequence = 'SID_WF_TRANSACAO';
    protected $_primary = array('ID_WF_FASE','ID_OBJETO');
    protected $_unique = array();
    protected $_cols = array('ID_WF_FASE','ID_OBJETO','ID_USUARIO_ALOC','DH_INC','OBSERVACAO');
    protected $_search = 'observacao';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdUsuarioAloc' => array(
                    'columns' => 'ID_USUARIO_ALOC',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ),
                'IdWfFase' => array(
                    'columns' => 'ID_WF_FASE',
                    'refTableClass' => 'Wf_Model_WfFase_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Wf_Model_WfTransacao_Mapper';
    protected $_element = 'Wf_Model_WfTransacao_Element';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Wf_Model_WfTransacao_Element
     */
    public function getElement($columnName){
        $_element = new Wf_Model_WfTransacao_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Wf_Model_WfTransacao_Mapper
     */
    public function getMapper(){    
        $mapper = new Wf_Model_WfTransacao_Mapper();
        return $mapper;
    }
}
?>