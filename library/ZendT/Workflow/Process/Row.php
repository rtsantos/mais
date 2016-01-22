<?php
/**
 * Class para definir o registro de privilégios
 * 
 * @package ZendT
 * @subpackage ZendT_Workflow
 * @author ksantoja
 */
class ZendT_Workflow_Process_Row {
    
    
    /**
     * Process description
     * 
     * @var string 
     */
    protected $_description;
    
    
    /**
     * Process ID
     * 
     * @var numeric 
     */
    protected $_id;
    
    
    /**
     * The column of table that will trigger the notification
     * 
     * @var string 
     */
    protected $_column;
    

    /**
     *
     * @return type 
     */
    public function getDescription(){
        return $this->_description;
    }
    /**
     *
     * @param type $value
     * @return \ZendT_Workflow_Process_Row 
     */
    public function setDescription($value){
        $this->_description = $value;
        return $this;
    }
    
    public function setId($value){
        $this->_id = $value;
    }
    
    public function getId(){
        return $this->_id;
    }
    
    public function setColumn($value){
        $this->_column = $value;
        return $this;
    }
    
    public function getColumn(){
        return $this->_column;
    }
}

?>