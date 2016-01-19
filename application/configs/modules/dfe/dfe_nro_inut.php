<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_nro_inut',
    'modelName' => 'nro_inut',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_nro_inut',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_NroInut',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'nro_inicial',
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
        'grid' => '/dfe/nro-inut/grid',
        'search' => '/dfe/nro-inut/seeker-search',
        'retrive' => '/dfe/nro-inut/retrive',
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
      'id_dfe_empresa' => 
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
              'search' => 'cnpj',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '50px',
            ),
            'display' => 
            array (
              'css-width' => '220px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/empresa/grid',
              'search' => '/dfe/empresa/seeker-search',
              'retrive' => '/dfe/empresa/retrive',
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
      'id_dfe_pessoa_emit' => 
      array (
        'label' => 'Emitente',
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
              'search' => 'cnpj',
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
              'grid' => '/dfe/pessoa/grid',
              'search' => '/dfe/pessoa/seeker-search',
              'retrive' => '/dfe/pessoa/retrive',
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
      'id_dfe_status' => 
      array (
        'label' => 'Status',
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
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'tp_amb' => 
      array (
        'label' => 'Tipo de Ambiente',
        'multiple' => 0,
        'type' => 'Number',
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
              '1' => 'Produção',
              '2' => 'Homologação',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '1',
            'id' => NULL,
          ),
          'type' => 'Select',
          'required' => true,
        ),
        'length' => 1,
        'nullable' => false,
      ),
      'modelo' => 
      array (
        'label' => 'Modelo',
        'multiple' => 0,
        'type' => 'Number',
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
              '55' => 'NFe',
              '57' => 'CTe',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Select',
          'required' => true,
        ),
        'length' => 2,
        'nullable' => false,
      ),
      'ano' => 
      array (
        'label' => 'Ano',
        'multiple' => 0,
        'type' => 'Number',
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
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'length' => 2,
        'nullable' => false,
      ),
      'serie' => 
      array (
        'label' => 'Série',
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
      'nro_inicial' => 
      array (
        'label' => 'Nro Inicial',
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
                'max' => 9,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '9',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '9',
        'nullable' => false,
      ),
      'nro_final' => 
      array (
        'label' => 'Nro Final',
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
                'max' => 9,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '9',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '9',
        'nullable' => false,
      ),
      'justificativa' => 
      array (
        'label' => 'Justificativa',
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
                'max' => 255,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '255',
            'css-width' => '300px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '255',
        'nullable' => false,
      ),
      'dh_envio' => 
      array (
        'label' => 'Data e Hora do Envio',
        'multiple' => 0,
        'type' => 'DateTime',
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
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
          ),
          'type' => 'DateTime',
          'time' => 
          array (
            'css-width' => '43.75px;',
            'maxlength' => 5,
          ),
          'required' => false,
        ),
        'length' => '7',
        'nullable' => true,
      ),
      'xml' => 
      array (
        'label' => 'XML',
        'multiple' => 0,
        'type' => 'StringLong',
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
          'type' => 'Textare',
          'textare' => 
          array (
            'id' => NULL,
            'cols' => 50,
            'rows' => 10,
          ),
          'required' => false,
        ),
        'length' => '86',
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
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_Estado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_DFE_EMPRESA',
        'objectNameReference' => 'Dfe_Model_Empresa',
        'tableNameReference' => 'dfe_empresa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_DFE_PESSOA_EMIT',
        'objectNameReference' => 'Dfe_Model_Pessoa',
        'tableNameReference' => 'dfe_pessoa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'ID_DFE_STATUS',
        'objectNameReference' => 'Dfe_Model_Status',
        'tableNameReference' => 'dfe_status',
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
      0 => 'id_dfe_empresa',
      1 => 'id_dfe_pessoa_emit',
      2 => 'id_dfe_estado',
      3 => 'id_dfe_status',
      4 => 'tp_amb',
      5 => 'modelo',
      6 => 'ano',
      7 => 'serie',
      8 => 'nro_inicial',
    ),
    'description' => 'Número Inutilizado',
  ),
)
?>