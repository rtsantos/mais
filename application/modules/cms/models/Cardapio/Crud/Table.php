<?php
/**
 * Classe de mapeamento da tabela cardapio
 */
class Cms_Model_Cardapio_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'CARDAPIO';
    protected $_sequence = 'SID_CARDAPIO';
    protected $_required = array('ID','ID_FILIAL');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','DT_EXIBE','PT_PRINCIPAL','OPCAO','GUARNICAO','ARROZ_FEIJAO','SALADA','SOBREMESA','SUCO','PT_LIGHT','ID_FILIAL');
    protected $_search = 'pt_principal';
    protected $_schema  = 'PHP';
    protected $_adapter = 'db.php';
    protected $_dependentTables = array();
    protected $_referenceMap = array(
                'IdFilial' => array(
                    'columns' => 'ID_FILIAL',
                    'refTableClass' => 'Ca_Model_Filial_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('arroz_feijao'=>array('A/F'=>'Sim'
                                                    ,''=>'Não'));
    protected $_mapper = 'Cms_Model_Cardapio_Mapper';
    protected $_element = 'Cms_Form_Cardapio_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Cms_Model_Cardapio_Element
     */
    public function getElement($columnName){
        $_element = new Cms_Form_Cardapio_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Cms_Model_Cardapio_Mapper
     */
    public function getMapper(){    
        $mapper = new Cms_Model_Cardapio_Mapper();
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