<?php
    /**
    * Classe de visão da tabela img_aplicacao
    */
    class Ged_DataView_Aplicacao_Crud_MapperView extends Ged_Model_Aplicacao_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected $_aplicacao;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected function _getAplicacao(){
            if (!is_object($this->_aplicacao)){
                $this->_aplicacao = new Auth_Model_Aplicacao_Mapper();
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
           $profile['order'] = array('id','id_aplic_prouser');
           $profile['width'] = array('id'=>100,'id_aplic_prouser'=>120);
           $profile['align'] = array('id'=>'left','id_aplic_prouser'=>'left');
           $profile['hidden'] = array('id_aplic_prouser');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ged_DataView_Aplicacao_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'img_aplicacao', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_aplicacao.id'),'String','%?%');
            $this->_columns->add('id_aplic_prouser', 'img_aplicacao', 'id_aplic_prouser', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_aplicacao.id_aplic_prouser'), null, '=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getAplicacao()->getModel()->getTableName()." aplic_prouser ON ( img_aplicacao.id_aplic_prouser = aplic_prouser.id )  "; 
            return $sql;
        }
    }
?>