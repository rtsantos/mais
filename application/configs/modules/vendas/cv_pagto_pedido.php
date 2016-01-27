<?php
return array (
  'table' => 
  array (
    'name' => 'cv_pagto_pedido',
    'modelName' => 'pagamento',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_pagto_pedido',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_Pagamento',
    'controllerName' => true,
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
      'forma' => 
      array (
        'label' => 'Forma de Pagamento',
        'multiple' => 0,
        'type' => 'String',
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
            'D' => 'Dinheiro',
            'O' => 'Crediário',
            'C' => 'Cartão',
            'Q' => 'Cheque',
            'F' => 'Faturar',
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
      'vlr_total' => 
      array (
        'label' => 'Valor Total',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => true,
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => '11.4',
        'nullable' => false,
      ),
      'vlr_pago' => 
      array (
        'label' => 'Valor Pago',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'vlr_desc' => 
      array (
        'label' => 'Desconto',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'vlr_acrec' => 
      array (
        'label' => 'Acréscimo',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'nro_parc' => 
      array (
        'label' => 'Número de Parcelas',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => NULL,
        'nullable' => true,
      ),
      'vlr_parc' => 
      array (
        'label' => 'Valor da Parcela',
        'multiple' => 0,
        'type' => 'Number',
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
          'required' => false,
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
        ),
        'length' => '11.4',
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
        'columnName' => 'id_pedido',
        'objectNameReference' => 'Vendas_Model_Pedido',
        'tableNameReference' => 'cv_pedido',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'id_pedido',
    ),
    'description' => 'Pagamento',
    'tabs' => NULL,
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/vendas/pagto-pedido/retrieve',
        'insert' => '/vendas/pagto-pedido/insert',
        'update' => '/vendas/pagto-pedido/update',
        'delete' => '/vendas/pagto-pedido/delete',
      ),
    ),
  ),
)
?>