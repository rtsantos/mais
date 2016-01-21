<?php

    /**
     * Classe de mapeamento do registro da tabela cms_priv_conteudo
     */
    class Cms_Model_PrivConteudo_Mapper extends Cms_Model_PrivConteudo_Crud_Mapper {

        public function _beforeSave() {
            parent::_beforeSave();
            if ($this->getEnvEmail(true)->toPhp() == '') {
                $this->setEnvEmail('N');
            }
            if ($this->_action != 'delete') {
                $this->_isValidPrivConteudo();
            }
        }

        public function addPrivConteudo($idConteudo, $idPapel = '', $tipo) {
            if (!$idPapel) {
                $_papel = new Auth_Model_Conta_Mapper();
                $idPapel = $_papel->getIdPapelInformatica();
            }
            $this->setIdConteudo($idConteudo);
            $this->setIdPapel($idPapel);
            $this->setTipo($tipo);
            if ($this->exists()) {
                return false;
            }
            return $this->insert();
        }

        private function _isValidPrivConteudo() {
            if (!$this->_ignoreValidation) {
                /*if ($this->_action == 'delete' || $this->_action == 'update') {
                    $_papel = new Auth_Model_Conta_Mapper();
                    $idPapel = $_papel->getIdPapelInformatica();
                    $_privConteudo = new Cms_Model_PrivConteudo_Mapper();
                    if ($_privConteudo->setId($this->getId())->retrieve()->getIdPapel()->toPhp() == $idPapel) {
                        throw new ZendT_Exception("Não é possível remover/alterar esse privilégio!");
                    }
                }
                if ($this->_action != 'delete') {
                    $_conteudo = new Cms_Model_Conteudo_Mapper();
                    $_conteudo->setId($this->getIdConteudo())->retrieve();
                    if ($_conteudo->getPublico()->toPhp() == 'S' && $this->getTipo()->toPhp() == 'V') {
                        throw new ZendT_Exception("Não é possível adicionar privilégios de visualização pois o registro selecionado já é 'público'!");
                    }
                }*/
            }
            return true;
        }

    }

?>