<?php
    /**
    * Classe de visão da tabela ca_numeracao
    */
    class Ca_DataView_Numeracao_Crud_MapperView extends Ca_Model_Numeracao_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','nome','numero','tamanho','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'nome'=>200,'numero'=>200,'tamanho'=>200,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','numero'=>'left','tamanho'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_empresa');
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
            $this->_columns->add('id_empresa', 'ca_numeracao', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_numeracao.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( ca_numeracao.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>