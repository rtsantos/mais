<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_tipo_emissao',
    'modelName' => 'tipo_emissao',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_tipo_emissao',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_TipoEmissao',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'codigo',
        'display' => 'descricao',
        'id' => 'id',
      ),
      'search' => 
      array (
        'css-width' => '40px',
      ),
      'display' => 
      array (
        'css-width' => '230px',
      ),
      'url' => 
      array (
        'grid' => '/dfe/tipo-emissao/grid',
        'search' => '/dfe/tipo-emissao/seeker-search',
        'retrive' => '/dfe/tipo-emissao/retrive',
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
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Text',
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
        'length' => 10,
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
          ),
          'type' => 'Text',
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
      'descricao' => 
      array (
        'label' => 'Descrição',
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
          'required' => true,
        ),
        'length' => '30',
        'nullable' => false,
      ),
      'observacao' => 
      array (
        'label' => 'Observação',
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
                'max' => 200,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '200',
            'css-width' => '400px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '200',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Dfe_Model_DfeDocto',
    ),
    'referenceMaps' => 
    array (
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'codigo',
    ),
    'description' => 'Tipo de Emissão',
  ),
)
?>