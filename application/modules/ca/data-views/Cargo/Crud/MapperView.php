<?php
    /**
    * Classe de visão da tabela ca_cargo
    */
    class Ca_DataView_Cargo_Crud_MapperView extends Ca_Model_Cargo_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','descricao','sigla','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'descricao'=>200,'sigla'=>100,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','descricao'=>'left','sigla'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Cargo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_cargo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cargo.id'),'String','%?%');
            $this->_columns->add('descricao', 'ca_cargo', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cargo.descricao'),'String','%?%');
            $this->_columns->add('sigla', 'ca_cargo', 'sigla', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cargo.sigla'),'String','%?%');
            $this->_columns->add('id_empresa', 'ca_cargo', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cargo.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cargo.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( ca_cargo.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>