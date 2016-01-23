<?php
    /**
    * Classe de visão da tabela cv_produto
    */
    class Vendas_DataView_Produto_Crud_MapperView extends Vendas_Model_Produto_Mapper implements ZendT_Db_View
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
         * @return Vendas_Model_Produto_Mapper
         */
        protected $_produto;
                
        
                
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
         * @return Vendas_Model_Produto_Mapper
         */
        protected function _getProduto(){
            if (!is_object($this->_produto)){
                $this->_produto = new Vendas_Model_Produto_Mapper();
            }
            return $this->_produto;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','codigo','nome','tipo','apelido','vlr_venda','vlr_compra','medida','qtd_estoque','id_cliente','nome_cliente','id_produto_resp','codigo_produto_resp','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'codigo'=>200,'nome'=>200,'tipo'=>150,'apelido'=>200,'vlr_venda'=>200,'vlr_compra'=>200,'medida'=>150,'qtd_estoque'=>200,'id_cliente'=>120,'nome_cliente'=>200,'id_produto_resp'=>120,'codigo_produto_resp'=>200,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','codigo'=>'left','nome'=>'left','tipo'=>'center','apelido'=>'left','vlr_venda'=>'left','vlr_compra'=>'left','medida'=>'center','qtd_estoque'=>'left','id_cliente'=>'left','nome_cliente'=>'left','id_produto_resp'=>'left','codigo_produto_resp'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_cliente','id_produto_resp','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'medida'=>$this->getModel()->getListOptions('medida'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Produto_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_produto', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id'),'String','%?%');
            $this->_columns->add('codigo', 'cv_produto', 'codigo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.codigo'),'String','%?%');
            $this->_columns->add('nome', 'cv_produto', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.nome'),'String','%?%');
            $this->_columns->add('tipo', 'cv_produto', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.tipo'),'String','=');
            $this->_columns->add('apelido', 'cv_produto', 'apelido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.apelido'),'String','%?%');
            $this->_columns->add('vlr_venda', 'cv_produto', 'vlr_venda', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.vlr_venda'),'String','%?%');
            $this->_columns->add('vlr_compra', 'cv_produto', 'vlr_compra', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.vlr_compra'),'String','%?%');
            $this->_columns->add('medida', 'cv_produto', 'medida', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.medida'),'String','=');
            $this->_columns->add('qtd_estoque', 'cv_produto', 'qtd_estoque', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.qtd_estoque'),'String','%?%');
            $this->_columns->add('id_cliente', 'cv_produto', 'id_cliente', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_cliente'), null, '=');
            $this->_columns->add('nome_cliente', 'cliente', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_cliente.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('id_produto_resp', 'cv_produto', 'id_produto_resp', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_produto_resp'), null, '=');
            $this->_columns->add('codigo_produto_resp', 'produto_resp', 'codigo', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_produto_resp.cv_produto.codigo'),null,'?%');
            $this->_columns->add('id_empresa', 'cv_produto', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_produto.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." cliente ON ( cv_produto.id_cliente = cliente.id ) 
                    LEFT  JOIN ".$this->_getProduto()->getModel()->getTableName()." produto_resp ON ( cv_produto.id_produto_resp = produto_resp.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( cv_produto.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>