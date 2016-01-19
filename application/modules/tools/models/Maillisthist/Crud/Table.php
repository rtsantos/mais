<?php
/**
 * Classe de mapeamento da tabela maillisthist
 */
class Tools_Model_Maillisthist_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'MAILLISTHIST';
    protected $_sequence = 'SID_MAILLISTHIST';
    protected $_primary = array();
    protected $_unique = array('ID_MAILLIST','DH_ACTION');
    protected $_cols = array('ID_MAILLIST','ACTION','DH_ACTION','ERR_MSG');
    protected $_search = 'action';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdMaillist' => array(
                    'columns' => 'ID_MAILLIST',
                    'refTableClass' => 'Tools_Model_Maillist_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('action'=>array('S'=>'Enviado'
                                                    ,'R'=>'Reativado'));
    protected $_mapper = 'Tools_Model_Maillisthist_Mapper';
    protected $_element = 'Tools_Model_Maillisthist_Element';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_Maillisthist_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Model_Maillisthist_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_Maillisthist_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_Maillisthist_Mapper();
        return $mapper;
    }
}
?>