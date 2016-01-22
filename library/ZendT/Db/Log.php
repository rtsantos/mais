<?php
    /**
     * Description of Log
     *
     * @author rsantos
     */
    class ZendT_Db_Log {
        //put your code here
        public static function add($objeto,$operac,$idObjeto,$observacao='',$chave='',$commit='N'){
            if($idObjeto instanceof ZendT_Type){
                $idObjeto = $idObjeto->get();
            }
            if($chave instanceof ZendT_Type){
                $chave = $chave->get();
            }
            
            $sql = "
                begin
                log_pkg.addlog(p_objeto => :p_objeto,
                                p_operac => :p_operac,
                                p_id_objeto => :p_id_objeto,
                                p_id_usuario => :p_id_usuario,
                                p_chave => :p_chave,
                                p_observacao => :p_observacao,
                                p_commit => :p_commit);
                end;                
            ";
            $db = Zend_Registry::get('db.log');
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':p_objeto', $objeto);
            $stmt->bindValue(':p_operac', $operac);
            $stmt->bindValue(':p_id_objeto', $idObjeto);
            $stmt->bindValue(':p_chave', $chave);
            $stmt->bindValue(':p_observacao', $observacao);
            $stmt->bindValue(':p_commit', $commit);
            $stmt->bindValue(':p_id_usuario', Zend_Auth::getInstance()->getStorage()->read()->getId());
            $stmt->execute();
        }
    }
?>
