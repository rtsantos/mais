<?php
return array (
  'table' => 
  array (
    'name' => 'wf_processo',
    'schema' => 'projta',
    'sequenceName' => 'sid_wf_processo',
    'moduleName' => 'wf',
    'objectName' => 'Wf_Model_WfProcesso',
    'controllerName' => true,
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
        'size' => 40,
      ),
      'display' => 
      array (
        'size' => 50,
      ),
      'url' => 
      array (
        'grid' => '/wf/wf-processo/grid',
        'search' => '/wf/wf-processo/seeker-search',
        'retrive' => '/wf/wf-processo/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 400,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Wf_Model_WfFase',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_APLICACAO',
        'objectNameReference' => 'Auth_Model_Aplicacao',
        'tableNameReference' => 'aplicacao',
        'schemaNameReference' => 'auth',
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
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'size' => 27,
            'maxlength' => '22',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Identificação',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => '22',
        'nullable' => false,
      ),
      'descricao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
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
            'size' => 40,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => true,
      ),
      'id_aplicacao' => 
      array (
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'validators' => 
          array (
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Seeker',
          'seeker' => 
          array (
            'search' => 
            array (
              'css-width' => '100',
            ),
            'display' => 
            array (
              'css-width' => '170',
            ),
            'field' => 
            array (
              'id' => 'id',
              'search' => 'sigla',
              'display' => 'nome',
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
              'height' => 360,
            ),
          ),
          'required' => false,
        ),
        'label' => 'Aplicação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
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
    'description' => 'Processo',
  ),
)
?>