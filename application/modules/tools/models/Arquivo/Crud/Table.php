<?php
/**
 * Classe de mapeamento da tabela arquivo
 */
class Tools_Model_Arquivo_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'ARQUIVO';
    protected $_sequence = 'SID_ARQUIVO';
    protected $_required = array('ID','TIPO','TEMPO_VIDA','DH_INC','NOME');
    protected $_primary = array('ID');
    protected $_unique = array('HASHCODE','CHAVE_ACESSO');
    protected $_cols = array('ID','TIPO','TEMPO_VIDA','DH_INC','HASHCODE','NOME','ARQ_CLOB','CHAVE_ACESSO','ARQ_BLOB');
    protected $_search = 'hashcode';
    protected $_schema  = 'PROJTA';
    protected $_adapter = 'db.projta';
    protected $_dependentTables = array(
                'Tools_Model_ConhecArquivo_Table',
                'Tools_Model_DoctoFiscalArquivo_Table',
                'Coleta_Model_ColetaArquivo_Table',
                'Tools_Model_DoctoCobrancaArquivo_Table',
                'Tools_Model_EdiPrefatArquivo_Table',
                'Tools_Model_EdiArqReceb_Table');
    protected $_referenceMap = array();
    protected $_listOptions = array('tipo'=>array('1'=>'Texto'
                                                    ,'2'=>'XML'
                                                    ,'3'=>'FDF'
                                                    ,'4'=>'EMAIL'
                                                    ,'5'=>'PDF'));
    protected $_mapper = 'Tools_Model_Arquivo_Mapper';
    protected $_element = 'Tools_Form_Arquivo_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_Arquivo_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Form_Arquivo_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_Arquivo_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_Arquivo_Mapper();
        return $mapper;
    }
    
    /**
     * Retorna um array contendo todas as colunas obrigatórias
     *
     * @return array
     */
    public function getRequired() {
        return $this->_required;
    }
    
    /**
     * Informa se a coluna é obrigatória
     *
     * @param string $field
     * @return boolean
     */
    public function isRequired($field) {
        return in_array($field, $this->_required);
    }
    
}
?>