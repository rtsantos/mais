<?php

   return array(
      'table' =>
      array(
         'name' => 'at_tipo_recurso',
         'modelName' => 'tipo_recurso',
         'schema' => 'mais',
         'sequenceName' => 'sid_at_tipo_recurso',
         'moduleName' => 'auth',
         'objectName' => 'Auth_Model_TipoRecurso',
         'controllerName' => true,
         'seeker' =>
         array(
            'field' =>
            array(
               'search' => 'nome',
               'display' => '',
               'id' => 'id',
            ),
            'search' =>
            array(
               'width' => 50,
            ),
            'display' =>
            array(
               'width' => 50,
            ),
            'url' =>
            array(
               'grid' => '/auth/tipo-recurso/grid',
               'search' => '/auth/tipo-recurso/seeker-search',
               'retrive' => '/auth/tipo-recurso/retrive',
            ),
            'modal' =>
            array(
               'width' => 800,
               'height' => 400,
            ),
         ),
         'dependentTables' =>
         array(
            0 => 'Auth_Model_Recurso',
         ),
         'referenceMaps' =>
         array(
         ),
         'columns' =>
         array(
            'id' =>
            array(
               'object' =>
               array(
                  'mask' => NULL,
                  'validators' =>
                  array(
                  ),
                  'listOptions' =>
                  array(
                  ),
                  'type' => 'Text',
                  'text' =>
                  array(
                     'size' => 15,
                     'maxlength' => 10,
                     'id' => NULL,
                     'css-width' => 15,
                  ),
                  'required' => true,
                  'charMask' => '@',
                  'filter' =>
                  array(
                     0 => 'strtoupper',
                  ),
               ),
               'label' => 'Identificação',
               'multiple' => 0,
               'type' => 'Integer',
               'length' => 10,
               'nullable' => false,
            ),
            'nome' =>
            array(
               'object' =>
               array(
                  'mask' => NULL,
                  'validators' =>
                  array(
                     0 =>
                     array(
                        'name' => 'Zend_Validate_StringLength',
                        'param' =>
                        array(
                           'max' => 30,
                        ),
                     ),
                  ),
                  'listOptions' =>
                  array(
                  ),
                  'type' => 'Text',
                  'text' =>
                  array(
                     'maxlength' => '30',
                     'size' => 35,
                     'id' => NULL,
                  ),
                  'required' => true,
                  'charMask' => '@',
                  'filter' =>
                  array(
                     0 => 'strtoupper',
                  ),
               ),
               'label' => 'Nome',
               'multiple' => 0,
               'type' => 'String',
               'length' => '30',
               'nullable' => false,
            ),
            'descricao' =>
            array(
               'object' =>
               array(
                  'mask' => NULL,
                  'validators' =>
                  array(
                     0 =>
                     array(
                        'name' => 'Zend_Validate_StringLength',
                        'param' =>
                        array(
                           'max' => 30,
                        ),
                     ),
                  ),
                  'listOptions' =>
                  array(
                  ),
                  'type' => 'Text',
                  'text' =>
                  array(
                     'maxlength' => '30',
                     'size' => 35,
                     'id' => NULL,
                  ),
                  'required' => true,
                  'charMask' => '@',
                  'filter' =>
                  array(
                     0 => 'strtoupper',
                  ),
               ),
               'label' => 'Descrição',
               'multiple' => 0,
               'type' => 'String',
               'length' => '30',
               'nullable' => false,
            ),
         ),
         'primary' =>
         array(
            0 => 'id',
         ),
         'unique' =>
         array(
            0 => 'nome',
         ),
         'description' => 'Tipo de Recurso',
      ),
         )
?>