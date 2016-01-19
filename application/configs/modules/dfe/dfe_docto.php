<?php
return array (
  'table' => 
  array (
    'name' => 'dfe_docto',
    'modelName' => 'docto',
    'schema' => 'fiscal',
    'sequenceName' => 'sid_dfe_docto',
    'moduleName' => 'dfe',
    'objectName' => 'Dfe_Model_Docto',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => 'origem',
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
        'grid' => '/dfe/docto/grid',
        'search' => '/dfe/docto/seeker-search',
        'retrive' => '/dfe/docto/retrive',
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
        'type' => 'Text',
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
      'id_dfe_empresa' => 
      array (
        'label' => 'Empresa',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'sigla',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '50px',
            ),
            'display' => 
            array (
              'css-width' => '220px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/empresa/grid',
              'search' => '/dfe/empresa/seeker-search',
              'retrive' => '/dfe/empresa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_pessoa_emit' => 
      array (
        'label' => 'Emitente',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'cnpj',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/pessoa/grid',
              'search' => '/dfe/pessoa/seeker-search',
              'retrive' => '/dfe/pessoa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_pessoa_remet' => 
      array (
        'label' => 'Remetente',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'cnpj',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/pessoa/grid',
              'search' => '/dfe/pessoa/seeker-search',
              'retrive' => '/dfe/pessoa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_pessoa_dest' => 
      array (
        'label' => 'Destinatário',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'cnpj',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/pessoa/grid',
              'search' => '/dfe/pessoa/seeker-search',
              'retrive' => '/dfe/pessoa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_pessoa_pag' => 
      array (
        'label' => 'Pagador',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'cnpj',
              'display' => 'nome',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '70px',
            ),
            'display' => 
            array (
              'css-width' => '200px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/pessoa/grid',
              'search' => '/dfe/pessoa/seeker-search',
              'retrive' => '/dfe/pessoa/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'id_dfe_tipo_emissao' => 
      array (
        'label' => 'Tipo de Emissão',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'codigo',
              'display' => 'descricao',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '40px',
            ),
            'display' => 
            array (
              'css-width' => '230px',
            ),
            'url' => 
            array (
              'grid' => '/dfe/tipo-emissao/grid',
              'search' => '/dfe/tipo-emissao/seeker-search',
              'retrive' => '/dfe/tipo-emissao/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_estado' => 
      array (
        'label' => 'Estado',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'uf',
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
              'grid' => '/dfe/estado/grid',
              'search' => '/dfe/estado/seeker-search',
              'retrive' => '/dfe/estado/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
      'id_dfe_lote' => 
      array (
        'label' => 'Lote',
        'referenceMap' => true,
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
          'type' => 'Seeker',
          'seeker' => 
          array (
            'field' => 
            array (
              'search' => 'numero',
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
              'grid' => '/dfe/lote/grid',
              'search' => '/dfe/lote/seeker-search',
              'retrive' => '/dfe/lote/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 450,
            ),
          ),
          'required' => false,
        ),
        'length' => 10,
        'nullable' => true,
      ),
      'tp_amb' => 
      array (
        'label' => 'Tipo de Ambiente',
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
              '1' => 'Produção',
              '2' => 'Homologação',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '1',
            'id' => NULL,
          ),
          'type' => 'Select',
          'required' => true,
        ),
        'length' => 1,
        'nullable' => false,
      ),
      'origem' => 
      array (
        'label' => 'Origem',
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
              '1' => 'Emissor DFE',
              '2' => 'Emissor Portal NFE',
              '3' => 'Emissor Parceiro (Synchro)',
              '4' => 'Receb automatico por email',
              '5' => 'Receb automatico por FTP',
              '6' => 'Receb manual',
              '9' => 'Descarregado do Portal de NFe (parser)',
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
      'situacao' => 
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
              'N' => 'Normal',
              'C' => 'Cancelado',
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
      'status' => 
      array (
        'label' => 'Status',
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
                'max' => 1,
              ),
            ),
          ),
          'listOptions' => 
          array (
              '1' => 'Aguardando autorização',
              '2' => 'Erro',
              '3' => 'Autorizado',
              '4' => 'Rejeitado',
              '5' => 'Cancelado',
              '6' => 'Aguardando autorização via contingência',
              '9' => 'Importado(recebido)',
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
      'modelo' => 
      array (
        'label' => 'Modelo',
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
              55 => 'NFe',
              57 => 'CTe',
          ),
          'numeric' => 
          array (
            'numDecimal' => NULL,
            'numInteger' => '2',
            'id' => NULL,
          ),
          'type' => 'Select',
          'required' => true,
        ),
        'length' => 2,
        'nullable' => false,
      ),
      'chave_acesso' => 
      array (
        'label' => 'Chave de Acesso',
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
                'max' => 44,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '44',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '44',
        'nullable' => false,
      ),
      'chave_orig' => 
      array (
        'label' => 'Chave de Acesso Original',
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
                'max' => 44,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '44',
            'css-width' => '200px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '44',
        'nullable' => true,
      ),
      'numero' => 
      array (
        'label' => 'Número',
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
                'max' => 20,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '20',
            'css-width' => '175px',
            'id' => NULL,
          ),
          'required' => true,
        ),
        'length' => '20',
        'nullable' => false,
      ),
      'serie' => 
      array (
        'label' => 'Série',
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
                'max' => 10,
              ),
            ),
          ),
          'listOptions' => 
          array (
          ),
          'type' => 'Text',
          'text' => 
          array (
            'maxlength' => '10',
            'css-width' => '100px',
            'id' => NULL,
          ),
          'required' => false,
        ),
        'length' => '10',
        'nullable' => true,
      ),
      'valor' => 
      array (
        'label' => 'Valor',
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
            'numInteger' => '13',
            'id' => NULL,
          ),
          'type' => 'Numeric',
          'required' => false,
        ),
        'length' => '13.2',
        'nullable' => true,
      ),
      'dt_emissao' => 
      array (
        'label' => 'Data de Emissão',
        'multiple' => 0,
        'type' => 'Date',
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
            'id' => NULL,
          ),
          'type' => 'Date',
          'required' => true,
        ),
        'length' => '7',
        'nullable' => false,
      ),
      'dt_canc' => 
      array (
        'label' => 'Data de Cancelamento',
        'multiple' => 0,
        'type' => 'Date',
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
            'id' => NULL,
          ),
          'type' => 'Date',
          'required' => false,
        ),
        'length' => '7',
        'nullable' => true,
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
    ),
    'dependentTables' => 
    array (
      0 => 'Dfe_Model_Evento',
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_DFE_ESTADO',
        'objectNameReference' => 'Dfe_Model_Estado',
        'tableNameReference' => 'dfe_estado',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_DFE_EMPRESA',
        'objectNameReference' => 'Dfe_Model_Empresa',
        'tableNameReference' => 'dfe_empresa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      2 => 
      array (
        'columnName' => 'ID_DFE_PESSOA_EMIT',
        'objectNameReference' => 'Dfe_Model_Pessoa',
        'tableNameReference' => 'dfe_pessoa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      3 => 
      array (
        'columnName' => 'ID_DFE_PESSOA_REMET',
        'objectNameReference' => 'Dfe_Model_Pessoa',
        'tableNameReference' => 'dfe_pessoa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      4 => 
      array (
        'columnName' => 'ID_DFE_PESSOA_DEST',
        'objectNameReference' => 'Dfe_Model_Pessoa',
        'tableNameReference' => 'dfe_pessoa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      5 => 
      array (
        'columnName' => 'ID_DFE_PESSOA_PAG',
        'objectNameReference' => 'Dfe_Model_Pessoa',
        'tableNameReference' => 'dfe_pessoa',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      6 => 
      array (
        'columnName' => 'ID_DFE_LOTE',
        'objectNameReference' => 'Dfe_Model_Lote',
        'tableNameReference' => 'dfe_lote',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
      7 => 
      array (
        'columnName' => 'ID_DFE_TIPO_EMISSAO',
        'objectNameReference' => 'Dfe_Model_TipoEmissao',
        'tableNameReference' => 'dfe_tipo_emissao',
        'schemaNameReference' => 'fiscal',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'chave_acesso',
    ),
    'description' => 'Documento',
  ),
)
?>