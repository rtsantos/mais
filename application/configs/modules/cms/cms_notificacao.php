<?php
return array (
  'table' => 
  array (
    'name' => 'cms_notificacao',
    'modelName' => 'notificacao',
    'schema' => 'php',
    'moduleName' => 'cms',
    'objectName' => 'Cms_Model_CmsNotificacao',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => '',
        'display' => '',
        'id' => 'id_usuario',
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
        'grid' => '/cms/cms-notificacao/grid',
        'search' => '/cms/cms-notificacao/seeker-search',
        'retrieve' => '/cms/cms-notificacao/retrieve',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'columns' => 
    array (
      'id_conteudo' => 
      array (
        'label' => 'Conteúdo',
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
      'id_usuario' => 
      array (
        'label' => 'Usuário',
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
      'id_maillist' => 
      array (
        'label' => 'E-Mail',
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
              'search' => 'mail_from',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '200px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/tools/maillist/grid',
              'search' => '/tools/maillist/seeker-search',
              'retrive' => '/tools/maillist/retrive',
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
        'columnName' => 'ID_MAILLIST',
        'objectNameReference' => 'Tools_Model_Maillist',
        'tableNameReference' => 'maillist',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_USUARIO',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_CONTEUDO',
        'objectNameReference' => 'Cms_Model_Conteudo',
        'tableNameReference' => 'cms_conteudo',
        'schemaNameReference' => 'php',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id_conteudo',
      1 => 'id_usuario',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Notificação',
  ),
)
?>