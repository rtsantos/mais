<?php

   require_once('ZendT/Lib.php');
   require_once('ZendT/Tool/Crud.php');
   require_once('ZendT/Tool/Crud/Bootstrap.php');
   require_once('ZendT/Tool/Crud/Controller.php');
   require_once('ZendT/Tool/Crud/Element.php');
   require_once('ZendT/Tool/Crud/Form.php');
   require_once('ZendT/Tool/Crud/Language.php');
   require_once('ZendT/Tool/Crud/Mapper.php');
   require_once('ZendT/Tool/Crud/MapperView.php');
   require_once('ZendT/Tool/Crud/Service.php');
   require_once('ZendT/Tool/Crud/Table.php');
   require_once('ZendT/Tool/Crud/View.php');
   require_once('ZendT/Tool/Crud/Report.php');
   require_once('ZendT/Tool/Crud/MakeResources.php');

   /**
    * ZendT Tool Provider - CRUD
    *
    * @author rsantos
    */
   class ZendT_Tool_CrudTProvider extends Zend_Tool_Project_Provider_Abstract implements Zend_Tool_Framework_Provider_Pretendable {

       /**
        *
        * @var Zend_Db_Adapter_Abstract
        */
       protected $_dbAdapter = null;

       /**
        * @param string $line
        * @param array $decoratorOptions
        */
       protected function _print($line, array $decoratorOptions = array()) {
           $this->_registry->getResponse()->appendContent("[ZendT] " . $line, $decoratorOptions);
       }

       /**
        *
        * @param Zend_Tool_Project_Profile $profile
        * @param type $adapter
        * @throws Zend_Tool_Project_Exception 
        */
       private function _connect(Zend_Tool_Project_Profile $profile, $adapter, $env = 'development') {
           $applicationConfigResource = $profile->search('ApplicationConfigFile');

           if ($env == null || $env == '') {
               $env = 'development';
           }

           if (!$applicationConfigResource) {
               throw new Zend_Tool_Project_Exception('A project with an application config file is required to use this provider.');
           }

           //$conn = 'testing';
           //$conn = 'development';
           $zf = $applicationConfigResource->getAsZendConfig($env);
           $this->_print('Conectado em ' . $env);
           #$zf = $applicationConfigResource->getAsZendConfig('testing');

           $_configDb = $zf->resources->multidb->{$adapter};
           if (!$_configDb) {
               throw new Zend_Tool_Project_Exception('Adapter not found in config application "resources.multidb.' . $adapter . '" .');
           }
           $configDb = array();
           $configDb['host'] = $_configDb->host;
           $configDb['username'] = $_configDb->username;
           $configDb['password'] = $_configDb->password;
           $configDb['dbname'] = $_configDb->dbname;
           $configDb['adapterNamespace'] = $_configDb->adapterNamespace;
           $configDb['options']['caseFolding'] = 1;

           $this->_dbAdapter = Zend_Db::factory($_configDb->adapter, $configDb);
       }

       /**
        * Configura a descriÃ§Ã£o do mÃ³dulo
        * 
        * @param string $pathBase
        * @param string $module 
        */
       private function _configModule($pathBase, $module) {
           $fileName = $pathBase . '/application/configs/modules/config.php';
           $config = array();
           if (file_exists($fileName)) {
               $config = require($fileName);
           }
           if (!isset($config[$module])) {
               $nameResponse = $this->_registry
                     ->getClient()
                     ->promptInteractiveInput("[ZendT] Informe a descricao do modulo?");
               $description = $nameResponse->getContent();
               $config[$module] = utf8_encode($description);
               file_put_contents($fileName, '<?php return ' . var_export($config, true) . '?>');
           }
       }

       /**
        * Cria os arquivos do CRUD
        * 
        * @param type $profile
        * @param type $table
        * @param type $adapter
        * @param type $module
        * @param type $overwrite
        * @throws Zend_Tool_Project_Provider_Exception 
        */
       private function _create($profile, $table, $adapter, $module, $overwrite) {
           $this->_registry->getRequest()->isPretend();

           $this->_print(' Criando CRUD ');
           $this->_print(' table: ' . $table . ' | adapter : ' . $adapter . ' | module: ' . $module);

           $table = strtolower($table);
           $module = strtolower($module);

           $path = $profile->getAttribute('projectDirectory');
           $dirModules = $path . '/application/configs/modules';
           if (!is_dir($dirModules))
               mkdir($dirModules);
           $dirModule = $dirModules . '/' . $module;
           if (!is_dir($dirModule))
               mkdir($dirModule);
           $fileName = $dirModule . '/' . $table . '.php';
           if (!file_exists($fileName)) {
               throw new Zend_Tool_Project_Provider_Exception('Para executar essa aÃ§Ã£o Ã© necessÃ¡rio criar o arquivo ' . $fileName);
           }
           $config = require($fileName);

           $this->_print(' Criando Tables ');
           ZendT_Tool_Crud_Table::create($path, $config);

           $this->_print(' Criando Mappers ');
           ZendT_Tool_Crud_Mapper::create($path, $config);

           $this->_print(' Criando MapperView ');
           ZendT_Tool_Crud_MapperView::create($path, $config);

           $this->_print(' Criando Element ');
           ZendT_Tool_Crud_Element::create($path, $config);

           $this->_print(' Criando Form ');
           ZendT_Tool_Crud_Form::create($path, $config);

           $this->_print(' Criando Controller ');
           ZendT_Tool_Crud_Controller::create($path, $config, $overwrite);

           $this->_print(' Criando Service ');
           ZendT_Tool_Crud_Service::create($path, $config);

           $this->_print(' Criando Language ');
           ZendT_Tool_Crud_Language::create($path, $config);

           $this->_print(' Criando Bootstrap ');
           ZendT_Tool_Crud_Bootstrap::create($path, $config);

           $this->_print(' Criando View ');
           ZendT_Tool_Crud_View::create($path, $config);
       }

       /**
        *
        * @param string $table
        * @param string $adapter
        * @param string $module 
        * @return void
        * @throws Zend_Tool_Project_Exception
        * @throws Exception 
        */
       public function config($table, $adapter, $module = null, $name = null, $env = null, $schema = null) {
           if (!$schema) {
               $schema = $adapter;
           }

           $this->_print(' Criando arquivo de configuracao ');

           $this->_print(' table: ' . $table . ' | adapter : ' . $adapter . ' | module: ' . $module);
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);

           $table = strtolower($table);
           $module = strtolower($module);
           if ($name !== null) {
               $controllerName = strtolower(str_replace('_', '-', $name));
           } else {
               $controllerName = strtolower(str_replace('_', '-', $table));
           }

           $path = $this->_loadedProfile->getAttribute('projectDirectory');
           $this->_configModule($path
                 , $module);

           $dirModules = $path . '/application/configs/modules';
           if (!is_dir($dirModules))
               mkdir($dirModules);
           $dirModule = $dirModules . '/' . $module;
           if (!is_dir($dirModule))
               mkdir($dirModule);
           $fileName = $dirModule . '/' . $table . '.php';
           /**
            * 
            */
           $config = array();
           if (!file_exists($fileName)) {
               $config['table']['name'] = $table;
               if ($name != null || $name) {
                   $config['table']['modelName'] = $name;
               } else {
                   $config['table']['modelName'] = $table;
               }
               $config['table']['schema'] = $adapter;
               $config['table']['sequenceName'] = 'sid_' . $table;
               $config['table']['moduleName'] = $module;
               $config['table']['objectName'] = str_replace("_Crud", "", ZendT_Lib::convertTableNameToObjectName($module, $config['table']['modelName']));
               $config['table']['controllerName'] = str_replace("Model_", "", $config['table']['objectName']) || 'Controller';
               $config['table']['seeker']['field']['search'] = '';
               $config['table']['seeker']['field']['display'] = '';
               $config['table']['seeker']['search']['css-width'] = '270px';
               $config['table']['seeker']['display']['css-width'] = '0px';
               $config['table']['seeker']['url']['grid'] = "/$module/$controllerName/grid";
               $config['table']['seeker']['url']['search'] = "/$module/$controllerName/seeker-search";
               $config['table']['seeker']['url']['retrieve'] = "/$module/$controllerName/retrieve";
               $config['table']['seeker']['modal']['width'] = 800;
               $config['table']['seeker']['modal']['height'] = 450;
           } else {
               $config = require ($fileName);
           }
           
           $config['table']['seeker']['field']['id'] = array();
           $this->_connect($this->_loadedProfile, $adapter, $env);

           $describeModel = $this->_dbAdapter->describeTable($table, $schema);
           if (count($describeModel) <= 0) {
               $this->_print('Erro ao localizar as colunas da Tabela, certifique a conexao e nome da tabela');
               exit;
           } else {
               /**
                * 
                */
               /* if (!isset($config['table']['columns'])) {
                 $config['table']['columns'] = array();
                 } */
               /**
                * Força para manter a ordem das colunas
                */
               foreach ($describeModel as $columnName => $column) {
                   if (!isset($config['table']['columns'][$columnName])) {
                       if (!$config['table']['columns'][strtolower($columnName)]['label']) {
                           $config['table']['columns'][strtolower($columnName)]['label'] = $columnName;
                       }
                   }
               }
           }
           //print_r($describeModel);
           //$describeModel['PRECISION'] = (int) $describeModel['PRECISION'];
           if (!isset($config['table']['dependentTables'])) {
               $config['table']['dependentTables'] = array();
           }
           if (!isset($config['table']['referenceMaps'])) {
               $config['table']['referenceMaps'] = array();
           }

           if (isset($describeModel['REFERENCE_MAP'])) {
               $_referenceMaps = array();
               foreach ($describeModel['REFERENCE_MAP'] as &$reference) {
                   $modelName = ZendT_Tool_Crud::getModelName($this->_loadedProfile->getAttribute('projectDirectory')
                               , $reference['TABLE_NAME_REFERENCE']
                               , $reference['SCHEMA_NAME_REFERENCE']);
                   if ($modelName) {
                       $data = array();
                       $data['columnName'] = $reference['COLUMN_NAME'];
                       $data['objectNameReference'] = $modelName;
                       $data['tableNameReference'] = strtolower($reference['TABLE_NAME_REFERENCE']);
                       $data['schemaNameReference'] = strtolower($reference['SCHEMA_NAME_REFERENCE']);
                       $data['columnReference'] = $reference['COLUMN_NAME_REFERENCE'];
                       $_referenceMaps[] = $data;
                   } else {
                       $data = array();
                       $data['columnName'] = $reference['COLUMN_NAME'];
                       if (strtolower($reference['TABLE_NAME_REFERENCE']) == strtolower($table)) {
                           $data['objectNameReference'] = $config['table']['objectName'];
                       } else {
                           $data['objectNameReference'] = str_replace("_Crud", "", ZendT_Lib::convertTableNameToObjectName($module, $reference['TABLE_NAME_REFERENCE']));
                       }
                       $data['tableNameReference'] = strtolower($reference['TABLE_NAME_REFERENCE']);
                       $data['schemaNameReference'] = strtolower($reference['SCHEMA_NAME_REFERENCE']);
                       $data['columnReference'] = $reference['COLUMN_NAME_REFERENCE'];
                       $_referenceMaps[] = $data;
                   }

                   $config['table']['columns'][strtolower($reference['COLUMN_NAME'])]['referenceMap'] = true;
               }
               $config['table']['referenceMaps'] = $_referenceMaps;
           }

           if (isset($describeModel['DEPENDENT_TABLES'])) {
               $_dependentTables = array();
               foreach ($describeModel['DEPENDENT_TABLES'] as &$dependentTable) {
                   $modelName = ZendT_Tool_Crud::getModelName($this->_loadedProfile->getAttribute('projectDirectory')
                               , $dependentTable['TABLE_NAME']
                               , $dependentTable['SCHEMA_NAME']
                               , true);

                   if ($modelName) {
                       $_dependentTables[] = $modelName['table']['objectName'];
                       $tab['description'] = $modelName['table']['description'];
                       $tab['url'] = str_replace('/grid','/form/grid/1',$modelName['table']['seeker']['url']['grid']);
                       $tab['column'] = $dependentTable['COLUMN_NAME'];
                       $tab['message'] = 'Necessário seleção ' . $config['table']['description'];
                   } else {
                       $_dependentTables[] = str_replace("_Crud", "", ZendT_Lib::convertTableNameToObjectName($module, $dependentTable['TABLE_NAME']));
                       $tab['description'] = $dependentTable['TABLE_NAME'];
                       $tab['url'] = '/' . strtolower($module).'/' . strtolower(str_replace('_', '-', $dependentTable['TABLE_NAME'])) . '/form/grid/1';
                       $tab['column'] = 'ID_' . strtoupper($config['table']);
                       $tab['message'] = 'Necessário seleção ' . $config['table']['description'];
                   }
                   $_tabs[] = $tab;
               }
               $config['table']['dependentTables'] = $_dependentTables;               
               $config['table']['tabs'] = $_tabs;
           }
           
           
           if (!isset($config['table']['form'])){
               $config['table']['form']['url']['retrieve'] = "/$module/$controllerName/retrieve";
               $config['table']['form']['url']['insert'] = "/$module/$controllerName/insert";
               $config['table']['form']['url']['update'] = "/$module/$controllerName/update";
               $config['table']['form']['url']['delete'] = "/$module/$controllerName/delete";
           }
           
           
           unset($describeModel['REFERENCE_MAP']);
           unset($describeModel['DEPENDENT_TABLES']);

           $primary = array();
           foreach ($describeModel as $columnName => $column) {
               $columnName = strtolower($columnName);

               if ($column['PRECISION']) {
                   $column['LENGTH'] = (int) $column['PRECISION'];
               }
               if ($column['SCALE']) {
                   $column['LENGTH']-= (int) $column['SCALE'];
                   $column['LENGTH'].= '.' . $column['SCALE'];
               }

               /* if (!isset($config['table']['columns'])) {
                 $config['table']['columns'] = array();
                 } */

               /* if (!isset($config['table']['columns'][$columnName])) {
                 $config['table']['columns'][$columnName] = array();
                 } */

               /* if (!isset($config['table']['columns'][$columnName]['object'])) {
                 $config['table']['columns'][$columnName]['object'] = array();
                 } */

               //$this->_print('Coluna '.$columnName.' => Label: '.$config['table']['columns'][$columnName]['label']);
               if ($config['table']['columns'][$columnName]['label'] == '') {
                   $config['table']['columns'][$columnName]['label'] = $columnName;
               }
               //$this->_print('Coluna '.$columnName.' => Label: '.$config['table']['columns'][$columnName]['label']);
               #$config['table']['columns'][$columnName]['label'] = $config['table']['columns'][$columnName]['label'];
               if (!isset($config['table']['columns'][$columnName]['multiple'])) {
                   $config['table']['columns'][$columnName]['multiple'] = 0;
               }
               if (!isset($config['table']['columns'][$columnName]['type'])) {
                   $config['table']['columns'][$columnName]['type'] = 'String';
               }
               if (!isset($config['table']['columns'][$columnName]['object']['mask'])) {
                   $config['table']['columns'][$columnName]['object']['mask'] = null;
               }
               if (!isset($config['table']['columns'][$columnName]['object']['charMask'])) {
                   $config['table']['columns'][$columnName]['object']['charMask'] = '@';
               }
               if (!isset($config['table']['columns'][$columnName]['object']['filter'])) {
                   $config['table']['columns'][$columnName]['object']['filter'][] = 'trim';
                   $config['table']['columns'][$columnName]['object']['filter'][] = 'strtoupper';
                   $config['table']['columns'][$columnName]['object']['filter'][] = 'removeAccent';
               }
               if (!isset($config['table']['columns'][$columnName]['object']['filterDb'])) {
                   $config['table']['columns'][$columnName]['object']['filterDb'][] = '';
               }
               if (!isset($config['table']['columns'][$columnName]['object']['validators'])) {
                   $config['table']['columns'][$columnName]['object']['validators'] = array();
               }
               if (!isset($config['table']['columns'][$columnName]['object']['listOptions'])) {
                   $config['table']['columns'][$columnName]['object']['listOptions'] = array();
               }
               $config['table']['columns'][$columnName]['object']['listOptions'] = $config['table']['columns'][$columnName]['object']['listOptions'];

               $config['table']['columns'][$columnName]['type'] = $column['DATA_TYPE'];
               $config['table']['columns'][$columnName]['length'] = $column['LENGTH'];
               $config['table']['columns'][$columnName]['nullable'] = $column['NULLABLE'];
               if (!isset($config['table']['primary'])) {
                   $config['table']['primary'] = array();
               }

               $column['DATA_TYPE'] = strtoupper($column['DATA_TYPE']);

               if ($column['PRIMARY']) {
                   /**
                    * @todo pensar em uma forma de tratar os casos de chave composta
                    */
                   $config['table']['seeker']['field']['id'] = $columnName;
                   $primary[] = $columnName;
                   $config['table']['columns'][$columnName]['type'] = 'Integer';
                   $config['table']['columns'][$columnName]['object']['type'] = 'Text';
                   $config['table']['columns'][$columnName]['object']['text']['css-width'] = $column['LENGTH'] * 8.75;
                   if ($config['table']['columns'][$columnName]['object']['text']['css-width'] > 300) {
                       $config['table']['columns'][$columnName]['object']['text']['css-width'] = '300px';
                   } else if ($config['table']['columns'][$columnName]['object']['text']['css-width'] < 100) {
                       $config['table']['columns'][$columnName]['object']['text']['css-width'] = '100px';
                   } else {
                       $config['table']['columns'][$columnName]['object']['text']['css-width'].='px';
                   }
                   $config['table']['columns'][$columnName]['object']['text']['maxlength'] = $column['LENGTH'];
                   $config['table']['columns'][$columnName]['object']['text']['id'] = null;
               } elseif (isset($config['table']['columns'][$columnName]['referenceMap'])) {//substr(strtolower($columnName),0,2) == 'id' || is_numeric(strpos($columnName, '_id'))) {
                   $config['table']['columns'][$columnName]['type'] = 'Integer';
                   $config['table']['columns'][$columnName]['object']['type'] = 'Seeker';
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('Seeker')))
                       $load = true;
                   if (!isset($config['table']['columns'][$columnName]['object']['seeker'])) {
                       $configSeeker = ZendT_Tool_Crud::getConfigSeeker($this->_loadedProfile->getAttribute('projectDirectory')
                                   , $config
                                   , $columnName);
                       $config['table']['columns'][$columnName]['object']['seeker'] = array();
                       $config['table']['columns'][$columnName]['object']['seeker'] = $configSeeker;
                   }
               } elseif (in_array($column['DATA_TYPE'], array('VARCHAR2', 'VARCHAR', 'CHAR'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('Text', 'Select')))
                       $load = true;
                   if (!isset($config['table']['columns'][$columnName]['object']['type'])) {
                       $config['table']['columns'][$columnName]['object']['type'] = 'Text';
                   }
                   if (!isset($config['table']['columns'][$columnName]['object']['text'])) {
                       $config['table']['columns'][$columnName]['object']['text'] = array();
                   }

                   if ($config['table']['seeker']['field']['search'] == '') {
                       $config['table']['seeker']['field']['search'] = $columnName;
                   }
                   $config['table']['columns'][$columnName]['object']['text']['maxlength'] = $column['LENGTH'];
                   $validatorNew = array('name' => 'Zend_Validate_StringLength',
                      'param' => array('max' => (int) $column['LENGTH']));
                   foreach ($config['table']['columns'][$columnName]['object']['validators'] as &$validator) {
                       if ($validator['name'] == 'Zend_Validate_StringLength') {
                           $validator = $validatorNew;
                           $validatorNew = null;
                       }
                   }
                   if ($validatorNew !== null) {
                       $config['table']['columns'][$columnName]['object']['validators'][] = $validatorNew;
                   }
                   if ($load) {
                       $config['table']['columns'][$columnName]['object']['text']['css-width'] = $column['LENGTH'] * 8.75;
                       if ($config['table']['columns'][$columnName]['object']['text']['css-width'] > 200) {
                           $config['table']['columns'][$columnName]['object']['text']['css-width'] = '200px';
                       } else if ($config['table']['columns'][$columnName]['object']['text']['css-width'] < 100) {
                           $config['table']['columns'][$columnName]['object']['text']['css-width'] = '100px';
                       } else {
                           $config['table']['columns'][$columnName]['object']['text']['css-width'].= 'px';
                       }
                       $config['table']['columns'][$columnName]['object']['text']['id'] = null;
                       $config['table']['columns'][$columnName]['object']['mask'] = null;
                   }
                   $config['table']['columns'][$columnName]['type'] = 'String';
               } elseif (in_array($column['DATA_TYPE'], array('CLOB'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('Text', 'Select')))
                       $load = true;
                   $config['table']['columns'][$columnName]['object']['type'] = 'Textare';
                   if (!isset($config['table']['columns'][$columnName]['object']['textare'])) {
                       $config['table']['columns'][$columnName]['object']['textare'] = array();
                   }
                   if ($load) {
                       $config['table']['columns'][$columnName]['object']['textare']['id'] = null;
                       $config['table']['columns'][$columnName]['object']['textare']['html'] = false;
                       $config['table']['columns'][$columnName]['object']['textare']['cols'] = 50;
                       $config['table']['columns'][$columnName]['object']['textare']['rows'] = 10;
                   }
                   $config['table']['columns'][$columnName]['type'] = 'StringLong';
               } elseif (in_array($column['DATA_TYPE'], array('BLOB'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   $config['table']['columns'][$columnName]['object']['type'] = 'File';
                   if ($load) {
                       $config['table']['columns'][$columnName]['object']['file']['id'] = null;
                   }
                   $config['table']['columns'][$columnName]['type'] = 'BinaryLong';
               } elseif (in_array($column['DATA_TYPE'], array('DATE'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('DateTime', 'Date')))
                       $load = true;

                   if ($load) {
                       unset($config['table']['columns'][$columnName]['object'][strtolower($config['table']['columns'][$columnName]['object']['type'])]);

                       if (!isset($config['table']['columns'][$columnName]['object']['date'])) {
                           $config['table']['columns'][$columnName]['object']['date'] = array();
                       }

                       if (is_numeric(strpos(strtoupper($columnName), 'DH_'))) {
                           $config['table']['columns'][$columnName]['object']['type'] = 'DateTime';
                           $config['table']['columns'][$columnName]['object']['date']['css-width'] = '87.5px';
                           $config['table']['columns'][$columnName]['object']['date']['maxlength'] = 10;

                           $config['table']['columns'][$columnName]['object']['time']['css-width'] = '43.75px;';
                           $config['table']['columns'][$columnName]['object']['time']['maxlength'] = 5;
                           $config['table']['columns'][$columnName]['type'] = 'DateTime';
                       } else {
                           $config['table']['columns'][$columnName]['object']['type'] = 'Date';
                           $config['table']['columns'][$columnName]['object']['date']['css-width'] = '87.5px';
                           $config['table']['columns'][$columnName]['object']['date']['maxlength'] = 10;
                           $config['table']['columns'][$columnName]['object']['date']['id'] = null;
                           $config['table']['columns'][$columnName]['type'] = 'Date';
                       }
                   }
               } elseif (in_array($column['DATA_TYPE'], array('DATETIME'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('DateTime')))
                       $load = true;

                   if ($load) {
                       if (!isset($config['table']['columns'][$columnName]['object']['datetime'])) {
                           $config['table']['columns'][$columnName]['object']['datetime'] = array();
                       }

                       unset($config['table']['columns'][$columnName]['object'][strtolower($config['table']['columns'][$columnName]['object']['type'])]);
                       $config['table']['columns'][$columnName]['object']['type'] = 'DateTime';
                       $config['table']['columns'][$columnName]['object']['date']['css-width'] = '87.5px';
                       $config['table']['columns'][$columnName]['object']['date']['maxlength'] = 10;
                       $config['table']['columns'][$columnName]['object']['date']['id'] = null;

                       $config['table']['columns'][$columnName]['object']['time']['css-width'] = '43.75px';
                       $config['table']['columns'][$columnName]['object']['time']['maxlength'] = 5;
                       $config['table']['columns'][$columnName]['object']['time']['id'] = null;
                   }
                   $config['table']['columns'][$columnName]['type'] = 'DateTime';
               } elseif (in_array($column['DATA_TYPE'], array('TIME'))) {
                   $load = false;
                   if (!isset($config['table']['columns'][$columnName]['object']['type']))
                       $load = true;
                   elseif (!in_array($config['table']['columns'][$columnName]['object']['type'], array('Time')))
                       $load = true;

                   if ($load) {
                       if (!isset($config['table']['columns'][$columnName]['object']['time'])) {
                           $config['table']['columns'][$columnName]['object']['time'] = array();
                       }

                       unset($config['table']['columns'][$columnName]['object'][strtolower($config['table']['columns'][$columnName]['object']['type'])]);
                       $config['table']['columns'][$columnName]['object']['type'] = 'Time';
                       $config['table']['columns'][$columnName]['object']['time']['css-width'] = '43.75px';
                       $config['table']['columns'][$columnName]['object']['time']['maxlength'] = 5;
                       $config['table']['columns'][$columnName]['object']['time']['id'] = null;
                   }
                   $config['table']['columns'][$columnName]['type'] = 'Time';
               } elseif (in_array($column['DATA_TYPE'], array('NUMBER', 'INTEGER','DECIMAL'))) {
                   if (!isset($config['table']['columns'][$columnName]['object']['numeric'])) {
                       $config['table']['columns'][$columnName]['object']['numeric'] = array();
                   }

                   $config['table']['columns'][$columnName]['object']['type'] = 'Numeric';
                   $aux = explode('.', $column['LENGTH']);
                   $config['table']['columns'][$columnName]['object']['numeric']['numDecimal'] = $aux[1];
                   $config['table']['columns'][$columnName]['object']['numeric']['numInteger'] = $aux[0];
                   $config['table']['columns'][$columnName]['object']['numeric']['id'] = null;
                   unset($aux);
                   $config['table']['columns'][$columnName]['type'] = 'Number';
               }
               if ($column['NULLABLE'])
                   $config['table']['columns'][$columnName]['object']['required'] = false;
               else
                   $config['table']['columns'][$columnName]['object']['required'] = true;
           }
           if (count($primary) > 0) {
               $config['table']['primary'] = $primary;
           }
           if (count($config['table']['primary']) > 1) {
               unset($config['table']['sequenceName']);
           }
           foreach ($config['table']['columns'] as $columnName => $prop) {
               if (!isset($describeModel[strtoupper($columnName)])) {
                   unset($config['table']['columns'][$columnName]);
               }
           }
           if (!isset($config['table']['unique'])) {
               $config['table']['unique'] = array();
           }

           if (!isset($config['table']['description'])) {
               $config['table']['description'] = $config['table']['name'];
               /* $nameResponse = $this->_registry
                 ->getClient()
                 ->promptInteractiveInput("[ZendT] Informe a descricao da tabela?");
                 $description = $nameResponse->getContent();
                 $config['table']['description'] = utf8_encode($description); */
           }

           $content = "<?php
return " . var_export($config, true) . "
?>";
           file_put_contents($fileName, $content);
           $this->_print('Gerado o arquivo ' . $fileName);
       }

       /**
        *
        * @param string $table
        * @param string $adapter
        * @param string $module
        * @return void
        * @throws Zend_Tool_Project_Exception
        * @throws Exception 
        */
       public function create($table, $adapter, $module, $overwrite = 0) {
           $this->_registry->getRequest()->isPretend();
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           if (strtolower($overwrite) === 'yes') {
               $overwrite = 1;
           } else {
               $overwrite = 0;
           }
           $this->_create($this->_loadedProfile, $table, $adapter, $module, $overwrite);
       }

       /**
        *
        * @param type $table
        * @param type $module 
        */
       public function _removeCreate($path, $table, $module) {
           $pathBase = $path . '/application/configs/modules/' . strtolower($module);
           $config = require $pathBase . '/' . strtolower($table) . '.php';
           if (isset($config['table']['modelName'])) {
               $config['table']['modelName'] = $config['table']['name'];
           }

           $pathBase = $path . '/application/modules/' . strtolower($module);
           $tableClass = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);
           $tableView = strtolower(str_replace('_', '-', $config['table']['modelName']));
           /**
            * Controller 
            */
           @unlink($pathBase . '/controllers/' . $tableClass . 'Controller.php');
           $this->_print('Controller deleted');
           /**
            * Forms 
            */
           @unlink($pathBase . '/forms/' . $tableClass . '/Crud/Edit.php');
           @unlink($pathBase . '/forms/' . $tableClass . '/Edit.php');
           @unlink($pathBase . '/forms/' . $tableClass . '/Search.php');
           @rmdir($pathBase . '/forms/' . $tableClass . '/Crud');
           @rmdir($pathBase . '/forms/' . $tableClass);
           $this->_print('Form deleted');
           /**
            * Service 
            */
           @unlink($pathBase . '/services/' . $tableClass . '.php');
           $this->_print('Service deleted');
           /**
            * View 
            */
           @unlink($pathBase . '/views/scripts/' . $tableView . '/form.phtml');
           @unlink($pathBase . '/views/scripts/' . $tableView . '/grid.phtml');
           @unlink($pathBase . '/views/scripts/' . $tableView . '/search.phtml');
           @rmdir($pathBase . '/views/scripts/' . $tableView);
           $this->_print('Views deleted');
           /**
            * Models 
            */
           @unlink($pathBase . '/models/' . $tableClass . '/Crud/Table.php');
           @unlink($pathBase . '/models/' . $tableClass . '/Crud/Mapper.php');
           @unlink($pathBase . '/models/' . $tableClass . '/Crud/MapperView.php');
           @unlink($pathBase . '/models/' . $tableClass . '/Crud/Element.php');
           @rmdir($pathBase . '/models/' . $tableClass . '/Crud');

           @unlink($pathBase . '/models/' . $tableClass . '/Table.php');
           @unlink($pathBase . '/models/' . $tableClass . '/Mapper.php');
           @unlink($pathBase . '/models/' . $tableClass . '/MapperView.php');
           @unlink($pathBase . '/models/' . $tableClass . '/Element.php');
           @rmdir($pathBase . '/models/' . $tableClass);
           $this->_print('Models deleted');
       }

       /**
        *
        * @param type $path
        * @param type $table
        * @param type $module 
        */
       public function _removeConfig($path, $table, $module) {
           $pathBase = $path . '/application/configs/modules/' . strtolower($module);
           @unlink($pathBase . '/' . strtolower($table) . '.php');
       }

       /**
        *
        * @param type $table
        * @param type $module 
        */
       public function remove($table, $module) {
           $this->_registry->getRequest()->isPretend();
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $this->_removeCreate($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
           $this->_removeConfig($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
       }

       /**
        *
        * @param type $table
        * @param type $module 
        */
       public function removeCreate($table, $module) {
           $this->_registry->getRequest()->isPretend();
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $this->_removeCreate($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
       }

       /**
        *
        * @param type $table
        * @param type $module 
        */
       public function removeConfig($table, $module) {
           $this->_registry->getRequest()->isPretend();
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $this->_removeConfig($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
       }

       /**
        *
        * @param type $module 
        */
       public function removeAll($module) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);

           $nameResponse = $this->_registry
                 ->getClient()
                 ->promptInteractiveInput("[ZendT] Tem certeza que deseja excluir o modulo?(S/N oo Y/N)");
           $description = strtoupper($nameResponse->getContent());
           if ($description == 'S' || $description == 'Y') {
               $path = $this->_loadedProfile->getAttribute('projectDirectory');
               $path.= '/application/configs/modules/' . $module;
               $path = str_replace("\\", "/", $path);

               $this->_print('Varrendo: ' . $path);

               @$myDirectory = opendir($path);
               if ($myDirectory) {
                   while ($tableName = @readdir($myDirectory)) {
                       $fileName = $path . '/' . strtolower($tableName);
                       $fileName = str_replace('.php', '', $fileName);
                       $fileName.= '.php';
                       if (file_exists($fileName)) {
                           $configTable = require($fileName);
                           $table = $configTable['table']['name'];
                           $this->_removeCreate($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
                           $this->_removeConfig($this->_loadedProfile->getAttribute('projectDirectory'), $table, $module);
                       }
                   }
                   closedir($myDirectory);
               }
               /**
                * Remove as pastas da aplicaÃ§Ã£o 
                */
               @rmdir($path);
               $path = $this->_loadedProfile->getAttribute('projectDirectory');
               $path.= '/application/modules/' . $module;
               $path = str_replace("\\", "/", $path);
               @unlink($path . '/Bootstrap.php');
               @unlink($path . '/languages/pt_BR.php');
               @rmdir($path . '/languages');
               @rmdir($path . '/controllers');
               @rmdir($path . '/forms');
               @rmdir($path . '/reports');
               @rmdir($path . '/models/View');
               @rmdir($path . '/models');
               @rmdir($path . '/services');
               @rmdir($path . '/views/scripts');
               @rmdir($path . '/views');
               @rmdir($path);

               $this->_print($module . ' deleted');
           } else {
               $this->_print('Aborted');
           }
       }

       /**
        * Cria todos os dados das tabelas de um cÃ³dulo selecionado
        *
        * @param string $module
        * @param int $overwrite 
        */
       public function createAll($module, $overwrite = 0) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $path = $this->_loadedProfile->getAttribute('projectDirectory');
           $path.= '/application/configs/modules/' . $module;
           $path = str_replace("\\", "/", $path);

           $this->_print('Varrendo: ' . $path);

           $myDirectory = opendir($path);
           while ($tableName = @readdir($myDirectory)) {
               $fileName = $path . '/' . strtolower($tableName);
               $fileName = str_replace('.php', '', $fileName);
               $fileName.= '.php';
               if (file_exists($fileName)) {
                   $configTable = require($fileName);
                   /**
                    *  
                    */
                   $this->_create($this->_loadedProfile
                         , $configTable['table']['name']
                         , $configTable['table']['schema']
                         , $module
                         , $overwrite);
               }
           }
           closedir($myDirectory);
       }

       /**
        * Cria um modelo de relatÃ³rio
        *
        * @param string $name
        * @param string $module 
        */
       public function createReport($name, $module) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $path = $this->_loadedProfile->getAttribute('projectDirectory');

           ZendT_Tool_Crud_Report::create($path, $name, $module);
           $this->_print('Criado o modelo de relatÃ³rio em ' . $path . '/application/modules/' . $module . '/reports/' . $name . '.php');
       }

       public function createMapperView($table, $adapter, $name) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $path = $this->_loadedProfile->getAttribute('projectDirectory');

           $configTable = ZendT_Tool_Crud::getConfig($path, $table, $adapter);

           ZendT_Tool_Crud_MapperView::createView($path, $name, $configTable);
           $this->_print('Criado visÃ£o do modelo em ' . $path . '/application/modules/' . $configTable['table']['moduleName'] . '/models/' . $configTable['table']['name'] . '/view/' . $name . '.php');
       }

       public function loadResources($module, $session = 'development') {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $applicationConfigResource = $this->_loadedProfile->search('ApplicationConfigFile');

           if (!$applicationConfigResource) {
               throw new Zend_Tool_Project_Exception('A project with an application config file is required to use this provider.');
           }
           $zf = $applicationConfigResource->getAsZendConfig($session);

           foreach ($zf->resources->multidb as $name => $config) {
               //$this->_print($name);
               Zend_Registry::set('db.' . $name, $config);
           }

           $optionsAcl = $zf->resources->acl->toArray();
           ZendT_Acl::setOptions($optionsAcl);

           $pathBase = $this->_loadedProfile->getAttribute('projectDirectory');
           ZendT_Tool_Crud_MakeResources::make($pathBase, $module);
           $this->_print('Recursos carregados para o banco de dados');
       }

       public function factory($table, $module) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $path = $this->_loadedProfile->getAttribute('projectDirectory');
           $dirModules = $path . '/application/configs/modules';

           if (!is_dir($dirModules))
               mkdir($dirModules);

           $dirModule = $dirModules . '/' . $module;

           if (!is_dir($dirModule))
               mkdir($dirModule);

           $fileName = $dirModule . '/' . $table . '.php';

           if (!file_exists($fileName)) {
               throw new Zend_Tool_Project_Provider_Exception('Para executar essa aÃ§Ã£o Ã© necessÃ¡rio criar o arquivo ' . $fileName);
           }

           $config = require($fileName);
           $path.= '/application/modules/' . strtolower($module);

           /**
            * Gerando o DataView 
            */
           if (!isset($config['table']['modelName'])) {
               $config['table']['modelName'] = $config['table']['name'];
           }
           $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);

           /**
            * 
            */
           if (file_exists($path . '/models/' . $modelName . '/MapperView.php')) {
               ZendT_Lib::createDirectory($path, '/data-views/' . $modelName . '/Crud');

               copy($path . '/models/' . $modelName . '/Crud/MapperView.php', $path . '/data-views/' . $modelName . '/Crud/MapperView.php');
               unlink($path . '/models/' . $modelName . '/Crud/MapperView.php');
               $content = file_get_contents($path . '/data-views/' . $modelName . '/Crud/MapperView.php');
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_Crud_MapperView', ucfirst($module) . '_DataView_' . $modelName . '_Crud_MapperView', $content);
               file_put_contents($path . '/data-views/' . $modelName . '/Crud/MapperView.php', $content);

               copy($path . '/models/' . $modelName . '/MapperView.php', $path . '/data-views/' . $modelName . '/MapperView.php');
               unlink($path . '/models/' . $modelName . '/MapperView.php');
               $content = file_get_contents($path . '/data-views/' . $modelName . '/MapperView.php');
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_MapperView', ucfirst($module) . '_DataView_' . $modelName . '_MapperView', $content);
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_Crud_MapperView', ucfirst($module) . '_DataView_' . $modelName . '_Crud_MapperView', $content);
               file_put_contents($path . '/data-views/' . $modelName . '/MapperView.php', $content);

               $content = file_get_contents($path . '/controllers/' . $modelName . 'Controller.php');
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_MapperView', ucfirst($module) . '_DataView_' . $modelName . '_MapperView', $content);
               file_put_contents($path . '/controllers/' . $modelName . 'Controller.php', $content);

               $this->_print('Objeto MapperView fatorado com sucesso!');
           } else {
               $this->_print('Objeto MapperView já fatorado');
           }

           /**
            * 
            */
           if (file_exists($path . '/models/' . $modelName . '/Element.php')) {
               copy($path . '/models/' . $modelName . '/Crud/Element.php', $path . '/forms/' . $modelName . '/Crud/Elements.php');
               unlink($path . '/models/' . $modelName . '/Crud/Element.php');
               $content = file_get_contents($path . '/forms/' . $modelName . '/Crud/Elements.php');
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_Crud_Element', ucfirst($module) . '_Form_' . $modelName . '_Crud_Elements', $content);
               file_put_contents($path . '/forms/' . $modelName . '/Crud/Elements.php', $content);

               copy($path . '/models/' . $modelName . '/Element.php', $path . '/forms/' . $modelName . '/Elements.php');
               unlink($path . '/models/' . $modelName . '/Element.php');
               $content = file_get_contents($path . '/forms/' . $modelName . '/Elements.php');
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_Element', ucfirst($module) . '_Form_' . $modelName . '_Elements', $content);
               $content = str_replace(ucfirst($module) . '_Model_' . $modelName . '_Crud_Element', ucfirst($module) . '_Form_' . $modelName . '_Crud_Elements', $content);
               file_put_contents($path . '/forms/' . $modelName . '/Elements.php', $content);

               $this->_print('Objeto Element fatorado com sucesso!');
           } else {
               $this->_print('Objeto Element já fatorado');
           }

           ZendT_Lib::replaceFiles($path, ucfirst($module) . '_Model_' . $modelName . '_MapperView', ucfirst($module) . '_DataView_' . $modelName . '_MapperView');
           ZendT_Lib::replaceFiles($path, ucfirst($module) . '_Model_' . $modelName . '_Element', ucfirst($module) . '_Form_' . $modelName . '_Elements');

           $path = $this->_loadedProfile->getAttribute('projectDirectory');

           $this->_print(' Criando Tables ');
           ZendT_Tool_Crud_Table::create($path, $config);

           $this->_print(' Criando Mappers ');
           ZendT_Tool_Crud_Mapper::create($path, $config);

           $this->_print(' Criando MapperView ');
           ZendT_Tool_Crud_MapperView::create($path, $config);

           $this->_print(' Criando Elements ');
           ZendT_Tool_Crud_Element::create($path, $config);

           $this->_print(' Criando Form ');
           ZendT_Tool_Crud_Form::create($path, $config);

           $this->_print(' Criando Bootstrap ');
           ZendT_Tool_Crud_Bootstrap::create($path, $config, 1);

           $this->_print('Finalizado Factory ' . $table);
       }

       /**
        * Fatora todos os módulos de uma aplicação
        *
        * @param string $module
        * @param int $overwrite 
        */
       public function factoryAll($module) {
           $this->_loadProfile(self::NO_PROFILE_THROW_EXCEPTION);
           $path = $this->_loadedProfile->getAttribute('projectDirectory');
           $path.= '/application/configs/modules/' . $module;
           $path = str_replace("\\", "/", $path);

           $this->_print('Varrendo: ' . $path);
           $this->_print('-');

           $myDirectory = opendir($path);
           while ($tableName = @readdir($myDirectory)) {
               $fileName = $path . '/' . strtolower($tableName);
               $fileName = str_replace('.php', '', $fileName);
               $fileName.= '.php';
               if (file_exists($fileName)) {
                   $configTable = require($fileName);
                   $this->_print('Fatorando ' . $configTable['table']['name'] . '...');
                   $this->factory($configTable['table']['name'], $module);
                   $this->_print('-');
               }
           }
           closedir($myDirectory);

           $this->_print('Finalizado FactoryAll');
       }

   }
   