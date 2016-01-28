<?php
    /**
    * Classe de visão da tabela fr_veiculo
    */
    class Frota_DataView_Veiculo_Crud_MapperView extends Frota_Model_Veiculo_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Frota_Model_Modelo_Mapper
         */
        protected $_modelo;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Frota_Model_Modelo_Mapper
         */
        protected function _getModelo(){
            if (!is_object($this->_modelo)){
                $this->_modelo = new Frota_Model_Modelo_Mapper();
            }
            return $this->_modelo;
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
           $profile['order'] = array('id','id_modelo','descricao_modelo','placa','descricao','chassi','renavam','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'id_modelo'=>120,'descricao_modelo'=>200,'placa'=>100,'descricao'=>200,'chassi'=>200,'renavam'=>200,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','id_modelo'=>'left','descricao_modelo'=>'left','placa'=>'left','descricao'=>'left','chassi'=>'left','renavam'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_modelo','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Frota_DataView_Veiculo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'fr_veiculo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.id'),'String','%?%');
            $this->_columns->add('id_modelo', 'fr_veiculo', 'id_modelo', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.id_modelo'), null, '=');
            $this->_columns->add('descricao_modelo', 'modelo', 'descricao', $this->_getModelo()->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.id_modelo.fr_modelo.descricao'),null,'?%');
            $this->_columns->add('placa', 'fr_veiculo', 'placa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.placa'),'String','%?%');
            $this->_columns->add('descricao', 'fr_veiculo', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.descricao'),'String','%?%');
            $this->_columns->add('chassi', 'fr_veiculo', 'chassi', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.chassi'),'String','%?%');
            $this->_columns->add('renavam', 'fr_veiculo', 'renavam', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.renavam'),'String','%?%');
            $this->_columns->add('id_empresa', 'fr_veiculo', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('fr_veiculo.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getModelo()->getModel()->getTableName()." modelo ON ( fr_veiculo.id_modelo = modelo.id ) 
                    JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( fr_veiculo.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>