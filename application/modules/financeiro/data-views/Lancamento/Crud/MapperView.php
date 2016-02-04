<?php
    /**
    * Classe de visão da tabela fc_lancamento
    */
    class Financeiro_DataView_Lancamento_Crud_MapperView extends Financeiro_Model_Lancamento_Mapper implements ZendT_Db_View
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
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Contrato_Mapper
         */
        protected $_contrato;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_FormaPagamento_Mapper
         */
        protected $_formaPagamento;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Lancamento_Mapper
         */
        protected $_lancamento;
                
        
                
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
         * @return Ca_Model_Contrato_Mapper
         */
        protected function _getContrato(){
            if (!is_object($this->_contrato)){
                $this->_contrato = new Ca_Model_Contrato_Mapper();
            }
            return $this->_contrato;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_FormaPagamento_Mapper
         */
        protected function _getFormaPagamento(){
            if (!is_object($this->_formaPagamento)){
                $this->_formaPagamento = new Vendas_Model_FormaPagamento_Mapper();
            }
            return $this->_formaPagamento;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Financeiro_Model_Lancamento_Mapper
         */
        protected function _getLancamento(){
            if (!is_object($this->_lancamento)){
                $this->_lancamento = new Financeiro_Model_Lancamento_Mapper();
            }
            return $this->_lancamento;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_empresa','nome_empresa','tipo','descricao','id_usu_inc','descricao_usu_inc','dh_inc','dt_lanc','vlr_lanc','vlr_saldo','ultimo','status','id_favorecido','nome_favorecido','id_contrato','numero_contrato','descricao_contrato','id_forma_pagto','descricao_forma_pagto','pago','observacao','id_lancamento_orig','tipo_lancamento_orig');
           $profile['width'] = array('id'=>100,'id_empresa'=>120,'nome_empresa'=>200,'tipo'=>150,'descricao'=>200,'id_usu_inc'=>120,'descricao_usu_inc'=>200,'dh_inc'=>150,'dt_lanc'=>100,'vlr_lanc'=>150,'vlr_saldo'=>150,'ultimo'=>150,'status'=>150,'id_favorecido'=>120,'nome_favorecido'=>200,'id_contrato'=>120,'numero_contrato'=>200,'descricao_contrato'=>200,'id_forma_pagto'=>120,'descricao_forma_pagto'=>200,'pago'=>150,'observacao'=>200,'id_lancamento_orig'=>120,'tipo_lancamento_orig'=>200);
           $profile['align'] = array('id'=>'left','id_empresa'=>'left','nome_empresa'=>'left','tipo'=>'center','descricao'=>'left','id_usu_inc'=>'left','descricao_usu_inc'=>'left','dh_inc'=>'center','dt_lanc'=>'center','vlr_lanc'=>'right','vlr_saldo'=>'right','ultimo'=>'center','status'=>'center','id_favorecido'=>'left','nome_favorecido'=>'left','id_contrato'=>'left','numero_contrato'=>'left','descricao_contrato'=>'left','id_forma_pagto'=>'left','descricao_forma_pagto'=>'left','pago'=>'center','observacao'=>'left','id_lancamento_orig'=>'left','tipo_lancamento_orig'=>'left');
           $profile['hidden'] = array('id_empresa','id_usu_inc','id_favorecido','id_contrato','id_forma_pagto','id_lancamento_orig');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'ultimo'=>$this->getModel()->getListOptions('ultimo'),'status'=>$this->getModel()->getListOptions('status'),'pago'=>$this->getModel()->getListOptions('pago'),'tipo_lancamento_orig'=>$this->_getLancamento()->getModel()->getListOptions('tipo'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Financeiro_DataView_Lancamento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'fc_lancamento', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id'),'String','%?%');
            $this->_columns->add('id_empresa', 'fc_lancamento', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('tipo', 'fc_lancamento', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.tipo'),'String','=');
            $this->_columns->add('descricao', 'fc_lancamento', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.descricao'),'String','%?%');
            $this->_columns->add('id_usu_inc', 'fc_lancamento', 'id_usu_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_usu_inc'), null, '=');
            $this->_columns->add('descricao_usu_inc', 'usu_inc', 'descricao', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_usu_inc.papel.descricao'),null,'?%');
            $this->_columns->add('dh_inc', 'fc_lancamento', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.dh_inc'),'DateTime','=');
            $this->_columns->add('dt_lanc', 'fc_lancamento', 'dt_lanc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.dt_lanc'),'Date','=');
            $this->_columns->add('vlr_lanc', 'fc_lancamento', 'vlr_lanc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.vlr_lanc'),'Numeric','=');
            $this->_columns->add('vlr_saldo', 'fc_lancamento', 'vlr_saldo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.vlr_saldo'),'Numeric','=');
            $this->_columns->add('ultimo', 'fc_lancamento', 'ultimo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.ultimo'),'String','=');
            $this->_columns->add('status', 'fc_lancamento', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.status'),'String','=');
            $this->_columns->add('id_favorecido', 'fc_lancamento', 'id_favorecido', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_favorecido'), null, '=');
            $this->_columns->add('nome_favorecido', 'favorecido', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_favorecido.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_contrato', 'fc_lancamento', 'id_contrato', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_contrato'), null, '=');
            $this->_columns->add('numero_contrato', 'contrato', 'numero', $this->_getContrato()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_contrato.ca_contrato.numero'),null,'?%');
            $this->_columns->add('descricao_contrato', 'contrato', 'descricao', $this->_getContrato()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_contrato.ca_contrato.descricao'),null,'?%');
            $this->_columns->add('id_forma_pagto', 'fc_lancamento', 'id_forma_pagto', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_forma_pagto'), null, '=');
            $this->_columns->add('descricao_forma_pagto', 'forma_pagto', 'descricao', $this->_getFormaPagamento()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_forma_pagto.cv_forma_pagto.descricao'),null,'?%');
            $this->_columns->add('pago', 'fc_lancamento', 'pago', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.pago'),'String','=');
            $this->_columns->add('observacao', 'fc_lancamento', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.observacao'),'String','%?%');
            $this->_columns->add('id_lancamento_orig', 'fc_lancamento', 'id_lancamento_orig', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_lancamento_orig'), null, '=');
            $this->_columns->add('tipo_lancamento_orig', 'lancamento_orig', 'tipo', $this->_getLancamento()->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_lancamento_orig.fc_lancamento.tipo'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( fc_lancamento.id_empresa = empresa.id ) 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usu_inc ON ( fc_lancamento.id_usu_inc = usu_inc.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." favorecido ON ( fc_lancamento.id_favorecido = favorecido.id ) 
                    LEFT  JOIN ".$this->_getContrato()->getModel()->getTableName()." contrato ON ( fc_lancamento.id_contrato = contrato.id ) 
                    LEFT  JOIN ".$this->_getFormaPagamento()->getModel()->getTableName()." forma_pagto ON ( fc_lancamento.id_forma_pagto = forma_pagto.id ) 
                    LEFT  JOIN ".$this->_getLancamento()->getModel()->getTableName()." lancamento_orig ON ( fc_lancamento.id_lancamento_orig = lancamento_orig.id )  "; 
            return $sql;
        }
    }
?>