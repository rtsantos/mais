<?php
/**
 * Classe de mapeamento do registro da tabela cv_parcela
 */
class Vendas_Model_Parcela_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','descricao','status','qtd','id_empresa');
    protected $_model = 'Vendas_Model_Parcela_Table';
    public static $table = 'mais.cv_parcela';
    /**
     *
     * @var Vendas_Model_Parcela_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Vendas_Model_Parcela_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Vendas_Model_Parcela_Mapper){
            $this->_dataOld = new Vendas_Model_Parcela_Mapper();
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
                'id_empresa' => array(
                    'mapper' => 'Ca_DataView_Pessoa_MapperView',
                    'column' => 'id'
                ));
    }
    /**
     * @retun array
     */
    public function getTabs(){
        return array (
  'cv_pagto_pedido' => 
  array (
    'description' => 'Pagamento',
    'url' => '/vendas/pagamento/form/grid/1',
    'column' => 'id_parcela',
    'message' => 'Necessário seleção ',
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
     * @return Vendas_Model_Parcela_Crud_Mapper
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
     * Retorna os dados da coluna descricao
     *
     * @return string
     */
    public function getDescricao($instance=false){
        if ($instance && !is_object($this->_data['descricao'])){
            $this->setDescricao('',array('required'=>false));
        }
        return $this->_data['descricao'];
    }
    /**
     * Seta o valor da coluna descricao
     *
     * @param string $value
     * @return Vendas_Model_Parcela_Crud_Mapper
     */
    public function setDescricao($value,$options=array('required'=>true)){        
        $this->_data['descricao'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', 'strtoupper', 'removeAccent', )));
        if ($options['db'])
            $this->_data['descricao']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'descricao');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 50, ) );
            $valueValid = $this->_data['descricao']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna per_juro
     *
     * @return string
     */
    public function getPerJuro($instance=false){
        if ($instance && !is_object($this->_data['per_juro'])){
            $this->setPerJuro('',array('required'=>false));
        }
        return $this->_data['per_juro'];
    }
    /**
     * Seta o valor da coluna per_juro
     *
     * @param string $value
     * @return Vendas_Model_Parcela_Crud_Mapper
     */
    public function setPerJuro($value,$options=array('required'=>true)){        
        $this->_data['per_juro'] = new ZendT_Type_Number($value,array('numDecimal'=>5));
         if ($options['db'])
            $this->_data['per_juro']->setValueFromDb($value);
                    
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
     * @return Vendas_Model_Parcela_Crud_Mapper
     */
    public function setStatus($value,$options=array('required'=>true)){        
        
        $options['listOptions']=array('A'=>'Ativo','I'=>'Inativo');
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
     * Retorna os dados da coluna qtd
     *
     * @return string
     */
    public function getQtd($instance=false){
        if ($instance && !is_object($this->_data['qtd'])){
            $this->setQtd('',array('required'=>false));
        }
        return $this->_data['qtd'];
    }
    /**
     * Seta o valor da coluna qtd
     *
     * @param string $value
     * @return Vendas_Model_Parcela_Crud_Mapper
     */
    public function setQtd($value,$options=array('required'=>true)){        
        $this->_data['qtd'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['qtd']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'qtd');
                    
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
     * @return Vendas_Model_Parcela_Crud_Mapper
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
     * Retorna os dados da coluna dias_venc
     *
     * @return string
     */
    public function getDiasVenc($instance=false){
        if ($instance && !is_object($this->_data['dias_venc'])){
            $this->setDiasVenc('',array('required'=>false));
        }
        return $this->_data['dias_venc'];
    }
    /**
     * Seta o valor da coluna dias_venc
     *
     * @param string $value
     * @return Vendas_Model_Parcela_Crud_Mapper
     */
    public function setDiasVenc($value,$options=array('required'=>true)){        
        $this->_data['dias_venc'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['dias_venc']->setValueFromDb($value);
                    
        if (!$options['db']){
            
        }
        return $this;
    }

            
}
?>