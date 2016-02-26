<?php

    class ZendT_Cron_Bootstrap {

        /**
         *
         * @var array
         */
        private $_configs;

        /**
         *
         * @var string
         */
        private $_documentRoot;

        /**
         *
         * @var array
         */
        private $_object;

        /**
         *
         * @var string
         */
        private $_configIni;

        /**
         * 
         */
        public function __construct($options) {
            ob_start();
            spl_autoload_register(array($this, 'loader'));

            $this->_documentRoot = $options['documentRoot'];
            #echo $this->_documentRoot . "\n";
            $this->_object = $options['object'];

            if (!isset($options['configIni'])) {
                $this->_configIni = APPLICATION_PATH . '/configs/application.ini';
            } else {
                $this->_configIni = $options['configIni'];
            }
        }

        /**
         * 
         * @throws ZendT_Exception
         */
        private function _init() {
            $_config = new Zend_Config_Ini($this->_configIni, APPLICATION_ENV);
            $this->_configs = $_config->toArray();

            if ($this->_documentRoot == '') {
                throw new ZendT_Exception('"documentRoot" não configurado!');
            }

            if ($this->_object == '') {
                throw new ZendT_Exception('"object" não informado!');
            }
        }

        private function _initDb() {
            /**
             * Levanta as configurações dos registros
             */
            /**
             * Sobe as conexões do banco de dados
             */
            foreach ($this->_configs['resources']['multidb'] as $name => $config) {
                $db = Zend_Db::factory($config['adapter'], $config);
                Zend_Registry::set('db.' . $name, $db);
            }
        }

        public function run() {
            try {
                $this->_init();
                $this->_initDb();

                /* $rowSession = new ZendT_Acl_User_Row();
                  $rowSession->setId(1);
                  $rowSession->setLogin('ADMIN');
                  $rowSession->setName('USUARIO ADMINISTRADOR');
                  $rowSession->setRole('TA.INFORMATICA');

                  $storage = Zend_Auth::getInstance()->getStorage();
                  $storage->write($rowSession);
                  Zend_Auth::getInstance()->setStorage($storage); */
                /**
                 * 
                 */
                list($module) = explode('_', $this->_object['name']);
                Zend_Registry::set('module', strtolower($module));
                /**
                 * @todo codificar a entrada de parâmetros
                 */
                $obj = new $this->_object['name']();
                call_user_func_array(array($obj, $this->_object['method']), array());
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        public function loader($fileName) {
            $dirs = explode('_', $fileName);

            if (!in_array($dirs[0], array('Zend', 'ZendX', 'ZendT'))) {
                $dirs[0] = strtolower($dirs[0]);
            }

            $old = array();
            $new = array();

            $old[] = 'Context';
            $new[] = 'contexts';

            $old[] = 'DataView';
            $new[] = 'data-views';

            $old[] = 'Interface';
            $new[] = 'interfaces';

            $old[] = 'Session';
            $new[] = 'sessions';

            if (!in_array($dirs[0], array('Zend', 'ZendX', 'ZendT'))) {
                $old[] = 'Service';
                $new[] = 'services';
            }

            $old[] = 'Form';
            $new[] = 'forms';

            $old[] = 'Model';
            $new[] = 'models';

            $old[] = 'Model';
            $new[] = 'models';

            $dirs[1] = str_replace($old, $new, $dirs[1]);

            $filename = implode('/', $dirs);

            require_once $filename . '.php';
        }

        /**
         * 
         */
        public function __destruct() {
            $content = ob_get_contents();
            /**
             * @todo implementar log de saída
             */
        }

    }
    