<?php
return array (
  'table' => 
  array (
    'name' => 'cv_log_pedido',
    'alias' => 'log_pedido',
    'modelName' => 'log_pedido',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_log_pedido',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_LogPedido',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'message',
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
        'grid' => '/vendas/log-pedido/grid',
        'search' => '/vendas/log-pedido/seeker-search',
        'retrieve' => '/vendas/log-pedido/retrieve',
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
        'label' => 'Id.',
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
      'id_pedido' => 
      array (
        'label' => 'Pedido',
        'referenceMap' => true,
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
              'search' => 'numero',
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
              'grid' => '/vendas/pedido/grid',
              'search' => '/vendas/pedido/seeker-search',
              'retrieve' => '/vendas/pedido/retrieve',
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
      'dh_log' => 
      array (
        'label' => 'Inclusão',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'mensagem' => 
      array (
        'label' => 'Mensagem',
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
                'max' => 1000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1000',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '1000',
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
        'columnName' => 'id_pedido',
        'objectNameReference' => 'Vendas_Model_Pedido',
        'tableNameReference' => 'cv_pedido',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
    ),
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/vendas/log-pedido/retrieve',
        'insert' => '/vendas/log-pedido/insert',
        'update' => '/vendas/log-pedido/update',
        'delete' => '/vendas/log-pedido/delete',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Log de Processamento do Pedido',
  ),
)
?>