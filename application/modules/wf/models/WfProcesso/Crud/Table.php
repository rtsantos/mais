<?php
/**
 * Classe de mapeamento da tabela wf_processo
 */
class Wf_Model_WfProcesso_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'WF_PROCESSO';
    protected $_sequence = 'SID_WF_PROCESSO';
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','DESCRICAO','ID_APLICACAO');
    protected $_search = 'descricao';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array(
                'Wf_Model_WfFase_Table');
    protected $_referenceMap = array(
                'IdAplicacao' => array(
                    'columns' => 'ID_APLICACAO',
                    'refTableClass' => 'Auth_Model_Aplicacao',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array();
    protected $_mapper = 'Wf_Model_WfProcesso_Mapper';
    protected $_element = 'Wf_Model_WfProcesso_Element';
    protected $_columnMappers = array('default'=>array('mapper'=>'Wf_Model_WfProcesso_Mapper'),
                                  'sigla_aplicacao'=>array('mapper'=>'Auth_Model_Aplicacao_Mapper','column'=>'sigla'),
                
                                  'nome_aplicacao'=>array('mapper'=>'Auth_Model_Aplicacao_Mapper','column'=>'nome'),
                    );
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Wf_Model_WfProcesso_Element
     */
    public function getElement($columnName){
        $_element = new Wf_Model_WfProcesso_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Wf_Model_WfProcesso_Mapper
     */
    public function getMapper(){    
        $mapper = new Wf_Model_WfProcesso_Mapper();
        return $mapper;
    }
}
?>