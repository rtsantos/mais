<?php
    /**
    * Classe de visão da tabela cv_forma_pagto
    */
    class Vendas_DataView_FormaPagamento_Crud_MapperView extends Vendas_Model_FormaPagamento_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','descricao','parcela','status','id_empresa','nome_empresa','pago');
           $profile['width'] = array('id'=>100,'descricao'=>200,'parcela'=>150,'status'=>150,'id_empresa'=>120,'nome_empresa'=>200,'pago'=>150);
           $profile['align'] = array('id'=>'left','descricao'=>'left','parcela'=>'center','status'=>'center','id_empresa'=>'left','nome_empresa'=>'left','pago'=>'center');
           $profile['hidden'] = array('id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('parcela'=>$this->getModel()->getListOptions('parcela'),'status'=>$this->getModel()->getListOptions('status'),'pago'=>$this->getModel()->getListOptions('pago'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_FormaPagamento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_forma_pagto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.id'),'String','%?%');
            $this->_columns->add('descricao', 'cv_forma_pagto', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.descricao'),'String','%?%');
            $this->_columns->add('parcela', 'cv_forma_pagto', 'parcela', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.parcela'),'String','=');
            $this->_columns->add('status', 'cv_forma_pagto', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.status'),'String','=');
            $this->_columns->add('id_empresa', 'cv_forma_pagto', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('pago', 'cv_forma_pagto', 'pago', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_forma_pagto.pago'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( cv_forma_pagto.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>