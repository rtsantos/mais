<?php
return array (
  'table' => 
  array (
    'name' => 'papel_recurso',
    'schema' => 'prouser',
    'sequenceName' => 'sid_papel_recurso',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_PapelRecurso',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'acesso',
        'display' => '',
        'id' => 
        array (
        ),
      ),
      'search' => 
      array (
        'width' => 50,
      ),
      'display' => 
      array (
        'width' => 50,
      ),
      'url' => 
      array (
        'grid' => '/auth/papel-recurso/grid',
        'search' => '/auth/papel-recurso/seeker-search',
        'retrive' => '/auth/papel-recurso/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 400,
      ),
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_PAPEL',
        'objectNameReference' => 'Auth_Model_Papel',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_RECURSO',
        'objectNameReference' => 'Auth_Model_Recurso',
        'tableNameReference' => 'recurso',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
    ),
    'columns' => 
    array (
      'id_papel' => 
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
              'search' => 'nome',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'width' => '270px',
            ),
            'display' => 
            array (
              'width' => 50,
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
              'height' => 360,
            ),
          ),
          'required' => true,
        ),
        'label' => 'Papel',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '10',
        'nullable' => false,
      ),
      'id_recurso' => 
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
              'search' => 'nome',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'width' => '270px',
            ),
            'display' => 
            array (
              'width' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/recurso/grid',
              'search' => '/auth/recurso/seeker-search',
              'retrive' => '/auth/recurso/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
        ),
        'label' => 'Recurso',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '10',
        'nullable' => false,
      ),
      'acesso' => 
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
              'P'=>'Permitido',
              'N'=>'Negado'
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'size' => 6,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'acesso',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
    ),
    'primary' => 
    array ('id_papel','id_recurso'),
    'unique' => 
    array ('id_papel','id_recurso'),
  ),
)
?>