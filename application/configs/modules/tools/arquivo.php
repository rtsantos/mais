<?php
return array (
  'table' => 
  array (
    'name' => 'arquivo',
    'schema' => 'projta',
    'sequenceName' => 'sid_arquivo',
    'moduleName' => 'tools',
    'objectName' => 'Tools_Model_Arquivo',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'hashcode',
        'display' => '',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '200px',
      ),
      'display' => 
      array (
        'css-width' => '70px',
      ),
      'url' => 
      array (
        'grid' => '/tools/arquivo/grid',
        'search' => '/tools/arquivo/seeker-search',
        'retrive' => '/tools/arquivo/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Tools_Model_ConhecArquivo',
      1 => 'Tools_Model_DoctoFiscalArquivo',
      2 => 'Coleta_Model_ColetaArquivo',
      3 => 'Tools_Model_DoctoCobrancaArquivo',
      4 => 'Tools_Model_EdiPrefatArquivo',
      5 => 'Tools_Model_EdiArqReceb',
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
            'maxlength' => 10,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'tipo' => 
      array (
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
            1 => 'Texto',
            2 => 'XML',
            3 => 'FDF',
            4 => 'EMAIL',
            5 => 'PDF',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '1',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'label' => 'Tipo',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 1,
        'nullable' => false,
      ),
      'tempo_vida' => 
      array (
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
            'numInteger' => '4',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'label' => 'Tempo de Vida',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 4,
        'nullable' => false,
      ),
      'dh_inc' => 
      array (
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
          'required' => true,
        ),
        'label' => 'DH. Inc.',
        'multiple' => 0,
        'type' => 'DATE',
        'length' => '7',
        'nullable' => false,
      ),
      'hashcode' => 
      array (
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
                'max' => 32,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '32',
            'css-width' => 37,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Hashcode',
        'multiple' => 0,
        'type' => 'String',
        'length' => '32',
        'nullable' => true,
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
                'max' => 75,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '75',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Nome',
        'multiple' => 0,
        'type' => 'String',
        'length' => '75',
        'nullable' => false,
      ),
      'arq_clob' => 
      array (
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
          'type' => 'Textare',
          'textare' => 
          array (
            'id' => NULL,
            'cols' => 50,
            'rows' => 10,
          ),
          'required' => false,
        ),
        'label' => 'Arq. Clob',
        'multiple' => 0,
        'type' => 'StringLong',
        'length' => '4000',
        'nullable' => true,
      ),
      'chave_acesso' => 
      array (
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
                'max' => 44,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '44',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Chave Acesso',
        'multiple' => 0,
        'type' => 'String',
        'length' => '44',
        'nullable' => true,
      ),
      'arq_blob' => 
      array (
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
          'type' => 'File',
          'file' => 
          array (
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Arq Blob',
        'multiple' => 0,
        'type' => 'BinaryLong',
        'length' => '4000',
        'nullable' => true,
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'hashcode',
      1 => 'chave_acesso',
    ),
    'description' => 'Arquivo',
  ),
)
?>