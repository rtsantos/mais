<?php
    /**
    * Classe de visão da tabela at_papel_rel
    */
    class Auth_DataView_ContaRel_Crud_MapperView extends Auth_Model_ContaRel_Mapper implements ZendT_Db_View
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
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getConta(){
            if (!is_object($this->_conta)){
                $this->_conta = new Auth_Model_Conta_Mapper();
            }
            return $this->_conta;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_papel','id_papel_rel','status');
           $profile['width'] = array('id'=>100,'id_papel'=>120,'id_papel_rel'=>120,'status'=>150);
           $profile['align'] = array('id'=>'left','id_papel'=>'left','id_papel_rel'=>'left','status'=>'center');
           $profile['hidden'] = array('id_papel','id_papel_rel');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_ContaRel_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'at_papel_rel', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_rel.id'),'String','%?%');
            $this->_columns->add('id_papel', 'at_papel_rel', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_rel.id_papel'), null, '=');
            $this->_columns->add('id_papel_rel', 'at_papel_rel', 'id_papel_rel', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_rel.id_papel_rel'), null, '=');
            $this->_columns->add('status', 'at_papel_rel', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_rel.status'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." papel ON ( at_papel_rel.id_papel = papel.id ) 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." papel_rel ON ( at_papel_rel.id_papel_rel = papel_rel.id )  "; 
            return $sql;
        }
    }
?>