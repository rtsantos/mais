<?php
return array (
  'table' => 
  array (
    'name' => 'cms_conteudo',
    'modelName' => 'conteudo',
    'schema' => 'php',
    'sequenceName' => 'sid_cms_conteudo',
    'moduleName' => 'cms',
    'objectName' => 'Cms_Model_Conteudo',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'titulo',
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
        'grid' => '/cms/conteudo/grid',
        'search' => '/cms/conteudo/seeker-search',
        'retrieve' => '/cms/conteudo/retrieve',
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
      'id_categoria' => 
      array (
        'label' => 'Categoria',
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
              'grid' => '/cms/categoria/grid',
              'search' => '/cms/categoria/seeker-search',
              'retrieve' => '/cms/categoria/retrieve',
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
      'id_conteudo_pai' => 
      array (
        'label' => 'Conteúdo Pai',
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
              'search' => 'titulo',
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
              'grid' => '/cms/conteudo/grid',
              'search' => '/cms/conteudo/seeker-search',
              'retrieve' => '/cms/conteudo/retrieve',
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
      'titulo' => 
      array (
        'label' => 'Título',
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
          'required' => true,
        ),
        'length' => '50',
        'nullable' => false,
      ),
      'sub_titulo' => 
      array (
        'label' => 'Subtítulo',
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
      'dh_ini_pub' => 
      array (
        'label' => 'Data/Hora início publicação',
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
      'dh_fim_pub' => 
      array (
        'label' => 'Data/Hora fim publicação',
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
          'required' => false,
        ),
        'length' => '7',
        'nullable' => true,
      ),
      'corpo' => 
      array (
        'label' => 'Corpo',
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
            'html' => false,
            'cols' => 50,
            'rows' => 10,
          ),
          'required' => false,
        ),
        'length' => '4000',
        'nullable' => true,
      ),
      'arquivo' => 
      array (
        'label' => 'Arquivo',
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
          'type' => 'Numeric',
          'file' => 
          array (
            'id' => NULL,
          ),
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '10',
            'id' => NULL,
          ),
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'thumbnail' => 
      array (
        'label' => 'Thumbnail',
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
          'type' => 'Numeric',
          'file' => 
          array (
            'id' => NULL,
          ),
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '10',
            'id' => NULL,
          ),
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'id_usuario_inc' => 
      array (
        'label' => 'Usuário Inclusão',
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
        'length' => 10,
        'nullable' => false,
      ),
      'id_status' => 
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
              'grid' => '/cms/status/grid',
              'search' => '/cms/status/seeker-search',
              'retrieve' => '/cms/status/retrieve',
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
      'publico' => 
      array (
        'label' => 'Público',
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
      'banner' => 
      array (
        'label' => 'Banner',
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
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'corpo_url' => 
      array (
        'label' => 'URL do Corpo',
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
                'max' => 200,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '200',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '200',
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
            0 => 'removeAccent',
            1 => 'strtolower',
            2 => 'trim',
            'replace' => 
            array (
              0 => 
              array (
                0 => ' ',
                1 => '\\',
                2 => '/',
                3 => '|',
              ),
              1 => '-',
            ),
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
          'required' => true,
        ),
        'length' => '100',
        'nullable' => false,
      ),
      'chave_macro' => 
      array (
        'label' => 'Macro de Geração de Chave',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtolower',
            1 => 'trim',
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
          'required' => true,
        ),
        'length' => '50',
        'nullable' => false,
      ),
      'id_usuario_aprov' => 
      array (
        'label' => 'Usuário Aprovador',
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
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'id_filial' => 
      array (
        'label' => 'Filial',
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
              'search' => 'sigla',
              'display' => 'nome_cidade',
              'id' => 'id',
            ),
            'search' => 
            array (
              'size' => 5,
            ),
            'display' => 
            array (
              'size' => 30,
            ),
            'url' => 
            array (
              'grid' => '/ca/filial/grid',
              'search' => '/ca/filial/seeker-search',
              'retrive' => '/ca/filial/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
            'relation' => 
            array (
              0 => 
              array (
                'moduleNameReference' => 'ca',
                'tableNameReference' => 'cidade',
                'tableAliasReference' => 'cidade',
                'columnNameReference' => 'id',
                'tableName' => 'filial',
                'tableAlias' => 'filial',
                'columnName' => 'id_cidade',
                'columnDisplay' => 
                array (
                  0 => 'nome',
                ),
              ),
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
      0 => 'Cms_Model_PrivConteudo',
      1 => 'Cms_Model_CmsNotificacao',
      2 => 'Cms_Model_Conteudo',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_USUARIO_APROV',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_FILIAL',
        'objectNameReference' => 'Ca_Model_Filial',
        'tableNameReference' => 'filial',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_CATEGORIA',
        'objectNameReference' => 'Cms_Model_Categoria',
        'tableNameReference' => 'cms_categoria',
        'schemaNameReference' => 'php',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'ID_USUARIO_INC',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      4 => 
      array (
        'columnName' => 'ID_STATUS',
        'objectNameReference' => 'Cms_Model_Status',
        'tableNameReference' => 'cms_status',
        'schemaNameReference' => 'php',
        'columnReference' => 'ID',
      ),
      5 => 
      array (
        'columnName' => 'ID_CONTEUDO_PAI',
        'objectNameReference' => 'Cms_Model_Conteudo',
        'tableNameReference' => 'cms_conteudo',
        'schemaNameReference' => 'php',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'id_categoria',
      1 => 'titulo',
      2 => 'id_conteudo_pai',
      3 => 'id_usuario_inc',
    ),
    'description' => 'Conteúdo',
  ),
)
?>