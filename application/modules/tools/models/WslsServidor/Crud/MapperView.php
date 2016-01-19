<?php
    /**
    * Classe de visão da tabela wsls_servidor
    */
    class Tools_Model_WslsServidor_Crud_MapperView extends Tools_Model_WslsServidor_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Filial_Mapper
         */
        protected $_filial;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected $_cidade;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_PostoAvancado_Mapper
         */
        protected $_postoAvancado;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Filial_Mapper
         */
        protected function _getFilial(){
            if (!is_object($this->_filial)){
                $this->_filial = new Ca_Model_Filial_Mapper();
            }
            return $this->_filial;
        }
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Cidade_Mapper
         */
        protected function _getCidade(){
            if (!is_object($this->_cidade)){
                $this->_cidade = new Ca_Model_Cidade_Mapper();
            }
            return $this->_cidade;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_PostoAvancado_Mapper
         */
        protected function _getPostoAvancado(){
            if (!is_object($this->_postoAvancado)){
                $this->_postoAvancado = new Ca_Model_PostoAvancado_Mapper();
            }
            return $this->_postoAvancado;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','ip','padrao','status','id_filial','sigla_filial','nome_cidade','id_posto_avancado','nome_posto_avancado','impressora_padrao');
           $profile['width'] = array('id'=>87.5,'ip'=>20,'padrao'=>150,'status'=>150,'id_filial'=>120,'sigla_filial'=>200,'nome_cidade'=>200,'id_posto_avancado'=>120,'nome_posto_avancado'=>200,'impressora_padrao'=>200);
           $profile['align'] = array('id'=>'left','ip'=>'left','padrao'=>'center','status'=>'center','id_filial'=>'left','sigla_filial'=>'left','nome_cidade'=>'left','id_posto_avancado'=>'left','nome_posto_avancado'=>'left','impressora_padrao'=>'left');
           $profile['hidden'] = array('id_filial','id_posto_avancado');
           $profile['remove'] = array();
           $profile['listOptions'] = array('padrao'=>$this->getModel()->getListOptions('padrao'),'status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Tools_Model_WslsServidor_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'wsls_servidor', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id'),'String','%?%');
            $this->_columns->add('ip', 'wsls_servidor', 'ip', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.ip'),'String','%?%');
            $this->_columns->add('padrao', 'wsls_servidor', 'padrao', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.padrao'),'String','=');
            $this->_columns->add('status', 'wsls_servidor', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.status'),'String','=');
            $this->_columns->add('id_filial', 'wsls_servidor', 'id_filial', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id_filial'), null, '?%');
            $this->_columns->add('sigla_filial', 'filial', 'sigla', $this->_getFilial()->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id_filial.filial.sigla'),null,'?%');
            $this->_columns->add('nome_cidade', 'cidade', 'nome', $this->_getCidade()->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id_filial.filial.nome_cidade'),null,'?%');
            $this->_columns->add('id_posto_avancado', 'wsls_servidor', 'id_posto_avancado', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id_posto_avancado'), null, '?%');
            $this->_columns->add('nome_posto_avancado', 'posto_avancado', 'nome', $this->_getPostoAvancado()->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.id_posto_avancado.posto_avancado.nome'),null,'?%');
            $this->_columns->add('impressora_padrao', 'wsls_servidor', 'impressora_padrao', $this->getModel()->getMapperName(), ZendT_Lib::translate('wsls_servidor.impressora_padrao'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getFilial()->getModel()->getTableName()." filial ON ( wsls_servidor.id_filial = filial.id ) 
                    JOIN ".$this->_getCidade()->getModel()->getTableName()." cidade ON ( filial.id_cidade = cidade.id ) 
                    LEFT  JOIN ".$this->_getPostoAvancado()->getModel()->getTableName()." posto_avancado ON ( wsls_servidor.id_posto_avancado = posto_avancado.id )  "; 
            return $sql;
        }
    }
?>