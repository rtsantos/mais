<?php
    /**
    * Classe de visão da tabela cms_categoria
    */
    class Cms_DataView_Categoria_Crud_MapperView extends Cms_Model_Categoria_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected $_categoria;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Cms_Model_Categoria_Mapper
         */
        protected function _getCategoria(){
            if (!is_object($this->_categoria)){
                $this->_categoria = new Cms_Model_Categoria_Mapper();
            }
            return $this->_categoria;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','descricao','id_categoria_pai','descricao_categoria_pai','tipo','status','publico','menu','observacao','ordem','thumbnail','url','chave','nivel','url_macro');
           $profile['width'] = array('id'=>100,'descricao'=>200,'id_categoria_pai'=>120,'descricao_categoria_pai'=>200,'tipo'=>150,'status'=>150,'publico'=>150,'menu'=>150,'observacao'=>200,'ordem'=>150,'thumbnail'=>150,'url'=>200,'chave'=>200,'nivel'=>150,'url_macro'=>200);
           $profile['align'] = array('id'=>'left','descricao'=>'left','id_categoria_pai'=>'left','descricao_categoria_pai'=>'left','tipo'=>'center','status'=>'center','publico'=>'center','menu'=>'center','observacao'=>'left','ordem'=>'right','thumbnail'=>'right','url'=>'left','chave'=>'left','nivel'=>'right','url_macro'=>'left');
           $profile['hidden'] = array('id_categoria_pai');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'status'=>$this->getModel()->getListOptions('status'),'publico'=>$this->getModel()->getListOptions('publico'),'menu'=>$this->getModel()->getListOptions('menu'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Cms_DataView_Categoria_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'cms_categoria', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.id'),'String','%?%');
            $this->_columns->add('descricao', 'cms_categoria', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.descricao'),'String','%?%');
            $this->_columns->add('id_categoria_pai', 'cms_categoria', 'id_categoria_pai', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.id_categoria_pai'), null, '=');
            $this->_columns->add('descricao_categoria_pai', 'categoria_pai', 'descricao', $this->_getCategoria()->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.id_categoria_pai.cms_categoria.descricao'),null,'?%');
            $this->_columns->add('tipo', 'cms_categoria', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.tipo'),'String','=');
            $this->_columns->add('status', 'cms_categoria', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.status'),'String','=');
            $this->_columns->add('publico', 'cms_categoria', 'publico', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.publico'),'String','=');
            $this->_columns->add('menu', 'cms_categoria', 'menu', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.menu'),'String','=');
            $this->_columns->add('observacao', 'cms_categoria', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.observacao'),'String','%?%');
            $this->_columns->add('ordem', 'cms_categoria', 'ordem', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.ordem'),'Numeric','=');
            $this->_columns->add('thumbnail', 'cms_categoria', 'thumbnail', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.thumbnail'),'Numeric','=');
            $this->_columns->add('url', 'cms_categoria', 'url', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.url'),'String','%?%');
            $this->_columns->add('chave', 'cms_categoria', 'chave', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.chave'),'String','%?%');
            $this->_columns->add('nivel', 'cms_categoria', 'nivel', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.nivel'),'Numeric','=');
            $this->_columns->add('url_macro', 'cms_categoria', 'url_macro', $this->getModel()->getMapperName(), ZendT_Lib::translate('cms_categoria.url_macro'),'String','%?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getCategoria()->getModel()->getTableName()." categoria_pai ON ( cms_categoria.id_categoria_pai = categoria_pai.id )  "; 
            return $sql;
        }
    }
?>