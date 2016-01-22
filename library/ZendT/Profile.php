<?php

    /**
     * Description of Profile
     *
     * @author rsantos
     */
    class ZendT_Profile {

        /**
         * Lista os Profile do usuário, para preencher o Combobox
         * 
         * @param string $objectName
         * @param string $type
         * @param array $user
         * @return array
         */
        public static function listProfile($objectName, $type = '', $user = array()) {

            $listProfile = array();
            $_profile = new Profile_DataView_ObjectView_MapperView();

            $session = Zend_Auth::getInstance()->getStorage()->read();
            if ($session !== null || $user) {
                if ($user) {
                    $idUsuario = $user['id'];
                    $role = $user['role'];
                } else {
                    $idUsuario = $session->getId();
                    $role = $session->getRole();
                }
                #print_r($role);

                $_where = new ZendT_Db_Where('AND');
                $_where->addFilter('profile_object_view.objeto', $objectName);
                if (is_array($type))
                    $_where->addFilter('profile_object_view.tipo', $type, 'in');
                else if ($type)
                    $_where->addFilter('profile_object_view.tipo', $type);

                $profileKey = Zend_Controller_Front::getInstance()->getRequest()->getParam('profile_key');
                if ($profileKey) {
                    $_where->addFilter('profile_object_view.chave', $profileKey);
                }

                $_whereSec = new ZendT_Db_Where('OR');
                $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
                $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                    SELECT 1
                      FROM profile_object_view_priv po
                      JOIN papel p ON (po.id_papel = p.id)
                     WHERE po.id_profile_object_view = profile_object_view.id
                       AND " . $_profile->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
                )"), 'EXISTS');

                $_whereGroup = new ZendT_Db_Where_Group();
                $_whereGroup->addWhere($_whereSec);
                $_whereGroup->addWhere($_where);

                $_profile->findAll($_whereGroup, array('id', 'tipo', 'nome', 'observacao', 'config'), array('2', '3'));
                while ($_profile->fetch()) {
                    $key = $_profile->getId()->get();
                    $listProfile[$key] = array(
                        'tipo' => $_profile->getTipo()->toPhp(),
                        'tipoDescricao' => $_profile->getTipo()->get(),
                        'nome' => $_profile->getNome()->get(),
                        'observacao' => $_profile->getObservacao()->get(),
                        'config' => $_profile->getConfig()->get(),
                    );
                }
            }

            return $listProfile;
        }

        public static function get($objectName, $type, $profile = '') {
            $config = array();
            $row = false;

            $session = Zend_Auth::getInstance()->getStorage()->read();
            $idUsuario = '';
            $idProfile = '';
            $role = '';
            if ($session !== null) {
                $idUsuario = $session->getId();
                $role = $session->getRole();
            }
            $_profile = new Profile_DataView_ObjectView_MapperView();

            $request = Zend_Controller_Front::getInstance()->getRequest();

            if (is_object($request)) {
                if (!$profile) {
                    $profile = $request->getParam('profile');
                }

                $parentId = $request->getParam('profile_parent_id');

                $profileKey = $request->getParam('profile_key');
            }

            if ($parentId && is_numeric($parentId)) {
                $_profile->newRow()->setId($parentId)->retrieve();
                $chave = $_profile->getChave()->get();
                /**
                 * 
                 */
                $_where = new ZendT_Db_Where('AND');
                $_where->addFilter('profile_object_view.objeto', $objectName);
                $_where->addFilter('profile_object_view.chave', $chave);
                if (is_array($type))
                    $_where->addFilter('profile_object_view.tipo', $type, 'in');
                else if ($type)
                    $_where->addFilter('profile_object_view.tipo', $type);

                $_whereSec = new ZendT_Db_Where('OR');
                $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
                $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                    SELECT 1
                      FROM profile_object_view_priv po
                      JOIN papel p ON (po.id_papel = p.id)
                     WHERE po.id_profile_object_view = profile_object_view.id
                       AND " . $_profile->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
                )"), 'EXISTS');

                $_whereGroup = new ZendT_Db_Where_Group();
                $_whereGroup->addWhere($_whereSec);
                $_whereGroup->addWhere($_where);


                $row = $_profile->retriveRow($_whereGroup);
                if ($row) {
                    $profile = $row['id']->get();
                }
            }
            if (!$profile) {
                if ($profileKey) {
                    $_where = new ZendT_Db_Where('AND');
                    $_where->addFilter('profile_object_view.objeto', $objectName);
                    $_where->addFilter('profile_object_view.chave', $profileKey);
                    if (is_array($type))
                        $_where->addFilter('profile_object_view.tipo', $type, 'in');
                    else if ($type)
                        $_where->addFilter('profile_object_view.tipo', $type);
                    $row = $_profile->retriveRow($_where);
                    if ($row) {
                        $profile = $row['id']->get();
                    }
                }
            }
            if ($profile) {
                if (!is_numeric($profile)) {
                    $_where = new ZendT_Db_Where('AND');
                    $_where->addFilter('profile_object_view.objeto', $objectName);
                    $_where->addFilter('profile_object_view.chave', $profile, '=');
                    $row = $_profile->retriveRow($_where);
                    if ($row) {
                        $profile = $row['id']->get();
                    }
                }
                $idProfile = $profile;
            }
            if (isset($_COOKIE['profile-' . $objectName . '-' . $type]) && $idProfile == '') {
                $idProfile = $_COOKIE['profile-' . $objectName . '-' . $type];
            }
            if (isset($_COOKIE['profile-' . $objectName]) && $idProfile == '') {
                $idProfile = $_COOKIE['profile-' . $objectName];
            }
            if (isset($_SESSION['profile-' . $objectName]) && $idProfile == '') {
                $idProfile = $_SESSION['profile-' . $objectName];
            }
            if ($idProfile) {
                $_where = new ZendT_Db_Where();
                $_where->addFilter('profile_object_view.id', $idProfile);

                $_whereSec = new ZendT_Db_Where('OR');
                $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
                $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                    SELECT 1
                      FROM profile_object_view_priv po
                      JOIN papel p ON (po.id_papel = p.id)
                     WHERE po.id_profile_object_view = profile_object_view.id
                       AND " . $_profile->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
                )"), 'EXISTS');

                $_whereGroup = new ZendT_Db_Where_Group();
                $_whereGroup->addWhere($_whereSec);
                $_whereGroup->addWhere($_where);

                $row = $_profile->retriveRow($_whereGroup);
            }

            if ($idUsuario && !$row) {
                $_where = new ZendT_Db_Where('AND');
                $_where->addFilter('profile_object_view.objeto', $objectName);
                $_where->addFilter('profile_object_view.padrao', 'S');
                if (is_array($type))
                    $_where->addFilter('profile_object_view.tipo', $type, 'in');
                else if ($type)
                    $_where->addFilter('profile_object_view.tipo', $type);

                $_whereSec = new ZendT_Db_Where('OR');
                $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
                $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                    SELECT 1
                      FROM profile_object_view_priv po
                      JOIN papel p ON (po.id_papel = p.id)
                     WHERE po.id_profile_object_view = profile_object_view.id
                       AND " . $_profile->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
                )"), 'EXISTS');

                $_whereGroup = new ZendT_Db_Where_Group();
                $_whereGroup->addWhere($_whereSec);
                $_whereGroup->addWhere($_where);


                $row = $_profile->retriveRow($_whereGroup);
            }

            if ($idUsuario && !$row) {
                $_where = new ZendT_Db_Where('AND');
                $_where->addFilter('profile_object_view.objeto', $objectName);
                if (is_array($type))
                    $_where->addFilter('profile_object_view.tipo', $type, 'in');
                else if ($type)
                    $_where->addFilter('profile_object_view.tipo', $type);

                $_whereSec = new ZendT_Db_Where('OR');
                $_whereSec->addFilter('profile_object_view.id_usuario', $idUsuario);
                $_whereSec->addFilter('acesso_liberado', new Zend_Db_Expr("(
                    SELECT 1
                      FROM profile_object_view_priv po
                      JOIN papel p ON (po.id_papel = p.id)
                     WHERE po.id_profile_object_view = profile_object_view.id
                       AND " . $_profile->getModel()->getAdapter()->quote($role) . " LIKE p.nome || '%'
                )"), 'EXISTS');

                $_whereGroup = new ZendT_Db_Where_Group();
                $_whereGroup->addWhere($_whereSec);
                $_whereGroup->addWhere($_where);


                $row = $_profile->retrieveRow($_whereGroup);
            }

            if ($row) {
                $config = unserialize(html_entity_decode($row['config']->get()));
                /*
                  echo '<pre>';
                  print_r($config);
                  echo '</pre>';
                 */
                $config['id'] = $row['id']->get();
                $config['tipo'] = $row['tipo']->toPhp();
                $config['title'] = $row['nome']->get();
            }
            return $config;
        }

    }

?>