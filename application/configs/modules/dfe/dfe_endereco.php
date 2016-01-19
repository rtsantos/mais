<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_endereco',
    'modelName' => 'endereco',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_endereco',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_Endereco',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'tipo',
        'display' => 'url',
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
        'grid' => '/dfe/endereco/grid',
        'search' => '/dfe/endereco/seeker-search',
        'retrive' => '/dfe/endereco/retrive',
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
      'id_dfe_estado' => 
      array (
        'label' => 'Estado',
        'referenceMap' => true,
        'multiple' => 0,
        'type' => 'Integer',
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
              'search' => 'uf',
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
              'grid' => '/dfe/estado/grid',
              'search' => '/dfe/estado/seeker-search',
              'retrive' => '/dfe/estado/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'tipo' => 
      array (
        'label' => 'Tipo',
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '1',
        'nullable' => false,
      ),
      'url' => 
      array (
        'label' => 'URL',
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
                'max' => 100,
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
            'css-width' => '400px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '100',
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Dfe_Model_DfeServico',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_Estado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'id_dfe_estado',
      1 => 'tipo',
    ),
    'description' => 'Endereço',
  ),
)
?>