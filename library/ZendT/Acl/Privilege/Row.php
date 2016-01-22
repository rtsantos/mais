<?php
/**
 * Class para definir o registro de privilégios
 * 
 * @package ZendT
 * @subpackage ZendT_Acl
 * @author jcarlos
 */
class ZendT_Acl_Privilege_Row {
    /**
     * Nome do papel
     * 
     * @var string
     */
    private $_role;

    /**
     * Nome do recurso
     *
     * @var string
     */
    private $_resource;

    /**
     * Tipo de acesso
     * @example A -> Allow
     *          D -> Deny
     *
     * @var string
     */
    private $_access;
    /**
     * Retorna o nome do papel
     * 
     * @return string 
     */
    public function getRole() {
        return $this->_role;
    }

    public function setRole($role) {
        $this->_role = $role;
        return $this;
    }

    public function getResource() {
        return $this->_resource;
    }

    public function setResource($resource) {
        $this->_resource = $resource;
        return $this;
    }

    public function getAccess() {
        return $this->_access;
    }

    public function setAccess($access) {
        $this->_access = $access;
        return $this;
    }
}

?>
