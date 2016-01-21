<?php

    /**
     * Classe de mapeamento do registro da tabela cms_priv_categ
     */
    class Cms_Model_PrivCateg_Mapper extends Cms_Model_PrivCateg_Crud_Mapper {

        public function _beforeSave() {
            parent::_beforeSave();
            if ($this->getEnvEmail(true)->toPhp() == '') {
                $this->setEnvEmail('N');
            }
            if ($this->_action != 'delete') {
                $this->_isValidPrivCateg();
            }
        }

        public function addPrivCateg($idCategoria, $idPapel = '', $tipo) {
            if (!$idPapel) {
                $_papel = new Auth_Model_Conta_Mapper();
                $idPapel = $_papel->getIdPapelInformatica();
            }
            $this->setIdCategoria($idCategoria);
            $this->setIdPapel($idPapel);
            $this->setTipo($tipo);
            if ($this->exists()) {
                return false;
            }
            return $this->insert();
        }

        private function _isValidPrivCateg() {
            /*if ($this->_action == 'delete' || $this->_action == 'update') {
                $_papel = new Auth_Model_Conta_Mapper();
                $idPapel = $_papel->getIdPapelInformatica();
                $_privCateg = new Cms_Model_PrivCateg_Mapper();
                if ($_privCateg->setId($this->getId())->retrieve()->getIdPapel()->toPhp() == $idPapel) {
                    throw new ZendT_Exception("Não é possível remover/alterar esse privilégio!");
                }
            }
            if ($this->_action != 'delete') {
                $_categ = new Cms_Model_Categoria_Mapper();
                $_categ->setId($this->getIdCategoria())->retrieve();
                if ($_categ->getPublico()->toPhp() == 'S' && $this->getTipo()->toPhp() == 'V') {
                    throw new ZendT_Exception("Não é possível adicionar privilégios de visualização pois o registro selecionado já é 'público'!");
                }
            }*/
            return true;
        }

    }

?>