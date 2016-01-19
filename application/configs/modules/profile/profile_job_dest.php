<?php
return array (
  'table' => 
  array (
    'name' => 'profile_job_dest',
    'modelName' => 'job_dest',
    'schema' => 'prouser',
    'moduleName' => 'profile',
    'objectName' => 'Profile_Model_JobDest',
    'controllerName' => true,
    'seeker' => 
    array (
      'field' => 
      array (
        'search' => '',
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
        'grid' => '/profile/job-dest/grid',
        'search' => '/profile/job-dest/seeker-search',
        'retrive' => '/profile/job-dest/retrive',
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
        'label' => 'ID',
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
      'id_profile_job' => 
      array (
        'label' => 'ID_PROFILE_JOB',
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
              'search' => 'descricao',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '400px',
            ),
            'display' => 
            array (
              'css-width' => '0px',
            ),
            'url' => 
            array (
              'grid' => '/profile/job/grid',
              'search' => '/profile/job/seeker-search',
              'retrive' => '/profile/job/retrive',
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
      'id_papel' => 
      array (
        'label' => 'ID_PAPEL',
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
              'search' => 'nome',
              'display' => '',
              'id' => 'id',
            ),
            'search' => 
            array (
              'css-width' => '400px',
            ),
            'display' => 
            array (
              'size' => 50,
            ),
            'url' => 
            array (
              'grid' => '/auth/papel/grid',
              'search' => '/auth/papel/seeker-search',
              'retrive' => '/auth/papel/retrive',
            ),
            'modal' => 
            array (
              'width' => 800,
              'height' => 400,
            ),
          ),
          'required' => true,
        ),
        'length' => 10,
        'nullable' => false,
      ),
    ),
    'dependentTables' => 
    array (
    ),
    'referenceMaps' => 
    array (
      0 => 
      array (
        'columnName' => 'ID_PROFILE_JOB',
        'objectNameReference' => 'Profile_Model_Job',
        'tableNameReference' => 'profile_job',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
      1 => 
      array (
        'columnName' => 'ID_PAPEL',
        'objectNameReference' => 'Auth_Model_Papel',
        'tableNameReference' => 'papel',
        'schemaNameReference' => 'prouser',
        'columnReference' => 'ID',
      ),
    ),
    'primary' => 
    array (
      0 => 'id',
    ),
    'unique' => 
    array (
      0 => 'id_profile_job',
      1 => 'id_papel',
    ),
    'description' => 'Profile Job Dest',
  ),
)
?>