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
      'per_acre' => 
      array (
        'label' => '% de Acréscimo',
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
      'vlr_a_pagar' => 
      array (
        'label' => 'Valor a Pagar',
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
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'per_desc' => 
      array (
        'label' => '% de Desconto',
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
          'numeric' => 
          array (
            'numDecimal' => '4',
            'numInteger' => '11',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => '11.4',
        'nullable' => true,
      ),
      'nro_comprov' => 
      array (
        'label' => 'Número de Comprovante',
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => '175px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '20',
        'nullable' => true,
      ),
      'id_forma_pagto' => 
      array (
        'label' => 'Forma de Pagamento',
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
              'grid' => '/vendas/forma-pagamento/grid',
              'search' => '/vendas/forma-pagamento/seeker-search',
              'retrieve' => '/vendas/forma-pagamento/retrieve',
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
      'id_parcela' => 
      array (
        'label' => 'Parcelas',
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
              'grid' => '/vendas/parcela/grid',
              'search' => '/vendas/parcela/seeker-search',
              'retrieve' => '/vendas/parcela/retrieve',
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
      'dt_venc_parc' => 
      array (
        'label' => 'Data de Vencimento',
        'multiple' => 0,
        'type' => 'Date',
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
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'type' => 'Date',
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
        'columnName' => 'id_pedido',
        'objectNameReference' => 'Vendas_Model_Pedido',
        'tableNameReference' => 'cv_pedido',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_forma_pagto',
        'objectNameReference' => 'Vendas_Model_FormaPagamento',
        'tableNameReference' => 'cv_forma_pagto',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      2 => 
      array (
        'columnName' => 'id_parcela',
        'objectNameReference' => 'Vendas_Model_Parcela',
        'tableNameReference' => 'cv_parcela',
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
    ),
    'description' => 'Pagamento',
    'tabs' => NULL,
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/vendas/pagamento/retrieve',
        'insert' => '/vendas/pagamento/insert',
        'update' => '/vendas/pagamento/update',
        'delete' => '/vendas/pagamento/delete',
      ),
    ),
  ),
)
?>