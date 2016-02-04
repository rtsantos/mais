<?php
return array (
  'table' => 
  array (
    'name' => 'profile_object_view',
    'modelName' => 'object_view',
    'schema' => 'prouser',
    'sequenceName' => 'sid_profile_object_view',
    'moduleName' => 'profile',
    'objectName' => 'Profile_Model_ObjectView',
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
            'maxlength' => NULL,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'tipo' => 
      array (
        'label' => 'Tipo',
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
            'F' => 'Formulário',
            'G' => 'Tabela',
            'C' => 'Gráfico Dinâmico',
            'D' => 'Tabela Dinâmica',
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
      'padrao' => 
      array (
        'label' => 'Visão Padrão',
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
            'S' => 'Sim',
            'N' => 'Não',
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
      'nome' => 
      array (
        'label' => 'Nome da Visão',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
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
      'objeto' => 
      array (
        'label' => 'Nome do Objeto',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
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
      'observacao' => 
      array (
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
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
                'max' => 4000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '4000',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '4000',
        'nullable' => true,
      ),
      'config' => 
      array (
        'label' => 'Configuração',
        'multiple' => 0,
        'type' => 'text',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
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
        'length' => NULL,
        'nullable' => true,
      ),
      'id_usuario' => 
      array (
        'label' => 'Usuário Criador',
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
              'search' => 'login',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '100px',
            ),
            'display' => 
            array (
              'css-width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/auth/usuario/grid',
              'search' => '/auth/usuario/seeker-search',
              'retrive' => '/auth/usuario/retrive',
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
      'uri' => 
      array (
        'label' => 'URI',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
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
        'length' => '100',
        'nullable' => true,
      ),
      'chave' => 
      array (
        'label' => 'Chave',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim'
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
                'max' => 40,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '40',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '40',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Profile_Model_Job',
      1 => 'Profile_Model_ObjectViewPriv',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'id_usuario',
        'objectNameReference' => 'Auth_Model_Conta',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'id',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'objeto',
      1 => 'id_usuario',
      2 => 'nome',
    ),
    'description' => 'Configuração de Visão',
  ),
)
?>