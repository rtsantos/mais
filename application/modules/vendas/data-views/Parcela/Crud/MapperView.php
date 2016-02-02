<?php
    /**
    * Classe de visão da tabela cv_parcela
    */
    class Vendas_DataView_Parcela_Crud_MapperView extends Vendas_Model_Parcela_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','descricao','per_juro','status','qtd','id_empresa','nome_empresa','dias_venc');
           $profile['width'] = array('id'=>100,'descricao'=>200,'per_juro'=>150,'status'=>150,'qtd'=>150,'id_empresa'=>120,'nome_empresa'=>200,'dias_venc'=>150);
           $profile['align'] = array('id'=>'left','descricao'=>'left','per_juro'=>'right','status'=>'center','qtd'=>'right','id_empresa'=>'left','nome_empresa'=>'left','dias_venc'=>'right');
           $profile['hidden'] = array('id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Vendas_DataView_Parcela_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cv_parcela', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.id'),'String','%?%');
            $this->_columns->add('descricao', 'cv_parcela', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.descricao'),'String','%?%');
            $this->_columns->add('per_juro', 'cv_parcela', 'per_juro', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.per_juro'),'Numeric','=');
            $this->_columns->add('status', 'cv_parcela', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.status'),'String','=');
            $this->_columns->add('qtd', 'cv_parcela', 'qtd', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.qtd'),'Numeric','=');
            $this->_columns->add('id_empresa', 'cv_parcela', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.id_empresa.ca_pessoa.nome'),null,'?%');
            $this->_columns->add('dias_venc', 'cv_parcela', 'dias_venc', $this->getModel()->getMapperName(), ZendT_Lib::translate('cv_parcela.dias_venc'),'Numeric','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( cv_parcela.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>