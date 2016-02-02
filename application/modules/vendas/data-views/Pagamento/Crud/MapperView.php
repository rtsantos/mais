<?php
    /**
    * Classe de visão da tabela cv_pagto_pedido
    */
    class Vendas_DataView_Pagamento_Crud_MapperView extends Vendas_Model_Pagamento_Mapper implements ZendT_Db_View
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
         * @return Vendas_Model_Pedido_Mapper
         */
        protected function _getPedido(){
            if (!is_object($this->_pedido)){
                $this->_pedido = new Vendas_Model_Pedido_Mapper();
            }
            return $this->_pedido;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_pedido','numero_pedido','forma','vlr_total','vlr_pago','per_acre','nro_parc','vlr_parc','vlr_a_pagar','per_desc','nro_comprov');
           $profile['width'] = array('id'=>100,'id_pedido'=>120,'numero_pedido'=>200,'forma'=>150,'vlr_total'=>150,'vlr_pago'=>150,'per_acre'=>150,'nro_parc'=>150,'vlr_parc'=>150,'vlr_a_pagar'=>150,'per_desc'=>150,'nro_comprov'=>175);
           $profile['align'] = array('id'=>'left','id_pedido'=>'left','numero_pedido'=>'left','forma'=>'center','vlr_total'=>'right','vlr_pago'=>'right','per_acre'=>'right','nro_parc'=>'right','vlr_parc'=>'right','vlr_a_pagar'=>'right','per_desc'=>'right','nro_comprov'=>'left');
           $profile['hidden'] = array('id_pedido');
           $profile['remove'] = array();
           $profile['listOptions'] = array('forma'=>$this->getModel()->getListOptions('forma'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Pagamento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_pagto_pedido', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id'),'String','%?%');
            $this->_columns->add('id_pedido', 'cv_pagto_pedido', 'id_pedido', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_pedido'), null, '=');
            $this->_columns->add('numero_pedido', 'pedido', 'numero', $this->_getPedido()->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.id_pedido.cv_pedido.numero'),null,'?%');
            $this->_columns->add('forma', 'cv_pagto_pedido', 'forma', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.forma'),'String','=');
            $this->_columns->add('vlr_total', 'cv_pagto_pedido', 'vlr_total', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_total'),'Numeric','=');
            $this->_columns->add('vlr_pago', 'cv_pagto_pedido', 'vlr_pago', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_pago'),'Numeric','=');
            $this->_columns->add('per_acre', 'cv_pagto_pedido', 'per_acre', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.per_acre'),'Numeric','=');
            $this->_columns->add('nro_parc', 'cv_pagto_pedido', 'nro_parc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.nro_parc'),'Numeric','=');
            $this->_columns->add('vlr_parc', 'cv_pagto_pedido', 'vlr_parc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_parc'),'Numeric','=');
            $this->_columns->add('vlr_a_pagar', 'cv_pagto_pedido', 'vlr_a_pagar', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.vlr_a_pagar'),'Numeric','=');
            $this->_columns->add('per_desc', 'cv_pagto_pedido', 'per_desc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.per_desc'),'Numeric','=');
            $this->_columns->add('nro_comprov', 'cv_pagto_pedido', 'nro_comprov', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_pagto_pedido.nro_comprov'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPedido()->getModel()->getTableName()." pedido ON ( cv_pagto_pedido.id_pedido = pedido.id )  "; 
            return $sql;
        }
    }
?>