<?php
return array (
  'table' => 
  array (
    'name' => 'cv_item_lanc',
    'modelName' => 'item_lanc',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_item_lanc',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_ItemLanc',
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
        'grid' => '/vendas/item-lanc/grid',
        'search' => '/vendas/item-lanc/seeker-search',
        'retrieve' => '/vendas/item-lanc/retrieve',
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
      'id_item_pedido' => 
      array (
        'label' => 'Item do Pedido',
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
              'search' => 'calculo',
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
              'grid' => '/vendas/item-pedido/grid',
              'search' => '/vendas/item-pedido/seeker-search',
              'retrieve' => '/vendas/item-pedido/retrieve',
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
          'required' => true,
        ),
        'length' => NULL,
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
        'columnName' => 'id_item_pedido',
        'objectNameReference' => 'Vendas_Model_ItemPedido',
        'tableNameReference' => 'cv_item_pedido',
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
        'retrieve' => '/vendas/item-lanc/retrieve',
        'insert' => '/vendas/item-lanc/insert',
        'update' => '/vendas/item-lanc/update',
        'delete' => '/vendas/item-lanc/delete',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Itens do Pedido com o Financeiro',
  ),
)
?>