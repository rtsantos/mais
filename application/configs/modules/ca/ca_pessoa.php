<?php
return array (
  'table' => 
  array (
    'name' => 'ca_pessoa',
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
             0 => 'Não'
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
    ),
    'dependentTables' => 
    array (
      0 => 'Ca_Model_Cargo',
      1 => 'Ca_Model_CaContrato',
      2 => 'Ca_Model_Pessoa',
      3 => 'Ca_Model_CaRegraContrato',
      4 => 'Ca_Model_CvPedido',
      5 => 'Ca_Model_CvProduto',
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
      0 => 'id_empresa',
      1 => 'nome',
      2 => 'apelido',
    ),
    'description' => 'Pessoa',
  ),
)
?>