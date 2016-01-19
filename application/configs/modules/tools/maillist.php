<?php
return array (
  'table' => 
  array (
    'name' => 'maillist',
    'schema' => 'projta',
    'sequenceName' => 'sid_maillist',
    'moduleName' => 'tools',
    'objectName' => 'Tools_Model_Maillist',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'mail_from',
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
        'grid' => '/tools/maillist/grid',
        'search' => '/tools/maillist/seeker-search',
        'retrive' => '/tools/maillist/retrive',
      ),
      'modal' => 
      array (
        'width' => 800,
        'height' => 450,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Tools_Model_AcrMaillist',
      1 => 'Tools_Model_EdiArqMaillist',
      2 => 'Tools_Model_PendenciaMaillist',
      3 => 'Tools_Model_ItemEventoEmailDiaria',
      4 => 'Tools_Model_FaturaAvisoMaillist',
      5 => 'Tools_Model_ColetaMaillist',
      6 => 'Tools_Model_CvoFormularioMaillist',
      7 => 'Tools_Model_Maillisthist',
      8 => 'Tools_Model_ConhecMaillist',
      9 => 'Tools_Model_ControleEntregaMaillist',
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
      'mail_from' => 
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
          'required' => true,
        ),
        'label' => 'De',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => false,
      ),
      'mail_to' => 
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
                'max' => 2000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '2000',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Para',
        'multiple' => 0,
        'type' => 'String',
        'length' => '2000',
        'nullable' => false,
      ),
      'mail_subject' => 
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
          'required' => true,
        ),
        'label' => 'Assunto',
        'multiple' => 0,
        'type' => 'String',
        'length' => '150',
        'nullable' => false,
      ),
      'mail_cc' => 
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
                'max' => 1500,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1500',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Cópia',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1500',
        'nullable' => true,
      ),
      'mail_bcc' => 
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
                'max' => 1500,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1500',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Cópia Oculta',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1500',
        'nullable' => true,
      ),
      'mail_alert' => 
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
        'label' => 'Alerta',
        'multiple' => 0,
        'type' => 'String',
        'length' => '100',
        'nullable' => true,
      ),
      'send_alert' => 
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
            '' => '',
            'N' => 'Não',
            'S' => 'Sim',
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
        'label' => 'Envia Alerta',
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
            '' => '',
            'S' => 'S',
            'E' => 'E',
            'N' => 'N',
            'Z' => 'Z',
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
        'label' => 'Status',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'html' => 
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
            '' => '',
            'N' => 'Não',
            'S' => 'Sim',
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
        'label' => 'Html',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'ntry' => 
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
            'numInteger' => '3',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'label' => 'Tentativas(ntry)',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 3,
        'nullable' => true,
      ),
      'life_time' => 
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
          'required' => false,
        ),
        'label' => 'Tempo de Vida',
        'multiple' => 0,
        'type' => 'Number',
        'length' => 4,
        'nullable' => true,
      ),
      'dh_send' => 
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
          'required' => false,
        ),
        'label' => 'Envio',
        'multiple' => 0,
        'type' => 'DateTime',
        'length' => '7',
        'nullable' => true,
      ),
      'dh_request' => 
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
        'label' => 'Requisição',
        'multiple' => 0,
        'type' => 'DateTime',
        'length' => '7',
        'nullable' => false,
      ),
      'discard_attachment' => 
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
            '' => '',
            'N' => 'Não',
            'S' => 'Sim',
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => 6,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'label' => 'Anexo Descartado',
        'multiple' => 0,
        'type' => 'String',
        'length' => '1',
        'nullable' => false,
      ),
      'attachment' => 
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
                'max' => 4000,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '4000',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'label' => 'Anexo',
        'multiple' => 0,
        'type' => 'String',
        'length' => '4000',
        'nullable' => true,
      ),
      'mail_body' => 
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
        'label' => 'Corpo',
        'multiple' => 0,
        'type' => 'StringLong',
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
    ),
    'description' => 'Mail List',
  ),
)
?>