<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_status',
    'modelName' => 'status',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_status',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_Status',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'codigo',
        'display' => 'descricao',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '40px',
      ),
      'display' => 
      array (
        'css-width' => '230px',
      ),
      'url' => 
      array (
        'grid' => '/dfe/status/grid',
        'search' => '/dfe/status/seeker-search',
        'retrive' => '/dfe/status/retrive',
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
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Text',
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
            'css-width' => '100px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'codigo' => 
      array (
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'String',
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
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '3',
        'nullable' => false,
      ),
      'descricao' => 
      array (
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
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
                'max' => 200,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '200',
            'css-width' => '400px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '200',
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Dfe_Model_DfeNroInut',
      1 => 'Dfe_Model_Evento',
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
    'description' => 'Status',
  ),
)
?>