<?php
return array (
  'table' => 
  array (
    'name' => 'log_server',
    'modelName' => 'log_server',
    'schema' => 'log',
    'sequenceName' => 'sid_log_server',
    'moduleName' => 'monitor',
    'objectName' => 'Monitor_Model_LogServer',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'dh_log',
        'display' => 'cpu_load',
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
        'grid' => '/monitor/log-server/grid',
        'search' => '/monitor/log-server/seeker-search',
        'retrive' => '/monitor/log-server/retrive',
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
      'dh_log' => 
      array (
        'label' => 'Data do Log',
        'multiple' => 0,
        'type' => 'DATE',
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
        'length' => '7',
        'nullable' => false,
      ),
      'total_accesses' => 
      array (
        'label' => 'Total Accesses',
        'multiple' => 0,
        'type' => 'Number',
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
        'length' => 10,
        'nullable' => false,
      ),
      'total_traffic' => 
      array (
        'label' => 'Total Traffic',
        'multiple' => 0,
        'type' => 'Number',
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
            'numDecimal' => '2',
            'numInteger' => '8',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'length' => '8.2',
        'nullable' => false,
      ),
      'cpu_usage' => 
      array (
        'label' => 'CPU Usage',
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
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '50',
        'nullable' => true,
      ),
      'cpu_load' => 
      array (
        'label' => 'CPU Load',
        'multiple' => 0,
        'type' => 'Number',
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
            'numDecimal' => '3',
            'numInteger' => '7',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => true,
        ),
        'length' => '7.3',
        'nullable' => false,
      ),
      'total_requests' => 
      array (
        'label' => 'Total Requests',
        'multiple' => 0,
        'type' => 'Number',
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
          'type' => 'Numeric',
          'required' => true,
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '6',
            'id' => NULL,
          ),
        ),
        'length' => 6,
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
      0 => 'Monitor_Model_LogServerRequest',
    ),
    'referenceMaps' => 
    array (
    ),
    'unique' => 
    array (
      0 => '',
    ),
    'description' => 'Log Servidor',
    'primary' => 
    array (
      0 => 'id',
    ),
  ),
)
?>