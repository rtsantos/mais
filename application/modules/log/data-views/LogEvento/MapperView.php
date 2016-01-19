<?php

    /**
     * Classe de visão da tabela log_evento
     */
    class Log_DataView_LogEvento_MapperView extends Log_DataView_LogEvento_Crud_MapperView {

        protected function _loadColumns() {
            parent::_loadColumns();

            $this->_columns->addExpression('id', 'log_evento.id_objeto||\'-\'||log_evento.id_log_tabela', 'Log_Model_LogEvento_Mapper', ZendT_Lib::translate('Identificação'), null, '=');
            $this->_columns->add('operacao_log_operac', 'log_operac', 'operacao', $this->_getLogOperac()->getModel()->getMapperName(), ZendT_Lib::translate('Operação'), null, '?%');
        }

    }

?>