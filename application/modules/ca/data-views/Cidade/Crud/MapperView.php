<?php
    /**
    * Classe de visão da tabela ca_cidade
    */
    class Ca_DataView_Cidade_Crud_MapperView extends Ca_Model_Cidade_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Estado_Mapper
         */
        protected $_estado;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Estado_Mapper
         */
        protected function _getEstado(){
            if (!is_object($this->_estado)){
                $this->_estado = new Ca_Model_Estado_Mapper();
            }
            return $this->_estado;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','nome','polo','classificacao','id_estado','uf_estado','nome_estado','cod_ibge','aliq_iss','cep');
           $profile['width'] = array('id'=>100,'nome'=>200,'polo'=>150,'classificacao'=>150,'id_estado'=>120,'uf_estado'=>200,'nome_estado'=>200,'cod_ibge'=>175,'aliq_iss'=>150,'cep'=>175);
           $profile['align'] = array('id'=>'left','nome'=>'left','polo'=>'center','classificacao'=>'center','id_estado'=>'left','uf_estado'=>'left','nome_estado'=>'left','cod_ibge'=>'left','aliq_iss'=>'right','cep'=>'left');
           $profile['hidden'] = array('id_estado');
           $profile['remove'] = array();
           $profile['listOptions'] = array('polo'=>$this->getModel()->getListOptions('polo'),'classificacao'=>$this->getModel()->getListOptions('classificacao'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ca_DataView_Cidade_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'ca_cidade', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.id'),'String','%?%');
            $this->_columns->add('nome', 'ca_cidade', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.nome'),'String','%?%');
            $this->_columns->add('polo', 'ca_cidade', 'polo', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.polo'),'String','=');
            $this->_columns->add('classificacao', 'ca_cidade', 'classificacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.classificacao'),'String','=');
            $this->_columns->add('id_estado', 'ca_cidade', 'id_estado', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.id_estado'), null, '=');
            $this->_columns->add('uf_estado', 'estado', 'uf', $this->_getEstado()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.id_estado.ca_estado.uf'),null,'?%');
            $this->_columns->add('nome_estado', 'estado', 'nome', $this->_getEstado()->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.id_estado.ca_estado.nome'),null,'?%');
            $this->_columns->add('cod_ibge', 'ca_cidade', 'cod_ibge', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.cod_ibge'),'String','%?%');
            $this->_columns->add('aliq_iss', 'ca_cidade', 'aliq_iss', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.aliq_iss'),'Numeric','=');
            $this->_columns->add('cep', 'ca_cidade', 'cep', $this->getModel()->getMapperName(), ZendT_Lib::translate('ca_cidade.cep'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getAlias() ." 
                    JOIN ".$this->_getEstado()->getModel()->getTableName()." estado ON ( ca_cidade.id_estado = estado.id )  "; 
            return $sql;
        }
    }
?>