<?php
return array (
  'table' => 
  array (
    'name' => 'log_operac',
    'modelName' => 'log_operac',
    'schema' => 'log',
    'sequenceName' => 'sid_log_operac',
    'moduleName' => 'log',
    'objectName' => 'Log_Model_LogOperac',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'codigo',
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
            'css-width' => 50,
            'maxlength' => 2,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 2,
        'nullable' => false,
      ),
      'codigo' => 
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
                'max' => 3,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '3',
            'css-width' => 50,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'String',
        'length' => '3',
        'nullable' => false,
      ),
      'operacao' => 
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => 150,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Operação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => 150,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'acao' => 
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => 150,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Ação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Log_Model_LogEvento',
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
      0 => 'codigo',
    ),
    'description' => 'Log Operac',
  ),
)
?>