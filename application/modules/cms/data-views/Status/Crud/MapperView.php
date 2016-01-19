<?php
    /**
    * Classe de visão da tabela cms_status
    */
    class Cms_DataView_Status_Crud_MapperView extends Cms_Model_Status_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected $_categoria;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected function _getCategoria(){
            if (!is_object($this->_categoria)){
                $this->_categoria = new Cms_Model_Categoria_Mapper();
            }
            return $this->_categoria;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','descricao','status','acao','id_categoria','descricao_categoria');
           $profile['width'] = array('id'=>100,'descricao'=>200,'status'=>150,'acao'=>150,'id_categoria'=>120,'descricao_categoria'=>200);
           $profile['align'] = array('id'=>'left','descricao'=>'left','status'=>'center','acao'=>'center','id_categoria'=>'left','descricao_categoria'=>'left');
           $profile['hidden'] = array('id_categoria');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'),'acao'=>$this->getModel()->getListOptions('acao'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_Status_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cms_status', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.id'),'String','%?%');
            $this->_columns->add('descricao', 'cms_status', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.descricao'),'String','%?%');
            $this->_columns->add('status', 'cms_status', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.status'),'String','=');
            $this->_columns->add('acao', 'cms_status', 'acao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.acao'),'String','=');
            $this->_columns->add('id_categoria', 'cms_status', 'id_categoria', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.id_categoria'), null, '=');
            $this->_columns->add('descricao_categoria', 'categoria', 'descricao', $this->_getCategoria()->getModel()->getMapperName(), ZendT_Lib::translate('cms_status.id_categoria.cms_categoria.descricao'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getCategoria()->getModel()->getTableName()." categoria ON ( cms_status.id_categoria = categoria.id )  "; 
            return $sql;
        }
    }
?>