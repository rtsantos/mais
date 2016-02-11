<?php

    /**
     * Essa classe tem como finalidade levantar o ACL, com base
     * nos adaptadores informado no arquivo de configuração,
     * bem como analisar se a sessão está ativa e se o usuário
     * tem permissão de acesso
     *
     * @category   ZendT
     * @package    Acl
     */
    class ZendT_Acl {

        /**
         * @var array
         * @static
         */
        protected static $_options = null;

        /**
         *
         * @var ZendT_Acl 
         */
        protected static $_instance = null;

        /**
         * 
         * @var bool
         */
        private $_valid;

        /**
         * 
         * @var string
         */
        private $_message;

        /**
         * 
         * @var Zend_Acl
         */
        private $_acl;

        /**
         *
         * @var type 
         */
        private $_moduleLoaded;

        /**
         * 
         * @var array
         */
        public $objectToken;
        private $_started = false;

        /**
         * 
         * @return ZendT_Acl
         */
        public static function getInstance() {
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /**
         * 
         * @throws ZendT_Exception 
         */
        public function __construct() {
            /**
             * Configurações dos adaptares de ACL 
             */
            if (!isset(self::$_options['resource']['adapter'])) {
                throw new ZendT_Exception('Não configura no application.ini o resource resources.acl.resource.adapter ');
            }

            if (!isset(self::$_options['user']['adapter'])) {
                throw new ZendT_Exception('Não configura no application.ini o resource resources.acl.user.adapter ');
            }

            if (!isset(self::$_options['role']['adapter'])) {
                throw new ZendT_Exception('Não configura no application.ini o resource resources.acl.role.adapter ');
            }

            if (!isset(self::$_options['privilege']['adapter'])) {
                throw new ZendT_Exception('Não configura no application.ini o resource resources.acl.privilege.adapter ');
            }

            $this->_resource = self::$_options['resource']['adapter'];
            $this->_user = self::$_options['user']['adapter'];
            $this->_role = self::$_options['role']['adapter'];
            $this->_privilege = self::$_options['privilege']['adapter'];
            $this->_acl = null;
            $this->_started = false;
            $this->_moduleLoaded = null;
        }

        /**
         * Configura as opções de adaptadores
         * Essas informações devem vir do arquivo de configuração
         * 
         * @param array $options 
         */
        public static function setOptions($options) {
            self::$_options = $options;
        }

        /**
         * Retorna o objeto de papel
         * 
         * @return \ZendT_Acl_Role
         */
        protected function _getRole() {
            if (!is_object($this->_role)) {
                $this->_role = ZendT_Acl_Role::factory($this->_role);
            }

            return $this->_role;
        }

        /**
         * Retorna o objeto de recurso
         * 
         * @return \ZendT_Acl_Resource
         */
        protected function _getResource() {
            if (!is_object($this->_resource)) {
                $this->_resource = ZendT_Acl_Resource::factory($this->_resource);
            }

            return $this->_resource;
        }

        /**
         * Retorna o objeto os privilégios
         * 
         * @return \ZendT_Acl_Privilege
         */
        protected function _getPrivilege() {
            if (!is_object($this->_privilege)) {
                $this->_privilege = ZendT_Acl_Privilege::factory($this->_privilege);
            }

            return $this->_privilege;
        }

        /**
         * Retorna o objeto usuário
         * 
         * @return \ZendT_Acl_User
         */
        protected function _getUser() {
            if (!is_object($this->_user)) {
                $this->_user = ZendT_Acl_User::factory($this->_user);
            }

            return $this->_user;
        }

        /**
         * 
         * @return Zend_Cache
         */
        private function getObjectCache() {
            $frontendOptions = array(
                'lifetime' => 7200, // cache lifetime of 2 hours
                'automatic_serialization' => true
            );

            $backendOptions = array();
            $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);

            return $cache;
        }

        /**
         * Limpa o cache
         * 
         * @param string $idCache
         * @return void
         */
        public function clearCache($module) {
            $cache = $this->getObjectCache();
            $idCache = 'acl_' . strtolower($module);
            $cache->remove($idCache);
        }

        /**
         * Levando os dados do ACL
         * 
         * @return bool
         */
        public function startup($options = array('validSession' => true)) {
            $this->_started = true;
            $token = Zend_Controller_Front::getInstance()->getRequest()->getParam('token');
            $__idUserToken__ = Zend_Controller_Front::getInstance()->getRequest()->getParam('__idUserToken__');
            $__codeToken__ = Zend_Controller_Front::getInstance()->getRequest()->getParam('__codeToken__');
            $noLocation = Zend_Controller_Front::getInstance()->getRequest()->getParam('no_location');

            /**
             * Resgate os parâmetros usados no roteamento do FrontController
             * para carregarmos no Zend_Acl
             * 
             * Carregue o Acl de acordo com o módulo que o usuário querer
             * acessar
             */
            if (isset($options['module'])) {
                $moduleName = $options['module'];
            } else {
                $moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            }

            if (isset($options['controller'])) {
                $controllerName = $options['controller'];
            } else {
                $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
            }
            $actionName = Zend_Controller_Front::getInstance()->getRequest()->getActionName();

            /** processo usado para os sistemas que estão dentro do VB, não usar para os sistemas em PHP */
            if ($__idUserToken__ != '') {
                Zend_Auth::getInstance()->getStorage()->clear();

                $idUser = $__idUserToken__ * 1;
                $codeToken = $__codeToken__ * 1;

                if ($idUser == 0)
                    $idUser = 1;
                if ($codeToken == 0)
                    $codeToken = -1;

                $idUser = $idUser / 70; # algorítmo com a criptografia
                $idUser = $idUser / $codeToken;
                /**
                 * Levanto o objeto para o usuário
                 * Resgato os dados do usuário da sessão
                 */
                $user = $this->_getUser();
                $rowSession = $user->getRowSession($idUser);

                /**
                 * Verifico se existe id do usuário na sessão
                 * se não escreva nela os dados do usuário 
                 */
                if ($rowSession->getId() != '') {
                    if (!$noLocation) {
                        if ($_SESSION["logon"]["usuario"] != $rowSession->getLogin()) {
                            header('location:/Application/index.php?email=' . $rowSession->getLogin() . '&urlLocation=' . $_SERVER['PHP_SELF'] . '&module=' . $moduleName);
                            exit;
                        }
                    } else {
                        $storage = Zend_Auth::getInstance()->getStorage();
                        $storage->write($rowSession);
                        Zend_Auth::getInstance()->setStorage($storage);
                        /**
                         * Usado para sistema legado
                         */
                        $_SESSION["logon"]["active"] = 1;
                        $_SESSION["logon"]["id_usuario"] = $rowSession->getId();
                        $_SESSION["logon"]["usuario"] = $rowSession->getLogin();
                        $_SESSION["logon"]["nome"] = $rowSession->getName();
                        $_SESSION["logon"]["papel"] = $rowSession->getRole();
                    }
                } else {
                    $rowSession = new stdClass();
                }

                unset($user);
            } else if ($token) {
                $rowSession = new ZendT_Acl_User_Row();
                $rowSession->fromToken($token);
                /**
                 * Usado para sistema legado
                 */
                $_SESSION["logon"]["active"] = 1;
                $_SESSION["logon"]["id_usuario"] = $rowSession->getId();
                $_SESSION["logon"]["usuario"] = $rowSession->getLogin();
                $_SESSION["logon"]["nome"] = $rowSession->getName();
                $_SESSION["logon"]["papel"] = $rowSession->getRole();
            } else {
                #$rowSession = Zend_Auth::getInstance()->getStorage()->read();
                $rowSession = Auth_Session_User::getInstance()->getRowSession();
            }

            if (!($rowSession instanceof ZendT_Acl_User_Row)) {
                /**
                 * Usado para sistema legado
                 */
                $rowSession = new ZendT_Acl_User_Row();
                $rowSession->setId($_SESSION["logon"]["id_usuario"]);
                $rowSession->setLogin($_SESSION["logon"]["usuario"]);
                $rowSession->setName($_SESSION["logon"]["nome"]);
                $rowSession->setRole($_SESSION["logon"]["papel"]);
            }

            /**
             * Se não existir o id do usuário na sessão
             * e se o validar sessão estiver habilitado
             * 
             * Retorne para o usuário a mensagem de sessão expirada
             */
            if ($rowSession->getRole() == '' && $options['validSession']) {
                $this->_valid = false;
                $this->_message = "Sessão expirada, favor logar novamente!";

                /**
                 * Caso a sessão estiver de pé execute as regras relacionadas
                 * a disposição dos elementos da intranet de acordo com seu papel
                 *
                 */
            } else {
                /**
                 * Implemente o papel default para o usuário caso não haja na sessão
                 * um papel definido.
                 */
                if ($rowSession->getRole() == '') {
                    $rowSession->setRole('DEFAULT');
                }


                $this->loadAcl($moduleName);

                /**
                 * Registro o recurso acessado montando uma string
                 * com o module/controller/action 
                 */
                $resource = strtolower($moduleName) . '.' . //module
                        strtolower($controllerName) . '.' . //controller
                        strtolower($actionName);              //action

                $roles = $rowSession->getRoles();

                if ($actionName == 'filter-valid') {
                    $this->_valid = true;
                } else {
                    $this->_valid = $this->_acl->isAllowed($rowSession->getRole(), $resource);
					if (strpos($resource,'cms.') !== false){
					    $this->_valid = true;
					}
                    if (!$this->_valid && is_array($roles)) {
                        foreach ($roles as $role) {
                            $this->_valid = $this->_acl->isAllowed($role, $resource);
                            if ($this->_valid) {
                                break;
                            }
                        }
                    }
                }
                #$rowSession->dataMenu = array();

                if (!isset($rowSession->dataMenu[$moduleName])) {
                    $dataMenu = $this->_getResource()->getMenu($moduleName);
                    $roles = $rowSession->getRoles();
                    foreach ($dataMenu as $parentName => &$itens) {
                        foreach ($itens as $menu) {
                            $isAllow = $this->_acl->isAllowed($rowSession->getRole(), $menu->getParent());

                            if ($isAllow) {
                                $rowSession->dataMenu[$moduleName][$parentName][] = $menu->toArray();
                            }
                            if (!$isAllow && is_array($roles)) {

                                foreach ($roles as $role) {
                                    $isAllow = $this->_acl->isAllowed($role, $menu->getParent());
                                    if ($isAllow) {
                                        $rowSession->dataMenu[$moduleName][$parentName][] = $menu->toArray();
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    $rowSession->dataMenuEncode[$moduleName] = 'UTF8';
                    /**
                     * @todo 
                     */
                    /*
                      if ($rowSession->dataMenu[$moduleName]){
                      $rowSession->dataMenu[$moduleName] = 'loaded';
                      }
                     */

                    $storage = Zend_Auth::getInstance()->getStorage();
                    $storage->write($rowSession);
                    Zend_Auth::getInstance()->setStorage($storage);
                }

                $this->_message = "Acesso não autorizado!";
            }
        }

        /**
         * Valida se a sessão está valida
         * 
         * @return bool
         */
        public function isValid() {
            return $this->_valid;
        }

        /**
         * Retorna a mensagem de erro
         * 
         * @return string
         */
        public function getMessage() {
            return $this->_message;
        }

        /**
         * Analisa se o papel tem acesso ao recurso
         * 
         * @param string $name Nome da Ação
         * @param string $resourceBase Módulo e Controlador concatenado
         * @return bool
         */
        public function isAllowed($name, $resourceBase = null, $role = null) {
            if (!$this->_started)
                return true;

            $rowSession = Zend_Auth::getInstance()->getStorage()->read();
            $moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();

            if ($resourceBase == null) {
                $resourceBase = strtolower($moduleName) . '.' . strtolower($controllerName) . '.' . strtolower($name);
            } else {
                $resourceBase.= '.' . strtolower($name);
            }
            $aux = explode('.', $resourceBase);
            $moduleAccess = $aux[0];
            if ($this->_moduleLoaded != $moduleAccess) {
                $this->loadAcl($moduleAccess);
            }

            $isAllow = $this->_acl->isAllowed($rowSession->getRole(), $resourceBase);

            $roles = $rowSession->getRoles();

            if (!$isAllow && is_array($roles)) {

                foreach ($roles as $role) {
                    $isAllow = $this->_acl->isAllowed($role, $resourceBase);
                    if ($isAllow) {
                        break;
                    }
                }
            }

            return $isAllow;
        }

        /**
         * Analisa se o papel tem acesso ao recurso
         * 
         * @param string $name Nome da Ação
         * @param string $resourceBase Módulo e Controlador concatenado
         * @return bool
         */
        public function restriction($name, $resourceBase = null) {
            if (!$this->_started)
                return false;

            $rowSession = Zend_Auth::getInstance()->getStorage()->read();
            $moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();

            if ($resourceBase == null)
                $resourceBase = strtolower($moduleName) . '.' . strtolower($controllerName) . '.' . strtolower($name);
            else
                $resourceBase.= '.' . strtolower($name);

            $aux = explode('.', $resourceBase);
            $moduleAccess = $aux[0];
            if ($this->_moduleLoaded != $moduleAccess) {
                $this->loadAcl($moduleAccess);
            }

            return $this->_acl->isAllowed($rowSession->getRole(), $resourceBase);
        }

        /**
         * Implementa os roles, resources e privileges
         * no objeto Zend_Acl levantado
         * 
         * Para que assim começamos a definir os objetos a serem
         * exibidos na tela
         * 
         * @param string $module
         */
        private function loadAcl($module) {
            /**
             * Resgata o cache
             * Define o id do acl
             * 
             * Verifica se existe no cache um acl para o módulo
             * recebido por esta função
             */
            $cache = $this->getObjectCache();
            $idCache = 'acl_' . strtolower($module);
            $data = $cache->load($idCache);
            $this->_moduleLoaded = $module;

            if (!($data)) {
                $this->_acl = new Zend_Acl();

                /**
                 * Adiciona os papeis no ACL
                 * Para que posteriormente seja verificado os recursos
                 */
                $role = $this->_getRole();
                $roles = $role->getRoles();

                foreach ($roles as $row) {
                    /**
                     * Verifica se há existência de um papel pai
                     * se houver temos que adicionar um novo Zend_Acl_Role atribuindo
                     * a ele o nome do papel pai resgatado 
                     */
                    if ($row->getParent() != '') {
                        $this->_acl->addRole(new Zend_Acl_Role($row->getName()), $row->getParent());
                    } else {
                        $this->_acl->addRole(new Zend_Acl_Role($row->getName()));
                    }
                }

                /**
                 * Adiciona os recuros no ACL
                 */
                $resource = $this->_getResource();
                $resources = $resource->getResources($module);

                foreach ($resources as $resource) {
                    if ($resource->getParent() != '') {
                        $this->_acl->add(new Zend_Acl_Resource($resource->getName()), $resource->getParent());
                    } else {
                        $this->_acl->add(new Zend_Acl_Resource($resource->getName()));
                    }
                }

                /**
                 * Define as permissões que o usuário terá
                 * negando a ele acessar determinadas telas.
                 * Executar determinadas funções
                 */
                $privilege = $this->_getPrivilege();
                $privileges = $privilege->getPrivileges($module);
                foreach ($privileges as $privilege) {
                    if ($privilege->getAccess() == 'A') {
                        $this->_acl->allow($privilege->getRole(), $privilege->getResource());
                    } else {
                        $this->_acl->deny($privilege->getRole(), $privilege->getResource());
                    }
                }
                $data = serialize($this->_acl);
                $cache->save($data, $idCache);
            } else {
                $this->_acl = unserialize($data);
            }
        }

        /**
         * Retorna o registro do usuário
         * passando o token
         * 
         * @param string $token
         * @return \ZendT_Acl_User_Row 
         */
        public function getUserRow($token) {
            /**
             * @todo definir cryptografia
             */
            $idUser = base64_decode($token);
            $rowSession = $this->_getUser()->getRowSession($idUser);
            return $rowSession;
        }

    }

?>