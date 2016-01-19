<?php
return array (
  'table' => 
  array (
    'name' => 'gpb_bairro',
    'modelName' => 'bairro',
    'schema' => 'projta',
    'sequenceName' => 'sid_gpb_bairro',
    'moduleName' => 'gpb',
    'objectName' => 'Gpb_Model_Bairro',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'nome_abrev',
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
        'grid' => '/gpb/bairro/grid',
        'search' => '/gpb/bairro/seeker-search',
        'retrive' => '/gpb/bairro/retrive',
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
            'css-width' => 192.5,
            'maxlength' => '22',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
      ),
      'uf' => 
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
                'max' => 2,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => 7,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'UF',
        'multiple' => 0,
        'type' => 'String',
        'length' => '2',
        'nullable' => false,
      ),
      'id_localidade' => 
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
              'display' => 'uf',
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
              'grid' => '/gpb/localidade/grid',
              'search' => '/gpb/localidade/seeker-search',
              'retrive' => '/gpb/localidade/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'label' => 'Localidade',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
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
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => true,
      ),
      'nome_abrev' => 
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
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Nome Abreviado',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Gpb_Model_GpbLogradouro',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_LOCALIDADE',
        'objectNameReference' => 'Gpb_Model_Localidade',
        'tableNameReference' => 'gpb_localidade',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'uf',
      1 => 'id_localidade',
    ),
    'description' => 'Bairro',
  ),
)
?>