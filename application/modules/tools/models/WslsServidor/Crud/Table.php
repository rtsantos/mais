<?php
/**
 * Classe de mapeamento da tabela wsls_servidor
 */
class Tools_Model_WslsServidor_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'WSLS_SERVIDOR';
    protected $_sequence = 'SID_WSLS_SERVIDOR';
    protected $_primary = array('ID');
    protected $_unique = array('IP');
    protected $_cols = array('ID','IP','PADRAO','STATUS','ID_FILIAL','ID_POSTO_AVANCADO','IMPRESSORA_PADRAO');
    protected $_search = 'ip';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdFilial' => array(
                    'columns' => 'ID_FILIAL',
                    'refTableClass' => 'Ca_Model_Filial_Table',
                    'refColumns' => 'ID'
                ),
                'IdPostoAvancado' => array(
                    'columns' => 'ID_POSTO_AVANCADO',
                    'refTableClass' => 'Ca_Model_PostoAvancado_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('padrao'=>array('S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'status'=>array('A'=>'Ativo'
                                                    ,'I'=>'Inativo'));
    protected $_mapper = 'Tools_Model_WslsServidor_Mapper';
    protected $_element = 'Tools_Model_WslsServidor_Element';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_WslsServidor_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Model_WslsServidor_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_WslsServidor_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_WslsServidor_Mapper();
        return $mapper;
    }
}
?>