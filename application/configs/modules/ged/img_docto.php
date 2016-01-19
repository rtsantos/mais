<?php
return array (
  'table' => 
  array (
    'name' => 'img_docto',
    'modelName' => 'docto',
    'schema' => 'image',
    'sequenceName' => 'sid_img_docto',
    'moduleName' => 'ged',
    'objectName' => 'Ged_Model_Docto',
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
        'css-width' => '0px',
      ),
      'url' => 
      array (
        'grid' => '/ged/docto/grid',
        'search' => '/ged/docto/seeker-search',
        'retrive' => '/ged/docto/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
      'relation' => 
      array (
        0 => 
        array (
          'moduleNameReference' => 'ged',
          'tableNameReference' => 'img_arquivo',
          'tableAliasReference' => 'arquivo',
          'columnNameReference' => 'id',
          'tableName' => 'img_docto',
          'tableAlias' => 'img_docto',
          'columnName' => 'id_arquivo',
          'columnDisplay' => 
          array (
            0 => 'conteudo',
            1 => 'conteudo_type',
            2 => 'conteudo_name',
          ),
        ),
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
      'id_tipo_docto' => 
      array (
        'label' => 'Tipo do Documento',
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
              'grid' => '/ged/tipo-docto/grid',
              'search' => '/ged/tipo-docto/seeker-search',
              'retrive' => '/ged/tipo-docto/retrive',
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
      'id_prop_relac' => 
      array (
        'label' => 'ID Relacionado',
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
            'numInteger' => '10',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'dh_inclusao' => 
      array (
        'label' => 'Data e Hora de Inclusão',
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
          'required' => true,
        ),
        'length' => '7',
        'nullable' => false,
      ),
      'id_usu_incl' => 
        array(
            'object' =>
            array(
                'mask' => NULL,
                'charMask' => '@',
                'filter' =>
                array(
                    0 => 'strtoupper',
                    1 => 'removeAccent',
                ),
                'filterDb' =>
                array(
                    0 => '',
                ),
                'validators' =>
                array(
                ),
                'listOptions' =>
                array(
                ),
                'type' => 'Seeker',
                'seeker' =>
                array(
                    'search' =>
                    array(
                        'css-width' => '70px',
                    ),
                    'display' =>
                    array(
                        'css-width' => '200px',
                    ),
                    'field' =>
                    array(
                        'search' => 'login',
                        'display' => 'nome',
                        'id' => 'id',
                    ),
                    'url' =>
                    array(
                        'grid' => '/auth/usuario/grid',
                        'search' => '/auth/usuario/seeker-search',
                        'retrive' => '/auth/usuario/retrive',
                    ),
                    'modal' =>
                    array(
                        'width' => 800,
                        'height' => 450,
                    ),
                ),
                'required' => false,
            ),
            'label' => 'Usuário',
            'multiple' => 0,
            'type' => 'Integer',
            'length' => 10,
            'nullable' => true,
        ),
      'descricao' => 
      array (
        'label' => 'Descrição',
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
      'id_arquivo' => 
      array (
        'label' => 'Arquivo',
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
              'search' => 'conteudo_name',
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
              'grid' => '/ged/arquivo/grid',
              'search' => '/ged/arquivo/seeker-search',
              'retrive' => '/ged/arquivo/retrive',
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
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_TIPO_DOCTO',
        'objectNameReference' => 'Ged_Model_TipoDocto',
        'tableNameReference' => 'img_tipo_docto',
        'schemaNameReference' => 'image',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_ARQUIVO',
        'objectNameReference' => 'Ged_Model_Arquivo',
        'tableNameReference' => 'img_arquivo',
        'schemaNameReference' => 'image',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_USU_INCL',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
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
    ),
    'description' => 'Documento',
  ),
)
?>