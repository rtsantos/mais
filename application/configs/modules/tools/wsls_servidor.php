<?php
return array (
  'table' => 
  array (
    'name' => 'wsls_servidor',
    'modelName' => 'wsls_servidor',
    'schema' => 'projta',
    'sequenceName' => 'sid_wsls_servidor',
    'moduleName' => 'tools',
    'objectName' => 'Tools_Model_WslsServidor',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'ip',
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
        'grid' => '/tools/wsls-servidor/grid',
        'search' => '/tools/wsls-servidor/seeker-search',
        'retrive' => '/tools/wsls-servidor/retrive',
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
            'css-width' => 87.5,
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
      'ip' => 
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
                'max' => 15,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '15',
            'css-width' => 20,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'IP',
        'multiple' => 0,
        'type' => 'String',
        'length' => '15',
        'nullable' => false,
      ),
      'padrao' => 
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
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
        ),
        'label' => 'Padrão',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
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
            'A' => 'Ativo',
            'I' => 'Inativo',
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
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'id_filial' => 
      array (
        'referenceMap' => true,
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
              'search' => 'sigla',
              'display' => 'nome_cidade',
              'id' => 'id',
            ),
            'search' => 
            array (
              'size' => 5,
            ),
            'display' => 
            array (
              'size' => 30,
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
            'relation' => 
            array (
              0 => 
              array (
                'moduleNameReference' => 'ca',
                'tableNameReference' => 'cidade',
                'tableAliasReference' => 'cidade',
                'columnNameReference' => 'id',
                'tableName' => 'filial',
                'tableAlias' => 'filial',
                'columnName' => 'id_cidade',
                'columnDisplay' => 
                array (
                  0 => 'nome',
                ),
              ),
            ),
          ),
          'required' => true,
        ),
        'label' => 'Filial',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'id_posto_avancado' => 
      array (
        'referenceMap' => true,
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
              'css-width' => '200px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/ca/posto-avancado/grid',
              'search' => '/ca/posto-avancado/seeker-search',
              'retrive' => '/ca/posto-avancado/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'label' => 'Posto Avançado',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => true,
      ),
      'impressora_padrao' => 
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
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Impressora Padrão',
        'multiple' => 0,
        'type' => 'String',
        'length' => '40',
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
        'columnName' => 'ID_FILIAL',
        'objectNameReference' => 'Ca_Model_Filial',
        'tableNameReference' => 'filial',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_POSTO_AVANCADO',
        'objectNameReference' => 'Ca_Model_PostoAvancado',
        'tableNameReference' => 'posto_avancado',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'ip',
    ),
    'description' => 'Servidores de Impressão',
  ),
)
?>