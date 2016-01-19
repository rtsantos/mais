<?php

    return array(
        'table' =>
        array(
            'name' => 'usuario_papel',
            'modelName' => 'usuario_papel',
            'schema' => 'prouser',
            'sequenceName' => 'sid_usuario_papel',
            'moduleName' => 'auth',
            'objectName' => 'Auth_Model_UsuarioPapel',
            'controllerName' => true,
            'seeker' =>
            array(
                'field' =>
                array(
                    'search' => '',
                    'display' => '',
                    'id' =>
                    array(
                    ),
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
                    'grid' => '/auth/usuario-papel/grid',
                    'search' => '/auth/usuario-papel/seeker-search',
                    'retrieve' => '/auth/usuario-papel/retrieve',
                ),
                'modal' =>
                array(
                    'width' => 800,
                    'height' => 450,
                ),
            ),
            'columns' =>
            array(
                'id_usuario' =>
                array(
                    'label' => 'id_usuario',
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
                                'search' => 'login',
                                'display' => 'nome',
                                'id' => 'id',
                            ),
                            'search' =>
                            array(
                                'css-width' => '100px',
                            ),
                            'display' =>
                            array(
                                'css-width' => '170px',
                            ),
                            'url' =>
                            array(
                                'grid' => '/auth/usuario/grid',
                                'search' => '/auth/usuario/seeker-search',
                                'retrive' => '/auth/usuario/retrive',
                            ),
                            'modal' =>
                            array(
                                'width' => 800,
                                'height' => 450,
                            ),
                        ),
                        'required' => true,
                    ),
                    'length' => 10,
                    'nullable' => false,
                ),
                'id_papel' =>
                array(
                    'label' => 'id_papel',
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
                                'search' => 'nome',
                                'display' => '',
                                'id' => 'id',
                            ),
                            'search' =>
                            array(
                                'size' => '40px',
                            ),
                            'display' =>
                            array(
                                'size' => '0px',
                            ),
                            'url' =>
                            array(
                                'grid' => '/auth/papel/grid',
                                'search' => '/auth/papel/seeker-search',
                                'retrive' => '/auth/papel/retrive',
                            ),
                            'modal' =>
                            array(
                                'width' => 800,
                                'height' => 400,
                            ),
                        ),
                        'required' => true,
                    ),
                    'length' => 10,
                    'nullable' => false,
                ),
                'prioridade' =>
                array(
                    'label' => 'Prioridade',
                    'multiple' => 0,
                    'type' => 'Number',
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
                        'numeric' =>
                        array(
                            'numDecimal' => NULL,
                            'numInteger' => '2',
                            'id' => NULL,
                        ),
                        'type' => 'Numeric',
                        'required' => true,
                    ),
                    'length' => 2,
                    'nullable' => false,
                ),
            ),
            'dependentTables' =>
            array(
            ),
            'referenceMaps' =>
            array(
                0 =>
                array(
                    'columnName' => 'ID_PAPEL',
                    'objectNameReference' => 'Auth_Model_Papel',
                    'tableNameReference' => 'papel',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'ID',
                ),
                1 =>
                array(
                    'columnName' => 'ID_USUARIO',
                    'objectNameReference' => 'Auth_Model_Usuario',
                    'tableNameReference' => 'usuario',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'ID',
                ),
            ),
            'primary' =>
            array(
                'id_usuario', 'id_papel'
            ),
            'unique' =>
            array(
                'id_usuario', 'id_papel'
            ),
            'description' => 'usuario_papel',
        ),
            )
?>