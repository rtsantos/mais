<?php
    class Auth_Form_UsuarioSearch extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_auth');
            $model = new Auth_Model_Usuario();
            $element = new ZendT_Form_Element_SelectSqlGroupOperation();
            $element->setLabel('Filtrar com:');
            $this->addElement($element);
            
        /**
         * Campo para identificar que a busca é do tipo Search de GRID
         */
         $element = new ZendT_Form_Element_Hidden('isSearch');
         $element->setValue('true');
         $this->addElement($element);
            /**
             * Pesquisa na coluna id
             */
            
                $element = new ZendT_Form_Element_Hidden('idfield');
                $element->setBelongsTo('filter[id][field]');
                $element->setValue('usuario.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idop');
                $element->setBelongsTo('filter[id][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idop',$nameElement
                    ),'id.idop'
                );

                $fields = $this->getDisplayGroup('id.idop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.id') . ':')->setAttrib('id', 'id-fieldset');
            /**
             * Pesquisa na coluna idtipousuario
             */
            
                $element = new ZendT_Form_Element_Hidden('idtipousuariofield');
                $element->setBelongsTo('filter[idtipousuario][field]');
                $element->setValue('usuario.idtipousuario');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idtipousuariomapper');
                $element->setBelongsTo('filter[idtipousuario][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idtipousuarioop');
                $element->setBelongsTo('filter[idtipousuario][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('idtipousuario');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[idtipousuario][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idtipousuarioop',$nameElement
                    ),'idtipousuario.idtipousuarioop'
                );

                $fields = $this->getDisplayGroup('idtipousuario.idtipousuarioop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.idtipousuario') . ':')->setAttrib('id', 'idtipousuario-fieldset');
            /**
             * Pesquisa na coluna login
             */
            
                $element = new ZendT_Form_Element_Hidden('loginfield');
                $element->setBelongsTo('filter[login][field]');
                $element->setValue('usuario.login');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('loginmapper');
                $element->setBelongsTo('filter[login][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('loginop');
                $element->setBelongsTo('filter[login][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('login');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[login][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'loginop',$nameElement
                    ),'login.loginop'
                );

                $fields = $this->getDisplayGroup('login.loginop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.login') . ':')->setAttrib('id', 'login-fieldset');
            /**
             * Pesquisa na coluna senha
             */
            
                $element = new ZendT_Form_Element_Hidden('senhafield');
                $element->setBelongsTo('filter[senha][field]');
                $element->setValue('usuario.senha');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('senhamapper');
                $element->setBelongsTo('filter[senha][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('senhaop');
                $element->setBelongsTo('filter[senha][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('senha');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[senha][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'senhaop',$nameElement
                    ),'senha.senhaop'
                );

                $fields = $this->getDisplayGroup('senha.senhaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.senha') . ':')->setAttrib('id', 'senha-fieldset');
            /**
             * Pesquisa na coluna nome
             */
            
                $element = new ZendT_Form_Element_Hidden('nomefield');
                $element->setBelongsTo('filter[nome][field]');
                $element->setValue('usuario.nome');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('nomemapper');
                $element->setBelongsTo('filter[nome][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('nomeop');
                $element->setBelongsTo('filter[nome][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('nome');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[nome][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'nomeop',$nameElement
                    ),'nome.nomeop'
                );

                $fields = $this->getDisplayGroup('nome.nomeop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.nome') . ':')->setAttrib('id', 'nome-fieldset');
            /**
             * Pesquisa na coluna validadesenha
             */
            
                $element = new ZendT_Form_Element_Hidden('validadesenhafield');
                $element->setBelongsTo('filter[validadesenha][field]');
                $element->setValue('usuario.validadesenha');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('validadesenhamapper');
                $element->setBelongsTo('filter[validadesenha][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('validadesenhaop');
                $element->setBelongsTo('filter[validadesenha][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('validadesenha');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[validadesenha][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'validadesenhaop',$nameElement
                    ),'validadesenha.validadesenhaop'
                );

                $fields = $this->getDisplayGroup('validadesenha.validadesenhaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.validadesenha') . ':')->setAttrib('id', 'validadesenha-fieldset');
            /**
             * Pesquisa na coluna trocasenha
             */
            
                $element = new ZendT_Form_Element_Hidden('trocasenhafield');
                $element->setBelongsTo('filter[trocasenha][field]');
                $element->setValue('usuario.trocasenha');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('trocasenhamapper');
                $element->setBelongsTo('filter[trocasenha][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('trocasenhaop');
                $element->setBelongsTo('filter[trocasenha][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('trocasenha');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[trocasenha][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'trocasenhaop',$nameElement
                    ),'trocasenha.trocasenhaop'
                );

                $fields = $this->getDisplayGroup('trocasenha.trocasenhaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.trocasenha') . ':')->setAttrib('id', 'trocasenha-fieldset');
            /**
             * Pesquisa na coluna expiracaosenha
             */
            
                $element = new ZendT_Form_Element_Hidden('expiracaosenhafield');
                $element->setBelongsTo('filter[expiracaosenha][field]');
                $element->setValue('usuario.expiracaosenha');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('expiracaosenhamapper');
                $element->setBelongsTo('filter[expiracaosenha][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('expiracaosenhaop');
                $element->setBelongsTo('filter[expiracaosenha][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('expiracaosenha');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[expiracaosenha][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'expiracaosenhaop',$nameElement
                    ),'expiracaosenha.expiracaosenhaop'
                );

                $fields = $this->getDisplayGroup('expiracaosenha.expiracaosenhaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.expiracaosenha') . ':')->setAttrib('id', 'expiracaosenha-fieldset');
            /**
             * Pesquisa na coluna dhtrocasenha
             */
            
                $element = new ZendT_Form_Element_Hidden('dhtrocasenhafield');
                $element->setBelongsTo('filter[dhtrocasenha][field]');
                $element->setValue('usuario.dhtrocasenha');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('dhtrocasenhamapper');
                $element->setBelongsTo('filter[dhtrocasenha][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('dhtrocasenhaop');
                $element->setBelongsTo('filter[dhtrocasenha][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('dhtrocasenha');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[dhtrocasenha][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'dhtrocasenhaop',$nameElement
                    ),'dhtrocasenha.dhtrocasenhaop'
                );

                $fields = $this->getDisplayGroup('dhtrocasenha.dhtrocasenhaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.dhtrocasenha') . ':')->setAttrib('id', 'dhtrocasenha-fieldset');
            /**
             * Pesquisa na coluna status
             */
            
                $element = new ZendT_Form_Element_Hidden('statusfield');
                $element->setBelongsTo('filter[status][field]');
                $element->setValue('usuario.status');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('statusmapper');
                $element->setBelongsTo('filter[status][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('statusop');
                $element->setBelongsTo('filter[status][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('status');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[status][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'statusop',$nameElement
                    ),'status.statusop'
                );

                $fields = $this->getDisplayGroup('status.statusop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.status') . ':')->setAttrib('id', 'status-fieldset');
            /**
             * Pesquisa na coluna nerroslogin
             */
            
                $element = new ZendT_Form_Element_Hidden('nerrosloginfield');
                $element->setBelongsTo('filter[nerroslogin][field]');
                $element->setValue('usuario.nerroslogin');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('nerrosloginmapper');
                $element->setBelongsTo('filter[nerroslogin][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('nerrosloginop');
                $element->setBelongsTo('filter[nerroslogin][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('nerroslogin');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[nerroslogin][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'nerrosloginop',$nameElement
                    ),'nerroslogin.nerrosloginop'
                );

                $fields = $this->getDisplayGroup('nerroslogin.nerrosloginop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.nerroslogin') . ':')->setAttrib('id', 'nerroslogin-fieldset');
            /**
             * Pesquisa na coluna usuarioadmin
             */
            
                $element = new ZendT_Form_Element_Hidden('usuarioadminfield');
                $element->setBelongsTo('filter[usuarioadmin][field]');
                $element->setValue('usuario.usuarioadmin');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('usuarioadminmapper');
                $element->setBelongsTo('filter[usuarioadmin][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('usuarioadminop');
                $element->setBelongsTo('filter[usuarioadmin][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('usuarioadmin');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[usuarioadmin][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'usuarioadminop',$nameElement
                    ),'usuarioadmin.usuarioadminop'
                );

                $fields = $this->getDisplayGroup('usuarioadmin.usuarioadminop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.usuarioadmin') . ':')->setAttrib('id', 'usuarioadmin-fieldset');
            /**
             * Pesquisa na coluna observacao
             */
            
                $element = new ZendT_Form_Element_Hidden('observacaofield');
                $element->setBelongsTo('filter[observacao][field]');
                $element->setValue('usuario.observacao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('observacaomapper');
                $element->setBelongsTo('filter[observacao][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('observacaoop');
                $element->setBelongsTo('filter[observacao][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('observacao');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[observacao][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'observacaoop',$nameElement
                    ),'observacao.observacaoop'
                );

                $fields = $this->getDisplayGroup('observacao.observacaoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.observacao') . ':')->setAttrib('id', 'observacao-fieldset');
            /**
             * Pesquisa na coluna idempresadef
             */
            
                $element = new ZendT_Form_Element_Hidden('idempresadeffield');
                $element->setBelongsTo('filter[idempresadef][field]');
                $element->setValue('usuario.idempresadef');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idempresadefmapper');
                $element->setBelongsTo('filter[idempresadef][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idempresadefop');
                $element->setBelongsTo('filter[idempresadef][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('idempresadef');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[idempresadef][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idempresadefop',$nameElement
                    ),'idempresadef.idempresadefop'
                );

                $fields = $this->getDisplayGroup('idempresadef.idempresadefop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.idempresadef') . ':')->setAttrib('id', 'idempresadef-fieldset');
            /**
             * Pesquisa na coluna codccustodef
             */
            
                $element = new ZendT_Form_Element_Hidden('codccustodeffield');
                $element->setBelongsTo('filter[codccustodef][field]');
                $element->setValue('usuario.codccustodef');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('codccustodefmapper');
                $element->setBelongsTo('filter[codccustodef][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('codccustodefop');
                $element->setBelongsTo('filter[codccustodef][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('codccustodef');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[codccustodef][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'codccustodefop',$nameElement
                    ),'codccustodef.codccustodefop'
                );

                $fields = $this->getDisplayGroup('codccustodef.codccustodefop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.codccustodef') . ':')->setAttrib('id', 'codccustodef-fieldset');
            /**
             * Pesquisa na coluna cgccpf
             */
            
                $element = new ZendT_Form_Element_Hidden('cgccpffield');
                $element->setBelongsTo('filter[cgccpf][field]');
                $element->setValue('usuario.cgccpf');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('cgccpfmapper');
                $element->setBelongsTo('filter[cgccpf][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('cgccpfop');
                $element->setBelongsTo('filter[cgccpf][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('cgccpf');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[cgccpf][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'cgccpfop',$nameElement
                    ),'cgccpf.cgccpfop'
                );

                $fields = $this->getDisplayGroup('cgccpf.cgccpfop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.cgccpf') . ':')->setAttrib('id', 'cgccpf-fieldset');
            /**
             * Pesquisa na coluna empresa
             */
            
                $element = new ZendT_Form_Element_Hidden('empresafield');
                $element->setBelongsTo('filter[empresa][field]');
                $element->setValue('usuario.empresa');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('empresamapper');
                $element->setBelongsTo('filter[empresa][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('empresaop');
                $element->setBelongsTo('filter[empresa][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('empresa');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[empresa][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'empresaop',$nameElement
                    ),'empresa.empresaop'
                );

                $fields = $this->getDisplayGroup('empresa.empresaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.empresa') . ':')->setAttrib('id', 'empresa-fieldset');
            /**
             * Pesquisa na coluna endereco
             */
            
                $element = new ZendT_Form_Element_Hidden('enderecofield');
                $element->setBelongsTo('filter[endereco][field]');
                $element->setValue('usuario.endereco');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('enderecomapper');
                $element->setBelongsTo('filter[endereco][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('enderecoop');
                $element->setBelongsTo('filter[endereco][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('endereco');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[endereco][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'enderecoop',$nameElement
                    ),'endereco.enderecoop'
                );

                $fields = $this->getDisplayGroup('endereco.enderecoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.endereco') . ':')->setAttrib('id', 'endereco-fieldset');
            /**
             * Pesquisa na coluna telefone
             */
            
                $element = new ZendT_Form_Element_Hidden('telefonefield');
                $element->setBelongsTo('filter[telefone][field]');
                $element->setValue('usuario.telefone');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('telefonemapper');
                $element->setBelongsTo('filter[telefone][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('telefoneop');
                $element->setBelongsTo('filter[telefone][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('telefone');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[telefone][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'telefoneop',$nameElement
                    ),'telefone.telefoneop'
                );

                $fields = $this->getDisplayGroup('telefone.telefoneop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.telefone') . ':')->setAttrib('id', 'telefone-fieldset');
            /**
             * Pesquisa na coluna email
             */
            
                $element = new ZendT_Form_Element_Hidden('emailfield');
                $element->setBelongsTo('filter[email][field]');
                $element->setValue('usuario.email');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('emailmapper');
                $element->setBelongsTo('filter[email][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('emailop');
                $element->setBelongsTo('filter[email][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('email');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[email][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'emailop',$nameElement
                    ),'email.emailop'
                );

                $fields = $this->getDisplayGroup('email.emailop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.email') . ':')->setAttrib('id', 'email-fieldset');
            /**
             * Pesquisa na coluna usuario
             */
            
                $element = new ZendT_Form_Element_Hidden('usuariofield');
                $element->setBelongsTo('filter[usuario][field]');
                $element->setValue('usuario.usuario');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('usuariomapper');
                $element->setBelongsTo('filter[usuario][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('usuarioop');
                $element->setBelongsTo('filter[usuario][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('usuario');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[usuario][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'usuarioop',$nameElement
                    ),'usuario.usuarioop'
                );

                $fields = $this->getDisplayGroup('usuario.usuarioop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.usuario') . ':')->setAttrib('id', 'usuario-fieldset');
            /**
             * Pesquisa na coluna datahora
             */
            
                $element = new ZendT_Form_Element_Hidden('datahorafield');
                $element->setBelongsTo('filter[datahora][field]');
                $element->setValue('usuario.datahora');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('datahoramapper');
                $element->setBelongsTo('filter[datahora][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('datahoraop');
                $element->setBelongsTo('filter[datahora][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('datahora');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[datahora][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'datahoraop',$nameElement
                    ),'datahora.datahoraop'
                );

                $fields = $this->getDisplayGroup('datahora.datahoraop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.datahora') . ':')->setAttrib('id', 'datahora-fieldset');
            /**
             * Pesquisa na coluna fax
             */
            
                $element = new ZendT_Form_Element_Hidden('faxfield');
                $element->setBelongsTo('filter[fax][field]');
                $element->setValue('usuario.fax');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('faxmapper');
                $element->setBelongsTo('filter[fax][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('faxop');
                $element->setBelongsTo('filter[fax][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('fax');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[fax][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'faxop',$nameElement
                    ),'fax.faxop'
                );

                $fields = $this->getDisplayGroup('fax.faxop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.fax') . ':')->setAttrib('id', 'fax-fieldset');
            /**
             * Pesquisa na coluna idpessoal
             */
            
                $element = new ZendT_Form_Element_Hidden('idpessoalfield');
                $element->setBelongsTo('filter[idpessoal][field]');
                $element->setValue('usuario.idpessoal');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idpessoalmapper');
                $element->setBelongsTo('filter[idpessoal][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idpessoalop');
                $element->setBelongsTo('filter[idpessoal][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('idpessoal');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[idpessoal][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idpessoalop',$nameElement
                    ),'idpessoal.idpessoalop'
                );

                $fields = $this->getDisplayGroup('idpessoal.idpessoalop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.idpessoal') . ':')->setAttrib('id', 'idpessoal-fieldset');
            /**
             * Pesquisa na coluna idempresa
             */
            
                $element = new ZendT_Form_Element_Hidden('idempresafield');
                $element->setBelongsTo('filter[idempresa][field]');
                $element->setValue('usuario.idempresa');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idempresamapper');
                $element->setBelongsTo('filter[idempresa][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idempresaop');
                $element->setBelongsTo('filter[idempresa][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('idempresa');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[idempresa][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idempresaop',$nameElement
                    ),'idempresa.idempresaop'
                );

                $fields = $this->getDisplayGroup('idempresa.idempresaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.idempresa') . ':')->setAttrib('id', 'idempresa-fieldset');
            /**
             * Pesquisa na coluna chapa
             */
            
                $element = new ZendT_Form_Element_Hidden('chapafield');
                $element->setBelongsTo('filter[chapa][field]');
                $element->setValue('usuario.chapa');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('chapamapper');
                $element->setBelongsTo('filter[chapa][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('chapaop');
                $element->setBelongsTo('filter[chapa][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('chapa');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[chapa][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'chapaop',$nameElement
                    ),'chapa.chapaop'
                );

                $fields = $this->getDisplayGroup('chapa.chapaop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.chapa') . ':')->setAttrib('id', 'chapa-fieldset');
            /**
             * Pesquisa na coluna codeof
             */
            
                $element = new ZendT_Form_Element_Hidden('codeoffield');
                $element->setBelongsTo('filter[codeof][field]');
                $element->setValue('usuario.codeof');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('codeofmapper');
                $element->setBelongsTo('filter[codeof][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('codeofop');
                $element->setBelongsTo('filter[codeof][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('codeof');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[codeof][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'codeofop',$nameElement
                    ),'codeof.codeofop'
                );

                $fields = $this->getDisplayGroup('codeof.codeofop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.codeof') . ':')->setAttrib('id', 'codeof-fieldset');
            /**
             * Pesquisa na coluna idfilial
             */
            
                $element = new ZendT_Form_Element_Hidden('idfilialfield');
                $element->setBelongsTo('filter[idfilial][field]');
                $element->setValue('usuario.idfilial');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idfilialmapper');
                $element->setBelongsTo('filter[idfilial][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idfilialop');
                $element->setBelongsTo('filter[idfilial][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('idfilial');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[idfilial][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idfilialop',$nameElement
                    ),'idfilial.idfilialop'
                );

                $fields = $this->getDisplayGroup('idfilial.idfilialop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.idfilial') . ':')->setAttrib('id', 'idfilial-fieldset');
            /**
             * Pesquisa na coluna id_papel
             */
            
                $element = new ZendT_Form_Element_Hidden('id_papelfield');
                $element->setBelongsTo('filter[id_papel][field]');
                $element->setValue('usuario.id_papel');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_papelmapper');
                $element->setBelongsTo('filter[id_papel][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_papelop');
                $element->setBelongsTo('filter[id_papel][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_papel');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_papel][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_papelop',$nameElement
                    ),'id_papel.id_papelop'
                );

                $fields = $this->getDisplayGroup('id_papel.id_papelop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.id_papel') . ':')->setAttrib('id', 'id_papel-fieldset');
            /**
             * Pesquisa na coluna solic_info_adic
             */
            
                $element = new ZendT_Form_Element_Hidden('solic_info_adicfield');
                $element->setBelongsTo('filter[solic_info_adic][field]');
                $element->setValue('usuario.solic_info_adic');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('solic_info_adicmapper');
                $element->setBelongsTo('filter[solic_info_adic][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('solic_info_adicop');
                $element->setBelongsTo('filter[solic_info_adic][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('solic_info_adic');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[solic_info_adic][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'solic_info_adicop',$nameElement
                    ),'solic_info_adic.solic_info_adicop'
                );

                $fields = $this->getDisplayGroup('solic_info_adic.solic_info_adicop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.solic_info_adic') . ':')->setAttrib('id', 'solic_info_adic-fieldset');
            /**
             * Pesquisa na coluna old_login
             */
            
                $element = new ZendT_Form_Element_Hidden('old_loginfield');
                $element->setBelongsTo('filter[old_login][field]');
                $element->setValue('usuario.old_login');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('old_loginmapper');
                $element->setBelongsTo('filter[old_login][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('old_loginop');
                $element->setBelongsTo('filter[old_login][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('old_login');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[old_login][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'old_loginop',$nameElement
                    ),'old_login.old_loginop'
                );

                $fields = $this->getDisplayGroup('old_login.old_loginop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.old_login') . ':')->setAttrib('id', 'old_login-fieldset');
            /**
             * Pesquisa na coluna id_usuario_resp
             */
            
                $element = new ZendT_Form_Element_Hidden('id_usuario_respfield');
                $element->setBelongsTo('filter[id_usuario_resp][field]');
                $element->setValue('usuario.id_usuario_resp');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_usuario_respmapper');
                $element->setBelongsTo('filter[id_usuario_resp][mapper]');
                $element->setValue('Auth_Model_UsuarioMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_usuario_respop');
                $element->setBelongsTo('filter[id_usuario_resp][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_usuario_resp');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_usuario_resp][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_usuario_respop',$nameElement
                    ),'id_usuario_resp.id_usuario_respop'
                );

                $fields = $this->getDisplayGroup('id_usuario_resp.id_usuario_respop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('usuario.id_usuario_resp') . ':')->setAttrib('id', 'id_usuario_resp-fieldset');
        }
    }
?>