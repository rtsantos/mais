<?php
/**
 * Classe de mapeamento do registro da tabela cv_pedido
 */
class Vendas_Model_Pedido_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','numero','tipo','id_usu_inc','id_empresa','id_funcionario','id_cliente','status');
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
                ),
                'id_cliente_con' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ),
                'id_veiculo' => array(
                    'mapper' => 'Frota_DataView_Veiculo_MapperView',
                    'column' => 'id'
                ),
                'id_endereco' => array(
                    'mapper' => 'Ca_DataView_Endereco_MapperView',
                    'column' => 'id'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
  'cv_item_pedido' => 
  array (
    'description' => 'Itens do Pedido/Serviço',
    'url' => '/vendas/item-pedido/form/grid/1',
    'column' => 'id_pedido',
    'message' => 'Necessário seleção Pedido',
  ),
  'cv_pagto_pedido' => 
  array (
    'description' => 'Pagamento',
    'url' => '/vendas/pagamento/form/grid/1',
    'column' => 'id_pedido',
    'message' => 'Necessário seleção Pedido',
  ),
  'cv_vistoria' => 
  array (
    'description' => 'Vistorias',
    'url' => '/vendas/vistoria/form/grid/1',
    'column' => '',
    'message' => 'Necessário seleção Pedido',
  ),
);
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
     * Retorna os dados da coluna status
     *
     * @return string
     */
    public function getStatus($instance=false){
        if ($instance && !is_object($this->_data['status'])){
            $this->setStatus('',array('required'=>false));
        }
        return $this->_data['status'];
    }
    /**
     * Seta o valor da coluna status
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Aberto','P'=>'Pago','E'=>'Efetivado','C'=>'Cancelado');
        $this->_data['status'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['status']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'status');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['status']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_cliente_con
     *
     * @return string
     */
    public function getIdClienteCon($instance=false){
        if ($instance && !is_object($this->_data['id_cliente_con'])){
            $this->setIdClienteCon('',array('required'=>false));
        }
        return $this->_data['id_cliente_con'];
    }
    /**
     * Seta o valor da coluna id_cliente_con
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdClienteCon($value,$options=array('required'=>true)){        
        $this->_data['id_cliente_con'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_cliente_con']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna sinistro
     *
     * @return string
     */
    public function getSinistro($instance=false){
        if ($instance && !is_object($this->_data['sinistro'])){
            $this->setSinistro('',array('required'=>false));
        }
        return $this->_data['sinistro'];
    }
    /**
     * Seta o valor da coluna sinistro
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setSinistro($value,$options=array('required'=>true)){        
        $this->_data['sinistro'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['sinistro']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 80, ) );
            $valueValid = $this->_data['sinistro']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_veiculo
     *
     * @return string
     */
    public function getIdVeiculo($instance=false){
        if ($instance && !is_object($this->_data['id_veiculo'])){
            $this->setIdVeiculo('',array('required'=>false));
        }
        return $this->_data['id_veiculo'];
    }
    /**
     * Seta o valor da coluna id_veiculo
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdVeiculo($value,$options=array('required'=>true)){        
        $this->_data['id_veiculo'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_veiculo']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dh_inc
     *
     * @return string
     */
    public function getDhInc($instance=false){
        if ($instance && !is_object($this->_data['dh_inc'])){
            $this->setDhInc('',array('required'=>false));
        }
        return $this->_data['dh_inc'];
    }
    /**
     * Seta o valor da coluna dh_inc
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setDhInc($value,$options=array('required'=>true)){        
        $this->_data['dh_inc'] = new ZendT_Type_Date($value,'DateTime');
         if ($options['db'])
            $this->_data['dh_inc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna dt_emis
     *
     * @return string
     */
    public function getDtEmis($instance=false){
        if ($instance && !is_object($this->_data['dt_emis'])){
            $this->setDtEmis('',array('required'=>false));
        }
        return $this->_data['dt_emis'];
    }
    /**
     * Seta o valor da coluna dt_emis
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setDtEmis($value,$options=array('required'=>true)){        
        $this->_data['dt_emis'] = new ZendT_Type_Date($value,'Date');
         if ($options['db'])
            $this->_data['dt_emis']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna id_endereco
     *
     * @return string
     */
    public function getIdEndereco($instance=false){
        if ($instance && !is_object($this->_data['id_endereco'])){
            $this->setIdEndereco('',array('required'=>false));
        }
        return $this->_data['id_endereco'];
    }
    /**
     * Seta o valor da coluna id_endereco
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setIdEndereco($value,$options=array('required'=>true)){        
        $this->_data['id_endereco'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_endereco']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna telefone
     *
     * @return string
     */
    public function getTelefone($instance=false){
        if ($instance && !is_object($this->_data['telefone'])){
            $this->setTelefone('',array('required'=>false));
        }
        return $this->_data['telefone'];
    }
    /**
     * Seta o valor da coluna telefone
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setTelefone($value,$options=array('required'=>true)){        
        $this->_data['telefone'] = new ZendT_Type_String($value,array('mask'=>array (
  0 => '99 9.9999-9999',
  1 => '99 9999-9999',
  2 => '9999-9999',
  3 => '9.9999-9999',
)
                                                                   ,'charMask'=>'9'
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['telefone']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 45, ) );
            $valueValid = $this->_data['telefone']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna status_edi
     *
     * @return string
     */
    public function getStatusEdi($instance=false){
        if ($instance && !is_object($this->_data['status_edi'])){
            $this->setStatusEdi('',array('required'=>false));
        }
        return $this->_data['status_edi'];
    }
    /**
     * Seta o valor da coluna status_edi
     *
     * @param string $value
     * @return Vendas_Model_Pedido_Crud_Mapper
     */
    public function setStatusEdi($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('N'=>'Não transmitido','T'=>'Transmitido','E'=>'Erro na transmissão');
        $this->_data['status_edi'] = new ZendT_Type_String($value,$options);
        if ($options['db'])
            $this->_data['status_edi']->setValueFromDb($value);
                
        if (!$options['db']){
            
            $valid = new Zend_Validate_StringLength(array (   'max' => 1, ) );
            $valueValid = $this->_data['status_edi']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>