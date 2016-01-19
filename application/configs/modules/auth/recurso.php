<?php

    return array(
        'table' =>
        array(
            'name' => 'recurso',
            'modelName' => 'recurso',
            'schema' => 'prouser',
            'sequenceName' => 'sid_recurso',
            'moduleName' => 'auth',
            'objectName' => 'Auth_Model_Recurso',
            'controllerName' => true,
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
                'id_tipo_recurso' =>
                array(
                    'label' => 'Tipo de Recurso',
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
                        'required' => true,
                    ),
                    'length' => NULL,
                    'nullable' => false,
                ),
                'id_aplicacao' =>
                array(
                    'label' => 'Aplicação',
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
                        'required' => true,
                    ),
                    'length' => NULL,
                    'nullable' => false,
                ),
                'id_recurso_pai' =>
                array(
                    'label' => 'Recurso Pai',
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
                                    'max' => 80,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '80',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => '80',
                    'nullable' => false,
                ),
                'hierarquia' =>
                array(
                    'label' => 'Hierarquia',
                    'multiple' => 0,
                    'type' => 'String',
                    'object' =>
                    array(
                        'mask' => NULL,
                        'charMask' => '@',
                        'filter' =>
                        array(
                            0 => 'trim',
                            1 => 'strtolower',
                            2 => 'removeAccent',
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
                                    'max' => 100,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '100',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => true,
                    ),
                    'length' => '100',
                    'nullable' => false,
                ),
                'descricao' =>
                array(
                    'label' => 'Descrição',
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
                                    'max' => 4000,
                                ),
                            ),
                        ),
                        'listOptions' =>
                        array(
                        ),
                        'type' => 'Text',
                        'text' =>
                        array(
                            'maxlength' => '4000',
                            'css-width' => '200px',
                            'id' => NULL,
                        ),
                        'required' => false,
                    ),
                    'length' => '4000',
                    'nullable' => true,
                ),
                'ordem' =>
                array(
                    'label' => 'Ordem',
                    'multiple' => 0,
                    'type' => 'decimal',
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
                        'required' => false,
                    ),
                    'length' => 3,
                    'nullable' => true,
                ),
                'nivel' =>
                array(
                    'label' => 'Nível',
                    'multiple' => 0,
                    'type' => 'decimal',
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
                        'required' => false,
                    ),
                    'length' => 2,
                    'nullable' => true,
                ),
            ),
            'dependentTables' =>
            array(
                0 => 'Auth_Model_PapelRecurso',
                1 => 'Auth_Model_Recurso',
            ),
            'referenceMaps' =>
            array(
                0 =>
                array(
                    'columnName' => 'id_tipo_recurso',
                    'objectNameReference' => 'Auth_Model_TipoRecurso',
                    'tableNameReference' => 'tipo_recurso',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'id',
                ),
                1 =>
                array(
                    'columnName' => 'id_aplicacao',
                    'objectNameReference' => 'Auth_Model_Aplicacao',
                    'tableNameReference' => 'aplicacao',
                    'schemaNameReference' => 'prouser',
                    'columnReference' => 'id',
                ),
                2 =>
                array(
                    'columnName' => 'id_recurso_pai',
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
            ),
            'description' => 'recurso',
        ),
            )
?>