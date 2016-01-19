<?php
return array (
  'table' => 
  array (
    'name' => 'aplicacao',
    'schema' => 'prouser',
    'sequenceName' => 'sid_aplicacao',
    'moduleName' => 'auth',
    'objectName' => 'Auth_Model_Aplicacao',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'sigla',
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
        'grid' => '/auth/aplicacao/grid',
        'search' => '/auth/aplicacao/seeker-search',
        'retrive' => '/auth/aplicacao/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 400,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Auth_Model_Menu',
      1 => 'Auth_Model_Tela',
      2 => 'Auth_Model_MenuAplic',
      3 => 'Auth_Model_Recurso',
      4 => 'Auth_Model_Objeto',
      5 => 'Auth_Model_RelUsuarioAprovador',
      6 => 'Auth_Model_ControleVersao',
      7 => 'Auth_Model_Logacesso',
      8 => 'Auth_Model_Operacao',
      9 => 'Auth_Model_Perfil',
      10 => 'Auth_Model_Privilegio',
      11 => 'Auth_Model_WebSessaoAtiva',
    ),
    'referenceMaps' => 
    array (
    ),
    'columns' => 
    array (
      'id' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'css-width' => 27,
            'maxlength' => '22',
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Código',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
      ),
      'sigla' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Sigla',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => false,
      ),
      'nome' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'validators' => 
          array (
            0 => 
            array (
              'name' => 'Zend_Validate_StringLength',
              'param' => 
              array (
                'max' => 40,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '40',
            'css-width' => '300px',
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
          ),
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '40',
        'nullable' => false,
      ),
      'status' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'P' => 'Produção',
            'T' => 'Teste',
            'V' => 'Homologação',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => '61px;',
            'id' => NULL,
          ),
          'required' => true,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'CHAR',
        'length' => '1',
        'nullable' => false,
      ),
      'observacao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'css-width' => '300px',
            'id' => NULL,
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
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
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '80px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'type' => 'DateTime',
          'required' => true,
        ),
        'label' => 'Data de Cadastro',
        'multiple' => 0,
        'type' => 'Date',
        'length' => '7',
        'nullable' => false,
      ),
      'schema' => 
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
        ),
        'label' => 'Schema',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Password',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => 25,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Senha',
        'multiple' => 0,
        'type' => 'String',
        'length' => '20',
        'nullable' => true,
      ),
      'webapp' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
          'listOptions' => 
          array (
            '' => '',
            'S' => 'Sim',
            'N' => 'Não',
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
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => 6,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Aplicação Web',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'area' => 
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
            'A' => 'Administrativo',
            'T' => 'Terceiro',
            'P' => 'Portal',
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => 6,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Área',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => true,
      ),
      'icone' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'css-width' => '262px',
            'id' => NULL,
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Ícone',
        'multiple' => 0,
        'type' => 'String',
        'length' => '30',
        'nullable' => true,
      ),
      'url' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
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
            'css-width' => '300px',
            'id' => NULL,
          ),
          'required' => false,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'strtoupper',
          ),
        ),
        'label' => 'Url',
        'multiple' => 0,
        'type' => 'String',
        'length' => '150',
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
    'description' => 'Aplicação',
  ),
)
?>