<?php

    /**
     * Classe de visão da tabela cms_categoria
     */
    class Cms_DataView_Categoria_MapperView extends Cms_DataView_Categoria_Crud_MapperView {

        protected function _restritionSql(){
            $idUsuario = Auth_Session_User::getInstance()->getId();
            
            return "(
                    /**
                     * privilégio por usuário na categoria
                     */
                     SELECT 1
                       FROM cms_categoria ct
                       JOIN cms_categoria ct_pai
                         ON (ct.chave LIKE ct_pai.chave || '%')
                       JOIN cms_priv_categ pc
                         ON (pc.id_categoria = ct_pai.id)
                      WHERE ct.id = cms_categoria.id
                        AND pc.id_usuario = {$idUsuario}

                     UNION ALL

                     /**
                      * privilégio por papel na categoria
                      */
                     SELECT 1
                       FROM cms_categoria ct
                       JOIN cms_categoria ct_pai
                         ON (ct.chave LIKE ct_pai.chave || '%')
                       JOIN cms_priv_categ pc
                         ON (pc.id_categoria = ct_pai.id)
                       JOIN prouser.papel pa
                         ON (pc.id_papel = pa.id)
                      WHERE ct.id = cms_categoria.id
                        AND EXISTS (SELECT 1
                               FROM prouser.usuario_papel up
                               JOIN prouser.papel pu
                                 ON (up.id_papel = pu.id)
                              WHERE up.id_usuario = {$idUsuario}
                                AND pu.nome LIKE pa.nome || '%'
                             UNION ALL
                             SELECT 1
                               FROM prouser.usuario us
                               JOIN prouser.papel pu
                                 ON (us.id_papel = pu.id)
                              WHERE us.id = {$idUsuario}
                                AND pu.nome LIKE pa.nome || '%') 
            )";
        }


        public function _getWhere($postData) {
            if(Zend_Controller_Front::getInstance()->getRequest()->getParam('autoselectFilter')){
                return false;
            }
            $_where = new ZendT_Db_Where('OR');
            $_where->addFilterExists("(".$this->_restritionSql().")");
            $_where->addFilter("cms_categoria.publico", "S");
            return $_where;
        }

    }

?>