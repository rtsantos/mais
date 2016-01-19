<?php
return array (
  'table' => 
  array (
    'name' => 'log_evento',
    'modelName' => 'log_evento',
    'schema' => 'log',
    'sequenceName' => 'sid_log_evento',
    'moduleName' => 'log',
    'objectName' => 'Log_Model_LogEvento',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'chave',
        'display' => '',
        'id' => 
        array (
        ),
      ),
      'search' => 
      array (
        'css-width' => '270px',
      ),
      'display' => 
      array (
        'css-width' => '0px',
      ),
      'url' => 
      array (
        'grid' => '/log/log-evento/grid',
        'search' => '/log/log-evento/seeker-search',
        'retrive' => '/log/log-evento/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'columns' => 
    array (
      'id_log_objeto' => 
      array (
        'referenceMap' => true,
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'nome',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '270px',
            ),
            'display' => 
            array (
              'css-width' => '0px',
            ),
            'url' => 
            array (
              'grid' => '/log/log-objeto/grid',
              'search' => '/log/log-objeto/seeker-search',
              'retrive' => '/log/log-objeto/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'label' => 'Objeto',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 4,
        'nullable' => false,
      ),
      'id_log_operac' => 
      array (
        'referenceMap' => true,
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'acao',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '270px',
            ),
            'display' => 
            array (
              'css-width' => '0px',
            ),
            'url' => 
            array (
              'grid' => '/log/log-operac/grid',
              'search' => '/log/log-operac/seeker-search',
              'retrive' => '/log/log-operac/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'label' => 'Operação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 2,
        'nullable' => false,
      ),
      'id_objeto' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '10',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'label' => 'Objeto',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 10,
        'nullable' => false,
      ),
      'id_usuario' =>
        array(
            'object' =>
            array(
                'mask' => NULL,
                'charMask' => '@',
                'filter' =>
                array(
                    0 => 'strtoupper',
                    1 => 'removeAccent',
                ),
                'filterDb' =>
                array(
                    0 => '',
                ),
                'validators' =>
                array(
                ),
                'listOptions' =>
                array(
                ),
                'type' => 'Seeker',
                'seeker' =>
                array(
                    'search' =>
                    array(
                        'css-width' => '70px',
                    ),
                    'display' =>
                    array(
                        'css-width' => '200px',
                    ),
                    'field' =>
                    array(
                        'search' => 'login',
                        'display' => 'nome',
                        'id' => 'id',
                    ),
                    'url' =>
                    array(
                        'grid' => '/auth/usuario/grid',
                        'search' => '/auth/usuario/seeker-search',
                        'retrive' => '/auth/usuario/retrive',
                    ),
                    'modal' =>
                    array(
                        'width' => 800,
                        'height' => 450,
                    ),
                ),
                'required' => false,
            ),
            'label' => 'Usuário',
            'multiple' => 0,
            'type' => 'Integer',
            'length' => 10,
            'nullable' => true,
        ),
      'dh_evento' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
          ),
          'type' => 'DateTime',
          'time' => 
          array (
            'css-width' => '43.75px;',
            'maxlength' => 5,
          ),
          'required' => true,
        ),
        'label' => 'Data Hora do Evento',
        'multiple' => 0,
        'type' => 'DateTime',
        'length' => '7',
        'nullable' => false,
      ),
      'chave' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
            0 => 
            array (
              'name' => 'Zend_Validate_StringLength',
              'param' => 
              array (
                'max' => 30,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '30',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Chave',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => false,
      ),
      'observacao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
            0 => 
            array (
              'name' => 'Zend_Validate_StringLength',
              'param' => 
              array (
                'max' => 250,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '250',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '250',
        'nullable' => true,
      ),
      'id_log_tabela' => 
      array (
        'referenceMap' => true,
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
            1 => 'removeAccent',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'nome',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '200px',
            ),
            'display' => 
            array (
              'css-width' => '70px',
            ),
            'url' => 
            array (
              'grid' => '/log/log-tabela/grid',
              'search' => '/log/log-tabela/seeker-search',
              'retrive' => '/log/log-tabela/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'label' => 'Tabela',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_LOG_OBJETO',
        'objectNameReference' => 'Log_Model_LogObjeto',
        'tableNameReference' => 'log_objeto',
        'schemaNameReference' => 'log',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_LOG_OPERAC',
        'objectNameReference' => 'Log_Model_LogOperac',
        'tableNameReference' => 'log_operac',
        'schemaNameReference' => 'log',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_LOG_TABELA',
        'objectNameReference' => 'Log_Model_LogTabela',
        'tableNameReference' => 'log_tabela',
        'schemaNameReference' => 'log',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'ID_USUARIO',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      )  
    ),
    'primary' => 
    array (
        0 => 'id_objeto',
        1 => 'id_log_tabela'
    ),
    'unique' => 
    array (
      0 => 'chave',
    ),
    'description' => 'Log de Eventos',
  ),
)
?>