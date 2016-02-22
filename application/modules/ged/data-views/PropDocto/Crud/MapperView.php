<?php
    /**
    * Classe de visão da tabela img_prop_docto
    */
    class Ged_DataView_PropDocto_Crud_MapperView extends Ged_Model_PropDocto_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','config');
           $profile['width'] = array('id'=>100,'nome'=>200,'config'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','config'=>'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ged_DataView_PropDocto_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'img_prop_docto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.id'),'String','%?%');
            $this->_columns->add('nome', 'img_prop_docto', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.nome'),'String','%?%');
            $this->_columns->add('config', 'img_prop_docto', 'config', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.config'),'String','%?%');

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