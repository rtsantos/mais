<?php
/**
 * Classe de mapeamento do registro da tabela cv_pedido
 */
class Vendas_Model_Pedido_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','numero','tipo','id_usu_inc','id_empresa','id_funcionario','id_cliente');
    protected $_model = 'Vendas_Model_Pedido_Table';
    public static $table = 'mais.cv_pedido';
    /**
     *
     * @var Vendas_Model_Pedido_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_Pedido_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_Pedido_Mapper){
            $this->_dataOld = new Vendas_Model_Pedido_Mapper();
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
                'id_usu_inc' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ),
                'id_usu_alt' => array(
                    'mapper' => 'Auth_DataView_Conta_MapperView',
                    'column' => 'id'
                ),
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_funcionario' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_cliente' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_cont_cli_resp' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_cont_cli_vend' => array(
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
     * @return Vendas_Model_Pedido_Crud_Mapper
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
     * Retorna os dados da coluna numero
     *
     * @return string
     */
    public function getNumero($instance=false){
        if ($instance && !is_object($this->_data['numero'])){
            $this->setNumero('',array('required'=>false));
        }
        return $this->_data['numero'];
    }
    /**
     * Seta o valor da coluna numero
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setNumero($value,$options=array('required'=>true)){        
        $this->_data['numero'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['numero']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'numero');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 10, ) );
            $valueValid = $this->_data['numero']->getValueToDb();
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
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setTipo($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('V'=>'Venda','C'=>'Compra','O'=>'Orçamento');
        $this->_data['tipo'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['tipo']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'tipo');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 2, ) );
            $valueValid = $this->_data['tipo']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usu_inc
     *
     * @return string
     */
    public function getIdUsuInc($instance=false){
        if ($instance && !is_object($this->_data['id_usu_inc'])){
            $this->setIdUsuInc('',array('required'=>false));
        }
        return $this->_data['id_usu_inc'];
    }
    /**
     * Seta o valor da coluna id_usu_inc
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdUsuInc($value,$options=array('required'=>true)){        
        $this->_data['id_usu_inc'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usu_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_usu_inc');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_usu_alt
     *
     * @return string
     */
    public function getIdUsuAlt($instance=false){
        if ($instance && !is_object($this->_data['id_usu_alt'])){
            $this->setIdUsuAlt('',array('required'=>false));
        }
        return $this->_data['id_usu_alt'];
    }
    /**
     * Seta o valor da coluna id_usu_alt
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdUsuAlt($value,$options=array('required'=>true)){        
        $this->_data['id_usu_alt'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_usu_alt']->setValueFromDb($value);
                    
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
     * @return Vendas_Model_Pedido_Crud_Mapper
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

            
    /**
     * Retorna os dados da coluna id_funcionario
     *
     * @return string
     */
    public function getIdFuncionario($instance=false){
        if ($instance && !is_object($this->_data['id_funcionario'])){
            $this->setIdFuncionario('',array('required'=>false));
        }
        return $this->_data['id_funcionario'];
    }
    /**
     * Seta o valor da coluna id_funcionario
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdFuncionario($value,$options=array('required'=>true)){        
        $this->_data['id_funcionario'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_funcionario']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_funcionario');
                    
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
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdCliente($value,$options=array('required'=>true)){        
        $this->_data['id_cliente'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cliente']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_cliente');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_cont_cli_resp
     *
     * @return string
     */
    public function getIdContCliResp($instance=false){
        if ($instance && !is_object($this->_data['id_cont_cli_resp'])){
            $this->setIdContCliResp('',array('required'=>false));
        }
        return $this->_data['id_cont_cli_resp'];
    }
    /**
     * Seta o valor da coluna id_cont_cli_resp
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdContCliResp($value,$options=array('required'=>true)){        
        $this->_data['id_cont_cli_resp'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cont_cli_resp']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_cont_cli_vend
     *
     * @return string
     */
    public function getIdContCliVend($instance=false){
        if ($instance && !is_object($this->_data['id_cont_cli_vend'])){
            $this->setIdContCliVend('',array('required'=>false));
        }
        return $this->_data['id_cont_cli_vend'];
    }
    /**
     * Seta o valor da coluna id_cont_cli_vend
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdContCliVend($value,$options=array('required'=>true)){        
        $this->_data['id_cont_cli_vend'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cont_cli_vend']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_total
     *
     * @return string
     */
    public function getVlrTotal($instance=false){
        if ($instance && !is_object($this->_data['vlr_total'])){
            $this->setVlrTotal('',array('required'=>false));
        }
        return $this->_data['vlr_total'];
    }
    /**
     * Seta o valor da coluna vlr_total
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setVlrTotal($value,$options=array('required'=>true)){        
        $this->_data['vlr_total'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_total']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna pagamento
     *
     * @return string
     */
    public function getPagamento($instance=false){
        if ($instance && !is_object($this->_data['pagamento'])){
            $this->setPagamento('',array('required'=>false));
        }
        return $this->_data['pagamento'];
    }
    /**
     * Seta o valor da coluna pagamento
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setPagamento($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('D'=>'Crediário','C'=>'Cartão','Q'=>'Cheque','F'=>'Faturar');
        $this->_data['pagamento'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['pagamento']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['pagamento']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_pago
     *
     * @return string
     */
    public function getVlrPago($instance=false){
        if ($instance && !is_object($this->_data['vlr_pago'])){
            $this->setVlrPago('',array('required'=>false));
        }
        return $this->_data['vlr_pago'];
    }
    /**
     * Seta o valor da coluna vlr_pago
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setVlrPago($value,$options=array('required'=>true)){        
        $this->_data['vlr_pago'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_pago']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_desc
     *
     * @return string
     */
    public function getVlrDesc($instance=false){
        if ($instance && !is_object($this->_data['vlr_desc'])){
            $this->setVlrDesc('',array('required'=>false));
        }
        return $this->_data['vlr_desc'];
    }
    /**
     * Seta o valor da coluna vlr_desc
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setVlrDesc($value,$options=array('required'=>true)){        
        $this->_data['vlr_desc'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_desc']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna nro_parc
     *
     * @return string
     */
    public function getNroParc($instance=false){
        if ($instance && !is_object($this->_data['nro_parc'])){
            $this->setNroParc('',array('required'=>false));
        }
        return $this->_data['nro_parc'];
    }
    /**
     * Seta o valor da coluna nro_parc
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setNroParc($value,$options=array('required'=>true)){        
        $this->_data['nro_parc'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['nro_parc']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna vlr_parc
     *
     * @return string
     */
    public function getVlrParc($instance=false){
        if ($instance && !is_object($this->_data['vlr_parc'])){
            $this->setVlrParc('',array('required'=>false));
        }
        return $this->_data['vlr_parc'];
    }
    /**
     * Seta o valor da coluna vlr_parc
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setVlrParc($value,$options=array('required'=>true)){        
        $this->_data['vlr_parc'] = new ZendT_Type_String($value);
        if ($options['db'])
            $this->_data['vlr_parc']->setValueFromDb($value);
                
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>