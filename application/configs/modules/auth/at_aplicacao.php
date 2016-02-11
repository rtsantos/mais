<?php

    return array(
        'table' =>
        array(
            'name' => 'at_aplicacao',
            'modelName' => 'aplicacao',
            'schema' => 'mais',
            'sequenceName' => 'sid_at_aplicacao',
            'moduleName' => 'auth',
            'objectName' => 'Auth_Model_Aplicacao',
            'controllerName' => true,
            'seeker' =>
            array(
                'field' =>
                array(
                    'search' => 'sigla',
                    'display' => 'nome',
                    'id' => 'id',
                ),
                'search' =>
                array(
                    'css-width' => '80px',
                ),
                'display' =>
                array(
                    'css-width' => '190px',
                ),
                'url' =>
                array(
                    'grid' => '/auth/aplicacao/grid',
                    'search' => '/auth/aplicacao/seeker-search',
                    'retrieve' => '/auth/aplicacao/retrieve',
                ),
                'modal' =>
                array(
                    'width' => 800,
                    'height' => 450,
                ),
            ),
            'columns' =>
            array(
                'id' =>
                array(
                    'label' => 'Id.',
                    'multiple' => 0,
                    'type' => 'Integer',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'strtoupper',
                            1 => 'removeAccent',
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'css-width' => '100px',
                            'maxlength' => NULL,
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => NULL,
                    'nullable' => false,
                ),
                'sigla' =>
                array(
                    'label' => 'Sigla',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'strtoupper',
                            1 => 'removeAccent',
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                            0 =>
                            array(
                                'name' => 'Zend_Validate_StringLength',
                                'param' =>
                                array(
                                    'max' => 20,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '20',
                            'css-width' => '175px',
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => '20',
                    'nullable' => false,
                ),
                'nome' =>
                array(
                    'label' => 'Nome',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'trim'
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                            0 =>
                            array(
                                'name' => 'Zend_Validate_StringLength',
                                'param' =>
                                array(
                                    'max' => 40,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '40',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => '40',
                    'nullable' => false,
                ),
                'status' =>
                array(
                    'label' => 'Status',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'strtoupper',
                            1 => 'removeAccent',
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                            0 =>
                            array(
                                'name' => 'Zend_Validate_StringLength',
                                'param' =>
                                array(
                                    'max' => 1,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                            'A' => 'Ativo',
                            'I' => 'Inativo'
                        ),
                        'type' => 'Select',
                        'text' =>
                        array(
                            'maxlength' => '1',
                            'css-width' => '100px',
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => '1',
                    'nullable' => false,
                ),
                'observacao' =>
                array(
                    'label' => 'Observação',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'trim'
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                            0 =>
                            array(
                                'name' => 'Zend_Validate_StringLength',
                                'param' =>
                                array(
                                    'max' => 50,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '50',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => false,
                    ),
                    'length' => '50',
                    'nullable' => true,
                ),
                'icone' =>
                array(
                    'label' => 'Ícone',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'strtoupper',
                            1 => 'removeAccent',
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
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
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => false,
                    ),
                    'length' => '30',
                    'nullable' => true,
                ),
                'url' =>
                array(
                    'label' => 'Url de Acesso',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'trim',
                            1 => 'removeAccent',
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                            0 =>
                            array(
                                'name' => 'Zend_Validate_StringLength',
                                'param' =>
                                array(
                                    'max' => 150,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '150',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => false,
                    ),
                    'length' => '150',
                    'nullable' => true,
                ),
                'dh_inc' =>
                array(
                    'label' => 'Data de Inclusão',
                    'multiple' => 0,
                    'type' => 'DateTime',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                        ),
                        'filterDb' =>
                        array(
                            0 => '',
                        ),
                        'validators' =>
                        array(
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'datetime' =>
                        array(
                        ),
                        'type' => 'DateTime',
                        'date' =>
                        array(
                            'css-width' => '87.5px',
                            'maxlength' => 10,
                            'id' => NULL,
                        ),
                        'time' =>
                        array(
                            'css-width' => '43.75px',
                            'maxlength' => 5,
                            'id' => NULL,
                        ),
                        'required' => false,
                    ),
                    'length' => NULL,
                    'nullable' => true,
                ),
            ),
            'dependentTables' =>
            array(
                0 => 'Auth_Model_Recurso',
            ),
            'referenceMaps' =>
            array(
            ),
            'primary' =>
            array(
                0 => 'id',
            ),
            'unique' =>
            array(
                'sigla'
            ),
            'description' => 'Aplicação',
        ),
    );