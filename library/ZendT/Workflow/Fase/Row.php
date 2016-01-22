<?php
/**
 * Class para definir o registro de privilégios
 * 
 * @package ZendT
 * @subpackage ZendT_Workflow
 * @author ksantoja
 */
class ZendT_Workflow_Fase_Row {
    
    /**
     * Fase description
     * 
     * @var string
     */
    protected $_description;
    
    /**
     * Notification of this fase
     * 
     * @var string
     */
    protected $_notification;


    public function getDescription() {
        return $this->_description;
    }
    
    public function setDescription($value) {
        $this->_description = $value;
        return $this;
    }
    
    public function getNotification() {
        return $this->_notification;
    }

    public function setNotification($value) {
        $this->_notification = $value;
        return $this;
    }
}

?>