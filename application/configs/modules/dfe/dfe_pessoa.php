<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_pessoa',
    'modelName' => 'pessoa',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_pessoa',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_Pessoa',
    'controllerName' => true,
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
        'retrieve' => '/dfe/pessoa/retrieve',
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
            'search' => 
            array (
              'css-width' => '200px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'field' => 
            array (
              'id' => 'id',
              'search' => '',
              'display' => '',
            ),
            'url' => 
            array (
              'grid' => '/module/controller/grid',
              'search' => '/module/controller/seeker/search',
              'retrive' => '/module/controller/retrive',
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
      'emitente' => 
      array (
        'label' => 'Emitente',
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
            'N' => 'Não',
            'S' => 'Sim',
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
      'cnpj' => 
      array (
        'label' => 'CNPJ',
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
                'max' => 14,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '14',
            'css-width' => '122.5px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '14',
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
                'max' => 60,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '60',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '60',
        'nullable' => false,
      ),
      'nome_fantasia' => 
      array (
        'label' => 'Nome Fantasia',
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
                'max' => 60,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '60',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'dh_inc' => 
      array (
        'label' => 'Data e Hora de Inclusão',
        'multiple' => 0,
        'type' => 'DATE',
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
          'required' => true,
        ),
        'length' => '7',
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Dfe_Model_NroInut',
      1 => 'Dfe_Model_DfeDocumento',
      2 => 'Dfe_Model_DfeContato',
      3 => 'Dfe_Model_Docto',
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
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_Estado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_DfeEstado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'dfe',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_DfeEstado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'dfe',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'cnpj',
    ),
    'description' => 'Pessoa',
  ),
)
?>