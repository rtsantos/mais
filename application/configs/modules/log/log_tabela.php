<?php
return array (
  'table' => 
  array (
    'name' => 'log_tabela',
    'modelName' => 'log_tabela',
    'schema' => 'log',
    'sequenceName' => 'sid_log_tabela',
    'moduleName' => 'log',
    'objectName' => 'Log_Model_LogTabela',
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
            'css-width' => 87.5,
            'maxlength' => 10,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
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
            'maxlength' => '150',
            'css-width' => 150,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => false,
      ),
      'owner' => 
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
            'maxlength' => '100',
            'css-width' => 100,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'OWNER',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => false,
      ),
      'table_name' => 
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
            'maxlength' => '150',
            'css-width' => 150,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Nome da Tabela',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Log_Model_LogObjeto',
      1 => 'Log_Model_LogEvento',
    ),
    'referenceMaps' => 
    array (
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'nome',
    ),
    'description' => 'Log Tabela',
  ),
)
?>