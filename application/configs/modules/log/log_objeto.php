<?php
return array (
  'table' => 
  array (
    'name' => 'log_objeto',
    'modelName' => 'log_objeto',
    'schema' => 'log',
    'sequenceName' => 'sid_log_objeto',
    'moduleName' => 'log',
    'objectName' => 'Log_Model_LogObjeto',
    'controllerName' => true,
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
    'columns' => 
    array (
      'id' => 
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
          'type' => 'Text',
          'text' => 
          array (
            'css-width' => 35,
            'maxlength' => 4,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'id',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 4,
        'nullable' => false,
      ),
      'nome' => 
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
            'css-width' => 35,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => false,
      ),
      'descricao' => 
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
                'max' => 50,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '50',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'status' => 
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
            'A' => 'Ativo',
            'I' => 'Inativo',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => 6,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
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
        'label' => 'Log Tabela',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
      ),
      'tempo_vida' => 
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
            'numInteger' => '4',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'label' => 'Tempo de Vida',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 4,
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Log_Model_LogEvento',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_LOG_TABELA',
        'objectNameReference' => 'Log_Model_LogTabela',
        'tableNameReference' => 'log_tabela',
        'schemaNameReference' => 'log',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'nome',
    ),
    'description' => 'Log Objeto',
  ),
)
?>