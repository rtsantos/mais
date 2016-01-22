<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rsantos
 */
interface ZendT_Acl_User_Interface {
    /**
     * Retorna os dados de sessão do usuário
     * @param int $id
     * @return Zend_Acl_User_Row
     */
    public function getRowSession($id);
}
?>
