<?php
    /**
    * Classe de visão da tabela ca_pessoa
    */
    class Ca_DataView_Pessoa_Crud_MapperView extends Ca_Model_Pessoa_Mapper implements ZendT_Db_View
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
         * @return Ca_Model_Cargo_Mapper
         */
        protected $_cargo;
                
        
                
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
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cargo_Mapper
         */
        protected function _getCargo(){
            if (!is_object($this->_cargo)){
                $this->_cargo = new Ca_Model_Cargo_Mapper();
            }
            return $this->_cargo;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','apelido','codigo','email','id_pessoa_resp','nome_pessoa_resp','telefone','celular','fax','ed_logr','ed_numero','ed_compl','ed_bairro','ed_cidade','ed_estado','ed_cep','ed_cob_logr','ed_cob_numero','ed_cob_compl','ed_cob_bairro','ed_cob_cidade','ed_cob_estado','ed_cob_cep','papel_cliente','papel_funcionario','papel_usuario','papel_empresa','registro','id_empresa','nome_empresa','email_cob','hierarquia','papel_contato','id_cargo','descricao_cargo','papel_fornecedor');
           $profile['width'] = array('id'=>100,'nome'=>200,'apelido'=>200,'codigo'=>175,'email'=>200,'id_pessoa_resp'=>120,'nome_pessoa_resp'=>200,'telefone'=>200,'celular'=>200,'fax'=>200,'ed_logr'=>200,'ed_numero'=>200,'ed_compl'=>200,'ed_bairro'=>200,'ed_cidade'=>200,'ed_estado'=>100,'ed_cep'=>100,'ed_cob_logr'=>200,'ed_cob_numero'=>200,'ed_cob_compl'=>200,'ed_cob_bairro'=>200,'ed_cob_cidade'=>200,'ed_cob_estado'=>100,'ed_cob_cep'=>100,'papel_cliente'=>150,'papel_funcionario'=>150,'papel_usuario'=>150,'papel_empresa'=>150,'registro'=>200,'id_empresa'=>120,'nome_empresa'=>200,'email_cob'=>200,'hierarquia'=>200,'papel_contato'=>150,'id_cargo'=>120,'descricao_cargo'=>200,'papel_fornecedor'=>150);
           $profile['align'] = array('id'=>'left','nome'=>'left','apelido'=>'left','codigo'=>'left','email'=>'left','id_pessoa_resp'=>'left','nome_pessoa_resp'=>'left','telefone'=>'left','celular'=>'left','fax'=>'left','ed_logr'=>'left','ed_numero'=>'left','ed_compl'=>'left','ed_bairro'=>'left','ed_cidade'=>'left','ed_estado'=>'left','ed_cep'=>'left','ed_cob_logr'=>'left','ed_cob_numero'=>'left','ed_cob_compl'=>'left','ed_cob_bairro'=>'left','ed_cob_cidade'=>'left','ed_cob_estado'=>'left','ed_cob_cep'=>'left','papel_cliente'=>'center','papel_funcionario'=>'center','papel_usuario'=>'center','papel_empresa'=>'center','registro'=>'left','id_empresa'=>'left','nome_empresa'=>'left','email_cob'=>'left','hierarquia'=>'left','papel_contato'=>'center','id_cargo'=>'left','descricao_cargo'=>'left','papel_fornecedor'=>'center');
           $profile['hidden'] = array('id_pessoa_resp','id_empresa','id_cargo');
           $profile['remove'] = array();
           $profile['listOptions'] = array('papel_cliente'=>$this->getModel()->getListOptions('papel_cliente'),'papel_funcionario'=>$this->getModel()->getListOptions('papel_funcionario'),'papel_usuario'=>$this->getModel()->getListOptions('papel_usuario'),'papel_empresa'=>$this->getModel()->getListOptions('papel_empresa'),'papel_contato'=>$this->getModel()->getListOptions('papel_contato'),'papel_fornecedor'=>$this->getModel()->getListOptions('papel_fornecedor'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Pessoa_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_pessoa', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id'),'String','%?%');
            $this->_columns->add('nome', 'ca_pessoa', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.nome'),'String','%?%');
            $this->_columns->add('apelido', 'ca_pessoa', 'apelido', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.apelido'),'String','%?%');
            $this->_columns->add('codigo', 'ca_pessoa', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.codigo'),'String','%?%');
            $this->_columns->add('email', 'ca_pessoa', 'email', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.email'),'String','%?%');
            $this->_columns->add('id_pessoa_resp', 'ca_pessoa', 'id_pessoa_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_pessoa_resp'), null, '=');
            $this->_columns->add('nome_pessoa_resp', 'pessoa_resp', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_pessoa_resp.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('telefone', 'ca_pessoa', 'telefone', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.telefone'),'String','%?%');
            $this->_columns->add('celular', 'ca_pessoa', 'celular', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.celular'),'String','%?%');
            $this->_columns->add('fax', 'ca_pessoa', 'fax', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.fax'),'String','%?%');
            $this->_columns->add('ed_logr', 'ca_pessoa', 'ed_logr', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_logr'),'String','%?%');
            $this->_columns->add('ed_numero', 'ca_pessoa', 'ed_numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_numero'),'String','%?%');
            $this->_columns->add('ed_compl', 'ca_pessoa', 'ed_compl', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_compl'),'String','%?%');
            $this->_columns->add('ed_bairro', 'ca_pessoa', 'ed_bairro', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_bairro'),'String','%?%');
            $this->_columns->add('ed_cidade', 'ca_pessoa', 'ed_cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cidade'),'String','%?%');
            $this->_columns->add('ed_estado', 'ca_pessoa', 'ed_estado', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_estado'),'String','%?%');
            $this->_columns->add('ed_cep', 'ca_pessoa', 'ed_cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cep'),'String','%?%');
            $this->_columns->add('ed_cob_logr', 'ca_pessoa', 'ed_cob_logr', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_logr'),'String','%?%');
            $this->_columns->add('ed_cob_numero', 'ca_pessoa', 'ed_cob_numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_numero'),'String','%?%');
            $this->_columns->add('ed_cob_compl', 'ca_pessoa', 'ed_cob_compl', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_compl'),'String','%?%');
            $this->_columns->add('ed_cob_bairro', 'ca_pessoa', 'ed_cob_bairro', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_bairro'),'String','%?%');
            $this->_columns->add('ed_cob_cidade', 'ca_pessoa', 'ed_cob_cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_cidade'),'String','%?%');
            $this->_columns->add('ed_cob_estado', 'ca_pessoa', 'ed_cob_estado', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_estado'),'String','%?%');
            $this->_columns->add('ed_cob_cep', 'ca_pessoa', 'ed_cob_cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.ed_cob_cep'),'String','%?%');
            $this->_columns->add('papel_cliente', 'ca_pessoa', 'papel_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_cliente'),'String','=');
            $this->_columns->add('papel_funcionario', 'ca_pessoa', 'papel_funcionario', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_funcionario'),'String','=');
            $this->_columns->add('papel_usuario', 'ca_pessoa', 'papel_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_usuario'),'String','=');
            $this->_columns->add('papel_empresa', 'ca_pessoa', 'papel_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_empresa'),'String','=');
            $this->_columns->add('registro', 'ca_pessoa', 'registro', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.registro'),'String','%?%');
            $this->_columns->add('id_empresa', 'ca_pessoa', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('email_cob', 'ca_pessoa', 'email_cob', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.email_cob'),'String','%?%');
            $this->_columns->add('hierarquia', 'ca_pessoa', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.hierarquia'),'String','%?%');
            $this->_columns->add('papel_contato', 'ca_pessoa', 'papel_contato', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_contato'),'String','=');
            $this->_columns->add('id_cargo', 'ca_pessoa', 'id_cargo', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_cargo'), null, '=');
            $this->_columns->add('descricao_cargo', 'cargo', 'descricao', $this->_getCargo()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_cargo.ca_cargo.descricao'),null,'?%');
            $this->_columns->add('papel_fornecedor', 'ca_pessoa', 'papel_fornecedor', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.papel_fornecedor'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." pessoa_resp ON ( ca_pessoa.id_pessoa_resp = pessoa_resp.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( ca_pessoa.id_empresa = empresa.id ) 
                    LEFT  JOIN ".$this->_getCargo()->getModel()->getTableName()." cargo ON ( ca_pessoa.id_cargo = cargo.id )  "; 
            return $sql;
        }
    }
?>