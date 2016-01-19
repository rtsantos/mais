<?php

    /**
     * Classe de mapeamento do registro da tabela log_evento
     */
    class Log_Model_LogEvento_Mapper extends Log_Model_LogEvento_Crud_Mapper {

        public function save($tableName = '', $operation = '', $key = '', $note = '') {
            if ($tableName && $operation && $key) {
                list($owner, $table) = explode(".", str_replace('"', '', $tableName));
                if (substr($table, 0, 4) != 'LOG_') {
                    $_logTabela = new Log_Model_LogTabela_Mapper();
                    $where = new ZendT_Db_Where();
                    $where->addFilter('owner', $owner);
                    $where->addFilter('nome', $table);
                    $_logTabela->retrieve($where);
                    if (!$_logTabela->getId()) {
                        $_logTabela->setOwner($owner);
                        $_logTabela->setNome($table);
                        $_logTabela->setTableName($table);
                        $_logTabela->insert();
                    }
                    $this->setIdLogTabela($_logTabela->getId());

                    $_logObjeto = new Log_Model_LogObjeto_Mapper();
                    $where = new ZendT_Db_Where();
                    $where->addFilter('id_log_tabela', $_logTabela->getId());
                    $_logObjeto->retrieve($where);
                    if (!$_logObjeto->getId()) {
                        $_logObjeto->setNome($table);
                        $_logObjeto->setDescricao("LOG DE {$table}");
                        $_logObjeto->setStatus('A');
                        $_logObjeto->setIdLogTabela($_logTabela->getId());
                        $_logObjeto->insert();
                    }
                    $this->setIdLogObjeto($_logObjeto->getId());
                }
                if ($this->getIdLogTabela() && $this->getIdLogObjeto()) {
                    if ($operation == 'insert') {
                        $codOperation = 'INC';
                    } else if ($operation == 'update') {
                        $codOperation = 'ALT';
                    } else if ($operation == 'delete') {
                        $codOperation = 'EXC';
                    }
                    if ($codOperation) {
                        $this->setIdUsuario(Zend_Auth::getInstance()->getStorage()->read()->getId());
                        $this->setChave($key);
                        $this->setIdObjeto($key);
                        $this->setObservacao($note);
                        $db = $this->getModel()->getAdapter();
                        $sql = "begin
                                        log_pkg.addlog(p_objeto     => {$db->quote($_logObjeto->getNome()->getValueToDb())},
                                                       p_operac     => {$db->quote($codOperation)},
                                                       p_id_objeto  => {$db->quote($this->getIdObjeto()->getValueToDb())},
                                                       p_id_usuario => {$db->quote($this->getIdUsuario()->getValueToDb())},
                                                       p_chave      => {$db->quote($this->getChave()->getValueToDb())},
                                                       p_observacao => {$db->quote($this->getObservacao()->getValueToDb())},
                                                       p_commit     => 'S',
                                                       p_tabela     => {$db->quote($_logTabela->getNome()->getValueToDb())});
                                    end;";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                    }
                }
            }
            return $this;
        }

    }

?>