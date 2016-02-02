<?php
return array (
  'table' => 
  array (
    'name' => 'cv_pagto_lanc',
    'modelName' => 'pagto_lanc',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_pagto_lanc',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_PagtoLanc',
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
        'grid' => '/vendas/pagto-lanc/grid',
        'search' => '/vendas/pagto-lanc/seeker-search',
        'retrieve' => '/vendas/pagto-lanc/retrieve',
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
      'id_pagto_pedido' => 
      array (
        'label' => 'Pagamento',
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
              'search' => 'forma',
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
              'grid' => '/vendas/pagamento/grid',
              'search' => '/vendas/pagamento/seeker-search',
              'retrieve' => '/vendas/pagamento/retrieve',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => NULL,
        'nullable' => true,
      ),
      'id_lancamento' => 
      array (
        'label' => 'Lançamento',
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
              'search' => 'tipo',
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
              'grid' => '/financeiro/lancamento/grid',
              'search' => '/financeiro/lancamento/seeker-search',
              'retrieve' => '/financeiro/lancamento/retrieve',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => NULL,
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
        'columnName' => 'id_pagto_pedido',
        'objectNameReference' => 'Vendas_Model_Pagamento',
        'tableNameReference' => 'cv_pagto_pedido',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_lancamento',
        'objectNameReference' => 'Financeiro_Model_Lancamento',
        'tableNameReference' => 'fc_lancamento',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
    ),
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/vendas/pagto-lanc/retrieve',
        'insert' => '/vendas/pagto-lanc/insert',
        'update' => '/vendas/pagto-lanc/update',
        'delete' => '/vendas/pagto-lanc/delete',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
       'id_pagto_pedido','id_lancamento'
    ),
    'description' => 'Lançamentos do Pagamento',
  ),
)
?>