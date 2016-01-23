<?php
    /**
    * Classe de visão da tabela cv_item_pedido
    */
    class Vendas_DataView_ItemPedido_Crud_MapperView extends Vendas_Model_ItemPedido_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pedido_Mapper
         */
        protected $_pedido;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Produto_Mapper
         */
        protected $_produto;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Vendas_Model_Pedido_Mapper
         */
        protected function _getPedido(){
            if (!is_object($this->_pedido)){
                $this->_pedido = new Vendas_Model_Pedido_Mapper();
            }
            return $this->_pedido;
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
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pedido','numero_pedido','id_produto','codigo_produto','nome_produto','id_usu_inc','nome_usu_inc','id_usu_alt','nome_usu_alt','qtd_item','vlr_item','vlr_desc','calculo');
           $profile['width'] = array('id'=>100,'id_pedido'=>120,'numero_pedido'=>200,'id_produto'=>120,'codigo_produto'=>200,'nome_produto'=>200,'id_usu_inc'=>120,'nome_usu_inc'=>200,'id_usu_alt'=>120,'nome_usu_alt'=>200,'qtd_item'=>200,'vlr_item'=>200,'vlr_desc'=>200,'calculo'=>200);
           $profile['align'] = array('id'=>'left','id_pedido'=>'left','numero_pedido'=>'left','id_produto'=>'left','codigo_produto'=>'left','nome_produto'=>'left','id_usu_inc'=>'left','nome_usu_inc'=>'left','id_usu_alt'=>'left','nome_usu_alt'=>'left','qtd_item'=>'left','vlr_item'=>'left','vlr_desc'=>'left','calculo'=>'left');
           $profile['hidden'] = array('id_pedido','id_produto','id_usu_inc','id_usu_alt');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_ItemPedido_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_item_pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id'),'String','%?%');
            $this->_columns->add('id_pedido', 'cv_item_pedido', 'id_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_pedido'), null, '=');
            $this->_columns->add('numero_pedido', 'pedido', 'numero', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_pedido.cv_pedido.numero'),null,'?%');
            $this->_columns->add('id_produto', 'cv_item_pedido', 'id_produto', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_produto'), null, '=');
            $this->_columns->add('codigo_produto', 'produto', 'codigo', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_produto.cv_produto.codigo'),null,'?%');
            $this->_columns->add('nome_produto', 'produto', 'nome', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_produto.cv_produto.nome'),null,'?%');
            $this->_columns->add('id_usu_inc', 'cv_item_pedido', 'id_usu_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_usu_inc'), null, '=');
            $this->_columns->add('nome_usu_inc', 'usu_inc', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_usu_inc.papel.nome'),null,'?%');
            $this->_columns->add('id_usu_alt', 'cv_item_pedido', 'id_usu_alt', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_usu_alt'), null, '=');
            $this->_columns->add('nome_usu_alt', 'usu_alt', 'nome', $this->_getConta()->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.id_usu_alt.papel.nome'),null,'?%');
            $this->_columns->add('qtd_item', 'cv_item_pedido', 'qtd_item', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.qtd_item'),'String','%?%');
            $this->_columns->add('vlr_item', 'cv_item_pedido', 'vlr_item', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.vlr_item'),'String','%?%');
            $this->_columns->add('vlr_desc', 'cv_item_pedido', 'vlr_desc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.vlr_desc'),'String','%?%');
            $this->_columns->add('calculo', 'cv_item_pedido', 'calculo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_item_pedido.calculo'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPedido()->getModel()->getTableName()." pedido ON ( cv_item_pedido.id_pedido = pedido.id ) 
                    JOIN ".$this->_getProduto()->getModel()->getTableName()." produto ON ( cv_item_pedido.id_produto = produto.id ) 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usu_inc ON ( cv_item_pedido.id_usu_inc = usu_inc.id ) 
                    JOIN ".$this->_getConta()->getModel()->getTableName()." usu_alt ON ( cv_item_pedido.id_usu_alt = usu_alt.id )  "; 
            return $sql;
        }
    }
?>