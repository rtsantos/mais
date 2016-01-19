<?php
return array (
  'table' => 
  array (
    'name' => 'wf_fase',
    'schema' => 'projta',
    'sequenceName' => 'sid_wf_fase',
    'moduleName' => 'wf',
    'objectName' => 'Wf_Model_WfFase',
    'controllerName' => true,
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
    'dependentTables' => 
    array (
      0 => 'Wf_Model_WfTransacao',
      1 => 'Sales_Model_ClienteNegociacao',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_WF_PROCESSO',
        'objectNameReference' => 'Wf_Model_WfProcesso',
        'tableNameReference' => 'wf_processo',
        'schemaNameReference' => 'projta',
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
      'id_wf_processo' => 
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
          'required' => true,
        ),
        'label' => 'Processo',
        'multiple' => 0,
        'type' => 'Integer',
        'length' => 10,
        'nullable' => false,
      ),
      'valor' => 
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
            'css-width' => 7,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Valor',
        'multiple' => 0,
        'type' => 'String',
        'length' => '2',
        'nullable' => false,
      ),
      'descricao' => 
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
        ),
        'label' => 'Descrição',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
        'nullable' => false,
      ),
      'proc_prox_fase' => 
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
            'css-width' => 7,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Proxima Fase Processo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '2',
        'nullable' => false,
      ),
      'proc_prox_usuario' => 
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
        'label' => 'Proximo Usuário Processo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '60',
        'nullable' => false,
      ),
      'proc_notif' => 
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
          'required' => false,
        ),
        'label' => 'Notificação Processo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '50',
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
    'description' => 'Fase',
  ),
)
?>