<?php
    /**
     * Colunas do Modelo
     */
    class Usuario_Columns {
        
        /**
            * Coluna Identificação,chave primária
            *
            * @var string
            */
        public $id;
            
        /**
            * Coluna Tipo de Usuário
            *
            * @var string
            */
        public $idtipousuario;
            
        /**
            * Coluna Login
            *
            * @var string
            */
        public $login;
            
        /**
            * Coluna Senha
            *
            * @var string
            */
        public $senha;
            
        /**
            * Coluna nome
            *
            * @var string
            */
        public $nome;
            
        /**
            * Coluna Validade da Senha
            *
            * @var string
            */
        public $validadesenha;
            
        /**
            * Coluna Troca Senha
            *
            * @var string
            */
        public $trocasenha;
            
        /**
            * Coluna Data da Troca da Senha
            *
            * @var string
            */
        public $dhtrocasenha;
            
        /**
            * Coluna Dias para expiração
            *
            * @var string
            */
        public $expiracaosenha;
            
        /**
            * Coluna Situação
            *
            * @var string
            */
        public $status;
            
        /**
            * Coluna Número de erros no Login
            *
            * @var string
            */
        public $nerroslogin;
            
        /**
            * Coluna Administrador
            *
            * @var string
            */
        public $usuarioadmin;
            
        /**
            * Coluna CNPJ Empresa
            *
            * @var string
            */
        public $cgccpf;
            
        /**
            * Coluna Endereço
            *
            * @var string
            */
        public $endereco;
            
        /**
            * Coluna Telefone
            *
            * @var string
            */
        public $telefone;
            
        /**
            * Coluna E-Mail
            *
            * @var string
            */
        public $email;
            
        /**
            * Coluna Usuário de Inserção
            *
            * @var string
            */
        public $usuario;
            
        /**
            * Coluna Data de Inserção
            *
            * @var string
            */
        public $datahora;
            
        /**
            * Coluna Fax
            *
            * @var string
            */
        public $fax;
            
        /**
            * Coluna Colaborador
            *
            * @var string
            */
        public $idpessoal;
            
        /**
            * Coluna Matrícula
            *
            * @var string
            */
        public $chapa;
            
        /**
            * Coluna Centro de Custo
            *
            * @var string
            */
        public $codccustodef;
            
        /**
            * Coluna Código EOF
            *
            * @var string
            */
        public $codeof;
            
        /**
            * Coluna Empresa
            *
            * @var string
            */
        public $idempresa;
            
        /**
            * Coluna Empresa
            *
            * @var string
            */
        public $idempresadef;
            
        /**
            * Coluna Filial
            *
            * @var string
            */
        public $idfilial;
            
        /**
            * Coluna Usuário Responsável
            *
            * @var string
            */
        public $idusuarioresp;
            
        /**
            * Coluna Papel
            *
            * @var string
            */
        public $id_papel;
            
        /**
            * Coluna Solic. Dados Adicionais
            *
            * @var string
            */
        public $solic_info_adic;
            
        /**
            * Coluna Observação
            *
            * @var string
            */
        public $observacao;
            
    }
    /**
     * Resultado para padrão para a chamada dos serviços
     */
    class Usuario_Result extends ZendT_Service_Result {
        
    }
    /**
     * Resultado para listar os registros do modelo
     */
    class Usuario_Result_Rows extends ZendT_Service_Result_Rows{
        /**
         * Registros do modelo Usuario
         * @var Usuario_Columns[]
         */
        public $rows;
    }
    /**
     * Resultado para listar os registro selecionado do modelo
     */
    class Usuario_Result_Row extends ZendT_Service_Result_Row{
        /**
         * Registros do modelo Usuario
         * @var Usuario_Columns
         */
        public $row;
    }
    /**
     * Classe de serviço do modelo Usuario
     *
     * @package ZendT
     * @subpackage Service
     */
    class Auth_Service_Usuario extends ZendT_Service_Crud{
        /**
         * Construtor do serviço para levantar o modelo
         */
        public function __construct(){
            $this->_model = new Auth_Model_Usuario_Table();
        }
        /**
         * Insere um registro no modelo Usuario
         *
         * @param string $token
         * @param Usuario_Columns $data 
         * @return Usuario_Result
         */
        public function insert($token,$data){  
            $_result = new Usuario_Result();
            $result = parent::insert($token,$data);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }        
        /**
         * Atualiza um dado do modelo Usuario
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         * 
         * @param string $token
         * @param Usuario_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Usuario_Result
         */
        public function update($token,$data,$where,$whereGroupOp){
            $_result = new Usuario_Result();
            $result = parent::update($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Apaga um registro do modelo Usuario
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Usuario_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Usuario_Result
         */
        public function delete($token,$data,$where,$whereGroupOp){
            $_result = new Usuario_Result();
            $result = parent::delete($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca as linhas e colunas do modelo Usuario
         *
         * @param string $token
         * @param ZendT_Service_Where[] $where 
         * @param string $whereGroupOp 
         * @return Usuario_Result_Rows
         */
        public function fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1'){
            $_result = new Usuario_Result_Rows();
            $result = parent::fetchAll($token,$where,$whereGroupOp='AND',$returnColumns='*',$orderColumns='1');
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;
        }
        /**
         * Busca o registro do modelo Usuario
         * Esse método é possível usar o parâmetro $data 
         * para fazer o Where, preenchendo a chave primária
         * Passando o parâmetro $where vazio
         *
         * @param string $token
         * @param Usuario_Columns $data
         * @param ZendT_Service_Where[] $where
         * @param string $whereGroupOp
         * @return Usuario_Result_Row
         */
        public function retrive($token,$data,$where,$whereGroupOp){
            $_result = new Usuario_Result_Row();
            $result = parent::retrive($token,$data,$where,$whereGroupOp);
            foreach ($result as $key=>$value){
                $_result->{$key} = $value;
            }
            return $_result;            
        }
    }
?>