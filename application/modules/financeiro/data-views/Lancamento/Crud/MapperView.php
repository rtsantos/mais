<?php
    /**
    * Classe de visão da tabela fc_lancamento
    */
    class Financeiro_DataView_Lancamento_Crud_MapperView extends Financeiro_Model_Lancamento_Mapper implements ZendT_Db_View
    {
        
        
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','id_empresa','tipo','descricao','id_usu_inc','dh_inc','dt_lanc','vlr_lanc','vlr_saldo','ultimo','status','id_favorecido');
           $profile['width'] = array('id'=>100,'id_empresa'=>150,'tipo'=>150,'descricao'=>200,'id_usu_inc'=>150,'dh_inc'=>150,'dt_lanc'=>100,'vlr_lanc'=>150,'vlr_saldo'=>150,'ultimo'=>100,'status'=>150,'id_favorecido'=>150);
           $profile['align'] = array('id'=>'left','id_empresa'=>'right','tipo'=>'center','descricao'=>'left','id_usu_inc'=>'center','dh_inc'=>'center','dt_lanc'=>'center','vlr_lanc'=>'right','vlr_saldo'=>'right','ultimo'=>'left','status'=>'center','id_favorecido'=>'right');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Financeiro_DataView_Lancamento_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'fc_lancamento', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id'),'String','%?%');
            $this->_columns->add('id_empresa', 'fc_lancamento', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_empresa'),'Numeric','=');
            $this->_columns->add('tipo', 'fc_lancamento', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.tipo'),'String','=');
            $this->_columns->add('descricao', 'fc_lancamento', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.descricao'),'String','%?%');
            $this->_columns->add('id_usu_inc', 'fc_lancamento', 'id_usu_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_usu_inc'),'DateTime','=');
            $this->_columns->add('dh_inc', 'fc_lancamento', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.dh_inc'),'DateTime','=');
            $this->_columns->add('dt_lanc', 'fc_lancamento', 'dt_lanc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.dt_lanc'),'Date','=');
            $this->_columns->add('vlr_lanc', 'fc_lancamento', 'vlr_lanc', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.vlr_lanc'),'Numeric','=');
            $this->_columns->add('vlr_saldo', 'fc_lancamento', 'vlr_saldo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.vlr_saldo'),'Numeric','=');
            $this->_columns->add('ultimo', 'fc_lancamento', 'ultimo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.ultimo'),'String','%?%');
            $this->_columns->add('status', 'fc_lancamento', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.status'),'String','=');
            $this->_columns->add('id_favorecido', 'fc_lancamento', 'id_favorecido', $this->getModel()->getMapperName(), ZendT_Lib::translate('fc_lancamento.id_favorecido'),'Numeric','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = parent::_getSqlBase();
            return $sql;
        }
    }
?>