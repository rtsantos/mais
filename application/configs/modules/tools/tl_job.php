<?php
return array (
  'table' => 
  array (
    'name' => 'tl_job',
    'alias' => 'job',
    'modelName' => 'job',
    'schema' => 'mais',
    'sequenceName' => 'sid_tl_job',
    'moduleName' => 'tools',
    'objectName' => 'Tools_Model_Job',
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
        'css-width' => '270px',
      ),
      'display' => 
      array (
        'css-width' => '0px',
      ),
      'url' => 
      array (
        'grid' => '/tools/job/grid',
        'search' => '/tools/job/seeker-search',
        'retrieve' => '/tools/job/retrieve',
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
        'label' => 'Id.',
        'multiple' => 0,
        'type' => 'Integer',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'maxlength' => NULL,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
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
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'required' => true,
        ),
        'length' => '50',
        'nullable' => false,
      ),
      'dh_inc' => 
      array (
        'label' => 'Data de Inclusão',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'dh_ini_exec' => 
      array (
        'label' => 'Data Início da Execução',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'dh_ult_exec' => 
      array (
        'label' => 'Data da Última Execução',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => NULL,
        'nullable' => true,
      ),
      'dh_fim_exec' => 
      array (
        'label' => 'Data Fim da Execução',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => NULL,
        'nullable' => true,
      ),
      'tp_frequencia' => 
      array (
        'label' => 'Tipo da Frequência',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'M' => 'Mês',
            'H' => 'Hora',
            'D' => 'Dia',
          ),
          'type' => 'Select',
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
      'num_frequencia' => 
      array (
        'label' => 'Frequência',
        'multiple' => 0,
        'type' => 'Number',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'required' => true,
        ),
        'length' => 3,
        'nullable' => false,
      ),
      'forma_exec' => 
      array (
        'label' => 'Forma de Execução',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'C' => 'Classe',
            'U' => 'Url',
          ),
          'type' => 'Select',
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
      'procedimento' => 
      array (
        'label' => 'Procedimento',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
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
          'required' => true,
        ),
        'length' => '1000',
        'nullable' => false,
      ),
      'parametro' => 
      array (
        'label' => 'Parâmetros',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
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
      'tempo_ul_exec' => 
      array (
        'label' => 'Tempo da Última Execução',
        'multiple' => 0,
        'type' => 'Number',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
            'numDecimal' => '3',
            'numInteger' => '5',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => '5.3',
        'nullable' => true,
      ),
      'dh_pro_exec' => 
      array (
        'label' => 'Data da Próxima Execução',
        'multiple' => 0,
        'type' => 'DateTime',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
          'datetime' => 
          array (
          ),
          'type' => 'DateTime',
          'date' => 
          array (
            'css-width' => '87.5px',
            'maxlength' => 10,
            'id' => NULL,
          ),
          'time' => 
          array (
            'css-width' => '43.75px',
            'maxlength' => 5,
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => NULL,
        'nullable' => false,
      ),
      'status' => 
      array (
        'label' => 'Situação',
        'multiple' => 0,
        'type' => 'String',
        'object' => 
        array (
          'mask' => NULL,
          'charMask' => '@',
          'filter' => 
          array (
            0 => 'trim',
            1 => 'strtoupper',
            2 => 'removeAccent',
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
              'A' => 'Aguardando',
              'E' => 'Executando'
          ),
          'type' => 'Select',
          'text' => 
          array (
            'maxlength' => '1',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '1',
        'nullable' => true,
      ),
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
    ),
    'form' => 
    array (
      'url' => 
      array (
        'retrieve' => '/tools/job/retrieve',
        'insert' => '/tools/job/insert',
        'update' => '/tools/job/update',
        'delete' => '/tools/job/delete',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
    ),
    'description' => 'Agenda de Tarefas',
  ),
)
?>