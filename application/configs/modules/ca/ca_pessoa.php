<?php
return array (
  'table' => 
  array (
    'name' => 'ca_pessoa',
    'alias' => 'pessoa',
    'modelName' => 'pessoa',
    'schema' => 'mais',
    'sequenceName' => 'sid_ca_pessoa',
    'moduleName' => 'ca',
    'objectName' => 'Ca_Model_Pessoa',
    'controllerName' => true,
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
    'columns' => 
    array (
      'id' => 
      array (
        'label' => 'ID',
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
            'maxlength' => NULL,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
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
      'codigo' => 
      array (
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => 
          array (
            0 => '999.999.999-99',
            1 => '99.999.999/9999-99',
          ),
          'charMask' => '9',
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
      'email' => 
      array (
        'label' => 'E-Mail',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtolower',
            1 => 'removeAccent',
            2 => 'trim',
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
                'max' => 70,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '70',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '70',
        'nullable' => true,
      ),
      'id_pessoa_resp' => 
      array (
        'label' => 'Responsável',
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
          'required' => false,
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
        ),
        'length' => NULL,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'telefone' => 
      array (
        'label' => 'Telefone',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => '99 9999-9999',
          'charMask' => '9',
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
      'celular' => 
      array (
        'label' => 'Celular',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => 
          array (
            0 => '99 9999-9999',
            1 => '99 9.9999-9999',
          ),
          'charMask' => '9',
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
      'fax' => 
      array (
        'label' => 'Fax',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => '99 9999-9999',
          'charMask' => '9',
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
      'ed_logr' => 
      array (
        'label' => 'End. Logradouro',
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
      'ed_numero' => 
      array (
        'label' => 'End. Número',
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
                'max' => 30,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '30',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '30',
        'nullable' => true,
      ),
      'ed_compl' => 
      array (
        'label' => 'End. Complemento',
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
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'ed_bairro' => 
      array (
        'label' => 'End. Bairro',
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
          'required' => false,
        ),
        'length' => '50',
        'nullable' => true,
      ),
      'ed_cidade' => 
      array (
        'label' => 'End. Cidade',
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
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'ed_estado' => 
      array (
        'label' => 'End. Estado',
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
                'max' => 2,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '2',
        'nullable' => true,
      ),
      'ed_cep' => 
      array (
        'label' => 'End. CEP',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => '99.999-999',
          'charMask' => '9',
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
          'required' => false,
        ),
        'length' => '10',
        'nullable' => true,
      ),
      'ed_cob_logr' => 
      array (
        'label' => 'End. Cobrança Logradouro',
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
      'ed_cob_numero' => 
      array (
        'label' => 'End. Cobrança Número',
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
                'max' => 30,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '30',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '30',
        'nullable' => true,
      ),
      'ed_cob_compl' => 
      array (
        'label' => 'End. Cobrança Complemento',
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
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'ed_cob_bairro' => 
      array (
        'label' => 'End. Cobrança Bairro',
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
          'required' => false,
        ),
        'length' => '50',
        'nullable' => true,
      ),
      'ed_cob_cidade' => 
      array (
        'label' => 'End. Cobrança Cidade',
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
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'ed_cob_estado' => 
      array (
        'label' => 'End. Cobrança Estado',
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
                'max' => 2,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '2',
        'nullable' => true,
      ),
      'ed_cob_cep' => 
      array (
        'label' => 'End. Cobrança CEP',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => '99.999-999',
          'charMask' => '9',
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
          'required' => false,
        ),
        'length' => '10',
        'nullable' => true,
      ),
      'papel_cliente' => 
      array (
        'label' => 'Papel de Cliente',
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
            1 => 'Sim',
            0 => 'Não',
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
      'papel_funcionario' => 
      array (
        'label' => 'Papel de Funcionário',
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
            1 => 'Sim',
            0 => 'Não',
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
      'papel_usuario' => 
      array (
        'label' => 'Papel de Usuário',
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
            1 => 'Sim',
            0 => 'Não',
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
      'papel_empresa' => 
      array (
        'label' => 'Papel de Empresa',
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
            1 => 'Sim',
            0 => 'Não',
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
      'registro' => 
      array (
        'label' => 'Registro',
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
      'id_empresa' => 
      array (
        'label' => 'Registro da Empresa',
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
      'email_cob' => 
      array (
        'label' => 'E-Mail de Cobrança',
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
          'required' => false,
        ),
        'length' => '60',
        'nullable' => true,
      ),
      'hierarquia' => 
      array (
        'label' => 'Hierarquia',
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
                'max' => 150,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '150',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '150',
        'nullable' => true,
      ),
      'papel_contato' => 
      array (
        'label' => 'Papel de Contato',
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
            1 => 'Sim',
            0 => 'Não',
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
      'id_cargo' => 
      array (
        'label' => 'Cargo',
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
              'grid' => '/ca/cargo/grid',
              'search' => '/ca/cargo/seeker-search',
              'retrieve' => '/ca/cargo/retrieve',
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
      'papel_fornecedor' => 
      array (
        'label' => 'Fornecedor',
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
            1 => 'Sim',
            0 => 'Não',
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
      'id_endereco' => 
      array (
        'label' => 'Endereço',
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
              'search' => 'logradouro',
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
              'grid' => '/ca/endereco/grid',
              'search' => '/ca/endereco/seeker-search',
              'retrieve' => '/ca/endereco/retrieve',
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
      'id_endereco_cob' => 
      array (
        'label' => 'Endereço de Cobrança',
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
              'search' => 'logradouro',
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
              'grid' => '/ca/endereco/grid',
              'search' => '/ca/endereco/seeker-search',
              'retrieve' => '/ca/endereco/retrieve',
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
      'id_banco' => 
      array (
        'label' => 'Banco',
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
              'grid' => '/financeiro/banco/grid',
              'search' => '/financeiro/banco/seeker-search',
              'retrieve' => '/financeiro/banco/retrieve',
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
      'ag_banco' => 
      array (
        'label' => 'Agência do Banco',
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
          'required' => false,
        ),
        'length' => '10',
        'nullable' => true,
      ),
      'ag_dig_banco' => 
      array (
        'label' => 'Dígito da Agência do Banco',
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
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '2',
        'nullable' => true,
      ),
      'conta_banco' => 
      array (
        'label' => 'Conta do Banco',
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
      'conta_dig_banco' => 
      array (
        'label' => 'Dígito da Conta do Banco',
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
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '2',
        'nullable' => true,
      ),
      'cod_tit_banco' => 
      array (
        'label' => 'Titulo da Conta',
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
    ),
    'dependentTables' => 
    array (
      0 => 'Auth_Model_Conta',
      1 => 'Auth_Model_ContaEmpresa',
      2 => 'Ca_Model_Cargo',
      3 => 'Ca_Model_Contrato',
      4 => 'Ca_Model_Endereco',
      5 => 'Ca_Model_Numeracao',
      6 => 'Ca_Model_Pessoa',
      7 => 'Ca_Model_RegraContrato',
      8 => 'Vendas_Model_FormaPagamento',
      9 => 'Vendas_Model_Parcela',
      10 => 'Vendas_Model_Pedido',
      11 => 'Vendas_Model_Produto',
      12 => 'Financeiro_Model_Banco',
      13 => 'Financeiro_Model_Lancamento',
      14 => 'Frota_Model_Marca',
      15 => 'Frota_Model_Modelo',
      16 => 'Frota_Model_Veiculo',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'id_pessoa_resp',
        'objectNameReference' => 'Ca_Model_Pessoa',
        'tableNameReference' => 'ca_pessoa',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      1 => 
      array (
        'columnName' => 'id_cargo',
        'objectNameReference' => 'Ca_Model_Cargo',
        'tableNameReference' => 'ca_cargo',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      2 => 
      array (
        'columnName' => 'id_endereco',
        'objectNameReference' => 'Ca_Model_Endereco',
        'tableNameReference' => 'ca_endereco',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      3 => 
      array (
        'columnName' => 'id_endereco_cob',
        'objectNameReference' => 'Ca_Model_Endereco',
        'tableNameReference' => 'ca_endereco',
        'schemaNameReference' => 'mais',
        'columnReference' => 'id',
      ),
      4 => 
      array (
        'columnName' => 'id_banco',
        'objectNameReference' => 'Financeiro_Model_Banco',
        'tableNameReference' => 'fc_banco',
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
      0 => 'id_empresa',
      1 => 'nome',
      2 => 'codigo',
    ),
    'description' => 'Pessoa',
    'tabs' => 
    array (
      'at_papel' => 
      array (
        'description' => 'Conta',
        'url' => '/auth/conta/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'at_papel_empresa' => 
      array (
        'description' => 'Empresas do Usuário',
        'url' => '/auth/conta-empresa/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_cargo' => 
      array (
        'description' => 'ca_cargo',
        'url' => '/ca/cargo/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_contrato' => 
      array (
        'description' => 'Contrato',
        'url' => '/ca/contrato/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_endereco' => 
      array (
        'description' => 'Endereço',
        'url' => '/ca/endereco/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_numeracao' => 
      array (
        'description' => 'Numeração',
        'url' => '/ca/numeracao/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_pessoa' => 
      array (
        'description' => 'Pessoa',
        'url' => '/ca/pessoa/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'ca_regra_contrato' => 
      array (
        'description' => 'Regras do Contrato',
        'url' => '/ca/regra-contrato/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'cv_forma_pagto' => 
      array (
        'description' => 'Forma de Pagamento',
        'url' => '/vendas/forma-pagamento/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'cv_parcela' => 
      array (
        'description' => 'Parcelas',
        'url' => '/vendas/parcela/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'cv_pedido' => 
      array (
        'description' => 'Pedido',
        'url' => '/vendas/pedido/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'cv_produto' => 
      array (
        'description' => 'Produto/Serviço',
        'url' => '/vendas/produto/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'fc_banco' => 
      array (
        'description' => 'Banco',
        'url' => '/financeiro/banco/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'fc_lancamento' => 
      array (
        'description' => 'Lançamento',
        'url' => '/financeiro/lancamento/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'fr_marca' => 
      array (
        'description' => 'Marca',
        'url' => '/frota/marca/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'fr_modelo' => 
      array (
        'description' => 'Modelo',
        'url' => '/frota/modelo/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
      'fr_veiculo' => 
      array (
        'description' => 'Veículo',
        'url' => '/frota/veiculo/form/grid/1',
        'column' => '',
        'message' => 'Necessário seleção Pessoa',
      ),
    ),
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/ca/pessoa/retrieve',
        'insert' => '/ca/pessoa/insert',
        'update' => '/ca/pessoa/update',
        'delete' => '/ca/pessoa/delete',
      ),
    ),
  ),
)
?>