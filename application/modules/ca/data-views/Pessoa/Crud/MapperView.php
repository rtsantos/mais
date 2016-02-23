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
         * @return _Mapper
         */
        protected $_;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cargo_Mapper
         */
        protected $_cargo;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Endereco_Mapper
         */
        protected $_endereco;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Banco_Mapper
         */
        protected $_banco;
                
        
                
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
         * @return _Mapper
         */
        protected function _get(){
            if (!is_object($this->_)){
                $this->_ = new _Mapper();
            }
            return $this->_;
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
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Endereco_Mapper
         */
        protected function _getEndereco(){
            if (!is_object($this->_endereco)){
                $this->_endereco = new Ca_Model_Endereco_Mapper();
            }
            return $this->_endereco;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Banco_Mapper
         */
        protected function _getBanco(){
            if (!is_object($this->_banco)){
                $this->_banco = new Financeiro_Model_Banco_Mapper();
            }
            return $this->_banco;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','apelido','codigo','email','id_pessoa_resp','nome_pessoa_resp','telefone','celular','fax','ed_logr','ed_numero','ed_compl','ed_bairro','ed_cidade','ed_estado','ed_cep','ed_cob_logr','ed_cob_numero','ed_cob_compl','ed_cob_bairro','ed_cob_cidade','ed_cob_estado','ed_cob_cep','papel_cliente','papel_funcionario','papel_usuario','papel_empresa','registro','id_empresa','email_cob','hierarquia','papel_contato','id_cargo','descricao_cargo','papel_fornecedor','id_endereco','logradouro_endereco','id_endereco_cob','logradouro_endereco_cob','id_banco','nome_banco','ag_banco','ag_dig_banco','conta_banco','conta_dig_banco','cod_tit_banco');
           $profile['width'] = array('id'=>100,'nome'=>200,'apelido'=>200,'codigo'=>175,'email'=>200,'id_pessoa_resp'=>120,'nome_pessoa_resp'=>200,'telefone'=>200,'celular'=>200,'fax'=>200,'ed_logr'=>200,'ed_numero'=>200,'ed_compl'=>200,'ed_bairro'=>200,'ed_cidade'=>200,'ed_estado'=>100,'ed_cep'=>100,'ed_cob_logr'=>200,'ed_cob_numero'=>200,'ed_cob_compl'=>200,'ed_cob_bairro'=>200,'ed_cob_cidade'=>200,'ed_cob_estado'=>100,'ed_cob_cep'=>100,'papel_cliente'=>150,'papel_funcionario'=>150,'papel_usuario'=>150,'papel_empresa'=>150,'registro'=>200,'id_empresa'=>120,'email_cob'=>200,'hierarquia'=>200,'papel_contato'=>150,'id_cargo'=>120,'descricao_cargo'=>200,'papel_fornecedor'=>150,'id_endereco'=>120,'logradouro_endereco'=>200,'id_endereco_cob'=>120,'logradouro_endereco_cob'=>200,'id_banco'=>120,'nome_banco'=>200,'ag_banco'=>100,'ag_dig_banco'=>100,'conta_banco'=>175,'conta_dig_banco'=>100,'cod_tit_banco'=>175);
           $profile['align'] = array('id'=>'left','nome'=>'left','apelido'=>'left','codigo'=>'left','email'=>'left','id_pessoa_resp'=>'left','nome_pessoa_resp'=>'left','telefone'=>'left','celular'=>'left','fax'=>'left','ed_logr'=>'left','ed_numero'=>'left','ed_compl'=>'left','ed_bairro'=>'left','ed_cidade'=>'left','ed_estado'=>'left','ed_cep'=>'left','ed_cob_logr'=>'left','ed_cob_numero'=>'left','ed_cob_compl'=>'left','ed_cob_bairro'=>'left','ed_cob_cidade'=>'left','ed_cob_estado'=>'left','ed_cob_cep'=>'left','papel_cliente'=>'center','papel_funcionario'=>'center','papel_usuario'=>'center','papel_empresa'=>'center','registro'=>'left','id_empresa'=>'left','email_cob'=>'left','hierarquia'=>'left','papel_contato'=>'center','id_cargo'=>'left','descricao_cargo'=>'left','papel_fornecedor'=>'center','id_endereco'=>'left','logradouro_endereco'=>'left','id_endereco_cob'=>'left','logradouro_endereco_cob'=>'left','id_banco'=>'left','nome_banco'=>'left','ag_banco'=>'left','ag_dig_banco'=>'left','conta_banco'=>'left','conta_dig_banco'=>'left','cod_tit_banco'=>'left');
           $profile['hidden'] = array('id_pessoa_resp','id_empresa','id_cargo','id_endereco','id_endereco_cob','id_banco');
           $profile['remove'] = array();
           $profile['listOptions'] = array('papel_cliente'=>$this->getModel()->getListOptions('papel_cliente'),'papel_funcionario'=>$this->getModel()->getListOptions('papel_funcionario'),'papel_usuario'=>$this->getModel()->getListOptions('papel_usuario'),'papel_empresa'=>$this->getModel()->getListOptions('papel_empresa'),'papel_contato'=>$this->getModel()->getListOptions('papel_contato'),'papel_fornecedor'=>$this->getModel()->getListOptions('papel_fornecedor'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Pessoa_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'pessoa', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id'),'String','%?%');
            $this->_columns->add('nome', 'pessoa', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.nome'),'String','%?%');
            $this->_columns->add('apelido', 'pessoa', 'apelido', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.apelido'),'String','%?%');
            $this->_columns->add('codigo', 'pessoa', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.codigo'),'String','%?%');
            $this->_columns->add('email', 'pessoa', 'email', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.email'),'String','%?%');
            $this->_columns->add('id_pessoa_resp', 'pessoa', 'id_pessoa_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_pessoa_resp'), null, '=');
            $this->_columns->add('nome_pessoa_resp', 'pessoa_resp', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_pessoa_resp.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('telefone', 'pessoa', 'telefone', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.telefone'),'String','%?%');
            $this->_columns->add('celular', 'pessoa', 'celular', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.celular'),'String','%?%');
            $this->_columns->add('fax', 'pessoa', 'fax', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.fax'),'String','%?%');
            $this->_columns->add('ed_logr', 'pessoa', 'ed_logr', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_logr'),'String','%?%');
            $this->_columns->add('ed_numero', 'pessoa', 'ed_numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_numero'),'String','%?%');
            $this->_columns->add('ed_compl', 'pessoa', 'ed_compl', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_compl'),'String','%?%');
            $this->_columns->add('ed_bairro', 'pessoa', 'ed_bairro', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_bairro'),'String','%?%');
            $this->_columns->add('ed_cidade', 'pessoa', 'ed_cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cidade'),'String','%?%');
            $this->_columns->add('ed_estado', 'pessoa', 'ed_estado', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_estado'),'String','%?%');
            $this->_columns->add('ed_cep', 'pessoa', 'ed_cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cep'),'String','%?%');
            $this->_columns->add('ed_cob_logr', 'pessoa', 'ed_cob_logr', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_logr'),'String','%?%');
            $this->_columns->add('ed_cob_numero', 'pessoa', 'ed_cob_numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_numero'),'String','%?%');
            $this->_columns->add('ed_cob_compl', 'pessoa', 'ed_cob_compl', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_compl'),'String','%?%');
            $this->_columns->add('ed_cob_bairro', 'pessoa', 'ed_cob_bairro', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_bairro'),'String','%?%');
            $this->_columns->add('ed_cob_cidade', 'pessoa', 'ed_cob_cidade', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_cidade'),'String','%?%');
            $this->_columns->add('ed_cob_estado', 'pessoa', 'ed_cob_estado', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_estado'),'String','%?%');
            $this->_columns->add('ed_cob_cep', 'pessoa', 'ed_cob_cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ed_cob_cep'),'String','%?%');
            $this->_columns->add('papel_cliente', 'pessoa', 'papel_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_cliente'),'String','=');
            $this->_columns->add('papel_funcionario', 'pessoa', 'papel_funcionario', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_funcionario'),'String','=');
            $this->_columns->add('papel_usuario', 'pessoa', 'papel_usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_usuario'),'String','=');
            $this->_columns->add('papel_empresa', 'pessoa', 'papel_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_empresa'),'String','=');
            $this->_columns->add('registro', 'pessoa', 'registro', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.registro'),'String','%?%');
            $this->_columns->add('id_empresa', 'pessoa', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_empresa'), null, '=');
            $this->_columns->add('email_cob', 'pessoa', 'email_cob', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.email_cob'),'String','%?%');
            $this->_columns->add('hierarquia', 'pessoa', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.hierarquia'),'String','%?%');
            $this->_columns->add('papel_contato', 'pessoa', 'papel_contato', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_contato'),'String','=');
            $this->_columns->add('id_cargo', 'pessoa', 'id_cargo', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_cargo'), null, '=');
            $this->_columns->add('descricao_cargo', 'cargo', 'descricao', $this->_getCargo()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_cargo.ca_cargo.descricao'),null,'?%');
            $this->_columns->add('papel_fornecedor', 'pessoa', 'papel_fornecedor', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.papel_fornecedor'),'String','=');
            $this->_columns->add('id_endereco', 'pessoa', 'id_endereco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_endereco'), null, '=');
            $this->_columns->add('logradouro_endereco', 'endereco', 'logradouro', $this->_getEndereco()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_endereco.ca_endereco.logradouro'),null,'?%');
            $this->_columns->add('id_endereco_cob', 'pessoa', 'id_endereco_cob', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_endereco_cob'), null, '=');
            $this->_columns->add('logradouro_endereco_cob', 'endereco_cob', 'logradouro', $this->_getEndereco()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_endereco_cob.ca_endereco.logradouro'),null,'?%');
            $this->_columns->add('id_banco', 'pessoa', 'id_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.id_banco'), null, '=');
            $this->_columns->add('nome_banco', 'banco', 'nome', $this->_getBanco()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_banco.fc_banco.nome'),null,'?%');
            $this->_columns->add('ag_banco', 'pessoa', 'ag_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ag_banco'),'String','%?%');
            $this->_columns->add('ag_dig_banco', 'pessoa', 'ag_dig_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.ag_dig_banco'),'String','%?%');
            $this->_columns->add('conta_banco', 'pessoa', 'conta_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.conta_banco'),'String','%?%');
            $this->_columns->add('conta_dig_banco', 'pessoa', 'conta_dig_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.conta_dig_banco'),'String','%?%');
            $this->_columns->add('cod_tit_banco', 'pessoa', 'cod_tit_banco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pessoa.cod_tit_banco'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." pessoa_resp ON ( pessoa.id_pessoa_resp = pessoa_resp.id ) 
                    LEFT  JOIN ".$this->_get()->getModel()->getTableName()." empresa ON ( pessoa. = empresa. ) 
                    LEFT  JOIN ".$this->_getCargo()->getModel()->getTableName()." cargo ON ( pessoa.id_cargo = cargo.id ) 
                    LEFT  JOIN ".$this->_getEndereco()->getModel()->getTableName()." endereco ON ( pessoa.id_endereco = endereco.id ) 
                    LEFT  JOIN ".$this->_getEndereco()->getModel()->getTableName()." endereco_cob ON ( pessoa.id_endereco_cob = endereco_cob.id ) 
                    LEFT  JOIN ".$this->_getBanco()->getModel()->getTableName()." banco ON ( pessoa.id_banco = banco.id )  "; 
            return $sql;
        }
    }
?>