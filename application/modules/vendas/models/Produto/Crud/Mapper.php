<?php
/**
 * Classe de mapeamento do registro da tabela cv_produto
 */
class Vendas_Model_Produto_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','codigo','nome','tipo','vlr_venda','id_empresa');
    protected $_model = 'Vendas_Model_Produto_Table';
    public static $table = 'mais.cv_produto';
    /**
     *
     * @var Vendas_Model_Produto_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_Produto_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_Produto_Mapper){
            $this->_dataOld = new Vendas_Model_Produto_Mapper();
            $this->_dataOld->setId($this->getId());
            $this->_dataOld->retrive();
        }
        return $this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array(
                'id_cliente' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_produto_resp' => array(
                    'mapper' => 'Vendas_DataView_Produto_MapperView',
                    'column' => 'id'
                ),
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ));
    }
    
    
    /**
     * Retorna os dados da coluna id
     *
     * @return string
     */
    public function getId($instance=false){
        if ($instance && !is_object($this->_data['id'])){
            $this->setId('',array('required'=>false));
        }
        return $this->_data['id'];
    }
    /**
     * Seta o valor da coluna id
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setId($value,$options=array('required'=>true)){        
        $this->_data['id'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna codigo
     *
     * @return string
     */
    public function getCodigo($instance=false){
        if ($instance && !is_object($this->_data['codigo'])){
            $this->setCodigo('',array('required'=>false));
        }
        return $this->_data['codigo'];
    }
    /**
     * Seta o valor da coluna codigo
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setCodigo($value,$options=array('required'=>true)){        
        $this->_data['codigo'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['codigo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'codigo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['codigo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nome
     *
     * @return string
     */
    public function getNome($instance=false){
        if ($instance && !is_object($this->_data['nome'])){
            $this->setNome('',array('required'=>false));
        }
        return $this->_data['nome'];
    }
    /**
     * Seta o valor da coluna nome
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setNome($value,$options=array('required'=>true)){        
        $this->_data['nome'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['nome']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'nome');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 60, ) );
            $valueValid = $this->_data['nome']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna tipo
     *
     * @return string
     */
    public function getTipo($instance=false){
        if ($instance && !is_object($this->_data['tipo'])){
            $this->setTipo('',array('required'=>false));
        }
        return $this->_data['tipo'];
    }
    /**
     * Seta o valor da coluna tipo
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('S'=>'Serviço','P'=>'Produto');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna apelido
     *
     * @return string
     */
    public function getApelido($instance=false){
        if ($instance && !is_object($this->_data['apelido'])){
            $this->setApelido('',array('required'=>false));
        }
        return $this->_data['apelido'];
    }
    /**
     * Seta o valor da coluna apelido
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setApelido($value,$options=array('required'=>true)){        
        $this->_data['apelido'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['apelido']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['apelido']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_venda
     *
     * @return string
     */
    public function getVlrVenda($instance=false){
        if ($instance && !is_object($this->_data['vlr_venda'])){
            $this->setVlrVenda('',array('required'=>false));
        }
        return $this->_data['vlr_venda'];
    }
    /**
     * Seta o valor da coluna vlr_venda
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setVlrVenda($value,$options=array('required'=>true)){        
        $this->_data['vlr_venda'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_venda']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'vlr_venda');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_compra
     *
     * @return string
     */
    public function getVlrCompra($instance=false){
        if ($instance && !is_object($this->_data['vlr_compra'])){
            $this->setVlrCompra('',array('required'=>false));
        }
        return $this->_data['vlr_compra'];
    }
    /**
     * Seta o valor da coluna vlr_compra
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setVlrCompra($value,$options=array('required'=>true)){        
        $this->_data['vlr_compra'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_compra']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna medida
     *
     * @return string
     */
    public function getMedida($instance=false){
        if ($instance && !is_object($this->_data['medida'])){
            $this->setMedida('',array('required'=>false));
        }
        return $this->_data['medida'];
    }
    /**
     * Seta o valor da coluna medida
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setMedida($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('Q'=>'Quantidade','M'=>'Metro','K'=>'Kilo','L'=>'Litro');
        $this->_data['medida'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['medida']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['medida']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna qtd_estoque
     *
     * @return string
     */
    public function getQtdEstoque($instance=false){
        if ($instance && !is_object($this->_data['qtd_estoque'])){
            $this->setQtdEstoque('',array('required'=>false));
        }
        return $this->_data['qtd_estoque'];
    }
    /**
     * Seta o valor da coluna qtd_estoque
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setQtdEstoque($value,$options=array('required'=>true)){        
        $this->_data['qtd_estoque'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['qtd_estoque']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_cliente
     *
     * @return string
     */
    public function getIdCliente($instance=false){
        if ($instance && !is_object($this->_data['id_cliente'])){
            $this->setIdCliente('',array('required'=>false));
        }
        return $this->_data['id_cliente'];
    }
    /**
     * Seta o valor da coluna id_cliente
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setIdCliente($value,$options=array('required'=>true)){        
        $this->_data['id_cliente'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cliente']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_produto_resp
     *
     * @return string
     */
    public function getIdProdutoResp($instance=false){
        if ($instance && !is_object($this->_data['id_produto_resp'])){
            $this->setIdProdutoResp('',array('required'=>false));
        }
        return $this->_data['id_produto_resp'];
    }
    /**
     * Seta o valor da coluna id_produto_resp
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setIdProdutoResp($value,$options=array('required'=>true)){        
        $this->_data['id_produto_resp'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_produto_resp']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_empresa
     *
     * @return string
     */
    public function getIdEmpresa($instance=false){
        if ($instance && !is_object($this->_data['id_empresa'])){
            $this->setIdEmpresa('',array('required'=>false));
        }
        return $this->_data['id_empresa'];
    }
    /**
     * Seta o valor da coluna id_empresa
     *
     * @param string $value
     * @return Vendas_Model_Produto_Crud_Mapper
     */
    public function setIdEmpresa($value,$options=array('required'=>true)){        
        $this->_data['id_empresa'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_empresa']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_empresa');
                    
        }
        return $this;
    }

            
}
?>