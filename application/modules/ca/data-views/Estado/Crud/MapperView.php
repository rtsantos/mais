<?php
    /**
    * Classe de visão da tabela ca_estado
    */
    class Ca_DataView_Estado_Crud_MapperView extends Ca_Model_Estado_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','uf','nome','cod_ibge','mascara_ie');
           $profile['width'] = array('id'=>100,'uf'=>100,'nome'=>200,'cod_ibge'=>100,'mascara_ie'=>175);
           $profile['align'] = array('id'=>'left','uf'=>'left','nome'=>'left','cod_ibge'=>'left','mascara_ie'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Estado_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'estado', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('estado.id'),'String','%?%');
            $this->_columns->add('uf', 'estado', 'uf', $this->getModel()->getMapperName(), ZendT_Lib::translate('estado.uf'),'String','%?%');
            $this->_columns->add('nome', 'estado', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('estado.nome'),'String','%?%');
            $this->_columns->add('cod_ibge', 'estado', 'cod_ibge', $this->getModel()->getMapperName(), ZendT_Lib::translate('estado.cod_ibge'),'String','%?%');
            $this->_columns->add('mascara_ie', 'estado', 'mascara_ie', $this->getModel()->getMapperName(), ZendT_Lib::translate('estado.mascara_ie'),'String','%?%');

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