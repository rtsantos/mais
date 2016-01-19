<?php

   /**
    * Classe de visão da tabela log_web_relat
    */
   class Log_DataView_Relatorio_MapperView extends Log_Model_Relatorio_Mapper implements ZendT_Db_View {

       /**
        * Objeto de Mapeamento da Tabela
        *
        * @return Auth_Model_Usuario_Mapper
        */
       protected $_usuario;

       /**
        * Objeto de Mapeamento da Tabela
        *
        * @return Auth_Model_Usuario_Mapper
        */
       protected function _getUsuario() {
           if (!is_object($this->_usuario)) {
               $this->_usuario = new Auth_Model_Usuario_Mapper();
           }
           return $this->_usuario;
       }

       /**
        * Objeto de Mapeamento da Tabela
        *
        * @return Ca_Model_Filial_Mapper
        */
       protected function _getFilial() {
           if (!is_object($this->_filial)) {
               $this->_filial = new Ca_Model_Filial_Mapper();
           }
           return $this->_filial;
       }
       
       /**
        * Objeto de Mapeamento da Tabela
        *
        * @return Ca_Model_Empresa_Mapper
        */
       protected function _getEmpresa() {
           if (!is_object($this->_empresa)) {
               $this->_empresa = new Ca_Model_Empresa_Mapper();
           }
           return $this->_empresa;
       }
       /**
        * Retorna as configurações padrão da visualização
        *
        * @return array
        */
       protected function _getSettingsDefault() {
           $profile = array();
           
           $profile['order'] = array();
           $profile['order'][] = 'id';
           $profile['order'][] = 'login_usuario';
           $profile['order'][] = 'nome_usuario';
           $profile['order'][] = 'cliente_usuario';
           $profile['order'][] = 'sessao';
           $profile['order'][] = 'arquivo';
           $profile['order'][] = 'titulo';
           $profile['order'][] = 'dt_log';
           $profile['order'][] = 'dh_ini_exec';
           $profile['order'][] = 'dh_fim_exec';
           $profile['order'][] = 'dh_fim_relat';
           $profile['order'][] = 'qtd_reg';
           $profile['order'][] = 'impresso';
           $profile['order'][] = 'sigla_filial';
           $profile['order'][] = 'sigla_empresa';
           

           $profile['width'] = array();
           $profile['width']['id'] = 100;
           $profile['width']['login_usuario'] = 100;
           $profile['width']['nome_usuario'] = 100;
           $profile['width']['cliente_usuario'] = 100;
           $profile['width']['sessao'] = 100;
           $profile['width']['arquivo'] = 100;
           $profile['width']['titulo'] = 100;
           $profile['width']['dt_log'] = 100;
           $profile['width']['dh_ini_exec'] = 100;
           $profile['width']['dh_fim_exec'] = 100;
           $profile['width']['dh_fim_relat'] = 100;
           $profile['width']['qtd_reg'] = 100;
           $profile['width']['impresso'] = 100;
           $profile['width']['sigla_filial'] = 100;
           $profile['width']['sigla_empresa'] = 100;

           $profile['align'] = array();
           $profile['align']['id'] = 'center';
           $profile['align']['login_usuario'] = 'center';
           $profile['align']['nome_usuario'] = 'center';
           $profile['align']['cliente_usuario'] = 'center';
           $profile['align']['sessao'] = 'center';
           $profile['align']['arquivo'] = 'center';
           $profile['align']['titulo'] = 'center';
           $profile['align']['dt_log'] = 'center';
           $profile['align']['dh_ini_exec'] = 'center';
           $profile['align']['dh_fim_exec'] = 'center';
           $profile['align']['dh_fim_relat'] = 'center';
           $profile['align']['qtd_reg'] = 'center';
           $profile['align']['impresso'] = 'center';
           $profile['align']['sigla_filial'] = 'center';
           $profile['align']['sigla_empresa'] = 'center';

           $profile['required']['dt_log'] = 'Obrigatório informar o período de emissão do Log!';
           $profile['bind']['dt_log'] = array('dt_log_0', 'dt_log_1');
           return $profile;
       }

       /**
        * Carrega as colunas com suas configurações 
        */
       protected function _loadColumns() {
           $this->_columns = new ZendT_Db_Column_View('Log_Model_Relatorio_MapperView', $this->_getSettingsDefault());

           $this->_columns->add('id', 'log', 'id', $this->getId(true)
                 , ZendT_Lib::translate('ID Log'), 'String', '%?%');

           $this->_columns->add('login_usuario', 'log', 'login_usuario'
                 , $this->_getUsuario()->getLogin(true)
                 , ZendT_Lib::translate('Login do usuário'), null, '?%');

           $this->_columns->add('nome_usuario', 'log', 'nome_usuario'
                 , $this->_getUsuario()->getNome(true)
                 , ZendT_Lib::translate('Nome do usuário'), null, '?%');
           
           $this->_columns->add('cliente_usuario', 'log', 'cliente_usuario'
                 , $this->_getUsuario()->getNome(true)
                 , ZendT_Lib::translate('Nome do Cliente'), null, '?%');

           $this->_columns->add('sessao', 'log', 'sessao', $this->getSessao(true)
                 , ZendT_Lib::translate('Sessão'), 'String', '%?%');

           $this->_columns->add('arquivo', 'log', 'arquivo', $this->getArquivo(true)
                 , ZendT_Lib::translate('Programa'), 'String', '%?%');

           $this->_columns->add('titulo', 'log', 'titulo', $this->getTitulo(true)
                 , ZendT_Lib::translate('Título do Relatório'), 'String', '%?%');

           $this->_columns->add('dt_log', 'log', 'dt_log', new ZendT_Type_Date(null,'Date')
                 , ZendT_Lib::translate('Data Início da Execução'), 'String', '%?%');

           $this->_columns->add('dh_ini_exec', 'log', 'dh_ini_exec', $this->getDhIniExec(true)
                 , ZendT_Lib::translate('Data e Hora Início da Execução'), 'String', '%?%');

           $this->_columns->add('dh_fim_exec', 'log', 'dh_fim_exec', $this->getDhFimExec(true)
                 , ZendT_Lib::translate('Data e Hora Fim da Execução da Query'), 'String', '%?%');

           $this->_columns->add('dh_fim_relat', 'log', 'dh_fim_relat', $this->getDhFimRelat(true)
                 , ZendT_Lib::translate('Data e Hora Fim da Execução'), 'String', '%?%');

           $this->_columns->add('qtd_reg', 'log', 'qtd_reg', $this->getQtdReg(true)
                 , ZendT_Lib::translate('Quantidade de Registros'), 'String', '%?%');

           $this->_columns->add('impresso', 'log', 'impresso', $this->getImpresso(true)
                 , ZendT_Lib::translate('Impresso'), 'String', '%?%');
           
           $this->_columns->add('sigla_filial', 'log', 'sigla_filial', $this->_getFilial()->getSigla(true)
                 , ZendT_Lib::translate('Filial'), 'String', '%?%');
           
           $this->_columns->add('sigla_empresa', 'log', 'sigla_empresa', $this->_getEmpresa()->getSigla(true)
                 , ZendT_Lib::translate('Empresa'), 'String', '%?%');
       }

       /**
        * Retorna o SQL Base
        */
       protected function _getSqlBase() {
           $sql = "(SELECT {$this->getModel()->getName()}.id
                          ,{$this->getModel()->getName()}.sessao
                          ,{$this->getModel()->getName()}.arquivo
                          ,{$this->getModel()->getName()}.titulo
                          ,{$this->getModel()->getName()}.dh_ini_exec as dt_log
                          ,{$this->getModel()->getName()}.dh_ini_exec
                          ,{$this->getModel()->getName()}.dh_fim_exec
                          ,{$this->getModel()->getName()}.dh_fim_relat
                          ,{$this->getModel()->getName()}.qtd_reg
                          ,{$this->getModel()->getName()}.impresso
                          ,usuario.nome as nome_usuario
                          ,usuario.login as login_usuario
                          ,usuario.empresa as cliente_usuario
                          ,filial.sigla as sigla_filial
                          ,empresa.sigla as sigla_empresa
                     FROM {$this->getModel()->getTableName()} {$this->getModel()->getName()}
                     LEFT JOIN {$this->_getUsuario()->getModel()->getTableName()} usuario ON ( log_web_relat.id_usuario = usuario.id )
                     LEFT JOIN {$this->_getFilial()->getModel()->getTableName()} filial ON ( usuario.idfilial = filial.id )
                     LEFT JOIN {$this->_getEmpresa()->getModel()->getTableName()} empresa ON ( filial.id_empresa = empresa.id )
                    WHERE {$this->getModel()->getName()}.qtd_reg > 0 
                      AND {$this->getModel()->getName()}.dh_ini_exec 
                                      BETWEEN TO_DATE(TO_CHAR(:dt_log_0,'YYYY-DD-MM') || ' 00:00','YYYY-DD-MM HH24:MI')
                                          AND TO_DATE(TO_CHAR(:dt_log_1,'YYYY-DD-MM') || ' 23:59','YYYY-DD-MM HH24:MI')) log ";
           return $sql;
       }

   }

?>