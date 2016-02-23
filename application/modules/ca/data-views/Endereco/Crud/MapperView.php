<?php
    /**
    * Classe de visão da tabela ca_endereco
    */
    class Ca_DataView_Endereco_Crud_MapperView extends Ca_Model_Endereco_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected $_cidade;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected function _getCidade(){
            if (!is_object($this->_cidade)){
                $this->_cidade = new Ca_Model_Cidade_Mapper();
            }
            return $this->_cidade;
        }
                
                
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
           $profile['order'] = array('id','tipo','logradouro','numero','complemento','bairro','id_cidade','nome_cidade','cep','id_empresa','nome_empresa','cidade','uf');
           $profile['width'] = array('id'=>100,'tipo'=>200,'logradouro'=>200,'numero'=>175,'complemento'=>200,'bairro'=>200,'id_cidade'=>120,'nome_cidade'=>200,'cep'=>175,'id_empresa'=>120,'nome_empresa'=>200,'cidade'=>200,'uf'=>100);
           $profile['align'] = array('id'=>'left','tipo'=>'left','logradouro'=>'left','numero'=>'left','complemento'=>'left','bairro'=>'left','id_cidade'=>'left','nome_cidade'=>'left','cep'=>'left','id_empresa'=>'left','nome_empresa'=>'left','cidade'=>'left','uf'=>'left');
           $profile['hidden'] = array('id_cidade','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Endereco_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'endereco', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.id'),'String','%?%');
            $this->_columns->add('tipo', 'endereco', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.tipo'),'String','%?%');
            $this->_columns->add('logradouro', 'endereco', 'logradouro', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.logradouro'),'String','%?%');
            $this->_columns->add('numero', 'endereco', 'numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.numero'),'String','%?%');
            $this->_columns->add('complemento', 'endereco', 'complemento', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.complemento'),'String','%?%');
            $this->_columns->add('bairro', 'endereco', 'bairro', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.bairro'),'String','%?%');
            $this->_columns->add('id_cidade', 'endereco', 'id_cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.id_cidade'), null, '=');
            $this->_columns->add('nome_cidade', 'cidade', 'nome', $this->_getCidade()->getModel()->getMapperName(), ZendT_Lib::translate('ca_endereco.id_cidade.ca_cidade.nome'),null,'?%');
            $this->_columns->add('cep', 'endereco', 'cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.cep'),'String','%?%');
            $this->_columns->add('id_empresa', 'endereco', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_endereco.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('cidade', 'endereco', 'cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.cidade'),'String','%?%');
            $this->_columns->add('uf', 'endereco', 'uf', $this->getModel()->getMapperName(), ZendT_Lib::translate('endereco.uf'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    LEFT  JOIN ".$this->_getCidade()->getModel()->getTableName()." cidade ON ( endereco.id_cidade = cidade.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( endereco.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>