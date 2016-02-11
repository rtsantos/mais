<?php
    /**
    * Classe de visão da tabela at_papel
    */
    class Auth_DataView_Conta_Crud_MapperView extends Auth_Model_Conta_Mapper implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected $_conta;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Conta_Mapper
         */
        protected function _getConta(){
            if (!is_object($this->_conta)){
                $this->_conta = new Auth_Model_Conta_Mapper();
            }
            return $this->_conta;
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
           $profile['order'] = array('id','nome','descricao','hierarquia','id_papel_pai','tipo','status','senha','avatar','email','id_empresa','nome_empresa');
           $profile['width'] = array('id'=>100,'nome'=>200,'descricao'=>200,'hierarquia'=>200,'id_papel_pai'=>120,'tipo'=>150,'status'=>150,'senha'=>175,'avatar'=>200,'email'=>200,'id_empresa'=>120,'nome_empresa'=>200);
           $profile['align'] = array('id'=>'left','nome'=>'left','descricao'=>'left','hierarquia'=>'left','id_papel_pai'=>'left','tipo'=>'center','status'=>'center','senha'=>'left','avatar'=>'left','email'=>'left','id_empresa'=>'left','nome_empresa'=>'left');
           $profile['hidden'] = array('id_papel_pai','id_empresa');
           $profile['remove'] = array();
           $profile['listOptions'] = array('tipo'=>$this->getModel()->getListOptions('tipo'),'status'=>$this->getModel()->getListOptions('status'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Conta_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'at_papel', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.id'),'String','%?%');
            $this->_columns->add('nome', 'at_papel', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.nome'),'String','%?%');
            $this->_columns->add('descricao', 'at_papel', 'descricao', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.descricao'),'String','%?%');
            $this->_columns->add('hierarquia', 'at_papel', 'hierarquia', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.hierarquia'),'String','%?%');
            $this->_columns->add('id_papel_pai', 'at_papel', 'id_papel_pai', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.id_papel_pai'), null, '=');
            $this->_columns->add('tipo', 'at_papel', 'tipo', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.tipo'),'String','=');
            $this->_columns->add('status', 'at_papel', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.status'),'String','=');
            $this->_columns->add('senha', 'at_papel', 'senha', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.senha'),'String','%?%');
            $this->_columns->add('avatar', 'at_papel', 'avatar', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.avatar'),'String','%?%');
            $this->_columns->add('email', 'at_papel', 'email', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.email'),'String','%?%');
            $this->_columns->add('id_empresa', 'at_papel', 'id_empresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.id_empresa'), null, '=');
            $this->_columns->add('nome_empresa', 'empresa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('at_papel.id_empresa.ca_pessoa.nome'),null,'?%');

        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    LEFT  JOIN ".$this->_getConta()->getModel()->getTableName()." papel_pai ON ( at_papel.id_papel_pai = papel_pai.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." empresa ON ( at_papel.id_empresa = empresa.id )  "; 
            return $sql;
        }
    }
?>