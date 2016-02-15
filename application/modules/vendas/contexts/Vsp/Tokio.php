<?php

    class Vendas_Context_Vsp_Tokio {

        /**
         *
         * @var Zend_Http_Client
         */
        protected $_client;

        public function login() {
            $url = 'https://sso.tokiomarine.com.br/loginprestador';
            /**
             * Inicia a tela de login para gerar cookie da sessão
             */
            $config = array('useragent' => 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0',
                'encodecookies' => false,
                'timeout' => 10);
            $this->_client = new Zend_Http_Client('https://portal.tokiomarine.com.br/acesso/prestador', $config);
            $this->_client->setCookieJar();
            $response = $this->_client->request(Zend_Http_Client::GET);
            $cookies = $this->_client->getCookieJar()->getAllCookies();
            /**
             * Autentica o Usuário
             */
            $this->_client->setUri('https://portal.tokiomarine.com.br/acesso/efetuarLogin');
            foreach ($cookies as $cookie) {
                $this->_client->setCookie($cookie);
            }
            $param = array();
            $param['enviar'] = 'Enviar';
            $param['idSistema'] = '5';
            $param['login'] = '31295013800';
            $param['password'] = '094712';
            $param['userid'] = '120930';
            foreach ($param as $name => $value) {
                $this->_client->setParameterPost($name, $value);
            }
            $response = $this->_client->request(Zend_Http_Client::POST);
            $json = json_decode($response->getBody());
            /**
             * Redireciona para home para avaliar autenticação
             */
            $this->_client->resetParameters()
                    ->setUri('https://sso.tokiomarine.com.br/loginprestador');
            $this->_client->setCookieJar();
            $param = array();
            $param['enviar'] = 'Enviar';
            $param['idSistema'] = '5';
            $param['login'] = '31295013800';
            $param['password'] = '094712';
            $param['userid'] = $json->userid;
            foreach ($param as $name => $value) {
                $this->_client->setParameterPost($name, $value);
            }
            $this->_client->setCookie('ObSSOCookie', 'loggedout');
            $response = $this->_client->request(Zend_Http_Client::POST);
            $cookies = $this->_client->getCookieJar()->getAllCookies();

            $this->_client->resetParameters()
                    ->setUri('https://portal.tokiomarine.com.br/portalSalvadosPrestador/vistoriador/pesquisa/grid');
            $this->_client->setCookieJar();
            foreach ($cookies as $cookie) {
                $this->_client->setCookie($cookie);
            }
            $param['cd_aviso'] = '';
            $param['cd_caracteristica_bem_segur'] = '';
            $param['cd_letra_sinistro'] = 'D';
            $param['cd_local_contabil'] = '24';
            $param['cd_ramo'] = '31';
            $param['cd_reclamante_sinistro'] = '';
            $param['cd_salvado_auto_sinistro'] = '';
            $param['cd_sequencia_solicitacao'] = '';
            $param['cd_sinistro'] = '17312';
            $param['cd_status_alterado'] = '99-S';
            $param['cd_status_processo'] = '99-S';
            $param['cd_tipo_bem_segur'] = '';
            $param['cd_tipo_servico'] = '99';
            $param['cd_tipo_servico_retorno'] = '';
            $param['chassi'] = '9BGTT69B04B173235';
            $param['ds_status'] = '';
            $param['ds_tipo_perda'] = '';
            $param['ds_tipo_servico'] = '';
            $param['ds_veiculo'] = '';
            $param['dt_solicitacao'] = '';
            $param['periodo_final'] = '13/02/2016';
            $param['periodo_inicial'] = '15/12/2015';
            $param['placa'] = 'GXQ-8821';
            foreach ($param as $name => $value) {
                $this->_client->setParameterPost($name, $value);
            }
            $response = $this->_client->request(Zend_Http_Client::POST);
            $cookies = $this->_client->getCookieJar()->getAllCookies();
            var_dump($cookies);
            echo $response->getBody();



            $this->_client->resetParameters()
                    ->setUri('https://portal.tokiomarine.com.br/portalSalvadosPrestador/vistoriador/salvarEntregaVistoriador');
            $this->_client->setCookieJar();
            foreach ($cookies as $cookie) {
                $this->_client->setCookie($cookie);
            }
            $client->setFileUpload(APPLICATION_PATH . '/modules/vendas/contexts/Vsp/tmp/GXQ8821.pdf', 'bufile');
            $param = array();
            $param['cd_letra_sinistro']='D';
            $param['cd_local_contabil']='24';
            $param['cd_ramo']='31';
            $param['cd_sinistro=17312';
            $param['ds_veiculo=ASTRA SEDAN 2.0 MPFI 8V 4P AUT';
            $param['placa=GXQ-8821';
            $param['chassi=9BGTT69B04B173235';
            $param['ds_tipo_perda=RecuperÃ¡vel';
            $param['ds_status=AGUARDANDO';
            $param['dt_solicitacao=07/01/2016';
            $param['data_entrega=';
            $param['renavam=824136322';
            $param['uf_veiculo=MG';
            $param['id_tipo_aviso=1';
            $param['cd_aviso=1516332';
            $param['cd_tipo_bem_segur=1';
            $param['cd_caracteristica_bem_segur=1';
            $param['cd_natureza_sinistro=1';
            $param['cd_sequencia_solicitacao=79289';
            $param['documentos=';
            $param['cd_reclamante_sinistro=1';
            $param['cd_salvado_auto_sinistro=1';
            $param['paginaOrigem=VISTORIADOR';
            $param['cd_status_alterado=99-S';
            $param['periodo_inicial=15/12/2015';
            $param['periodo_final=13/02/2016';
            $param['cd_status_processo=99-S';
            $param['ds_endereco_retirada=EST MURANAKA';
            $param['nr_endereco_retirada=199';
            $param['ds_complemento_end_retirada=';
            $param['nm_bairro_retirada=JARDIM NOVO HORIZONTE';
            $param['nm_municipio_retirada=ITAQUAQUECETUBA';
            $param['id_unidade_federacao_retirada=SP';
            $param['nr_ddd_retirada=11';
            $param['nr_telefone_retirada=36518844';
            $param['id_cep_retirada=8597230';
            $param['origem=';
            $param['cd_tipo_servico=99';
            $param['ds_tipo_servico=VISTORIA ECV-EMPRESA CREDENCIADA DE VISTORIA';
            $param['dt_prazo=06/02/2016';
            $param['cd_tipo_servico_retorno=48';
            $param['dt_conclusao=13/02/2016';
            $param['dt_frustrada=';
            $param['ds_motivo=';
            foreach ($param as $name => $value) {
                $this->_client->setParameterPost($name, $value);
            }
            $response = $this->_client->request(Zend_Http_Client::POST);
            echo $response->getBody();
        }

    }
    