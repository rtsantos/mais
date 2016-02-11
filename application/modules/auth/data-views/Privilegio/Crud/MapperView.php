<?php
    /**
    * Classe de visão da tabela at_privilegio
    */
    class Auth_DataView_Privilegio_Crud_MapperView extends Auth_Model_Privilegio_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','id_papel','id_recurso','acesso');
           $profile['width'] = array('id'=>100,'id_papel'=>120,'id_recurso'=>120,'acesso'=>150);
           $profile['align'] = array('id'=>'left','id_papel'=>'left','id_recurso'=>'left','acesso'=>'center');
           $profile['hidden'] = array('id_papel','id_recurso');
           $profile['remove'] = array();
           $profile['listOptions'] = array('acesso'=>$this->getModel()->getListOptions('acesso'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Privilegio_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'at_privilegio', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_privilegio.id'),'String','%?%');
            $this->_columns->add('id_papel', 'at_privilegio', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_privilegio.id_papel'), null, '=');
            $this->_columns->add('id_recurso', 'at_privilegio', 'id_recurso', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_privilegio.id_recurso'), null, '=');
            $this->_columns->add('acesso', 'at_privilegio', 'acesso', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_privilegio.acesso'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getConta()->getModel()->getTableName()." papel ON ( at_privilegio.id_papel = papel.id ) 
                    LEFT  JOIN ".$this->_getRecurso()->getModel()->getTableName()." recurso ON ( at_privilegio.id_recurso = recurso.id )  "; 
            return $sql;
        }
    }
?>