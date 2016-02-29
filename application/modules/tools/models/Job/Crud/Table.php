<?php
/**
 * Classe de mapeamento da tabela tl_job
 */
class Tools_Model_Job_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'tl_job';
    protected $_alias = 'job';
    protected $_sequence = 'sid_tl_job';
    protected $_required = array('id','descricao','dh_inc','dh_ini_exec','tp_frequencia','num_frequencia','forma_exec','procedimento','dh_pro_exec');
    protected $_primary = array('id');
    protected $_unique = array();
    protected $_cols = array('id','descricao','dh_inc','dh_ini_exec','dh_ult_exec','dh_fim_exec','tp_frequencia','num_frequencia','forma_exec','procedimento','parametro','tempo_ul_exec','dh_pro_exec','status');
    protected $_search = 'descricao';
    protected $_schema  = 'mais';
    protected $_adapter = 'db.mais';
    protected $_dependentTables = array();
    protected $_referenceMap = array();
    protected $_listOptions = array('tp_frequencia'=>array('M'=>'Mês'
                                                    ,'H'=>'Hora'
                                                    ,'D'=>'Dia')
                                    ,'forma_exec'=>array('C'=>'Classe'
                                                    ,'U'=>'Url')
                                    ,'status'=>array('A'=>'Aguardando'
                                                    ,'E'=>'Executando'));
    protected $_mapper = 'Tools_Model_Job_Mapper';
    protected $_element = 'Tools_Form_Job_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Tools_Model_Job_Element
     */
    public function getElement($columnName){
        $_element = new Tools_Form_Job_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Tools_Model_Job_Mapper
     */
    public function getMapper(){    
        $mapper = new Tools_Model_Job_Mapper();
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