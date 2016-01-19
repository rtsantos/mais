<?php
return array (
  'table' => 
  array (
    'name' => 'gpb_logradouro',
    'modelName' => 'logradouro',
    'schema' => 'projta',
    'sequenceName' => 'sid_gpb_logradouro',
    'moduleName' => 'gpb',
    'objectName' => 'Gpb_Model_Logradouro',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'nome',
        'display' => 'nome_localidade',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '170px',
      ),
      'display' => 
      array (
        'css-width' => '100px',
      ),
      'url' => 
      array (
        'grid' => '/gpb/logradouro/grid',
        'search' => '/gpb/logradouro/seeker-search',
        'retrive' => '/gpb/logradouro/retrive',
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
      'tipo' => 
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
          'required' => false,
        ),
        'label' => 'Tipo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => true,
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
      'complemento' => 
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
        'label' => 'Complemento',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => true,
      ),
      'cep' => 
      array (
        'object' => 
        array (
          'mask' => '99.999-999',
          'charMask' => '9',
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
                'max' => 8,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '8',
            'css-width' => 13,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'CEP',
        'multiple' => 0,
        'type' => 'String',
        'length' => '8',
        'nullable' => true,
      ),
      'id_bairro_ini' => 
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
          'required' => false,
        ),
        'label' => 'Bairro Início',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => true,
      ),
      'id_bairro_fim' => 
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
          'required' => false,
        ),
        'label' => 'Bairro Fim',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
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
        'columnName' => 'ID_LOCALIDADE',
        'objectNameReference' => 'Gpb_Model_Localidade',
        'tableNameReference' => 'gpb_localidade',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_BAIRRO_FIM',
        'objectNameReference' => 'Gpb_Model_Bairro',
        'tableNameReference' => 'gpb_bairro',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_BAIRRO_INI',
        'objectNameReference' => 'Gpb_Model_Bairro',
        'tableNameReference' => 'gpb_bairro',
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
      0 => 'nome',
      1 => 'id_localidade',
    ),
    'description' => 'Logradouro',
  ),
)
?>