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
class ZendT_Acl_Resource_Row {
    /**
     * Nome do recurso
     * 
     * @var string
     */
    private $_name;
    /**
     * Nome do recurso pai
     * 
     * @var string 
     */
    private $_parent;
    /**
     * Busca o nome do recurso
     * 
     * @return string
     */
    public function getName() {
        return $this->_name;
    }
    /**
     * Configura o nome do recurso
     * 
     * @param string $recurso
     * @return \ZendT_Acl_Resource_Row 
     */
    public function setName($recurso) {
        $this->_name = $recurso;
        return $this;
    }
    /**
     * Busca o nome do Papel Pai
     * @return string
     */
    public function getParent() {
        return $this->_parent;
    }
    /**
     * Configura o nome do papel pai
     * 
     * @param string $parent
     * @return \ZendT_Acl_Resource_Row 
     */
    public function setParent($parent) {
        $this->_parent = $parent;
        return $this;
    }
}