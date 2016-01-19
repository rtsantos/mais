<?php
    /**
    * Classe de visão da tabela papel
    */
    class Auth_DataView_Papel_Crud_MapperView extends Auth_Model_Papel_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected $_papel;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected function _getPapel(){
            if (!is_object($this->_papel)){
                $this->_papel = new Auth_Model_Papel_Mapper();
            }
            return $this->_papel;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','descricao','hierarquia','id_papel_pai','hierarquia_papel_pai');
           $profile['width'] = array('id'=>100,'nome'=>200,'descricao'=>200,'hierarquia'=>200,'id_papel_pai'=>120,'hierarquia_papel_pai'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','descricao'=>'left','hierarquia'=>'left','id_papel_pai'=>'left','hierarquia_papel_pai'=>'left');
           $profile['hidden'] = array('id_papel_pai');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Papel_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'papel', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel.id'),'String','%?%');
            $this->_columns->add('nome', 'papel', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel.nome'),'String','%?%');
            $this->_columns->add('descricao', 'papel', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel.descricao'),'String','%?%');
            $this->_columns->add('hierarquia', 'papel', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel.hierarquia'),'String','%?%');
            $this->_columns->add('id_papel_pai', 'papel', 'id_papel_pai', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel.id_papel_pai'), null, '=');
            $this->_columns->add('hierarquia_papel_pai', 'papel_pai', 'hierarquia', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('papel.id_papel_pai.papel.hierarquia'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPapel()->getModel()->getTableName()." papel_pai ON ( papel.id_papel_pai = papel_pai.id )  "; 
            return $sql;
        }
    }
?>