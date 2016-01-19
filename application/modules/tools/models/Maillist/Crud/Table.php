<?php
/**
 * Classe de mapeamento da tabela maillist
 */
class Tools_Model_Maillist_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'MAILLIST';
    protected $_sequence = 'SID_MAILLIST';
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','MAIL_FROM','MAIL_TO','MAIL_SUBJECT','MAIL_CC','MAIL_BCC','MAIL_ALERT','SEND_ALERT','STATUS','HTML','NTRY','LIFE_TIME','DH_SEND','DH_REQUEST','DISCARD_ATTACHMENT','ATTACHMENT','MAIL_BODY');
    protected $_search = 'mail_from';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array(
                'Tools_Model_AcrMaillist_Table',
                'Tools_Model_EdiArqMaillist_Table',
                'Tools_Model_PendenciaMaillist_Table',
                'Tools_Model_ItemEventoEmailDiaria_Table',
                'Tools_Model_FaturaAvisoMaillist_Table',
                'Tools_Model_ColetaMaillist_Table',
                'Tools_Model_CvoFormularioMaillist_Table',
                'Tools_Model_Maillisthist_Table',
                'Tools_Model_ConhecMaillist_Table',
                'Tools_Model_ControleEntregaMaillist_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array('send_alert'=>array(''=>''
                                                    ,'N'=>'Não'
                                                    ,'S'=>'Sim')
                                    ,'status'=>array(''=>''
                                                    ,'S'=>'S'
                                                    ,'E'=>'E'
                                                    ,'N'=>'N'
                                                    ,'Z'=>'Z')
                                    ,'html'=>array(''=>''
                                                    ,'N'=>'Não'
                                                    ,'S'=>'Sim')
                                    ,'discard_attachment'=>array(''=>''
                                                    ,'N'=>'Não'
                                                    ,'S'=>'Sim'));
    protected $_mapper = 'Tools_Model_Maillist_Mapper';
    protected $_element = 'Tools_Model_Maillist_Element';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_Maillist_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Model_Maillist_Element();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_Maillist_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_Maillist_Mapper();
        return $mapper;
    }
}
?>