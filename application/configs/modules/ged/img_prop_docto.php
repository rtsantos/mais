<?php
return array (
  'table' => 
  array (
    'name' => 'img_prop_docto',
    'modelName' => 'prop_docto',
    'schema' => 'image',
    'sequenceName' => 'sid_img_prop_docto',
    'moduleName' => 'ged',
    'objectName' => 'Ged_Model_PropDocto',
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
        'grid' => '/ged/prop-docto/grid',
        'search' => '/ged/prop-docto/seeker-search',
        'retrive' => '/ged/prop-docto/retrive',
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
            'maxlength' => 10,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_aplicacao' => 
      array (
        'label' => 'Aplicação',
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
              'search' => 'sigla_aplic_prouser',
              'display' => 'nome_aplic_prouser',
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
              'grid' => '/ged/aplicacao/grid',
              'search' => '/ged/aplicacao/seeker-search',
              'retrive' => '/ged/aplicacao/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
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
      'tabela' => 
      array (
        'label' => 'Tabela',
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
      'sql' => 
      array (
        'label' => 'SQL',
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
                'max' => 500,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Textarea',
          'textarea' => 
          array (
            'maxlength' => '500',
            'css-width' => '200px',
            'rows' => 5,
            'id' => NULL,
          ),
          'text' => 
          array (
            'maxlength' => '500',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '500',
        'nullable' => true,
      ),
      'config' => 
      array (
        'label' => 'Configuração',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
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
                'max' => 1000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1000',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '1000',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Ged_Model_ImgPropGeral',
      1 => 'Ged_Model_ImgPropSeeker',
      2 => 'Ged_Model_TipoDocto',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_APLICACAO',
        'objectNameReference' => 'Ged_Model_Aplicacao',
        'tableNameReference' => 'img_aplicacao',
        'schemaNameReference' => 'image',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Propriedade do Documento',
  ),
)
?>