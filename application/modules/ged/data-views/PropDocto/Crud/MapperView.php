<?php
    /**
    * Classe de visão da tabela img_prop_docto
    */
    class Ged_DataView_PropDocto_Crud_MapperView extends Ged_Model_PropDocto_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_Aplicacao_Mapper
         */
        protected $_aplicacao;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_Aplicacao_Mapper
         */
        protected function _getAplicacao(){
            if (!is_object($this->_aplicacao)){
                $this->_aplicacao = new Ged_Model_Aplicacao_Mapper();
            }
            return $this->_aplicacao;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_aplicacao','nome','tabela','sql','config');
           $profile['width'] = array('id'=>100,'id_aplicacao'=>120,'nome'=>200,'tabela'=>200,'sql'=>200,'config'=>200);
           $profile['align'] = array('id'=>'left','id_aplicacao'=>'left','nome'=>'left','tabela'=>'left','sql'=>'left','config'=>'left');
           $profile['hidden'] = array('id_aplicacao');
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
            $this->_columns->add('id_aplicacao', 'img_prop_docto', 'id_aplicacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.id_aplicacao'), null, '=');
            $this->_columns->add('nome', 'img_prop_docto', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.nome'),'String','%?%');
            $this->_columns->add('tabela', 'img_prop_docto', 'tabela', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.tabela'),'String','%?%');
            $this->_columns->add('sql', 'img_prop_docto', 'sql', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.sql'),'String','%?%');
            $this->_columns->add('config', 'img_prop_docto', 'config', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_prop_docto.config'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getAplicacao()->getModel()->getTableName()." aplicacao ON ( img_prop_docto.id_aplicacao = aplicacao.id )  "; 
            return $sql;
        }
    }
?>