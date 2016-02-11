<?php

    return array(
        'table' =>
        array(
            'name' => 'at_privilegio',
            'modelName' => 'privilegio',
            'schema' => 'mais',
            'sequenceName' => 'sid_at_privilegio',
            'moduleName' => 'auth',
            'objectName' => 'Auth_Model_Privilegio',
            'controllerName' => true,
            'seeker' =>
            array(
                'field' =>
                array(
                    'search' => 'acesso',
                    'display' => '',
                    'id' => 'id',
                ),
                'search' =>
                array(
                    'css-width' => '270px',
                ),
                'display' =>
                array(
                    'css-width' => '0px',
                ),
                'url' =>
                array(
                    'grid' => '/auth/privilegio/grid',
                    'search' => '/auth/privilegio/seeker-search',
                    'retrieve' => '/auth/privilegio/retrieve',
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
                'id_papel' =>
                array(
                    'label' => 'Papel',
                    'referenceMap' => true,
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
                        'type' => 'Seeker',
                        'seeker' =>
                        array(
                            'search' =>
                            array(
                                'css-width' => '200px',
                            ),
                            'display' =>
                            array(
                                'css-width' => '200px',
                            ),
                            'field' =>
                            array(
                                'id' => 'id',
                                'search' => 'hierarquia',
                                'display' => '',
                            ),
                            'url' =>
                            array(
                                'grid' => '/auth/conta/grid',
                                'search' => '/auth/conta/seeker-search',
                                'retrive' => '/auth/conta/retrieve',
                            ),
                            'modal' =>
                            array(
                                'width' => 800,
                                'height' => 450,
                            ),
                        ),
                        'required' => false,
                    ),
                    'length' => NULL,
                    'nullable' => true,
                ),
                'id_recurso' =>
                array(
                    'label' => 'Recurso',
                    'referenceMap' => true,
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
                        'type' => 'Seeker',
                        'seeker' =>
                        array(
                            'field' =>
                            array(
                                'search' => 'hierarquia',
                                'display' => '',
                                'id' => 'id',
                            ),
                            'search' =>
                            array(
                                'css-width' => '270px',
                            ),
                            'display' =>
                            array(
                                'css-width' => '0px',
                            ),
                            'url' =>
                            array(
                                'grid' => '/auth/recurso/grid',
                                'search' => '/auth/recurso/seeker-search',
                                'retrieve' => '/auth/recurso/retrieve',
                            ),
                            'modal' =>
                            array(
                                'width' => 800,
                                'height' => 450,
                            ),
                        ),
                        'required' => false,
                    ),
                    'length' => NULL,
                    'nullable' => true,
                ),
                'acesso' =>
                array(
                    'label' => 'Acesso',
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
                            'P' => 'Permitido',
                            'N' => 'Negado'
                        ),
                        'type' => 'Select',
                        'text' =>
                        array(
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
            array(
            ),
            'referenceMaps' =>
            array(
                0 =>
                array(
                    'columnName' => 'id_papel',
                    'objectNameReference' => 'Auth_Model_Conta',
                    'tableNameReference' => 'papel',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'id',
                ),
                1 =>
                array(
                    'columnName' => 'id_recurso',
                    'objectNameReference' => 'Auth_Model_Recurso',
                    'tableNameReference' => 'recurso',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'id',
                ),
            ),
            'primary' =>
            array(
                0 => 'id',
            ),
            'unique' =>
            array(
                'id_papel', 'id_recurso'
            ),
            'description' => 'Privilégio',
        ),
            )
?>