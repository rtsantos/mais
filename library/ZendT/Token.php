<?php

/**
 *
 *
 * @author lmarquesini
 */
class ZendT_Token {
    
    /**
     *
     * @param string $token 
     */
    public static function isValid($token) {
        
        $db = Zend_Registry::get('db.prouser');
        
        $sql = "SELECT id
                  FROM prouser.usuario 
                 WHERE login = (crypt_pkg.decrypt(:token))";

        $bind = array('token' => $token);
        try{
            $id = $db->fetchOne($sql, $bind);
        }catch(Exception $ex){
            throw new ZendT_Exception_Alert('Token Inválido, usuário não encontrado!');
        }        

        if (! $id) {
            $sql = "SELECT id
                    FROM prouser.usuario 
                    WHERE login = (crypt_pkg.decrypt(:token,'TATRACKING-7@n3t'))";

            $bind = array('token' => $token);
            try{
                $id = $db->fetchOne($sql, $bind);
            }catch(Exception $ex){
                throw new ZendT_Exception_Alert('Token Inválido, usuário não encontrado!');
            }   
            if (!$id) {
                throw new ZendT_Exception_Alert('Token Inválido, usuário não encontrado!');
            }
        }
        
        return $id;
    }
    
}