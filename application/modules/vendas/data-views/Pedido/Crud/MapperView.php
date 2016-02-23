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
         * @return Ca_Model_Endereco_Mapper
         */
        protected $_endereco;
                
        
                
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
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','numero','tipo','id_usu_inc','nome_usu_inc','id_usu_alt','nome_usu_alt','id_empresa','nome_empresa','id_funcionario','nome_funcionario','id_cliente','nome_cliente','id_cont_cli_resp','nome_cont_cli_resp','id_cont_cli_vend','nome_cont_cli_vend','status','id_cliente_con','nome_cliente_con','sinistro','id_veiculo','placa_veiculo','dh_inc','dt_emis','id_endereco','logradouro_endereco','telefone','status_edi');
           $profile['width'] = array('id'=>100,'numero'=>100,'tipo'=>150,'id_usu_inc'=>120,'nome_usu_inc'=>200,'id_usu_alt'=>120,'nome_usu_alt'=>200,'id_empresa'=>120,'nome_empresa'=>200,'id_funcionario'=>120,'nome_funcionario'=>200,'id_cliente'=>120,'nome_cliente'=>200,'id_cont_cli_resp'=>120,'nome_cont_cli_resp'=>200,'id_cont_cli_vend'=>120,'nome_cont_cli_vend'=>200,'status'=>150,'id_cliente_con'=>120,'nome_cliente_con'=>200,'sinistro'=>200,'id_veiculo'=>120,'placa_veiculo'=>200,'dh_inc'=>150,'dt_emis'=>100,'id_endereco'=>120,'logradouro_endereco'=>200,'telefone'=>200,'status_edi'=>150);
           $profile['align'] = array('id'=>'left','numero'=>'left','tipo'=>'center','id_usu_inc'=>'left','nome_usu_inc'=>'left','id_usu_alt'=>'left','nome_usu_alt'=>'left','id_empresa'=>'left','nome_empresa'=>'left','id_funcionario'=>'left','nome_funcionario'=>'left','id_cliente'=>'left','nome_cliente'=>'left','id_cont_cli_resp'=>'left','nome_cont_cli_resp'=>'left','id_cont_cli_vend'=>'left','nome_cont_cli_vend'=>'left','status'=>'center','id_cliente_con'=>'left','nome_cliente_con'=>'left','sinistro'=>'left','id_veiculo'=>'left','placa_veiculo'=>'left','dh_inc'=>'center','dt_emis'=>'center','id_endereco'=>'left','logradouro_endereco'=>'left','telefone'=>'left','status_edi'=>'center');
           $profile['hidden'] = array('id_usu_inc','id_usu_alt','id_empresa','id_funcionario','id_cliente','id_cont_cli_resp','id_cont_cli_vend','id_cliente_con','id_veiculo','id_endereco');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'status'=>$this->getModel()->getListOptions('status'),'status_edi'=>$this->getModel()->getListOptions('status_edi'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Pedido_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id'),'String','%?%');
            $this->_columns->add('numero', 'pedido', 'numero', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.numero'),'String','%?%');
            $this->_columns->add('tipo', 'pedido', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.tipo'),'String','=');
            $this->_columns->add('id_usu_inc', 'pedido', 'id_usu_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_usu_inc'), null, '=');
            $this->_columns->add('nome_usu_inc', 'usu_inc', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_inc.at_papel.nome'),null,'?%');
            $this->_columns->add('id_usu_alt', 'pedido', 'id_usu_alt', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_usu_alt'), null, '=');
            $this->_columns->add('nome_usu_alt', 'usu_alt', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_usu_alt.at_papel.nome'),null,'?%');
            $this->_columns->add('id_empresa', 'pedido', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_funcionario', 'pedido', 'id_funcionario', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_funcionario'), null, '=');
            $this->_columns->add('nome_funcionario', 'funcionario', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_funcionario.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cliente', 'pedido', 'id_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_cliente'), null, '=');
            $this->_columns->add('nome_cliente', 'cliente', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cont_cli_resp', 'pedido', 'id_cont_cli_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_cont_cli_resp'), null, '=');
            $this->_columns->add('nome_cont_cli_resp', 'cont_cli_resp', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_resp.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_cont_cli_vend', 'pedido', 'id_cont_cli_vend', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_cont_cli_vend'), null, '=');
            $this->_columns->add('nome_cont_cli_vend', 'cont_cli_vend', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cont_cli_vend.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('status', 'pedido', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.status'),'String','=');
            $this->_columns->add('id_cliente_con', 'pedido', 'id_cliente_con', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_cliente_con'), null, '=');
            $this->_columns->add('nome_cliente_con', 'cliente_con', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_cliente_con.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('sinistro', 'pedido', 'sinistro', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.sinistro'),'String','%?%');
            $this->_columns->add('id_veiculo', 'pedido', 'id_veiculo', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_veiculo'), null, '=');
            $this->_columns->add('placa_veiculo', 'veiculo', 'placa', $this->_getVeiculo()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_veiculo.fr_veiculo.placa'),null,'?%');
            $this->_columns->add('dh_inc', 'pedido', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.dh_inc'),'DateTime','=');
            $this->_columns->add('dt_emis', 'pedido', 'dt_emis', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.dt_emis'),'Date','=');
            $this->_columns->add('id_endereco', 'pedido', 'id_endereco', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.id_endereco'), null, '=');
            $this->_columns->add('logradouro_endereco', 'endereco', 'logradouro', $this->_getEndereco()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pedido.id_endereco.ca_endereco.logradouro'),null,'?%');
            $this->_columns->add('telefone', 'pedido', 'telefone', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.telefone'),'String','%?%');
            $this->_columns->add('status_edi', 'pedido', 'status_edi', $this->getModel()->getMapperName(), ZendT_Lib::translate('pedido.status_edi'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usu_inc ON ( pedido.id_usu_inc = usu_inc.id ) 
                    LEFT  JOIN ".$this->_getConta()->getModel()->getTableName()." usu_alt ON ( pedido.id_usu_alt = usu_alt.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( pedido.id_empresa = empresa.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." funcionario ON ( pedido.id_funcionario = funcionario.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente ON ( pedido.id_cliente = cliente.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cont_cli_resp ON ( pedido.id_cont_cli_resp = cont_cli_resp.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cont_cli_vend ON ( pedido.id_cont_cli_vend = cont_cli_vend.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente_con ON ( pedido.id_cliente_con = cliente_con.id ) 
                    LEFT  JOIN ".$this->_getVeiculo()->getModel()->getTableName()." veiculo ON ( pedido.id_veiculo = veiculo.id ) 
                    LEFT  JOIN ".$this->_getEndereco()->getModel()->getTableName()." endereco ON ( pedido.id_endereco = endereco.id )  "; 
            return $sql;
        }
    }
?>