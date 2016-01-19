<?php
    /**
    * Classe de visão da tabela cardapio
    */
    class Cms_DataView_Cardapio_Crud_MapperView extends Cms_Model_Cardapio_Mapper implements ZendT_Db_View
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
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','dt_exibe','pt_principal','opcao','guarnicao','arroz_feijao','salada','sobremesa','suco','pt_light','id_filial','sigla_filial','nome_cidade');
           $profile['width'] = array('id'=>100,'dt_exibe'=>100,'pt_principal'=>200,'opcao'=>200,'guarnicao'=>200,'arroz_feijao'=>150,'salada'=>200,'sobremesa'=>200,'suco'=>200,'pt_light'=>200,'id_filial'=>120,'sigla_filial'=>200,'nome_cidade'=>200);
           $profile['align'] = array('id'=>'left','dt_exibe'=>'center','pt_principal'=>'left','opcao'=>'left','guarnicao'=>'left','arroz_feijao'=>'center','salada'=>'left','sobremesa'=>'left','suco'=>'left','pt_light'=>'left','id_filial'=>'left','sigla_filial'=>'left','nome_cidade'=>'left');
           $profile['hidden'] = array('id_filial');
           $profile['remove'] = array();
           $profile['listOptions'] = array('arroz_feijao'=>$this->getModel()->getListOptions('arroz_feijao'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_Cardapio_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cardapio', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.id'),'String','%?%');
            $this->_columns->add('dt_exibe', 'cardapio', 'dt_exibe', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.dt_exibe'),'Date','=');
            $this->_columns->add('pt_principal', 'cardapio', 'pt_principal', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.pt_principal'),'String','%?%');
            $this->_columns->add('opcao', 'cardapio', 'opcao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.opcao'),'String','%?%');
            $this->_columns->add('guarnicao', 'cardapio', 'guarnicao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.guarnicao'),'String','%?%');
            $this->_columns->add('arroz_feijao', 'cardapio', 'arroz_feijao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.arroz_feijao'),'String','=');
            $this->_columns->add('salada', 'cardapio', 'salada', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.salada'),'String','%?%');
            $this->_columns->add('sobremesa', 'cardapio', 'sobremesa', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.sobremesa'),'String','%?%');
            $this->_columns->add('suco', 'cardapio', 'suco', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.suco'),'String','%?%');
            $this->_columns->add('pt_light', 'cardapio', 'pt_light', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.pt_light'),'String','%?%');
            $this->_columns->add('id_filial', 'cardapio', 'id_filial', $this->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.id_filial'), null, '=');
            $this->_columns->add('sigla_filial', 'filial', 'sigla', $this->_getFilial()->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.id_filial.filial.sigla'),null,'?%');
            $this->_columns->add('nome_cidade', 'cidade', 'nome', $this->_getCidade()->getModel()->getMapperName(), ZendT_Lib::translate('cardapio.id_filial.filial.nome_cidade'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getFilial()->getModel()->getTableName()." filial ON ( cardapio.id_filial = filial.id ) 
                    JOIN ".$this->_getCidade()->getModel()->getTableName()." cidade ON ( filial.id_cidade = cidade.id )  "; 
            return $sql;
        }
    }
?>