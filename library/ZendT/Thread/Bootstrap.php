<?php

    class ZendT_Thread_Bootstrap {

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
         * @var string
         */
        private $_processId;

        /**
         *
         * @var string
         */
        private $_configIni;

        /**
         *
         * @var string
         */
        private $_dirTmp;

        /**
         *
         * @var string
         */
        private $_fileNameIn;

        /**
         *
         * @var string
         */
        private $_fileNameOut;

        /**
         *
         * @var string
         */
        private $_fileNameError;

        /**
         * 
         */
        public function __construct($options) {
            //ob_start();
            spl_autoload_register(array($this, 'loader'));

            $this->_documentRoot = $options['documentRoot'];
            $this->_processId = $options['processId'];

            if (!isset($options['dirTmp'])) {
                $this->_dirTmp = '/sistemas/batch/data';
            } else {
                $this->_dirTmp = $options['dirTmp'];
            }

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

            if ($this->_processId == '') {
                throw new ZendT_Exception('"processId" não informado!');
            }

            //$path = $this->_documentRoot . $this->_dirTmp;
            $this->_fileNameIn = $this->_dirTmp . "/" . $this->_processId . ".in";
            $this->_fileNameXml = $this->_dirTmp . "/" . $this->_processId . ".xml";
            $this->_fileNameOut = $this->_dirTmp . "/" . $this->_processId . ".out";
            $this->_fileNameError = $this->_dirTmp . "/" . $this->_processId . ".err";
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
                /**
                 * 
                 */
                if (!file_exists($this->_fileNameIn)) {
                    throw new ZendT_Exception('Arquivo "' . $this->_fileNameIn . '" não localizado!');
                }
                /**
                 * 
                 */
                $vars = unserialize(file_get_contents($this->_fileNameIn));
                /**
                 * 
                 */
                $obj = new $vars['object']['name']();
                foreach ($vars['object']['attr'] as $key => $value) {
                    $obj->$key = $value;
                }

                $result = call_user_func_array(array($obj, $vars['object']['method']), $vars['object']['params']);
                //$result = $obj->$vars['object']['method']();
                /**
                 * 
                 */
                if ($result) {
                    file_put_contents($this->_fileNameOut, serialize($result));
                }
                /**
                 * 
                 */
                #@unlink($this->_fileNameIn);
                #@unlink($this->_fileNameXml);
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
            #$dirs[0] = ucfirst($dirs[0]);
            #$dirs[1] = ucfirst($dirs[1]);

            $filename = implode('/', $dirs);

            require_once $filename . '.php';
        }

        /**
         * 
         */
        public function __destruct() {
            $content = ob_get_contents();
            if ($content) {
                file_put_contents($this->_fileNameError, $content);
            }
        }

    }
    