<?php
    /**
    * Classe de visão da tabela ca_numeracao
    */
    class Ca_DataView_Numeracao_Crud_MapperView extends Ca_Model_Numeracao_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','numero','tamanho');
           $profile['width'] = array('id'=>100,'nome'=>200,'numero'=>200,'tamanho'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','numero'=>'left','tamanho'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Numeracao_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_numeracao', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.id'),'String','%?%');
            $this->_columns->add('nome', 'ca_numeracao', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.nome'),'String','%?%');
            $this->_columns->add('numero', 'ca_numeracao', 'numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.numero'),'String','%?%');
            $this->_columns->add('tamanho', 'ca_numeracao', 'tamanho', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.tamanho'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = parent::_getSqlBase();
            return $sql;
        }
    }
?>