<?php
    /**
    * Classe de visão da tabela fc_banco
    */
    class Financeiro_DataView_Banco_Crud_MapperView extends Financeiro_Model_Banco_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected function _getPessoa(){
            if (!is_object($this->_pessoa)){
                $this->_pessoa = new Ca_Model_Pessoa_Mapper();
            }
            return $this->_pessoa;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','codigo','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'nome'=>200,'codigo'=>100,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','codigo'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Financeiro_DataView_Banco_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'fc_banco', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_banco.id'),'String','%?%');
            $this->_columns->add('nome', 'fc_banco', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_banco.nome'),'String','%?%');
            $this->_columns->add('codigo', 'fc_banco', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_banco.codigo'),'String','%?%');
            $this->_columns->add('id_empresa', 'fc_banco', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_banco.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('fc_banco.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( fc_banco.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>