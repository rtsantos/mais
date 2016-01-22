<?php
    /**
    * @category   ZendT
    * @package    ZendT_Application
    * @author     rsantos
    */
    class ZendT_Application {
        /**
         * Application environment
         *
         * @var string
         */
        protected $_environment;
        /**
         * Options for Zend_Application
         *
         * @var array
         */
        public static $options = array();
        /**
         * Constructor
         *
         * Initialize application. Potentially initializes include_paths, PHP
         * settings, and bootstrap class.
         *
         * @param  string                   $environment
         * @param  string|array|Zend_Config $options String path to configuration file, or array/Zend_Config of configuration options
         * @throws Zend_Application_Exception When invalid options are provided
         * @return void
         */
        public function __construct($environment, $options = null) {
            $this->_environment = (string) $environment;

            
            require_once 'ZendT/Loader.php';
            ZendT_Loader::registerAutoload();

            if (null !== $options) {
                if (is_string($options)) {
                    $options = $this->_loadConfig($options);
                } elseif ($options instanceof Zend_Config) {
                    $options = $options->toArray();
                } elseif (!is_array($options)) {
                    throw new Zend_Application_Exception('Invalid options provided; must be location of config file, a config object, or an array');
                }

                $this->setOptions($options);
            }
        }

        /**
        * Retrieve current environment
        *
        * @return string
        */
        public function getEnvironment() {
            return $this->_environment;
        }
        /**
        * Set application options
        *
        * @param  array $options
        * @throws Zend_Application_Exception When no bootstrap path is provided
        * @throws Zend_Application_Exception When invalid bootstrap information are provided
        * @return Zend_Application
        */
        public function setOptions(array $options) {
            if (!empty($options['config'])) {
                if (is_array($options['config'])) {
                    $_options = array();
                    foreach ($options['config'] as $tmp) {
                        $_options = $this->mergeOptions($_options, $this->_loadConfig($tmp));
                    }
                    $options = $this->mergeOptions($_options, $options);
                } else {
                    $options = $this->mergeOptions($this->_loadConfig($options['config']), $options);
                }
            }

            self::$options = $options;

            $options = array_change_key_case($options, CASE_LOWER);

            $this->_optionKeys = array_keys($options);

            if (!empty($options['phpsettings'])) {
                $this->setPhpSettings($options['phpsettings']);
            }

            if (!empty($options['includepaths'])) {
                $this->setIncludePaths($options['includepaths']);
            }
            
            if (!empty($options['registries'])){
                $this->setRegistries($options['registries']);
            }

            return $this;
        }
        /**
         * Registra a configuração Zend_Registry
         *
         * @param array $options 
         */
        public function setRegistries($options){
            foreach($options as $name => $data){
                if ($name == 'db'){
                    foreach($data as $schema=>$params){
                        $adapter = $params['adapter'];
                        unset($params['adapter']);
                        Zend_Registry::set($name.'.'.$schema, Zend_Db::factory($adapter, $params));
                        if ($params['default']){
                            Zend_Db_Table::setDefaultAdapter($name.'.'.$schema);
                        }
                    }
                }else{
                    Zend_Registry::set($name, $data);
                }
            }
        }
        /**
        * Retrieve application options (for caching)
        *
        * @return array
        */
        public function getOptions() {
            return self::$options;
        }

        /**
        * Is an option present?
        *
        * @param  string $key
        * @return bool
        */
        public function hasOption($key) {
            return in_array(strtolower($key), $this->_optionKeys);
        }

        /**
        * Retrieve a single option
        *
        * @param  string $key
        * @return mixed
        */
        public function getOption($key) {
            if ($this->hasOption($key)) {
                $options = $this->getOptions();
                $options = array_change_key_case($options, CASE_LOWER);
                return $options[strtolower($key)];
            }
            return null;
        }

        /**
        * Merge options recursively
        *
        * @param  array $array1
        * @param  mixed $array2
        * @return array
        */
        public function mergeOptions(array $array1, $array2 = null) {
            if (is_array($array2)) {
                foreach ($array2 as $key => $val) {
                    if (is_array($array2[$key])) {
                        $array1[$key] = (array_key_exists($key, $array1) && is_array($array1[$key])) ? $this->mergeOptions($array1[$key], $array2[$key]) : $array2[$key];
                    } else {
                        $array1[$key] = $val;
                    }
                }
            }
            return $array1;
        }

        /**
        * Set PHP configuration settings
        *
        * @param  array $settings
        * @param  string $prefix Key prefix to prepend to array values (used to map . separated INI values)
        * @return Zend_Application
        */
        public function setPhpSettings(array $settings, $prefix = '') {
            foreach ($settings as $key => $value) {
                $key = empty($prefix) ? $key : $prefix . $key;
                if (is_scalar($value)) {
                    ini_set($key, $value);
                } elseif (is_array($value)) {
                    $this->setPhpSettings($value, $key . '.');
                }
            }

            return $this;
        }

        /**
         * Set include path
         *
         * @param  array $paths
         * @return Zend_Application
         */
        public function setIncludePaths(array $paths) {
            $path = implode(PATH_SEPARATOR, $paths);
            set_include_path($path . PATH_SEPARATOR . get_include_path());
            return $this;
        }
        /**
         * Run the application
         *
         * @return void
         */
        public function run() {
            $options = self::$options['resources']['frontController'];
            $class   = self::$options['resources']['frontController']['class'];
            /** @var ZendT_Controller_Front */
            $controllerFront = forward_static_call(array($class,'getInstance'));
            $controllerFront->setOptions($options);
            $controllerFront->dispatch();
            #$this->getBootstrap()->run();
        }

        /**
        * Load configuration file of options
        *
        * @param  string $file
        * @throws Zend_Application_Exception When invalid configuration file is provided
        * @return array
        */
        protected function _loadConfig($file) {
            $environment = $this->getEnvironment();
            $suffix = pathinfo($file, PATHINFO_EXTENSION);
            $suffix = ($suffix === 'dist') ? pathinfo(basename($file, ".$suffix"), PATHINFO_EXTENSION) : $suffix;

            switch (strtolower($suffix)) {
                case 'ini':
                    $config = new Zend_Config_Ini($file, $environment);
                    break;

                case 'xml':
                    $config = new Zend_Config_Xml($file, $environment);
                    break;

                case 'json':
                    $config = new Zend_Config_Json($file, $environment);
                    break;

                case 'yaml':
                case 'yml':
                    $config = new Zend_Config_Yaml($file, $environment);
                    break;

                case 'php':
                case 'inc':
                    $config = include $file;
                    if (!is_array($config)) {
                        throw new Zend_Application_Exception('Invalid configuration file provided; PHP file does not return array value');
                    }
                    return $config;
                    break;

                default:
                    throw new Zend_Application_Exception('Invalid configuration file provided; unknown config type');
            }

            return $config->toArray();
        }
        /**
         * Retorna a configuração do recurso
         *
         * @param string $name
         * @return boolean|string|array
         */
        public static function getResource($name){
            if (isset(self::$options[$name])){
                return self::$options[$name];
            }else{
                return false;
            }
        }
    }