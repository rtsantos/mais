<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Function
 *
 * @author rsantos
 */
class ZendT_JS_Command {
    protected $_command;
    
    public function __construct($command) {
        $this->_command = $command;
    }
    /**
     *
     * @param type $command
     * @return \ZendT_JS_Command 
     */
    public function set($command){
        $this->_command = $command;        
        return $this;
    }
    /**
     *
     * @return string
     */
    public function get(){
        return $this->_command;
    }
    /**
     * @return string
     */
    public function render(){
        return $this->_command;
    }
    /**
     * @return string
     */
    public function __toString() {
        return $this->_command;
    }
}
?>
