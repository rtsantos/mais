<?php
    /**
    * Classe de visão da tabela ca_regra_contrato
    */
    class Ca_DataView_RegraContrato_Crud_MapperView extends Ca_Model_RegraContrato_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Contrato_Mapper
         */
        protected $_contrato;
                
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
        protected $_pessoa;
                
        
                
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
           $profile['order'] = array('id','id_contrato','descricao_contrato','id_produto','codigo_produto','nome_produto','status','vlr_fixo','vlr_min','vlr_perc','tipo','favorecido','id_favorecido','nome_favorecido','desc_lanc','pago');
           $profile['width'] = array('id'=>100,'id_contrato'=>120,'descricao_contrato'=>200,'id_produto'=>120,'codigo_produto'=>200,'nome_produto'=>200,'status'=>150,'vlr_fixo'=>150,'vlr_min'=>150,'vlr_perc'=>150,'tipo'=>150,'favorecido'=>150,'id_favorecido'=>120,'nome_favorecido'=>200,'desc_lanc'=>200,'pago'=>150);
           $profile['align'] = array('id'=>'left','id_contrato'=>'left','descricao_contrato'=>'left','id_produto'=>'left','codigo_produto'=>'left','nome_produto'=>'left','status'=>'center','vlr_fixo'=>'right','vlr_min'=>'right','vlr_perc'=>'right','tipo'=>'center','favorecido'=>'center','id_favorecido'=>'left','nome_favorecido'=>'left','desc_lanc'=>'left','pago'=>'center');
           $profile['hidden'] = array('id_contrato','id_produto','id_favorecido');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'),'tipo'=>$this->getModel()->getListOptions('tipo'),'favorecido'=>$this->getModel()->getListOptions('favorecido'),'pago'=>$this->getModel()->getListOptions('pago'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_RegraContrato_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_regra_contrato', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id'),'String','%?%');
            $this->_columns->add('id_contrato', 'ca_regra_contrato', 'id_contrato', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_contrato'), null, '=');
            $this->_columns->add('descricao_contrato', 'contrato', 'descricao', $this->_getContrato()->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_contrato.ca_contrato.descricao'),null,'?%');
            $this->_columns->add('id_produto', 'ca_regra_contrato', 'id_produto', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_produto'), null, '=');
            $this->_columns->add('codigo_produto', 'produto', 'codigo', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_produto.cv_produto.codigo'),null,'?%');
            $this->_columns->add('nome_produto', 'produto', 'nome', $this->_getProduto()->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_produto.cv_produto.nome'),null,'?%');
            $this->_columns->add('status', 'ca_regra_contrato', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.status'),'String','=');
            $this->_columns->add('vlr_fixo', 'ca_regra_contrato', 'vlr_fixo', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.vlr_fixo'),'Numeric','=');
            $this->_columns->add('vlr_min', 'ca_regra_contrato', 'vlr_min', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.vlr_min'),'Numeric','=');
            $this->_columns->add('vlr_perc', 'ca_regra_contrato', 'vlr_perc', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.vlr_perc'),'Numeric','=');
            $this->_columns->add('tipo', 'ca_regra_contrato', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.tipo'),'String','=');
            $this->_columns->add('favorecido', 'ca_regra_contrato', 'favorecido', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.favorecido'),'String','=');
            $this->_columns->add('id_favorecido', 'ca_regra_contrato', 'id_favorecido', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_favorecido'), null, '=');
            $this->_columns->add('nome_favorecido', 'favorecido', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.id_favorecido.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('desc_lanc', 'ca_regra_contrato', 'desc_lanc', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.desc_lanc'),'String','%?%');
            $this->_columns->add('pago', 'ca_regra_contrato', 'pago', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_regra_contrato.pago'),'String','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getContrato()->getModel()->getTableName()." contrato ON ( ca_regra_contrato.id_contrato = contrato.id ) 
                    JOIN ".$this->_getProduto()->getModel()->getTableName()." produto ON ( ca_regra_contrato.id_produto = produto.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." favorecido ON ( ca_regra_contrato.id_favorecido = favorecido.id )  "; 
            return $sql;
        }
    }
?>