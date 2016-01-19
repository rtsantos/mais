<?php
return array (
  'table' => 
  array (
    'name' => 'tipo_usuario',
    'schema' => 'prouser',
    'sequenceName' => 'sid_tipo_usuario',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_TipoUsuario',
    'controllerName' => true,
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
        'css-width' => '200px',
      ),
      'url' => 
      array (
        'grid' => '/auth/tipo-usuario/grid',
        'search' => '/auth/tipo-usuario/seeker-search',
        'retrive' => '/auth/tipo-usuario/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Auth_Model_Usuario',
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
          'type' => 'Text',
          'text' => 
          array (
            'css-width' => '192.5px',
            'maxlength' => '22',
            'id' => NULL,
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
      ),
      'codigo' => 
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'String',
        'length' => '8',
        'nullable' => true,
      ),
      'descricao' => 
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => true,
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Tipo de Usuário',
  ),
)
?>