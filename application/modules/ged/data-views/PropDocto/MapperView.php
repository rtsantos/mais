<?php
    /**
     * Classe de visão da tabela img_prop_docto
     */
    class Ged_DataView_PropDocto_MapperView extends Ged_DataView_PropDocto_Crud_MapperView
    {
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected $_aplicacaoAuth;
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Aplicacao_Mapper
         */
        protected function _getAplicacaoAuth(){
            if (!is_object($this->_aplicacaoAuth)){
                $this->_aplicacaoAuth = new Auth_Model_Aplicacao_Mapper();
            }
            return $this->_aplicacaoAuth;
        }
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = parent::_getSettingsDefault();
           $profile['order'] = array('id','id_aplicacao','sigla_aplic_prouser','nome_aplic_prouser','nome','tabela','sql');
           
           $profile['width']['sigla_aplic_prouser'] = 100;
           $profile['width']['nome_aplic_prouser'] = 200;
           
           $profile['align']['sigla_aplic_prouser'] = 'left';
           $profile['align']['nome_aplic_prouser'] = 'left';
           
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            parent::_loadColumns();
            
            $this->_columns->add('sigla_aplic_prouser', 'aplic_prouser', 'sigla', $this->_getAplicacaoAuth()->getModel()->getMapperName(), ZendT_Lib::translate('img_aplicacao.id_aplic_prouser.aplicacao.sigla'),null,'?%');
            $this->_columns->add('nome_aplic_prouser', 'aplic_prouser', 'nome', $this->_getAplicacaoAuth()->getModel()->getMapperName(), ZendT_Lib::translate('img_aplicacao.id_aplic_prouser.aplicacao.nome'),null,'?%');
        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = parent::_getSqlBase();
            $sql.= " JOIN ".$this->_getAplicacaoAuth()->getModel()->getTableName()." aplic_prouser ON ( aplicacao.id_aplic_prouser = aplic_prouser.id )  "; 
            return $sql;
        }
    }
?>