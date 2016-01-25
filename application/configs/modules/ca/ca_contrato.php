<?php
return array (
  'table' => 
  array (
    'name' => 'ca_contrato',
    'modelName' => 'contrato',
    'schema' => 'mais',
    'sequenceName' => 'sid_ca_contrato',
    'moduleName' => 'ca',
    'objectName' => 'Ca_Model_Contrato',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'numero',
        'display' => 'descricao',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '70px',
      ),
      'display' => 
      array (
        'css-width' => '200px',
      ),
      'url' => 
      array (
        'grid' => '/ca/contrato/grid',
        'search' => '/ca/contrato/seeker-search',
        'retrieve' => '/ca/contrato/retrieve',
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
        'label' => 'Id.',
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'maxlength' => NULL,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
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
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
                'max' => 45,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '45',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '45',
        'nullable' => false,
      ),
      'numero' => 
      array (
        'label' => 'Número',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
                'max' => 10,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '10',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '10',
        'nullable' => false,
      ),
      'status' => 
      array (
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '1',
        'nullable' => false,
      ),
      'id_empresa' => 
      array (
        'label' => 'Empresa',
        'referenceMap' => true,
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
              'grid' => '/ca/pessoa/grid',
              'search' => '/ca/pessoa/seeker-search',
              'retrieve' => '/ca/pessoa/retrieve',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'id_cliente' => 
      array (
        'label' => 'Cliente',
        'referenceMap' => true,
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
              'grid' => '/ca/pessoa/grid',
              'search' => '/ca/pessoa/seeker-search',
              'retrieve' => '/ca/pessoa/retrieve',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'dt_vig_ini' => 
      array (
        'label' => 'Vigência Incial',
        'multiple' => 0,
        'type' => 'Date',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'id' => NULL,
          ),
          'type' => 'Date',
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'dt_vig_fim' => 
      array (
        'label' => 'Vigência Final',
        'multiple' => 0,
        'type' => 'Date',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'id' => NULL,
          ),
          'type' => 'Date',
          'required' => false,
        ),
        'length' => NULL,
        'nullable' => true,
      ),
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'id_cliente',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_empresa',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'descricao',
      1 => 'id_empresa',
    ),
    'description' => 'Contrato',
    'dependentTables' => 
    array (
      0 => 'Ca_Model_RegraContrato',
    ),
    'tabs' => 
    array (
      0 => 
      array (
        'description' => 'Regras do Contrato',
        'url' => '/ca/regra-contrato/form/grid/1',
        'column' => 'id_contrato',
        'message' => 'Necessário seleção Contrato',
      ),
    ),
  ),
)
?>