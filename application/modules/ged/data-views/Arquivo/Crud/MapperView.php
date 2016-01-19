<?php
    /**
    * Classe de visão da tabela img_arquivo
    */
    class Ged_DataView_Arquivo_Crud_MapperView extends Ged_Model_Arquivo_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_PropDocto_Mapper
         */
        protected $_propDocto;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ged_Model_PropDocto_Mapper
         */
        protected function _getPropDocto(){
            if (!is_object($this->_propDocto)){
                $this->_propDocto = new Ged_Model_PropDocto_Mapper();
            }
            return $this->_propDocto;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','conteudo_name','conteudo_type','dh_inc','hashcode','conteudo','id_prop_docto','nome_prop_docto','path_arq','dt_expira');
           $profile['width'] = array('id'=>100,'conteudo_name'=>200,'conteudo_type'=>200,'dh_inc'=>150,'hashcode'=>200,'conteudo'=>200,'id_prop_docto'=>120,'nome_prop_docto'=>200,'path_arq'=>200,'dt_expira'=>100);
           $profile['align'] = array('id'=>'left','conteudo_name'=>'left','conteudo_type'=>'left','dh_inc'=>'center','hashcode'=>'left','conteudo'=>'left','id_prop_docto'=>'left','nome_prop_docto'=>'left','path_arq'=>'left','dt_expira'=>'center');
           $profile['hidden'] = array('id_prop_docto');
           $profile['remove'] = array('conteudo_type','conteudo');
           $profile['listOptions'] = array();
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Ged_DataView_Arquivo_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'img_arquivo', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.id'),'String','%?%');
            $this->_columns->add('conteudo_name', 'img_arquivo', 'conteudo_name', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.conteudo_name'),'String','%?%');
            $this->_columns->add('conteudo_type', 'img_arquivo', 'conteudo_type', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.conteudo_type'),'String','%?%');
            $this->_columns->add('dh_inc', 'img_arquivo', 'dh_inc', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.dh_inc'),'DateTime','=');
            $this->_columns->add('hashcode', 'img_arquivo', 'hashcode', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.hashcode'),'String','%?%');
            $this->_columns->add('conteudo', 'img_arquivo', 'conteudo', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.conteudo'),'String','%?%');
            $this->_columns->add('id_prop_docto', 'img_arquivo', 'id_prop_docto', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.id_prop_docto'), null, '=');
            $this->_columns->add('nome_prop_docto', 'prop_docto', 'nome', $this->_getPropDocto()->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.id_prop_docto.img_prop_docto.nome'),null,'?%');
            $this->_columns->add('path_arq', 'img_arquivo', 'path_arq', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.path_arq'),'String','%?%');
            $this->_columns->add('dt_expira', 'img_arquivo', 'dt_expira', $this->getModel()->getMapperName(), ZendT_Lib::translate('img_arquivo.dt_expira'),'Date','=');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getPropDocto()->getModel()->getTableName()." prop_docto ON ( img_arquivo.id_prop_docto = prop_docto.id )  "; 
            return $sql;
        }
    }
?>