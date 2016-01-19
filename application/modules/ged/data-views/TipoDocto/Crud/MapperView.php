<?php
    /**
    * Classe de visão da tabela img_tipo_docto
    */
    class Ged_DataView_TipoDocto_Crud_MapperView extends Ged_Model_TipoDocto_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_PropDocto_Mapper
         */
        protected $_propDocto;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_PropDocto_Mapper
         */
        protected function _getPropDocto(){
            if (!is_object($this->_propDocto)){
                $this->_propDocto = new Ged_Model_PropDocto_Mapper();
            }
            return $this->_propDocto;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_prop_docto','nome_prop_docto','nome','status');
           $profile['width'] = array('id'=>100,'id_prop_docto'=>120,'nome_prop_docto'=>200,'nome'=>200,'status'=>150);
           $profile['align'] = array('id'=>'left','id_prop_docto'=>'left','nome_prop_docto'=>'left','nome'=>'left','status'=>'center');
           $profile['hidden'] = array('id_prop_docto');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ged_DataView_TipoDocto_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'img_tipo_docto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_tipo_docto.id'),'String','%?%');
            $this->_columns->add('id_prop_docto', 'img_tipo_docto', 'id_prop_docto', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_tipo_docto.id_prop_docto'), null, '?%');
            $this->_columns->add('nome_prop_docto', 'prop_docto', 'nome', $this->_getPropDocto()->getModel()->getMapperName(), ZendT_Lib::translate('img_tipo_docto.id_prop_docto.img_prop_docto.nome'),null,'?%');
            $this->_columns->add('nome', 'img_tipo_docto', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_tipo_docto.nome'),'String','%?%');
            $this->_columns->add('status', 'img_tipo_docto', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_tipo_docto.status'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPropDocto()->getModel()->getTableName()." prop_docto ON ( img_tipo_docto.id_prop_docto = prop_docto.id )  "; 
            return $sql;
        }
    }
?>