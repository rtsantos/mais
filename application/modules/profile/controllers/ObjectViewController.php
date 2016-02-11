<?php

   class Profile_ObjectViewController extends ZendT_Controller_ActionCrud {

       public function init() {
           $this->_init();
           //$this->_startupAcl();
           $this->_serviceName = 'Profile_Service_ObjectView';
           $this->_formName = 'Profile_Form_ObjectView_Edit';
           $this->_formSearchName = 'Profile_Form_ObjectView_Search';
           $this->_mapper = new Profile_DataView_ObjectView_MapperView();
           /**
            * Configuração do Grid
            */
           $name = $this->getRequest()->getParam('name');
           if (!$name)
               $name = 'objectview';
           $this->setGrid(new ZendT_Grid('grid_' . $name));
       }

       /**
        *
        * @param string $mapperName
        * @return ZendT_Db_Mapper
        */
       private function _loadMapper($mapperName) {
           $_mapper = new $mapperName();
           return $_mapper;
       }

       /**
        *
        * @param string $formName
        * @return ZendT_Form
        */
       private function _loadForm($formName) {
           $_form = new $formName();
           return $_form;
       }

       private function _getTranslate($objectName) {
           $_module = explode('_', $objectName);
           $_module = $_module[0];
           $_module = strtolower($_module);
           $translate = Zend_Registry::get('translate_' . $_module);
           return $translate;
       }

       /**
        * Retorna as configurações do formulário
        *
        * @param array $row
        * @return array 
        */
       private function _getConfigForm($row) {

           $_objeto = $this->_loadForm($row['objeto']->get());
           $_objeto->loadElements();
           $elements = $_objeto->getElements();
           $columns = array();
           $_order = 1;

           foreach ($elements as $name => $value) {
               if (!$value->isHidden()) {
                   $columns[$name]['label'] = $value->getLabel();
                   $ordem = $value->getOrder();
                   if ($ordem == null) {
                       $ordem = $_order;
                   }
                   $columns[$name]['value'] = $value->getValue();
                   $columns[$name]['ordem'] = $ordem;
                   $columns[$name]['required'] = ($value->isRequired() ? 1 : 0);
                   $columns[$name]['width'] = $value->getAttrib('css-width');
                   $columns[$name]['height'] = $value->getAttrib('css-height');
                   $columns[$name]['minWidthBox'] = $value->getAttribBox('min-width');
                   $columns[$name]['minHeightBox'] = $value->getAttribBox('min-height');
                   $_order++;
               }
           }

           $config = unserialize(html_entity_decode($row['config']->get()));

           $configDefault = array('default' => array(
                 'name' => 'cols-default',
                 'label' => 'Grupo Padrão',
                 'draggable' => 0,
                 'created-by-user' => 0,
                 'fields' => array()
              ),
           );

           if (!$config || count($config) == 0) {
               $config = $configDefault;
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               #$config = ZendT_Sort::sortArray($config, 'order');
               foreach ($config as $key => $value) {
                   if (isset($value['fields'])) {
                       foreach ($value['fields'] as $chave => $configs) {
                           if (isset($columns[$chave])) {
                               unset($columns[$chave]);
                           }
                       }
                   }
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }

           if (count($config['ini']['fields']) == 0) {
               $config['ini']['fields'] = array();
           }

           return $config;
       }

       private function _getConfigGrid($row) {

           $_mapper = $this->_loadMapper($row['objeto']->get());
           $columns = $_mapper->getColumns()->toArray();

           $_translate = $this->_getTranslate($row['objeto']->get());

           foreach ($columns as $name => $value) {
               $columns[$name]['label'] = $_translate->_($value['label']);
               $columns[$name]['width'] = $value['width'];
               $columns[$name]['order'] = $value['ordem'];
               $columns[$name]['align'] = $value['align'];
               if ($value['required'])
                   $columns[$name]['required'] = 1;
               else
                   $columns[$name]['required'] = 0;
           }
           $config = unserialize(html_entity_decode($row['config']->get()));

           /**
            * 
            */
           if (!$config || count($config) == 0) {
               $config = array('detail' => array(
                     'name' => 'cols-detail',
                     'label' => 'Colunas Visíveis',
                     'draggable' => 0,
                     'fields' => array()
                  ),
               );
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               #$config = ZendT_Sort::sortArray($config, 'order');
               foreach ($config as $key => $value) {
                   unset($columns[$key]);
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }
           return $config;
       }

       private function _getConfigChart($row) {

           $_mapper = $this->_loadMapper($row['objeto']->get());
           $columns = $_mapper->getColumns()->toArray();

           $_translate = $this->_getTranslate($row['objeto']->get());
           foreach ($columns as $name => $value) {
               $columns[$name]['label'] = $_translate->_($value['label']);
               $columns[$name]['width'] = $value['width'];
               $columns[$name]['order'] = $value['ordem'];
               $columns[$name]['align'] = $value['align'];
               if ($value['required'])
                   $columns[$name]['required'] = 1;
               else
                   $columns[$name]['required'] = 0;
           }
           $config = unserialize(html_entity_decode($row['config']->get()));

           /**
            * 
            */
           if (!$config || count($config) == 0) {
               $config = array('axis' => array(
                     'name' => 'cols-axis',
                     'label' => 'Eixo',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'measures' => array(
                     'name' => 'cols-measures',
                     'label' => 'Medidas',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'cols-filter' => array(
                     'name' => 'cols-filter',
                     'label' => 'Colunas de Filtro',
                     'draggable' => 1,
                     'fields' => array()
                  ),
               );
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               #$config = ZendT_Sort::sortArray($config, 'order');
               foreach ($config as $key => $value) {
                   unset($columns[$key]);
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }
           return $config;
       }

       private function _getConfigDynamic($row) {

           $_mapper = $this->_loadMapper($row['objeto']->get());
           $columns = $_mapper->getColumns()->toArray();

           $_translate = $this->_getTranslate($row['objeto']->get());
           foreach ($columns as $name => $value) {
               $columns[$name]['label'] = $_translate->_($value['label']);
               $columns[$name]['width'] = $value['width'];
               $columns[$name]['order'] = $value['ordem'];
               $columns[$name]['align'] = $value['align'];
               if ($value['required'])
                   $columns[$name]['required'] = 1;
               else
                   $columns[$name]['required'] = 0;
           }
           $config = unserialize(html_entity_decode($row['config']->get()));

           /**
            * 
            */
           if (!$config || count($config) == 0) {
               $config = array('lines' => array(
                     'name' => 'cols-lines',
                     'label' => 'Rótulo de Linhas',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'cols' => array(
                     'name' => 'cols-cols',
                     'label' => 'Rótulo de Colunas',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'measures' => array(
                     'name' => 'cols-values',
                     'label' => 'Valores',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'cols-filter' => array(
                     'name' => 'cols-filter',
                     'label' => 'Colunas de Filtro',
                     'draggable' => 1,
                     'fields' => array()
                  )
               );
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               #$config = ZendT_Sort::sortArray($config, 'order');
               foreach ($config as $key => $value) {
                   unset($columns[$key]);
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }
           /* echo '<pre>';
             print_r($columns);
             echo '</pre>'; */
           return $config;
       }

       private function _getConfigReport($row) {
           $_mapper = $this->_loadMapper($row['objeto']->get());
           $columns = $_mapper->getColumns()->toArray();
           /* echo '<pre>';
             print_r($columns);
             echo '</pre>'; */

           $_translate = $this->_getTranslate($row['objeto']->get());
           foreach ($columns as $name => $value) {
               $columns[$name]['label'] = $_translate->_($value['label']);
               $columns[$name]['width'] = $value['width'];
               $columns[$name]['order'] = $value['ordem'];
               $columns[$name]['align'] = $value['align'];
               $columns[$name]['column'] = $value['column'];
               $columns[$name]['type'] = $value['type'];
           }
           $config = unserialize(html_entity_decode($row['config']->get()));

           /**
            * 
            */
           if (!$config || count($config) == 0) {
               $config = array('cols-detail' => array(
                     'name' => 'cols-detail',
                     'label' => 'Colunas de Detalhe',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'cols-break' => array(
                     'name' => 'cols-break',
                     'label' => 'Colunas de Quebra',
                     'draggable' => 0,
                     'fields' => array()
                  ), 'cols-filter' =>
                  array(
                     'name' => 'cols-filter',
                     'label' => 'Colunas de Filtro',
                     'draggable' => 1,
                     'fields' => array()
                  ),
               );
           } else if (!$config['cols-filter']) {
               $config['cols-filter'] = array(
                  'name' => 'cols-filter',
                  'label' => 'Colunas de Filtro',
                  'draggable' => 1,
                  'fields' => array()
               );
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               #$config = ZendT_Sort::sortArray($config, 'order');
               foreach ($config as $key => $value) {
                   unset($columns[$key]);
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }
           return $config;
       }

       private function _getConfigDashboard($row) {
           //$_mapper = $this->_loadMapper($row['objeto']->get());
           $_profile = new ZendT_Profile();
           $profiles = $_profile->listProfile($row['objeto']->get());

           $columns = array();
           foreach ($profiles as $id => $profile) {
               $name = 'view-' . $id . '-' . str_replace(' ', '_', strtolower(removeAccent($profile['nome'])));
               if ($profile['tipo'] != 'B') {
                   $columns[$name]['label'] = $profile['nome'];
                   $columns[$name]['width'] = 300;
                   $columns[$name]['order'] = null;
                   $columns[$name]['align'] = 'left';
                   $columns[$name]['column'] = $id;
                   $columns[$name]['id'] = $id;
                   $columns[$name]['type'] = null;
               }
           }
           $config = unserialize(html_entity_decode($row['config']->get()));
           /**
            * 
            */
           if (!isset($config['cols-panel'])) {
               $config = array(
                  'cols-panel' => array(
                     'name' => 'cols-panel',
                     'label' => 'Painel de Visões',
                     'draggable' => 0,
                     'fields' => array()
                  ),
                  'cols-filter' => array(
                     'name' => 'cols-filter',
                     'label' => 'Painel de Filtros',
                     'draggable' => 1,
                     'fields' => array()
                  )
               );
           }

           /**
            * Ordena as colunas 
            */
           if ($config) {
               foreach ($config as $key => $value) {
                   unset($columns[$key]);
               }
           }

           /**
            * Adiciona as novas colunas ou as que não foram configuradas
            */
           foreach ($columns as $name => $column) {
               if ($columns[$name]['label']) {
                   $column['hidden'] = 1;
                   $config['ini']['fields'][$name] = $column;
               }
           }
           return $config;
       }

       public function configAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               $id = $this->getRequest()->getParam('id');
               $row = $this->getMapper()->setId($id)->retriveRow();

               if ($row['tipo']->toPhp() == 'F') {
                   $config = $this->_getConfigForm($row);
               } else if ($row['tipo']->toPhp() == 'G') {
                   $config = $this->_getConfigGrid($row);
               } else if ($row['tipo']->toPhp() == 'P' || $row['tipo']->toPhp() == 'X') {
                   $config = $this->_getConfigReport($row);
               } else if ($row['tipo']->toPhp() == 'C') {
                   $config = $this->_getConfigChart($row);
               } else if ($row['tipo']->toPhp() == 'D') {
                   $config = $this->_getConfigDynamic($row);
               } else if ($row['tipo']->toPhp() == 'B') {
                   $config = $this->_getConfigDashboard($row);
               }

               $_prev = new Profile_DataView_ObjectViewPriv_MapperView();
               $_where = new ZendT_Db_Where();
               $_where->addFilter('profile_object_view_priv.id_profile_object_view', $id);
               $rows = $_prev->recordset($_where);

               $config['row'] = $row;
               $config['row']['padrao'] = $config['row']['padrao']->toPhp();
               $config['advanced']['owner'] = '';
               $config['advanced']['share'] = '';
               unset($config['advanced']['owner-multiple']);
               unset($config['advanced']['share-multiple']);

               while ($row = $rows->getRow()) {
                   if ($row['tipo']->toPhp() == 'O') {
                       $config['advanced']['owner'].= ';' . $row['nome_papel']->get();
                   } else {
                       $config['advanced']['share'].= ';' . $row['nome_papel']->get();
                   }
               }

               $config['advanced']['owner'] = substr($config['advanced']['owner'], 1);
               $config['advanced']['share'] = substr($config['advanced']['share'], 1);

               if ($config['ini']['fields']) {
                   $config['ini']['fields'] = ZendT_Sort::sortArray($config['ini']['fields'], 'label');
               }
               $json->setResult($config);

               /* Verifica se o campo que foi passado como filtro existe */
               $field = $this->getRequest()->getParam('field');
               if ($field) {
                   if (isset($config['ini']['fields'][$field])) {
                       $json->setResult(array("exists" => true));
                   } else {
                       $json->setResult(array("exists" => false));
                   }
               }
           } catch (Exception $ex) {
               $json->setException($ex);
           }
           echo $json->render();
       }

       public function listConfigAction() {
           Zend_Layout::getMvcInstance()->setLayout('window');

           $idUsuario = Auth_Session_User::getInstance()->getId();
           $login = Auth_Session_User::getInstance()->getLogin();
           $role = Auth_Session_User::getInstance()->getRole();

           $id = $this->getRequest()->getParam('id');
           if (!$id) {
               $id = $this->getRequest()->getParam('id_profile');
           }
           $tipo = $this->getRequest()->getParam('tipo');
           if (!$tipo) {
               $tipo = $this->getRequest()->getParam('tipo_profile');
           }
           $objeto = $this->getRequest()->getParam('objeto');
           if (!$objeto) {
               $objeto = $this->getRequest()->getParam('objeto_profile');
           }
           $uri = $this->getRequest()->getParam('uri');
           if (!$uri) {
               $uri = $this->getRequest()->getParam('uri_profile');
           }
           $chave = $this->getRequest()->getParam('chave');
           if (!$chave) {
               $chave = $this->getRequest()->getParam('chave_profile');
           }

           $_where = new ZendT_Db_Where();
           $_where->addFilter('profile_object_view.objeto', $objeto, '=', $this->getModel()->getMapperName());
           $_where->addFilter('profile_object_view.tipo', $tipo, '=', $this->getModel()->getMapperName());


           $_whereSec = new ZendT_Db_Where('OR');
           $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
           $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                SELECT 1
                    FROM ". Profile_Model_ObjectViewPriv_Mapper::$table ." po
                    JOIN ". Auth_Model_Conta_Mapper::$table ." p ON (po.id_papel = p.id)
                    WHERE po.id_profile_object_view = profile_object_view.id
                    AND po.tipo = 'O'
                    AND " . $this->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
            )"), 'EXISTS');

           $_whereGroup = new ZendT_Db_Where_Group('AND');
           $_whereGroup->addWhere($_where);
           $_whereGroup->addWhere($_whereSec);

           $this->view->arrTipos = $this->getModel()->getListOptions('tipo');

           $tipos = new ZendT_View_Select('tipoVisao', $tipo, $this->view->arrTipos);
           $this->view->tipos = $tipos;
           $this->view->tipo = $tipo;
           $this->view->rows = $this->getMapper()->getDataGrid($_whereGroup, array('noPage' => true));
           $this->view->objeto = $objeto;
           $this->view->id = $id;
           $this->view->role = $role;
           $this->view->login = $login;
           $this->view->idUsuario = $idUsuario;
           $this->view->uri = $uri;
           $this->view->chave = $chave;

           $formAdvanced = new Profile_Form_ObjectView_Dynamic();
           $formAdvanced->loadElements();
           $this->view->formAdvanced = $formAdvanced;
       }

       public function saveAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               $id = $this->getRequest()->getParam('id');
               $nome = $this->getRequest()->getParam('nome');
               $chave = $this->getRequest()->getParam('chave');
               $padrao = $this->getRequest()->getParam('padrao');
               if (!in_array($padrao, array('S', 'N'))) {
                   $padrao = 'N';
               }
               $observacao = $this->getRequest()->getParam('observacao');
               $config = serialize($this->getRequest()->getParam('groups'));

               //print_r($config);

               $this->getMapper()->setId($id)
                     ->setNome($nome)
                     ->setChave($chave)
                     ->setPadrao($padrao)
                     ->setObservacao($observacao)
                     ->setConfig($config)
                     ->update();

               $json->setResult($id);
           } catch (Exception $ex) {
               $json->setException($ex);
           }
           echo $json->render();
       }

       public function copyAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               $idUsuario = Auth_Session_User::getInstance()->getId();
               $id = $this->getRequest()->getParam('id');
               $nome = $this->getRequest()->getParam('nome');
               $privileges = $this->getRequest()->getParam('privileges');
               $this->getMapper()->setId($id);
               $this->getMapper()->retrive();
               $this->getMapper()->setId(null);
               $this->getMapper()->setNome($nome);
               $this->getMapper()->setIdUsuario($idUsuario);
               $this->getMapper()->insert();
               $idCopyFrom = '';
               if ($privileges) {
                   $idCopyFrom = $id;
               }
               $this->getMapper()->setDefaultPrivilege($this->getMapper()->getId(), $idCopyFrom);
               $json->setResult($this->getMapper()->getId()->get());
           } catch (Exception $ex) {
               $json->setException($ex);
           }
           echo $json->render();
       }

       public function setDefaultAction() {
           Zend_Session::start();
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);

           $json = new ZendT_Json_Result();
           try {
               $id = $this->getRequest()->getParam('id');
               $objeto = $this->getRequest()->getParam('objeto');

               $_mapper = new Profile_Model_ObjectView_Mapper();
               $_mapper->setId($id)->retrive();
               $chave = $_mapper->getChave()->get();

               setcookie("profile-" . $objeto, $id, time() + 60 * 60 * 24 * 7); # 7 dias
               $_SESSION["profile-" . $objeto] = $id;
               if ($chave) {
                   setcookie("profile-" . $objeto . "-chave", $chave, time() + 60 * 60 * 24 * 7); # 7 dias
                   $_SESSION["profile-" . $objeto . "-chave"] = $chave;
               } else {
                   unset($_SESSION["profile-" . $objeto . "-chave"]);
                   unset($_COOKIE["profile-" . $objeto . "-chave"]);
               }
               $json->setResult(true);
           } catch (Exception $ex) {
               $json->setException($ex);
           }
           echo $json->render();
       }

       public function formConfigAction() {
           Zend_Layout::getMvcInstance()->setLayout('ajax');

           $typeObjectView = $this->getRequest()->getParam('type_object_view');
           $typeGroup = $this->getRequest()->getParam('type_group');
           $columnName = $this->getRequest()->getParam('column_name');
           $objectName = $this->getRequest()->getParam('object_name');


           $columns = array();
           if ($typeObjectView == 'F') {
               #$_formObject = $this->_loadForm($objectName);
               #$columns = $_formObject->getElements();
           } else {
               $_mapper = $this->_loadMapper($objectName);
               $columns = $_mapper->getColumns()->toArray();
           }

           $columnType = '';
           if (isset($columns[$columnName]['type'])) {
               $columnType = $columns[$columnName]['type'];
           }

           $form = new Profile_Form_ObjectView_ConfigColumn();
           $form->setColumnType($columnType);

           if (isset($columns[$columnName]['seeker'])) {
               $form->setSeeker(true);
           }

           $explType = explode('-', $typeGroup);
           $method = '';

           if ($typeObjectView == 'F') {
               $method = 'loadElementsForm';
           } else if ($typeObjectView == 'B') {
               $method = 'loadElementsDashbord';
           } else {
               $method = 'loadElements' . $typeObjectView . ucfirst($explType[0]);
               if (!method_exists(get_class($form), $method)) {
                   if ($explType[0] == 'ini') {
                       $method = $method . 'Exp';
                   } else {
                       $method = $method . ucfirst($explType[1]);
                   }
               }
           }

           try {
               $form->{$method}();
           } catch (Exception $e) {
               $form->loadElements();
           }

           $form->setName('configColumn');

           $this->view->columnName = $columnName;
           $this->view->form = $form;
       }

       public function insertAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               $this->getMapper()->populate($param);
               $data = $this->getMapper()->insert();
               if ($data['id']) {
                   $this->getMapper()->setDefaultPrivilege($data['id']);
               }
               $json->setResult($data['id']->toPhp());
           } catch (Exception $Ex) {
               $json->setException($Ex);
           }
           echo $json->render();
       }

       public function deleteAction() {
           $param = $this->getRequest()->getParams();
           if ($param['id']) {
               $_objectViewPriv = new Profile_Model_ObjectViewPriv_Mapper();
               $_objectViewPriv->setIdProfileObjectView($param['id'])->delete();
           }
           parent::deleteAction();
       }

       public function countPrivilegesAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               $count = 0;
               if ($param['id']) {
                   $count = $this->getMapper()->getCountPrivilege($param['id']);
               }
           } catch (Exception $Ex) {
               $json->setException($Ex);
           }
           $json->setResult(array("count" => $count));
           echo $json->render();
       }

       public function existsFieldAction() {
           $this->_helper->layout->disableLayout();
           $this->_helper->viewRenderer->setNoRender(true);
           $json = new ZendT_Json_Result();
           try {
               $param = $this->getRequest()->getParams();
               if ($param['id']) {
                   $count = $this->getMapper()->getCountPrivilege($param['id']);
               }
           } catch (Exception $Ex) {
               $json->setException($Ex);
           }
           $json->setResult(array("count" => $count));
           echo $json->render();
       }

   }

?>
