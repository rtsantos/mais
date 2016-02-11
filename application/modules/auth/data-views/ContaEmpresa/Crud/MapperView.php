<?php
    /**
    * Classe de visão da tabela at_papel_empresa
    */
    class Auth_DataView_ContaEmpresa_Crud_MapperView extends Auth_Model_ContaEmpresa_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getConta(){
            if (!is_object($this->_conta)){
                $this->_conta = new Auth_Model_Conta_Mapper();
            }
            return $this->_conta;
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
           $profile['order'] = array('id','id_papel','hierarquia_papel','id_empresa','nome_empresa','status','padrao');
           $profile['width'] = array('id'=>100,'id_papel'=>120,'hierarquia_papel'=>200,'id_empresa'=>120,'nome_empresa'=>200,'status'=>150,'padrao'=>150);
           $profile['align'] = array('id'=>'left','id_papel'=>'left','hierarquia_papel'=>'left','id_empresa'=>'left','nome_empresa'=>'left','status'=>'center','padrao'=>'center');
           $profile['hidden'] = array('id_papel','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'),'padrao'=>$this->getModel()->getListOptions('padrao'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_ContaEmpresa_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'at_papel_empresa', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.id'),'String','%?%');
            $this->_columns->add('id_papel', 'at_papel_empresa', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.id_papel'), null, '=');
            $this->_columns->add('hierarquia_papel', 'papel', 'hierarquia', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.id_papel.at_papel.hierarquia'),null,'?%');
            $this->_columns->add('id_empresa', 'at_papel_empresa', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('status', 'at_papel_empresa', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.status'),'String','=');
            $this->_columns->add('padrao', 'at_papel_empresa', 'padrao', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel_empresa.padrao'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." papel ON ( at_papel_empresa.id_papel = papel.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( at_papel_empresa.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>