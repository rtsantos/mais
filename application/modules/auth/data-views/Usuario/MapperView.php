<?php
    /**
    * Classe de visão da tabela usuario
    */
    class Auth_DataView_Usuario_MapperView extends Auth_DataView_Usuario_Crud_MapperView implements ZendT_Db_View
    {
        
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_TipoUsuario_Mapper
         */
        protected $_tipoUsuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Folha_Model_Pessoal_Mapper
         */
        protected $_pessoal;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Empresa_Mapper
         */
        protected $_empresa;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Pessoa_Mapper
         */
        protected $_pessoa;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Filial_Mapper
         */
        protected $_filial;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Usuario_Mapper
         */
        protected $_usuario;
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected $_papel;
                
        
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_TipoUsuario_Mapper
         */
        protected function _getTipoUsuario(){
            if (!is_object($this->_tipoUsuario)){
                $this->_tipoUsuario = new Auth_Model_TipoUsuario_Mapper();
            }
            return $this->_tipoUsuario;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Folha_Model_Pessoal_Mapper
         */
        protected function _getPessoal(){
            if (!is_object($this->_pessoal)){
                $this->_pessoal = new Folha_Model_Pessoal_Mapper();
            }
            return $this->_pessoal;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Ca_Model_Empresa_Mapper
         */
        protected function _getEmpresa(){
            if (!is_object($this->_empresa)){
                $this->_empresa = new Ca_Model_Empresa_Mapper();
            }
            return $this->_empresa;
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
         * @return Auth_Model_Usuario_Mapper
         */
        protected function _getUsuario(){
            if (!is_object($this->_usuario)){
                $this->_usuario = new Auth_Model_Usuario_Mapper();
            }
            return $this->_usuario;
        }
                
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return Auth_Model_Papel_Mapper
         */
        protected function _getPapel(){
            if (!is_object($this->_papel)){
                $this->_papel = new Auth_Model_Papel_Mapper();
            }
            return $this->_papel;
        }
                
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           $profile = array();
           $profile['order'] = array('id','idtipousuario','descricao_tipousuario','login','senha','nome','validadesenha','trocasenha','dhtrocasenha','expiracaosenha','status','nerroslogin','usuarioadmin','cgccpf','endereco','telefone','email','usuario','datahora','fax','idpessoal','chapa_pessoal','nome_pessoal','chapa','codccustodef','codeof','idempresa','sigla_empresa','nome_pessoa','idempresadef','sigla_empresadef','nome_pessoadef','idfilial','sigla_filial','idusuarioresp','login_usuarioresp','nome_usuarioresp','id_papel','nome_papel','solic_info_adic','observacao');
           $profile['width'] = array('id'=>27,'idtipousuario'=>120,'descricao_tipousuario'=>200,'login'=>200,'senha'=>15,'nome'=>200,'validadesenha'=>100,'trocasenha'=>150,'dhtrocasenha'=>150,'expiracaosenha'=>150,'status'=>150,'nerroslogin'=>150,'usuarioadmin'=>200,'cgccpf'=>25,'endereco'=>200,'telefone'=>25,'email'=>200,'usuario'=>25,'datahora'=>150,'fax'=>25,'idpessoal'=>120,'chapa_pessoal'=>200,'nome_pessoal'=>200,'chapa'=>15,'codccustodef'=>15,'codeof'=>35,'idempresa'=>120,'sigla_empresa'=>200,'nome_pessoa'=>200,'idempresadef'=>120,'sigla_empresadef'=>200,'nome_pessoadef'=>200,'idfilial'=>120,'sigla_filial'=>200,'idusuarioresp'=>120,'login_usuarioresp'=>200,'nome_usuarioresp'=>200,'id_papel'=>120,'nome_papel'=>200,'solic_info_adic'=>150,'observacao'=>200);
           $profile['align'] = array('id'=>'left','idtipousuario'=>'left','descricao_tipousuario'=>'left','login'=>'left','senha'=>'left','nome'=>'left','validadesenha'=>'center','trocasenha'=>'center','dhtrocasenha'=>'center','expiracaosenha'=>'right','status'=>'center','nerroslogin'=>'right','usuarioadmin'=>'left','cgccpf'=>'left','endereco'=>'left','telefone'=>'left','email'=>'left','usuario'=>'left','datahora'=>'center','fax'=>'left','idpessoal'=>'left','chapa_pessoal'=>'left','nome_pessoal'=>'left','chapa'=>'left','codccustodef'=>'left','codeof'=>'left','idempresa'=>'left','sigla_empresa'=>'left','nome_pessoa'=>'left','idempresadef'=>'left','sigla_empresadef'=>'left','nome_pessoadef'=>'left','idfilial'=>'left','sigla_filial'=>'left','idusuarioresp'=>'left','login_usuarioresp'=>'left','nome_usuarioresp'=>'left','id_papel'=>'left','nome_papel'=>'left','solic_info_adic'=>'center','observacao'=>'left');
           $profile['hidden'] = array('idtipousuario','idpessoal','idempresa','idempresadef','idfilial','idusuarioresp','id_papel');
           $profile['remove'] = array();
           $profile['listOptions'] = array('trocasenha'=>$this->getModel()->getListOptions('trocasenha'),'status'=>$this->getModel()->getListOptions('status'),'solic_info_adic'=>$this->getModel()->getListOptions('solic_info_adic'));
           return $profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            $this->_columns = new ZendT_Db_Column_View('Auth_DataView_Usuario_MapperView',$this->_getSettingsDefault());
            
            $this->_columns->add('id', 'usuario', 'id', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.id'),'String','%?%');
            $this->_columns->add('id_tipousuario', 'usuario', 'idtipousuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idtipousuario'), null, '=');
            $this->_columns->add('descricao_tipousuario', 'tipousuario', 'descricao', $this->_getTipoUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idtipousuario.tipo_usuario.descricao'),null,'?%');
            $this->_columns->add('login', 'usuario', 'login', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.login'),'String','%?%');
            $this->_columns->add('senha', 'usuario', 'senha', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.senha'),'String','%?%');
            $this->_columns->add('nome', 'usuario', 'nome', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.nome'),'String','%?%');
            $this->_columns->add('validadesenha', 'usuario', 'validadesenha', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.validadesenha'),'Date','=');
            $this->_columns->add('trocasenha', 'usuario', 'trocasenha', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.trocasenha'),'String','=');
            $this->_columns->add('dhtrocasenha', 'usuario', 'dhtrocasenha', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.dhtrocasenha'),'DateTime','=');
            $this->_columns->add('expiracaosenha', 'usuario', 'expiracaosenha', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.expiracaosenha'),'Numeric','=');
            $this->_columns->add('status', 'usuario', 'status', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.status'),'String','=');
            $this->_columns->add('nerroslogin', 'usuario', 'nerroslogin', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.nerroslogin'),'Numeric','=');
            $this->_columns->add('usuarioadmin', 'usuario', 'usuarioadmin', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.usuarioadmin'),'String','%?%');
            $this->_columns->add('cgccpf', 'usuario', 'cgccpf', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.cgccpf'),'String','%?%');
            $this->_columns->add('endereco', 'usuario', 'endereco', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.endereco'),'String','%?%');
            $this->_columns->add('telefone', 'usuario', 'telefone', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.telefone'),'String','%?%');
            $this->_columns->add('email', 'usuario', 'email', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.email'),'String','%?%');
            $this->_columns->add('usuario', 'usuario', 'usuario', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.usuario'),'String','%?%');
            $this->_columns->add('datahora', 'usuario', 'datahora', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.datahora'),'DateTime','=');
            $this->_columns->add('fax', 'usuario', 'fax', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.fax'),'String','%?%');
            $this->_columns->add('id_pessoal', 'usuario', 'idpessoal', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idpessoal'), null, '=');
            $this->_columns->add('chapa_pessoal', 'pessoal', 'chapa', $this->_getPessoal()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idpessoal.pessoal.chapa'),null,'?%');
            $this->_columns->add('nome_pessoal', 'pessoal', 'nome', $this->_getPessoal()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idpessoal.pessoal.nome'),null,'?%');
            $this->_columns->add('chapa', 'usuario', 'chapa', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.chapa'),'String','%?%');
            $this->_columns->add('codccustodef', 'usuario', 'codccustodef', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.codccustodef'),'String','%?%');
            $this->_columns->add('codeof', 'usuario', 'codeof', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.codeof'),'String','%?%');
            $this->_columns->add('id_empresa', 'usuario', 'idempresa', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idempresa'), null, '=');
            $this->_columns->add('sigla_empresa', 'empresa', 'sigla', $this->_getEmpresa()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.empresa.empresa.sigla'),null,'?%');
            $this->_columns->add('nome_pessoa', 'pessoa', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.empresa.empresa.nome_pessoa'),null,'?%');
            $this->_columns->add('id_empresadef', 'usuario', 'idempresadef', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idempresadef'), null, '=');
            $this->_columns->add('sigla_empresadef', 'empresadef', 'sigla', $this->_getEmpresa()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idempresadef.empresa.sigla'),null,'?%');
            $this->_columns->add('nome_pessoadef', 'pessoadef', 'nome', $this->_getPessoa()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idempresadef.empresa.nome_pessoa'),null,'?%');
            $this->_columns->add('id_filial', 'usuario', 'idfilial', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idfilial'), null, '=');
            $this->_columns->add('sigla_filial', 'filial', 'sigla', $this->_getFilial()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idfilial.filial.sigla'),null,'?%');
            $this->_columns->add('id_usuarioresp', 'usuario', 'idusuarioresp', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idusuarioresp'), null, '=');
            $this->_columns->add('login_usuarioresp', 'usuarioresp', 'login', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idusuarioresp.usuario.login'),null,'?%');
            $this->_columns->add('nome_usuarioresp', 'usuarioresp', 'nome', $this->_getUsuario()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.idusuarioresp.usuario.nome'),null,'?%');
            $this->_columns->add('id_papel', 'usuario', 'id_papel', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.id_papel'), null, '=');
            $this->_columns->add('nome_papel', 'papel', 'nome', $this->_getPapel()->getModel()->getMapperName(), ZendT_Lib::translate('usuario.id_papel.papel.nome'),null,'?%');
            $this->_columns->add('solic_info_adic', 'usuario', 'solic_info_adic', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.solic_info_adic'),'String','=');
            $this->_columns->add('observacao', 'usuario', 'observacao', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.observacao'),'String','%?%');
            $this->_columns->add('avatar', 'usuario', 'avatar', $this->getModel()->getMapperName(), ZendT_Lib::translate('usuario.avatar'),'Numeric','=');
        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            $sql = $this->getModel()->getTableName().' '.$this->getModel()->getName() ." 
                    JOIN ".$this->_getTipoUsuario()->getModel()->getTableName()." tipousuario ON ( usuario.idtipousuario = tipousuario.id ) 
                    LEFT  JOIN ".$this->_getPessoal()->getModel()->getTableName()." pessoal ON ( usuario.idpessoal = pessoal.id ) 
                    LEFT  JOIN ".$this->_getEmpresa()->getModel()->getTableName()." empresa ON ( usuario.idempresa = empresa.id ) 
                        LEFT  JOIN ".$this->_getEmpresa()->getModel()->getTableName()." idempresa ON ( usuario.idempresa = idempresa.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." pessoa ON ( empresa.id_pessoa = pessoa.id ) 
                    LEFT  JOIN ".$this->_getEmpresa()->getModel()->getTableName()." empresadef ON ( usuario.idempresadef = empresadef.id ) 
                    LEFT  JOIN ".$this->_getPessoa()->getModel()->getTableName()." pessoadef ON ( empresadef.id_pessoa = pessoadef.id ) 
                    LEFT  JOIN ".$this->_getFilial()->getModel()->getTableName()." filial ON ( usuario.idfilial = filial.id ) 
                        LEFT  JOIN ".$this->_getFilial()->getModel()->getTableName()." idfilial ON ( usuario.idfilial = idfilial.id ) 
                    LEFT  JOIN ".$this->_getUsuario()->getModel()->getTableName()." usuarioresp ON ( usuario.idusuarioresp = usuarioresp.id ) 
                    LEFT  JOIN ".$this->_getPapel()->getModel()->getTableName()." papel ON ( usuario.id_papel = papel.id )  "; 
            return $sql;
        }
    }
?>