<?php
    /**
    * Classe de visão da tabela ca_contrato
    */
    class Ca_DataView_Contrato_Crud_MapperView extends Ca_Model_Contrato_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','descricao','dt_vig_ini','dt_vig_fim','id_cliente','nome_cliente','status','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'descricao'=>200,'dt_vig_ini'=>100,'dt_vig_fim'=>100,'id_cliente'=>120,'nome_cliente'=>200,'status'=>150,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','descricao'=>'left','dt_vig_ini'=>'center','dt_vig_fim'=>'center','id_cliente'=>'left','nome_cliente'=>'left','status'=>'center','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_cliente','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Contrato_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_contrato', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.id'),'String','%?%');
            $this->_columns->add('descricao', 'ca_contrato', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.descricao'),'String','%?%');
            $this->_columns->add('dt_vig_ini', 'ca_contrato', 'dt_vig_ini', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.dt_vig_ini'),'Date','=');
            $this->_columns->add('dt_vig_fim', 'ca_contrato', 'dt_vig_fim', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.dt_vig_fim'),'Date','=');
            $this->_columns->add('id_cliente', 'ca_contrato', 'id_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.id_cliente'), null, '=');
            $this->_columns->add('nome_cliente', 'cliente', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.id_cliente.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('status', 'ca_contrato', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.status'),'String','=');
            $this->_columns->add('id_empresa', 'ca_contrato', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_contrato.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente ON ( ca_contrato.id_cliente = cliente.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( ca_contrato.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>