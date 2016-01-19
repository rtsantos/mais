<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_servico',
    'modelName' => 'servico',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_servico',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_Servico',
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
        'grid' => '/dfe/servico/grid',
        'search' => '/dfe/servico/seeker-search',
        'retrive' => '/dfe/servico/retrive',
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
      'id_dfe_endereco' => 
      array (
        'label' => 'Endereço',
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
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_servico_cont' => 
      array (
        'label' => 'Serviço de Contingência',
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
              'search' => '',
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
              'grid' => '/dfe/servico/grid',
              'search' => '/dfe/servico/seeker-search',
              'retrive' => '/dfe/servico/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'nome' => 
      array (
        'label' => 'Nome',
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
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '30',
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
        'columnName' => 'ID_DFE_ENDERECO',
        'objectNameReference' => 'Dfe_Model_Endereco',
        'tableNameReference' => 'dfe_endereco',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_DFE_SERVICO_CONT',
        'objectNameReference' => 'Dfe_Model_Servico',
        'tableNameReference' => 'dfe_servico',
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
      0 => 'nome',
    ),
    'description' => 'Serviço',
  ),
)
?>