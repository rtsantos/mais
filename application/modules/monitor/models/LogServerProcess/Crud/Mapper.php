<?php
/**
 * Classe de mapeamento do registro da tabela log_server_process
 */
class Monitor_Model_LogServerProcess_Crud_Mapper extends ZendT_Db_Mapper
{
    protected $_required = array('id','id_log_server','pid','cpu','mem','men_vsz','men_rss','time_min','program');
    protected $_model = 'Monitor_Model_LogServerProcess_Table';
    /**
     *
     * @var Monitor_Model_LogServerProcess_Mapper
     */
    protected $_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return Monitor_Model_LogServerProcess_Mapper
     */
    public function getValueOld(){
        if (!$this->_dataOld instanceof Monitor_Model_LogServerProcess_Mapper){
            $this->_dataOld = new Monitor_Model_LogServerProcess_Mapper();
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
                'ID_LOG_SERVER' => array(
                    'mapper' => 'Monitor_DataView_LogServer_MapperView',
                    'column' => 'ID'
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
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
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
     * Retorna os dados da coluna id_log_server
     *
     * @return string
     */
    public function getIdLogServer($instance=false){
        if ($instance && !is_object($this->_data['id_log_server'])){
            $this->setIdLogServer('',array('required'=>false));
        }
        return $this->_data['id_log_server'];
    }
    /**
     * Seta o valor da coluna id_log_server
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setIdLogServer($value,$options=array('required'=>true)){        
        $this->_data['id_log_server'] = new ZendT_Type_Number($value,array('numDecimal'=>null));
         if ($options['db'])
            $this->_data['id_log_server']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'id_log_server');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna pid
     *
     * @return string
     */
    public function getPid($instance=false){
        if ($instance && !is_object($this->_data['pid'])){
            $this->setPid('',array('required'=>false));
        }
        return $this->_data['pid'];
    }
    /**
     * Seta o valor da coluna pid
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setPid($value,$options=array('required'=>true)){        
        $this->_data['pid'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['pid']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'pid');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna cpu
     *
     * @return string
     */
    public function getCpu($instance=false){
        if ($instance && !is_object($this->_data['cpu'])){
            $this->setCpu('',array('required'=>false));
        }
        return $this->_data['cpu'];
    }
    /**
     * Seta o valor da coluna cpu
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setCpu($value,$options=array('required'=>true)){        
        $this->_data['cpu'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['cpu']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'cpu');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna mem
     *
     * @return string
     */
    public function getMem($instance=false){
        if ($instance && !is_object($this->_data['mem'])){
            $this->setMem('',array('required'=>false));
        }
        return $this->_data['mem'];
    }
    /**
     * Seta o valor da coluna mem
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setMem($value,$options=array('required'=>true)){        
        $this->_data['mem'] = new ZendT_Type_Number($value,array('numDecimal'=>2));
         if ($options['db'])
            $this->_data['mem']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'mem');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna men_vsz
     *
     * @return string
     */
    public function getMenVsz($instance=false){
        if ($instance && !is_object($this->_data['men_vsz'])){
            $this->setMenVsz('',array('required'=>false));
        }
        return $this->_data['men_vsz'];
    }
    /**
     * Seta o valor da coluna men_vsz
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setMenVsz($value,$options=array('required'=>true)){        
        $this->_data['men_vsz'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['men_vsz']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'men_vsz');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna men_rss
     *
     * @return string
     */
    public function getMenRss($instance=false){
        if ($instance && !is_object($this->_data['men_rss'])){
            $this->setMenRss('',array('required'=>false));
        }
        return $this->_data['men_rss'];
    }
    /**
     * Seta o valor da coluna men_rss
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setMenRss($value,$options=array('required'=>true)){        
        $this->_data['men_rss'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['men_rss']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'men_rss');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna time_min
     *
     * @return string
     */
    public function getTimeMin($instance=false){
        if ($instance && !is_object($this->_data['time_min'])){
            $this->setTimeMin('',array('required'=>false));
        }
        return $this->_data['time_min'];
    }
    /**
     * Seta o valor da coluna time_min
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setTimeMin($value,$options=array('required'=>true)){        
        $this->_data['time_min'] = new ZendT_Type_Number($value,array('numDecimal'=>0));
         if ($options['db'])
            $this->_data['time_min']->setValueFromDb($value);
                    
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'time_min');
                    
        }
        return $this;
    }

            
    /**
     * Retorna os dados da coluna program
     *
     * @return string
     */
    public function getProgram($instance=false){
        if ($instance && !is_object($this->_data['program'])){
            $this->setProgram('',array('required'=>false));
        }
        return $this->_data['program'];
    }
    /**
     * Seta o valor da coluna program
     *
     * @param string $value
     * @return Monitor_Model_LogServerProcess_Crud_Mapper
     */
    public function setProgram($value,$options=array('required'=>true)){        
        $this->_data['program'] = new ZendT_Type_String($value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>array (
  0 => '',
)
                                                                   ,'filter'=>array('trim', )));
        if ($options['db'])
            $this->_data['program']->setValueFromDb($value);
                
        if (!$options['db']){
            
         if ($options['required'])
            $this->isRequired($value,'program');
                    
            $valid = new Zend_Validate_StringLength(array (   'max' => 30, ) );
            $valueValid = $this->_data['program']->getValueToDb();
            if ($valueValid && !$valid->isValid($valueValid)){
                throw new ZendT_Exception_Business(implode("\n",$valid->getMessages()));
            }
                    
        }
        return $this;
    }

            
}
?>