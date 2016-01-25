<?php
return array (
  'table' => 
  array (
    'name' => 'cv_produto',
    'modelName' => 'produto',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_produto',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_Produto',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'codigo',
        'display' => 'nome',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '70px',
      ),
      'display' => 
      array (
        'css-width' => '200px',
      ),
      'url' => 
      array (
        'grid' => '/vendas/produto/grid',
        'search' => '/vendas/produto/seeker-search',
        'retrieve' => '/vendas/produto/retrieve',
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
      'codigo' => 
      array (
        'label' => 'Código',
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
      'nome' => 
      array (
        'label' => 'Nome',
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
            'S' => 'Serviço',
            'P' => 'Produto',
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
      'apelido' => 
      array (
        'label' => 'Apelido',
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
                'max' => 45,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '45',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '45',
        'nullable' => true,
      ),
      'vlr_venda' => 
      array (
        'label' => 'Valor de Venda',
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
      'vlr_compra' => 
      array (
        'label' => 'Valor de Compra',
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
      'medida' => 
      array (
        'label' => 'Medida',
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
            'Q' => 'Quantidade',
            'M' => 'Metro',
            'K' => 'Kilo',
            'L' => 'Litro',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '1',
        'nullable' => true,
      ),
      'qtd_estoque' => 
      array (
        'label' => 'Qtd. em Estoque',
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
      'id_cliente' => 
      array (
        'label' => 'Cliente',
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
              'grid' => '/ca/pessoa/grid',
              'search' => '/ca/pessoa/seeker-search',
              'retrieve' => '/ca/pessoa/retrieve',
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
      'id_produto_resp' => 
      array (
        'label' => 'Produto Pai',
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
              'search' => 'codigo',
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
              'grid' => '/vendas/produto/grid',
              'search' => '/vendas/produto/seeker-search',
              'retrieve' => '/vendas/produto/retrieve',
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
      'id_empresa' => 
      array (
        'label' => 'Empresa',
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
              'grid' => '/ca/pessoa/grid',
              'search' => '/ca/pessoa/seeker-search',
              'retrieve' => '/ca/pessoa/retrieve',
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
      0 => 'Ca_Model_RegraContrato',
      1 => 'Vendas_Model_ItemPedido',
      2 => 'Vendas_Model_Produto',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'id_cliente',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_produto_resp',
        'objectNameReference' => 'Vendas_Model_Produto',
        'tableNameReference' => 'cv_produto',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      2 => 
      array (
        'columnName' => 'id_empresa',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
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
      0 => 'codigo',
      1 => 'id_empresa',
    ),
    'description' => 'Produto/Serviço',
    'tabs' => 
    array (
      0 => 
      array (
        'description' => 'Regras do Contrato',
        'url' => '/ca/regra-contrato/grid',
        'column' => 'id_produto',
        'message' => 'Necessário seleção Produto/Serviço',
      ),
      1 => 
      array (
        'description' => 'Itens do Pedido/Serviço',
        'url' => '/vendas/item-pedido/grid',
        'column' => 'id_produto',
        'message' => 'Necessário seleção Produto/Serviço',
      ),
      2 => 
      array (
        'description' => 'Produto/Serviço',
        'url' => '/vendas/produto/grid',
        'column' => 'id_produto_resp',
        'message' => 'Necessário seleção Produto/Serviço',
      ),
    ),
  ),
)
?>