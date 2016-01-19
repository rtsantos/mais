<?php
return array (
  'table' => 
  array (
    'name' => 'profile_object_view_priv',
    'modelName' => 'object_view_priv',
    'schema' => 'prouser',
    'sequenceName' => 'sid_profile_object_view_priv',
    'moduleName' => 'profile',
    'objectName' => 'Profile_Model_ObjectViewPriv',
    'controllerName' => true,
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
        'grid' => '/profile/object-view-priv/grid',
        'search' => '/profile/object-view-priv/seeker-search',
        'retrive' => '/profile/object-view-priv/retrive',
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
        'label' => 'ID',
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
        'length' => 1,
        'nullable' => false,
      ),
      'id_profile_object_view' => 
      array (
        'label' => 'Visão',
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
              'grid' => '/profile/object-view/grid',
              'search' => '/profile/object-view/seeker-search',
              'retrive' => '/profile/object-view/retrive',
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
      'id_papel' => 
      array (
        'label' => 'Papel',
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
              'css-width' => 50,
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
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'tipo' => 
      array (
        'label' => 'Tipo',
        'referenceMap' => true,
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
            'O' => 'Administração',
            'S' => 'Visualização',
          ),
          'text' => 
          array (
            'id' => NULL,
          ),
          'type' => 'Select',
          'required' => false,
        ),
        'length' => '1',
        'nullable' => false,
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
        'columnName' => 'ID_PROFILE_OBJECT_VIEW',
        'objectNameReference' => 'Profile_Model_ObjectView',
        'tableNameReference' => 'profile_object_view',
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
      0 => 'ID_PROFILE_OBJECT_VIEW',
      1 => 'ID_PAPEL',
      2 => 'TIPO',
    ),
    'description' => 'Compartilhamento de Visão',
  ),
)
?>