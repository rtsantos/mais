<?php
return array (
  'table' => 
  array (
    'name' => 'wf_transacao',
    'schema' => 'projta',
    'sequenceName' => 'sid_wf_transacao',
    'moduleName' => 'wf',
    'objectName' => 'Wf_Model_WfTransacao',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'observacao',
        'display' => '',
        'id' => 
        array (
        ),
      ),
      'search' => 
      array (
        'size' => 50,
      ),
      'display' => 
      array (
        'size' => 50,
      ),
      'url' => 
      array (
        'grid' => '/wf/wf-transacao/grid',
        'search' => '/wf/wf-transacao/seeker-search',
        'retrive' => '/wf/wf-transacao/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 400,
      ),
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_USUARIO_ALOC',
        'objectNameReference' => 'Auth_Model_Usuario',
        'tableNameReference' => 'usuario',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_WF_FASE',
        'objectNameReference' => 'Wf_Model_WfFase',
        'tableNameReference' => 'wf_fase',
        'schemaNameReference' => 'projta',
        'columnReference' => 'ID',
      ),
    ),
    'columns' => 
    array (
      'id_wf_fase' => 
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
              'search' => 'valor',
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
              'grid' => '/wf/wf-fase/grid',
              'search' => '/wf/wf-fase/seeker-search',
              'retrive' => '/wf/wf-fase/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'label' => 'id_wf_fase',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'id_objeto' => 
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
            'numInteger' => '10',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'label' => 'Objeto',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 10,
        'nullable' => false,
      ),
      'id_usuario_aloc' => 
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
          'required' => true,
        ),
        'label' => 'Usuário',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
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
        'label' => 'Inclusão',
        'multiple' => 0,
        'type' => 'DateTime',
        'length' => '7',
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
                'max' => 300,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Textare',
          'textare' => 
          array (
            'cols' => '50',
            'rows' => '4',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Observação',
        'multiple' => 0,
        'type' => 'String',
        'length' => '300',
        'nullable' => true,
      ),
    ),
    'primary' => 
    array (
        'id_wf_fase','id_objeto'
    ),
    'unique' => 
    array (
    ),
    'description' => 'Transação',
  ),
)
?>