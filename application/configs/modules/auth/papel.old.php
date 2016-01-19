<?php
return array (
  'table' => 
  array (
    'name' => 'papel',
    'schema' => 'prouser',
    'sequenceName' => 'sid_papel',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_Papel',
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
        'size' => '40px',
      ),
      'display' => 
      array (
        'size' => '0px',
      ),
      'url' => 
      array (
        'grid' => '/auth/papel/grid',
        'search' => '/auth/papel/seeker-search',
        'retrive' => '/auth/papel/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 400,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Profile_Model_ObjectViewPriv',
      1 => 'Profile_Model_JobDest',
      2 => 'Auth_Model_UsuarioPapel',
      3 => 'Auth_Model_PapelRecurso',
      4 => 'Auth_Model_Usuario',
    ),
    'referenceMaps' => 
    array (
    ),
    'columns' => 
    array (
      'id' => 
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
          'type' => 'Text',
          'text' => 
          array (
            'size' => 15,
            'maxlength' => 10,
            'id' => NULL,
            'css-width' => '100px',
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'nome' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'size' => 40,
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'descricao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'size' => 40,
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'id_papel_pai' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'size' => 40,
            ),
            'display' => 
            array (
              'size' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/papel/grid',
              'search' => '/auth/papel/seeker-search',
              'retrive' => '/auth/papel/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Papel Pai',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
    ),
    'dependentTables' =>
    array(
    ),
    'referenceMaps' =>
    array(
        0 =>
        array(
            'columnName' => 'ID_PAPEL_PAI',
            'objectNameReference' => 'Auth_Model_Papel',
            'tableNameReference' => 'papel',
            'schemaNameReference' => 'prouser',
            'columnReference' => 'ID',
        )
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'nome',
    ),
    'description' => 'Papel',
  ),
)
?>