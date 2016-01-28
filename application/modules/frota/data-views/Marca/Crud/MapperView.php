<?php
    /**
    * Classe de visão da tabela fr_marca
    */
    class Frota_DataView_Marca_Crud_MapperView extends Frota_Model_Marca_Mapper implements ZendT_Db_View
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
           $profile['order'] = array('id','descricao','status','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'descricao'=>200,'status'=>150,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','descricao'=>'left','status'=>'center','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Frota_DataView_Marca_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'fr_marca', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_marca.id'),'String','%?%');
            $this->_columns->add('descricao', 'fr_marca', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_marca.descricao'),'String','%?%');
            $this->_columns->add('status', 'fr_marca', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_marca.status'),'String','=');
            $this->_columns->add('id_empresa', 'fr_marca', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_marca.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('fr_marca.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( fr_marca.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>