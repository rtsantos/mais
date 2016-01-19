<?php

   /**
    * Classe de visão da tabela profile_object_view_priv
    */
   class Profile_DataView_ObjectViewPriv_Usuarios extends Profile_DataView_ObjectViewPriv_Crud_MapperView {

       protected function _getSettingsDefault() {
           $profile = array();
           $profile['order'] = array('id_visao');
           $profile['width'] = array('id_visao' => 100);
           $profile['align'] = array('id_visao' => 'left');
           $profile['hidden'] = array();
           $profile['remove'] = array();
           $profile['listOptions'] = array();
           return $profile;
       }

       protected function _loadColumns() {
           $_view = new Profile_Model_ObjectView_Mapper();
           $_papel = new Auth_Model_Papel_Mapper();
           $_privilegio = new Profile_Model_ObjectViewPriv_Mapper();
           $_usuario = new Auth_Model_Usuario_Mapper();
           $_empresa = new Ca_Model_Empresa_Mapper();
           $_filial = new Ca_Model_Filial_Mapper();

           $this->_columns = new ZendT_Db_Column_View('Profile_DataView_ObjectViewPriv_Usuarios', $this->_getSettingsDefault());

           $this->_columns->add('id_visao', 'base', 'id_visao'
                 , $_view->getId(true)
                 , 'Id. da Visão'
                 , '', '=');

           $this->_columns->add('nome_visao', 'base', 'nome_visao'
                 , $_view->getNome(true)
                 , 'Nome da Visão'
                 , '', '?%');

           $this->_columns->add('objeto_visao', 'base', 'objeto_visao'
                 , $_view->getObjeto(true)
                 , 'Objeto da Visão'
                 , '', '?%');

           $this->_columns->add('grupo_liberado', 'base', 'grupo_liberado'
                 , $_papel->getNome(true)
                 , 'Grupo Liberado'
                 , '', '?%');

           $this->_columns->add('tipo_privilegio', 'base', 'tipo_privilegio'
                 , $_privilegio->getTipo(true)
                 , 'Tipo da Liberação'
                 , '', '=');

           $this->_columns->add('nome_usuario', 'base', 'nome_usuario'
                 , $_usuario->getNome(true)
                 , 'Nome do Usuário'
                 , '', '?%');

           $this->_columns->add('email_usuario', 'base', 'email_usuario'
                 , $_usuario->getEmail(true)
                 , 'E-Mail do Usuário'
                 , '', '?%');

           $this->_columns->add('empresa_usuario', 'base', 'empresa_usuario'
                 , $_empresa->getSigla(true)
                 , 'Empresa do Usuário'
                 , '', '?%');

           $this->_columns->add('filial_usuario', 'base', 'filial_usuario'
                 , $_filial->getSigla(true)
                 , 'Filial do Usuário'
                 , '', '?%');

           $this->_columns->add('grupo_usuario', 'base', 'grupo_usuario'
                 , $_papel->getNome(true)
                 , 'Grupo do Usuário'
                 , '', '?%');

           $this->_columns->add('nome_cliente_usuario', 'base', 'nome_cliente_usuario'
                 , $_usuario->getNome(true)
                 , 'Nome do Cliente do Usuário'
                 , '', '?%');

           $this->_columns->add('cnpj_cliente_usuario', 'base', 'cnpj_cliente_usuario'
                 , $_usuario->getNome(true)
                 , 'CNPJ do Cliente do Usuário'
                 , '', '?%');
       }

       protected function _getSqlBase() {
           $sql = "( SELECT DISTINCT 
                            pov.id
                           ,pov.id as id_visao
                           ,pov.nome as nome_visao
                           ,pov.objeto as objeto_visao
                           ,ppp.nome as grupo_liberado
                           ,pri.tipo as tipo_privilegio
                           ,us.nome as nome_usuario
                           ,us.email as email_usuario
                           ,emp.sigla AS empresa_usuario
                           ,fil.sigla AS filial_usuario
                           ,pp.nome   AS grupo_usuario
                           ,us.empresa as nome_cliente_usuario
                           ,us.cgccpf as cnpj_cliente_usuario
                       FROM profile_object_view pov
                       JOIN profile_object_view_priv pri ON (pri.id_profile_object_view = pov.id)
                       JOIN papel ppp ON (pri.id_papel = ppp.id)
                       JOIN papel pp ON (pp.nome LIKE ppp.nome || '%')
                       JOIN usuario us ON (us.id_papel = pp.id AND us.status = 'A' AND us.email IS NOT NULL)
                       JOIN perfilusuario pu ON (pu.idusuario = us.id)
                       JOIN perfil p ON (pu.idperfil = p.id)
                       JOIN aplicacao app ON (p.idaplicacao = app.id AND UPPER(pov.objeto) LIKE app.sigla ||'%')
                       LEFT JOIN filial fil ON (us.idfilial = fil.id)
                       LEFT JOIN empresa emp ON (fil.id_empresa = emp.id) ) base";
           return $sql;
       }

   }

?>