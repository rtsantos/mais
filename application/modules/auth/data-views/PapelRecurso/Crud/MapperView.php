<?php
    /**
    * Classe de visão da tabela papel_recurso
    */
    class Auth_DataView_PapelRecurso_Crud_MapperView extends Auth_Model_PapelRecurso_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Recurso_Mapper
         */
        protected $_recurso;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getConta(){
            if (!is_object($this->_conta)){
                $this->_conta = new Auth_Model_Conta_Mapper();
            }
            return $this->_conta;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Recurso_Mapper
         */
        protected function _getRecurso(){
            if (!is_object($this->_recurso)){
                $this->_recurso = new Auth_Model_Recurso_Mapper();
            }
            return $this->_recurso;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_papel','hierarquia_papel','id_recurso','hierarquia_recurso','acesso');
           $profile['width'] = array('id'=>100,'id_papel'=>120,'hierarquia_papel'=>200,'id_recurso'=>120,'hierarquia_recurso'=>200,'acesso'=>150);
           $profile['align'] = array('id'=>'left','id_papel'=>'left','hierarquia_papel'=>'left','id_recurso'=>'left','hierarquia_recurso'=>'left','acesso'=>'center');
           $profile['hidden'] = array('id_papel','id_recurso');
           $profile['remove'] = array();
           $profile['listOptions'] = array('acesso'=>$this->getModel()->getListOptions('acesso'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_PapelRecurso_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'papel_recurso', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.id'),'String','%?%');
            $this->_columns->add('id_papel', 'papel_recurso', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.id_papel'), null, '=');
            $this->_columns->add('hierarquia_papel', 'papel', 'hierarquia', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.id_papel.papel.hierarquia'),null,'?%');
            $this->_columns->add('id_recurso', 'papel_recurso', 'id_recurso', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.id_recurso'), null, '=');
            $this->_columns->add('hierarquia_recurso', 'recurso', 'hierarquia', $this->_getRecurso()->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.id_recurso.recurso.hierarquia'),null,'?%');
            $this->_columns->add('acesso', 'papel_recurso', 'acesso', $this->getModel()->getMapperName(), ZendT_Lib::translate('papel_recurso.acesso'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getConta()->getModel()->getTableName()." papel ON ( papel_recurso.id_papel = papel.id ) 
                    LEFT  JOIN ".$this->_getRecurso()->getModel()->getTableName()." recurso ON ( papel_recurso.id_recurso = recurso.id )  "; 
            return $sql;
        }
    }
?>