<?php

    /**
     * Classe de mapeamento do registro da tabela cv_pedido
     */
    class Vendas_Model_Pedido_Mapper extends Vendas_Model_Pedido_Crud_Mapper {

        private $_pagamento = false;

        public function _beforeSave() {
            parent::_beforeSave();

            if ($this->_action == 'insert' && !$this->getNumero(true)->toPhp()) {
                $_numeracao = new Ca_Model_Numeracao_Mapper();
                $numero = $_numeracao->proximo(self::$table . '.numero'
                        , $this->getIdEmpresa()->toPhp());
                $this->setNumero($numero);
            }

            if ($this->getIdEmpresa(true)->toPhp() == '') {
                $this->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa());
            }

            if ($this->getIdCliente(true)->toPhp() == '') {
                $_pessoa = new Ca_DataView_Pessoa_MapperView();
                $_pessoa->setNome(_i18n('CONSUMIDOR'));
                $_pessoa->retrieve();
                $this->setIdCliente($_pessoa->getId());
            }

            if ($this->getIdClienteCon(true)->toPhp() == '') {
                $this->setIdClienteCon($this->getIdCliente());
            }

            if ($this->getIdUsuInc(true)->toPhp() == '') {
                $this->setIdUsuInc(Auth_Session_User::getInstance()->getId());
            }

            if ($this->getDtEmis(true)->toPhp() == '') {
                $this->setDtEmis(ZendT_Type_Date::nowDate());
            }

            if ($this->getDhInc(true)->toPhp() == '') {
                $this->setDhInc(ZendT_Type_Date::nowDateTime());
            }

            $this->setIdUsuAlt(Auth_Session_User::getInstance()->getId());

            if ($this->getIdFuncionario(true)->toPhp() == '') {
                $_pessoa = new Ca_DataView_Pessoa_MapperView();
                $_pessoa->setEmail(Auth_Session_User::getInstance()->getLogin());
                $_pessoa->retrieve();
                $this->setIdFuncionario($_pessoa->getId());
            }

            if ($this->_action == 'update') {
                $this->_pagamento = new Vendas_DataView_Pagamento_MapperView();
                $this->_saldoPagto = $this->_pagamento->getSaldoPagar($this->getId());
                if ($this->_saldoPagto > 0) {
                    if ($this->getStatus(true)->toPhp() == 'E') {
                        throw new ZendT_Exception_Alert(_i18n('Pedido ainda está pendente de Pagamento!'));
                    }
                } else {
                    if ($this->getStatus()->toPhp() == 'A') {
                        $this->setStatus('P'); // pago
                    }
                }
            }
        }

        public function _afterSave() {
            parent::_afterSave();

            if ($this->getStatus(true)->toPhp() == 'E') {
                $_pagtoLanc = new Vendas_DataView_PagtoLanc_MapperView();

                $_where = new ZendT_Db_Where();
                $_where->addFilter('pagto_pedido.id_pedido', $this->getId());
                $_pagtoLanc->findAll($_where);

                if (!$_pagtoLanc->fetch()) {
                    $this->_pagamento->efetivar($this->getId());
                }
            }
        }

        public function efetivar() {
            if ($this->getId()->toPhp() == '') {
                throw new ZendT_Exception_Alert(_i18n('Necessário informar um Pedido!'));
            } else {
                if ($this->getStatus()->toPhp() == '') {
                    $this->retrieve();
                }
            }
            $this->setStatus('E')->update();
            return true;
        }

    }

?>