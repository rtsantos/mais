<?php
/**
 * Classe de mapeamento da tabela usuario
 */
class Auth_Model_Usuario_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected $_name = 'USUARIO';
    protected $_sequence = 'SID_USUARIO';
    protected $_required = array('ID','IDTIPOUSUARIO','LOGIN','SENHA','NOME','TROCASENHA','DHTROCASENHA','STATUS','NERROSLOGIN','USUARIOADMIN','DATAHORA','SOLIC_INFO_ADIC');
    protected $_primary = array('ID');
    protected $_unique = array();
    protected $_cols = array('ID','IDTIPOUSUARIO','LOGIN','SENHA','NOME','VALIDADESENHA','TROCASENHA','DHTROCASENHA','EXPIRACAOSENHA','STATUS','NERROSLOGIN','USUARIOADMIN','CGCCPF','ENDERECO','TELEFONE','EMAIL','USUARIO','DATAHORA','FAX','IDPESSOAL','CHAPA','CODCCUSTODEF','CODEOF','IDEMPRESA','IDEMPRESADEF','IDFILIAL','IDUSUARIORESP','ID_PAPEL','SOLIC_INFO_ADIC','OBSERVACAO','EMPRESA','DH_ULT_LOGON','NTRY','AVATAR');
    protected $_search = 'login';
    protected $_schema  = 'PROUSER';
    protected $_adapter = 'db.prouser';
    protected $_dependentTables = array(
                'Ca_Model_ContatoFilial_Table',
                'Profile_Model_ObjectView_Table',
                'Auth_Model_ClienteUsuario_Table',
                'Auth_Model_RelUsuarioAprovador_Table',
                'Auth_Model_RelCcustoUsuario_Table',
                'Auth_Model_RelPostoAvancUsuario_Table',
                'Auth_Model_Privilegio_Table',
                'Auth_Model_WebSessaoAtiva_Table',
                'Auth_Model_UsuarioPapel_Table',
                'Auth_Model_Usuario_Table',
                'Auth_Model_RelEmpresaUsuario_Table',
                'Auth_Model_Perfilusuario_Table',
                'Auth_Model_Historicousuario_Table',
                'Auth_Model_RelFilialUsuario_Table');
    protected $_referenceMap = array(
                'IdPapel' => array(
                    'columns' => 'ID_PAPEL',
                    'refTableClass' => 'Auth_Model_Papel_Table',
                    'refColumns' => 'ID'
                ),
                'Idfilial' => array(
                    'columns' => 'IDFILIAL',
                    'refTableClass' => 'Ca_Model_Filial_Table',
                    'refColumns' => 'ID'
                ),
                'Idempresa' => array(
                    'columns' => 'IDEMPRESA',
                    'refTableClass' => 'Ca_Model_Empresa_Table',
                    'refColumns' => 'ID'
                ),
                'Idempresadef' => array(
                    'columns' => 'IDEMPRESADEF',
                    'refTableClass' => 'Ca_Model_Empresa_Table',
                    'refColumns' => 'ID'
                ),
                'Idtipousuario' => array(
                    'columns' => 'IDTIPOUSUARIO',
                    'refTableClass' => 'Auth_Model_TipoUsuario_Table',
                    'refColumns' => 'ID'
                ),
                'Idusuarioresp' => array(
                    'columns' => 'IDUSUARIORESP',
                    'refTableClass' => 'Auth_Model_Usuario_Table',
                    'refColumns' => 'ID'
                ));
    protected $_listOptions = array('trocasenha'=>array(''=>''
                                                    ,'S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'status'=>array(''=>''
                                                    ,'A'=>'Ativo'
                                                    ,'I'=>'Inativo')
                                    ,'usuarioadmin'=>array(''=>''
                                                    ,'S'=>'Sim'
                                                    ,'N'=>'Não')
                                    ,'solic_info_adic'=>array(''=>''
                                                    ,'S'=>'Sim'
                                                    ,'N'=>'Não'));
    protected $_mapper = 'Auth_Model_Usuario_Mapper';
    protected $_element = 'Auth_Form_Usuario_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string $columnName
     * @return Auth_Model_Usuario_Element
     */
    public function getElement($columnName){
        $_element = new Auth_Form_Usuario_Elements();        
        $method = 'get' . ZendT_Lib::convertTableNameToClassName($columnName);
        return $_element->$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return Auth_Model_Usuario_Mapper
     */
    public function getMapper(){    
        $mapper = new Auth_Model_Usuario_Mapper();
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