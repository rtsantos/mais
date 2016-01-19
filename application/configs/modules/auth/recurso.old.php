<?php
return array (
  'table' => 
  array (
    'name' => 'recurso',
    'schema' => 'prouser',
    'sequenceName' => 'sid_recurso',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_Recurso',
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
    'dependentTables' => 
    array (
      0 => 'Auth_Model_Recurso',
      1 => 'Auth_Model_PapelRecurso',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_TIPO_RECURSO',
        'objectNameReference' => 'Auth_Model_TipoRecurso',
        'tableNameReference' => 'tipo_recurso',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_RECURSO_PAI',
        'objectNameReference' => 'Auth_Model_Recurso',
        'tableNameReference' => 'recurso',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_APLICACAO',
        'objectNameReference' => 'Auth_Model_Aplicacao',
        'tableNameReference' => 'aplicacao',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
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
            'css-width' => 15,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtolower',
          ),
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'id_tipo_recurso' => 
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
              'css-width' => '270px',
            ),
            'display' => 
            array (
              'width' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/tipo-recurso/grid',
              'search' => '/auth/tipo-recurso/seeker-search',
              'retrive' => '/auth/tipo-recurso/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Tipo de Recurso',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'id_aplicacao' => 
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
              'search' => 'sigla',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'width' => '100px',
            ),
            'display' => 
            array (
              'width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/auth/aplicacao/grid',
              'search' => '/auth/aplicacao/seeker-search',
              'retrive' => '/auth/aplicacao/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Aplicação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'id_recurso_pai' => 
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
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Recurso Pai',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
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
                'max' => 80,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '80',
            'css-width' => '270px',
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtolower',
          ),
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '80',
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
            'css-width' => '270px',
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => true,
      ),
      'status' => 
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
            '' => '',
            'A' => 'Ativo',
            'I' => 'Inativo',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'size' => 6,
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'icone' => 
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
                'max' => 30,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '30',
            'size' => 35,
            'id' => NULL,
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Ícone',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => true,
      ),
      'observacao' => 
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
                'max' => 4000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Textare',
          'textare' => 
          array (
            'maxlength' => '4000',
            'cols' => 50,
            'rows' => 5,
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '4000',
        'nullable' => true,
      ),
      'ordem' => 
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
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '3',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Ordem',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 3,
        'nullable' => true,
      ),
      'nivel' => 
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
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Nível',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 2,
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
    'description' => 'Recurso',
  ),
)
?>