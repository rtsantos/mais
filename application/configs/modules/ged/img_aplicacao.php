<?php
return array (
  'table' => 
  array (
    'name' => 'img_aplicacao',
    'modelName' => 'aplicacao',
    'schema' => 'mais',
    'sequenceName' => 'sid_img_aplicacao',
    'moduleName' => 'ged',
    'objectName' => 'Ged_Model_Aplicacao',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'sigla_aplic_prouser',
        'display' => 'nome_aplic_prouser',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '100px',
      ),
      'display' => 
      array (
        'css-width' => '170px',
      ),
      'url' => 
      array (
        'grid' => '/ged/aplicacao/grid',
        'search' => '/ged/aplicacao/seeker-search',
        'retrive' => '/ged/aplicacao/retrive',
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
      'id_aplic_prouser' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
              'search' => 'sigla',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'width' => '100px',
            ),
            'display' => 
            array (
              'width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/auth/aplicacao/grid',
              'search' => '/auth/aplicacao/seeker-search',
              'retrive' => '/auth/aplicacao/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Aplicação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Ged_Model_ImgPropDocto',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_APLIC_PROUSER',
        'objectNameReference' => 'Auth_Model_Aplicacao',
        'tableNameReference' => 'aplicacao',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Aplicação',
  ),
)
?>