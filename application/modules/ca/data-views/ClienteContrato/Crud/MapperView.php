<?php
    /**
    * Classe de visão da tabela ca_cliente_contrato
    */
    class Ca_DataView_ClienteContrato_Crud_MapperView extends Ca_Model_ClienteContrato_Mapper implements ZendT_Db_View
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
         * @return Ca_Model_Contrato_Mapper
         */
        protected $_contrato;
                
        
                
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
         * @return Ca_Model_Contrato_Mapper
         */
        protected function _getContrato(){
            if (!is_object($this->_contrato)){
                $this->_contrato = new Ca_Model_Contrato_Mapper();
            }
            return $this->_contrato;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_cliente','nome_cliente','id_contrato','numero_contrato','descricao_contrato','dt_ini_vig','dt_fim_vig','status');
           $profile['width'] = array('id'=>100,'id_cliente'=>120,'nome_cliente'=>200,'id_contrato'=>120,'numero_contrato'=>200,'descricao_contrato'=>200,'dt_ini_vig'=>100,'dt_fim_vig'=>100,'status'=>150);
           $profile['align'] = array('id'=>'left','id_cliente'=>'left','nome_cliente'=>'left','id_contrato'=>'left','numero_contrato'=>'left','descricao_contrato'=>'left','dt_ini_vig'=>'center','dt_fim_vig'=>'center','status'=>'center');
           $profile['hidden'] = array('id_cliente','id_contrato');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_ClienteContrato_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_cliente_contrato', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id'),'String','%?%');
            $this->_columns->add('id_cliente', 'ca_cliente_contrato', 'id_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id_cliente'), null, '=');
            $this->_columns->add('nome_cliente', 'cliente', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id_cliente.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_contrato', 'ca_cliente_contrato', 'id_contrato', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id_contrato'), null, '=');
            $this->_columns->add('numero_contrato', 'contrato', 'numero', $this->_getContrato()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id_contrato.ca_contrato.numero'),null,'?%');
            $this->_columns->add('descricao_contrato', 'contrato', 'descricao', $this->_getContrato()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.id_contrato.ca_contrato.descricao'),null,'?%');
            $this->_columns->add('dt_ini_vig', 'ca_cliente_contrato', 'dt_ini_vig', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.dt_ini_vig'),'Date','=');
            $this->_columns->add('dt_fim_vig', 'ca_cliente_contrato', 'dt_fim_vig', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.dt_fim_vig'),'Date','=');
            $this->_columns->add('status', 'ca_cliente_contrato', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cliente_contrato.status'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente ON ( ca_cliente_contrato.id_cliente = cliente.id ) 
                    JOIN ".$this->_getContrato()->getModel()->getTableName()." contrato ON ( ca_cliente_contrato.id_contrato = contrato.id )  "; 
            return $sql;
        }
    }
?>