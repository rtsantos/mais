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
           $profile['order'] = array('id','nome','apelido','codigo','email','id_pessoa_resp','nome_pessoa_resp','telefone','celular','fax','ed_logr','ed_numero','ed_compl','ed_bairro','ed_cidade','ed_estado','ed_cep','ed_cob_logr','ed_cob_numero','ed_cob_compl','ed_cob_bairro','ed_cob_cidade','ed_cob_estado','ed_cob_cep','cliente','cont_cli_resp','cont_cli_vend','funcionario','usuario','empresa','registro','id_empresa','nome_empresa','email_cob','hierarquia');
           $profile['width'] = array('id'=>100,'nome'=>200,'apelido'=>200,'codigo'=>175,'email'=>200,'id_pessoa_resp'=>120,'nome_pessoa_resp'=>200,'telefone'=>200,'celular'=>200,'fax'=>200,'ed_logr'=>200,'ed_numero'=>200,'ed_compl'=>200,'ed_bairro'=>200,'ed_cidade'=>200,'ed_estado'=>100,'ed_cep'=>100,'ed_cob_logr'=>200,'ed_cob_numero'=>200,'ed_cob_compl'=>200,'ed_cob_bairro'=>200,'ed_cob_cidade'=>200,'ed_cob_estado'=>100,'ed_cob_cep'=>100,'cliente'=>150,'cont_cli_resp'=>150,'cont_cli_vend'=>150,'funcionario'=>150,'usuario'=>150,'empresa'=>150,'registro'=>200,'id_empresa'=>120,'nome_empresa'=>200,'email_cob'=>200,'hierarquia'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','apelido'=>'left','codigo'=>'left','email'=>'left','id_pessoa_resp'=>'left','nome_pessoa_resp'=>'left','telefone'=>'left','celular'=>'left','fax'=>'left','ed_logr'=>'left','ed_numero'=>'left','ed_compl'=>'left','ed_bairro'=>'left','ed_cidade'=>'left','ed_estado'=>'left','ed_cep'=>'left','ed_cob_logr'=>'left','ed_cob_numero'=>'left','ed_cob_compl'=>'left','ed_cob_bairro'=>'left','ed_cob_cidade'=>'left','ed_cob_estado'=>'left','ed_cob_cep'=>'left','cliente'=>'center','cont_cli_resp'=>'center','cont_cli_vend'=>'center','funcionario'=>'center','usuario'=>'center','empresa'=>'center','registro'=>'left','id_empresa'=>'left','nome_empresa'=>'left','email_cob'=>'left','hierarquia'=>'left');
           $profile['hidden'] = array('id_pessoa_resp','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('cliente'=>$this->getModel()->getListOptions('cliente'),'cont_cli_resp'=>$this->getModel()->getListOptions('cont_cli_resp'),'cont_cli_vend'=>$this->getModel()->getListOptions('cont_cli_vend'),'funcionario'=>$this->getModel()->getListOptions('funcionario'),'usuario'=>$this->getModel()->getListOptions('usuario'),'empresa'=>$this->getModel()->getListOptions('empresa'));
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
            $this->_columns->add('cliente', 'ca_pessoa', 'cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.cliente'),'String','=');
            $this->_columns->add('cont_cli_resp', 'ca_pessoa', 'cont_cli_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.cont_cli_resp'),'String','=');
            $this->_columns->add('cont_cli_vend', 'ca_pessoa', 'cont_cli_vend', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.cont_cli_vend'),'String','=');
            $this->_columns->add('funcionario', 'ca_pessoa', 'funcionario', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.funcionario'),'String','=');
            $this->_columns->add('usuario', 'ca_pessoa', 'usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.usuario'),'String','=');
            $this->_columns->add('empresa', 'ca_pessoa', 'empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.empresa'),'String','=');
            $this->_columns->add('registro', 'ca_pessoa', 'registro', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.registro'),'String','%?%');
            $this->_columns->add('id_empresa', 'ca_pessoa', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('email_cob', 'ca_pessoa', 'email_cob', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.email_cob'),'String','%?%');
            $this->_columns->add('hierarquia', 'ca_pessoa', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_pessoa.hierarquia'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." pessoa_resp ON ( ca_pessoa.id_pessoa_resp = pessoa_resp.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( ca_pessoa.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>