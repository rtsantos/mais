<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Row
 *
 * @author rsantos
 */
class ZendT_Acl_Role_Row {
    /**
     * Nome do papel
     * 
     * @var string
     */
    private $_name;

    /**
     * Nome do papel pai
     * 
     * @var string
     */
    private $_parent;

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
        return $this;
    }

    public function getParent() {
        return $this->_parent;
    }

    public function setParent($parent) {
        $this->_parent = $parent;
        return $this;
    }

}

?>
