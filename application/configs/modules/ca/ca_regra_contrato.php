<?php
return array (
  'table' => 
  array (
    'name' => 'ca_regra_contrato',
    'modelName' => 'regra_contrato',
    'schema' => 'mais',
    'sequenceName' => 'sid_ca_regra_contrato',
    'moduleName' => 'ca',
    'objectName' => 'Ca_Model_RegraContrato',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'status',
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
        'grid' => '/ca/regra-contrato/grid',
        'search' => '/ca/regra-contrato/seeker-search',
        'retrieve' => '/ca/regra-contrato/retrieve',
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
      'id_contrato' => 
      array (
        'label' => 'Contrato',
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
              'search' => 'descricao',
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
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'id_produto' => 
      array (
        'label' => 'Produto',
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
              'search' => 'codigo',
              'display' => 'nome',
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
              'grid' => '/vendas/produto/grid/profile_key/produto',
              'search' => '/vendas/produto/seeker-search/profile_key/produto',
              'retrieve' => '/vendas/produto/retrieve/profile_key/produto',
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
      'id_favorecido' => 
      array (
        'label' => 'Favorecido',
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
              'grid' => '/ca/pessoa/grid/profile_key/clientes',
              'search' => '/ca/pessoa/seeker-search/profile_key/clientes',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/clientes',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => NULL,
        'nullable' => true,
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
             'I' => 'Inativo'
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
      'vlr_fixo' => 
      array (
        'label' => 'Valor Fixo',
        'multiple' => 0,
        'type' => 'decimal',
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
          'required' => false,
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'vlr_min' => 
      array (
        'label' => 'Valor Mínimo',
        'multiple' => 0,
        'type' => 'decimal',
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
          'required' => false,
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'vlr_perc' => 
      array (
        'label' => 'Percentual',
        'multiple' => 0,
        'type' => 'decimal',
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
          'required' => false,
        ),
        'length' => '4.4',
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
        'columnName' => 'id_contrato',
        'objectNameReference' => 'Ca_Model_Contrato',
        'tableNameReference' => 'ca_contrato',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_produto',
        'objectNameReference' => 'Vendas_Model_Produto',
        'tableNameReference' => 'cv_produto',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      2 => 
      array (
        'columnName' => 'id_favorecido',
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
    ),
    'description' => 'Regras do Contrato',
  ),
)
?>