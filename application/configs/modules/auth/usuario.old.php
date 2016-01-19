<?php
return array (
  'table' => 
  array (
    'name' => 'usuario',
    'schema' => 'prouser',
    'sequenceName' => 'sid_usuario',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_Usuario',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'login',
        'display' => 'nome',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '100px',
      ),
      'display' => 
      array (
        'css-width' => '170px',
      ),
      'url' => 
      array (
        'grid' => '/auth/usuario/grid',
        'search' => '/auth/usuario/seeker-search',
        'retrive' => '/auth/usuario/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Ca_Model_ContatoFilial',
      1 => 'Profile_Model_ObjectView',
      2 => 'Auth_Model_ClienteUsuario',
      3 => 'Auth_Model_RelUsuarioAprovador',
      4 => 'Auth_Model_RelCcustoUsuario',
      5 => 'Auth_Model_RelPostoAvancUsuario',
      6 => 'Auth_Model_Privilegio',
      7 => 'Auth_Model_WebSessaoAtiva',
      8 => 'Auth_Model_UsuarioPapel',
      9 => 'Auth_Model_Usuario',
      10 => 'Auth_Model_RelEmpresaUsuario',
      11 => 'Auth_Model_Perfilusuario',
      12 => 'Auth_Model_Historicousuario',
      13 => 'Auth_Model_RelFilialUsuario',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_PAPEL',
        'objectNameReference' => 'Auth_Model_Papel',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'IDFILIAL',
        'objectNameReference' => 'Ca_Model_Filial',
        'tableNameReference' => 'filial',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'IDEMPRESA',
        'objectNameReference' => 'Ca_Model_Empresa',
        'tableNameReference' => 'empresa',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'IDEMPRESADEF',
        'objectNameReference' => 'Ca_Model_Empresa',
        'tableNameReference' => 'empresa',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      4 => 
      array (
        'columnName' => 'IDTIPOUSUARIO',
        'objectNameReference' => 'Auth_Model_TipoUsuario',
        'tableNameReference' => 'tipo_usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      5 => 
      array (
        'columnName' => 'IDUSUARIORESP',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
    ),
    'columns' => 
    array (
      'id' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => '192.5px',
            'maxlength' => '22',
            'id' => NULL,
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
      ),
      'idtipousuario' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'size' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/tipo-usuario/grid',
              'search' => '/auth/tipo-usuario/seeker-search',
              'retrive' => '/auth/tipo-usuario/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Tipo de Usuário',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
        'referenceMap' => true,
      ),
      'login' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Login',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'senha' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
          'type' => 'Password',
          'text' => 
          array (
            'maxlength' => '10',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Senha',
        'multiple' => 0,
        'type' => 'String',
        'length' => '10',
        'nullable' => false,
      ),
      'nome' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'validadesenha' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'date' => 
          array (
            'css-width' => '120px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'type' => 'Date',
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Validade da Senha',
        'multiple' => 0,
        'type' => 'DATE',
        'length' => '7',
        'nullable' => true,
      ),
      'trocasenha' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            '' => '',
            'S' => 'Sim',
            'N' => 'Não',
          ),
          'type' => 'Select',
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
          'text' => 
          array (
            'maxlength' => '1',
          ),
        ),
        'label' => 'Troca Senha',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'dhtrocasenha' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'date' => 
          array (
            'css-width' => '150px',
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '80px',
          ),
          'type' => 'DateTime',
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Data da Troca da Senha',
        'multiple' => 0,
        'type' => 'DATE',
        'length' => '7',
        'nullable' => false,
      ),
      'expiracaosenha' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '22',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Dias para expiração',
        'multiple' => 0,
        'type' => 'Number',
        'length' => '22',
        'nullable' => true,
      ),
      'status' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            '' => '',
            'A' => 'Ativo',
            'I' => 'Inativo',
          ),
          'type' => 'Select',
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
          'text' => 
          array (
            'maxlength' => '1',
          ),
        ),
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'nerroslogin' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Número de erros no Login',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 2,
        'nullable' => false,
      ),
      'usuarioadmin' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            '' => '',
            'S' => 'Sim',
            'N' => 'Não',
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => '100px',
            'id' => NULL,
          ),
        ),
        'label' => 'Administrador',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'cgccpf' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 25,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'CNPJ Empresa',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'endereco' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Endereço',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => true,
      ),
      'telefone' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 25,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Telefone',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'email' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtolower',
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
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'E-Mail',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => true,
      ),
      'usuario' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 25,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Usuário de Inserção',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'datahora' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'date' => 
          array (
            'css-width' => '120px',
          ),
          'time' => 
          array (
            'css-width' => '80px',
          ),
          'type' => 'DateTime',
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Data de Inserção',
        'multiple' => 0,
        'type' => 'DATE',
        'length' => '7',
        'nullable' => false,
      ),
      'fax' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 25,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Fax',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'idpessoal' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Numeric',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'chapa',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '100px',
            ),
            'display' => 
            array (
              'css-width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/folha/pessoal/grid',
              'search' => '/folha/pessoal/seeker-search',
              'retrive' => '/folha/pessoal/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '10',
            'id' => NULL,
          ),
        ),
        'label' => 'Colaborador',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 10,
        'nullable' => true,
      ),
      'chapa' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 15,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Matrícula',
        'multiple' => 0,
        'type' => 'String',
        'length' => '10',
        'nullable' => true,
      ),
      'codccustodef' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 15,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Centro de Custo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '10',
        'nullable' => true,
      ),
      'codeof' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            'css-width' => 35,
            'id' => NULL,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Código EOF',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => true,
      ),
      'idempresa' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'search' => 'sigla',
              'display' => 'nome_pessoa',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/ca/empresa/grid',
              'search' => '/ca/empresa/seeker-search',
              'retrive' => '/ca/empresa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
            'relation' => 
            array (
              0 => 
              array (
                'moduleNameReference' => 'ca',
                'tableNameReference' => 'pessoa',
                'tableAliasReference' => 'pessoa',
                'columnNameReference' => 'id',
                'tableName' => 'empresa',
                'tableAlias' => 'idempresa',
                'columnName' => 'id_pessoa',
                'columnDisplay' => 
                array (
                  0 => 'nome',
                ),
              ),
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Empresa',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'idempresadef' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'search' => 'sigla',
              'display' => 'nome_pessoa',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/ca/empresa/grid',
              'search' => '/ca/empresa/seeker-search',
              'retrive' => '/ca/empresa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
            'relation' => 
            array (
              0 => 
              array (
                'moduleNameReference' => 'ca',
                'tableNameReference' => 'pessoa',
                'tableAliasReference' => 'pessoadef',
                'columnNameReference' => 'id',
                'tableName' => 'empresa',
                'tableAlias' => 'idempresadef',
                'columnName' => 'id_pessoa',
                'columnDisplay' => 
                array (
                  0 => 'nome',
                ),
              ),
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Empresa',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'idfilial' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'search' => 'sigla',
              'display' => 'nome_cidade',
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
              'grid' => '/ca/filial/grid',
              'search' => '/ca/filial/seeker-search',
              'retrive' => '/ca/filial/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Filial',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'idusuarioresp' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'search' => 'login',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '100px',
            ),
            'display' => 
            array (
              'css-width' => '170px',
            ),
            'url' => 
            array (
              'grid' => '/auth/usuario/grid',
              'search' => '/auth/usuario/seeker-search',
              'retrive' => '/auth/usuario/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Usuário Responsável',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'id_papel' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
              'size' => 40,
            ),
            'display' => 
            array (
              'size' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/papel/grid',
              'search' => '/auth/papel/seeker-search',
              'retrive' => '/auth/papel/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Papel',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
        'referenceMap' => true,
      ),
      'solic_info_adic' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
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
            '' => '',
            'S' => 'Sim',
            'N' => 'Não',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => 6,
            'id' => NULL,
          ),
          'required' => true,
          'filterDb' => 
          array (
            0 => '',
          ),
        ),
        'label' => 'Solic. Dados Adicionais',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'observacao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'validators' => 
          array (
            0 => 
            array (
              'name' => 'Zend_Validate_StringLength',
              'param' => 
              array (
                'max' => 500,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Textare',
          'textare' => 
          array (
            'maxlength' => '500',
            'cols' => 50,
            'rows' => 5,
          ),
          'required' => false,
          'filterDb' => 
          array (
            0 => '',
          ),
          'text' => 
          array (
            'maxlength' => '500',
            'css-width' => '200px',
            'id' => NULL,
          ),
        ),
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '500',
        'nullable' => true,
      ),
      'empresa' => 
      array (
        'label' => 'Empresa',
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
      'dh_ult_logon' => 
      array (
        'label' => 'Data/Hora Último Login',
        'multiple' => 0,
        'type' => 'DATE',
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
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
          ),
          'type' => 'DateTime',
          'time' => 
          array (
            'css-width' => '43.75px;',
            'maxlength' => 5,
          ),
          'required' => false,
        ),
        'length' => '7',
        'nullable' => true,
      ),
      'ntry' => 
      array (
        'label' => 'NTRY',
        'multiple' => 0,
        'type' => 'Number',
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
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => 2,
        'nullable' => true,
      ),
      'avatar' => 
      array (
        'label' => 'Avatar',
        'multiple' => 0,
        'type' => 'Number',
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
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '10',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Usuário',
  ),
)
?>