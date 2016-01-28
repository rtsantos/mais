<?php
    /**
    * Classe de visão da tabela cv_pedido
    */
    class Vendas_DataView_Pedido_Crud_MapperView extends Vendas_Model_Pedido_Mapper implements ZendT_Db_View
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
         * @return Frota_Model_Veiculo_Mapper
         */
        protected $_veiculo;
                
        
                
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
         * Objeto de Mapeamento da Tabela
         *
         * @return Frota_Model_Veiculo_Mapper
         */
        protected function _getVeiculo(){
            if (!is_object($this->_veiculo)){
                $this->_veiculo = new Frota_Model_Veiculo_Mapper();
            }
            return $this->_veiculo;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','numero','tipo','id_usu_inc','nome_usu_inc','id_usu_alt','nome_usu_alt','id_empresa','nome_empresa','id_funcionario','nome_funcionario','id_cliente','nome_cliente','id_cont_cli_resp','nome_cont_cli_resp','id_cont_cli_vend','nome_cont_cli_vend','status','id_cliente_con','nome_cliente_con','sinistro','id_veiculo','placa_veiculo');
           $profile['width'] = array('id'=>100,'numero'=>100,'tipo'=>150,'id_usu_inc'=>120,'nome_usu_inc'=>200,'id_usu_alt'=>120,'nome_usu_alt'=>200,'id_empresa'=>120,'nome_empresa'=>200,'id_funcionario'=>120,'nome_funcionario'=>200,'id_cliente'=>120,'nome_cliente'=>200,'id_cont_cli_resp'=>120,'nome_cont_cli_resp'=>200,'id_cont_cli_vend'=>120,'nome_cont_cli_vend'=>200,'status'=>150,'id_cliente_con'=>120,'nome_cliente_con'=>200,'sinistro'=>200,'id_veiculo'=>120,'placa_veiculo'=>200);
           $profile['align'] = array('id'=>'left','numero'=>'left','tipo'=>'center','id_usu_inc'=>'left','nome_usu_inc'=>'left','id_usu_alt'=>'left','nome_usu_alt'=>'left','id_empresa'=>'left','nome_empresa'=>'left','id_funcionario'=>'left','nome_funcionario'=>'left','id_cliente'=>'left','nome_cliente'=>'left','id_cont_cli_resp'=>'left','nome_cont_cli_resp'=>'left','id_cont_cli_vend'=>'left','nome_cont_cli_vend'=>'left','status'=>'center','id_cliente_con'=>'left','nome_cliente_con'=>'left','sinistro'=>'left','id_veiculo'=>'left','placa_veiculo'=>'left');
           $profile['hidden'] = array('id_usu_inc','id_usu_alt','id_empresa','id_funcionario','id_cliente','id_cont_cli_resp','id_cont_cli_vend','id_cliente_con','id_veiculo');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Pedido_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id'),'String','%?%');
            $this->_columns->add('numero', 'cv_pedido', 'numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.numero'),'String','%?%');
            $this->_columns->add('tipo', 'cv_pedido', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.tipo'),'String','=');
            $this->_columns->add('id_usu_inc', 'cv_pedido', 'id_usu_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_inc'), null, '=');
            $this->_columns->add('nome_usu_inc', 'usu_inc', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_inc.papel.nome'),null,'?%');
            $this->_columns->add('id_usu_alt', 'cv_pedido', 'id_usu_alt', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_alt'), null, '=');
            $this->_columns->add('nome_usu_alt', 'usu_alt', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_alt.papel.nome'),null,'?%');
            $this->_columns->add('id_empresa', 'cv_pedido', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_funcionario', 'cv_pedido', 'id_funcionario', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_funcionario'), null, '=');
            $this->_columns->add('nome_funcionario', 'funcionario', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_funcionario.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cliente', 'cv_pedido', 'id_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente'), null, '=');
            $this->_columns->add('nome_cliente', 'cliente', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cont_cli_resp', 'cv_pedido', 'id_cont_cli_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_resp'), null, '=');
            $this->_columns->add('nome_cont_cli_resp', 'cont_cli_resp', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_resp.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cont_cli_vend', 'cv_pedido', 'id_cont_cli_vend', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_vend'), null, '=');
            $this->_columns->add('nome_cont_cli_vend', 'cont_cli_vend', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_vend.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('status', 'cv_pedido', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.status'),'String','=');
            $this->_columns->add('id_cliente_con', 'cv_pedido', 'id_cliente_con', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente_con'), null, '=');
            $this->_columns->add('nome_cliente_con', 'cliente_con', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente_con.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('sinistro', 'cv_pedido', 'sinistro', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.sinistro'),'String','%?%');
            $this->_columns->add('id_veiculo', 'cv_pedido', 'id_veiculo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_veiculo'), null, '=');
            $this->_columns->add('placa_veiculo', 'veiculo', 'placa', $this->_getVeiculo()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_veiculo.fr_veiculo.placa'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usu_inc ON ( cv_pedido.id_usu_inc = usu_inc.id ) 
                    LEFT  JOIN ".$this->_getConta()->getModel()->getTableName()." usu_alt ON ( cv_pedido.id_usu_alt = usu_alt.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( cv_pedido.id_empresa = empresa.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." funcionario ON ( cv_pedido.id_funcionario = funcionario.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente ON ( cv_pedido.id_cliente = cliente.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cont_cli_resp ON ( cv_pedido.id_cont_cli_resp = cont_cli_resp.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cont_cli_vend ON ( cv_pedido.id_cont_cli_vend = cont_cli_vend.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente_con ON ( cv_pedido.id_cliente_con = cliente_con.id ) 
                    LEFT  JOIN ".$this->_getVeiculo()->getModel()->getTableName()." veiculo ON ( cv_pedido.id_veiculo = veiculo.id )  "; 
            return $sql;
        }
    }
?>