<?php
    class Auth_Model_Usuario_LoginColetorMapperView extends Auth_DataView_Usuario_MapperView {
        
        protected function _prepareSql(&$sql, &$binds, $type) {
            
            if (in_array($binds['usuario_chapa'], array('99999', '99998', '99997', '99996', '99995', '99994', '99993', '99992', '99991', '99990'))) {
                $binds['usuario_chapa'] = '9' . $binds['usuario_chapa'];
            }
            
            if (isset($binds['usuario_chapa'])) {
                $binds['usuario_chapa'] = str_pad($binds['usuario_chapa'], 6, 0, STR_PAD_LEFT);
                $sql = str_replace('usuario.chapa', 'LPAD(usuario.chapa, 6, 0)', $sql);
            }
        }
        
    }