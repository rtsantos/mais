<?php
return array (
  'table' => 
  array (
    'name' => 'cv_pedido',
    'modelName' => 'pedido',
    'schema' => 'mais',
    'sequenceName' => 'sid_cv_pedido',
    'moduleName' => 'vendas',
    'objectName' => 'Vendas_Model_Pedido',
    'controllerName' => true,
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
      'numero' => 
      array (
        'label' => 'Número',
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
                'max' => 10,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '10',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '10',
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
                'max' => 2,
              ),
            ),
          ),
          'listOptions' => 
          array (
            'V' => 'Venda',
            'C' => 'Compra',
            'O' => 'Orçamento',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '2',
        'nullable' => false,
      ),
      'id_usu_inc' => 
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
              'grid' => '/auth/conta/grid/profile_key/usuario',
              'search' => '/auth/conta/seeker-search/profile_key/usuario',
              'retrieve' => '/auth/conta/retrieve/profile_key/usuario',
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
      'id_usu_alt' => 
      array (
        'label' => 'Usuário Alteração',
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
              'grid' => '/auth/conta/grid/profile_key/usuario',
              'search' => '/auth/conta/seeker-search/profile_key/usuario',
              'retrieve' => '/auth/conta/retrieve/profile_key/usuario',
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
              'grid' => '/ca/pessoa/grid/profile_key/empresa',
              'search' => '/ca/pessoa/seeker-search/profile_key/empresa',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/empresa',
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
      'id_funcionario' => 
      array (
        'label' => 'Funcionário',
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
              'grid' => '/ca/pessoa/grid/profile_key/funcionario',
              'search' => '/ca/pessoa/seeker-search/profile_key/funcionario',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/funcionario',
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
              'grid' => '/ca/pessoa/grid/profile_key/cliente',
              'search' => '/ca/pessoa/seeker-search/profile_key/cliente',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/cliente',
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
      'id_cont_cli_resp' => 
      array (
        'label' => 'Responsável',
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
              'grid' => '/ca/pessoa/grid/profile_key/cont_resp',
              'search' => '/ca/pessoa/seeker-search/profile_key/cont_resp',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/cont_resp',
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
      'id_cont_cli_vend' => 
      array (
        'label' => 'Vendedor',
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
              'grid' => '/ca/pessoa/grid/profile_key/cont_vend',
              'search' => '/ca/pessoa/seeker-search/profile_key/cont_vend',
              'retrieve' => '/ca/pessoa/retrieve/profile_key/cont_vend',
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
      'status' => 
      array (
        'label' => 'Situação',
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
            'A' => 'Aberto',
            'C' => 'Confirmado',
            'E' => 'Efetivado',
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
    ),
    'dependentTables' => 
    array (
      0 => 'Vendas_Model_ItemPedido',
      1 => 'Vendas_Model_Pagamento',
    ),
    'tabs' => 
    array (
      0 => 
      array (
        'description' => 'Itens do Pedido/Serviço',
        'url' => '/vendas/item-pedido/form/grid/1',
        'column' => 'id_pedido',
        'message' => 'Necessário seleção Pedido',
      ),
      1 => 
      array (
        'description' => 'Pagamento',
        'url' => '/vendas/pagamento/form/grid/1',
        'column' => 'id_pedido',
        'message' => 'Necessário seleção Pedido',
      ),
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'id_usu_inc',
        'objectNameReference' => 'Auth_Model_Conta',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_usu_alt',
        'objectNameReference' => 'Auth_Model_Conta',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
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
      3 => 
      array (
        'columnName' => 'id_funcionario',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      4 => 
      array (
        'columnName' => 'id_cliente',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      5 => 
      array (
        'columnName' => 'id_cont_cli_resp',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      6 => 
      array (
        'columnName' => 'id_cont_cli_vend',
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
      0 => 'tipo',
      1 => 'numero',
      2 => 'id_empresa',
    ),
    'description' => 'Pedido',
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/vendas/pedido/retrieve',
        'insert' => '/vendas/pedido/insert',
        'update' => '/vendas/pedido/update',
        'delete' => '/vendas/pedido/delete',
      ),
    ),
  ),
)
?>