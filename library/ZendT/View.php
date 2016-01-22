<?php
    /**
     * 
     */
    class ZendT_View{
        /**
         * Singleton instance
         *
         * Marked only as protected to allow extension of the class. To extend,
         * simply override {@link getInstance()}.
         *
         * @var ZendT_View
         */
        protected static $_instance = null;
        /**
         * @var bool
         */
        private $_noRenderView;
        /**
         * @var bool
         */
        private $_noRenderLayout;
        /**
         *
         * @var string
         */
        private $_layout = 'default';
        /**
         *
         * @var string
         */
        private $_module = '';
        /**
         *
         * @var string
         */
        private $_controller = '';
        /**
         *
         * @var string
         */
        private $_action = '';
        /**
         *
         * @var string 
         */
        private $_moduleDirectory = '';
        /**
         *
         * @var string
         */
        private $_layoutDirectory;
        /**
         *
         * @var array
         */
        private $_helperPath;
        /**
         *
         * @var array
         */
        private $_onLoad;
        /**
         *
         * @var string
         */
        private $_headerScript;
        /**
         *
         * @var string
         */
        private $_headerStyle;
        /**
         *
         * @var string
         */
        private $_screenName;
        /**
         *
         * @var string
         */
        private $_applicationName;
        /**
         *
         * @var Zend_Translate
         */
        private $_translate;
        /**
         * 
         */
        public function __construct() {
            $this->_helperPath = array('ZendT_View_Helper','Zend_View_Helper');
            
            $this->_onLoad = array();
            $this->_headerScript = '';
            $this->_headerStyle = '';
            #ob_start();
        }        
        /**
         * Configura se será renderizado o script phtml
         *
         * @param bool $value
         * @return \ZendT_View 
         */
        public function setNoRenderView($value=true){
            $this->_noRenderView = $value;
            return $this;
        }
        /**
         * Configura se será renderizado o layout
         *
         * @param bool $value
         * @return \ZendT_View 
         */
        public function setNoRederLayout($value=true){
            $this->_noRenderLayout = $value;
            return $this;
        }
        /**
         * Busca o comando de onLoad
         *
         * @param bool $jQuery 
         */
        public function getOnLoad($jQuery=true){
            if ($jQuery){
               $this->_onLoad = '
        jQuery(document).ready(function() {
            '.implode("\n",$this->_onLoad).'
        });
               ';
            }
            $this->_onLoad;
        }
        /**
         * Configura o JavaScript a ser executado no carregamento
         *
         * @param string $command
         * $param string $name
         * @return \ZendT_View
         */
        public function addOnLoad($command,$name='') {
            if (!$name){
                $name = count($this->_onLoad);
            }
            $this->_onLoad[$name] = $command;
            return $this;
        }        
        /**
         *
         * @return string 
         */
        public function getHeaderScript(){
            return $this->_headerScript;
        }
        /**
         * Adiciona comandos de JavaScript
         * 
         * @param string $command
         * @return \ZendT_View
         */
        public function appendScript($command) {
            $this->_headerScript.= '
            <script language="javascript" type="text/javascript">
                '.$command.'
            </script>';
            return $this;
        }
        /**
         * Adiciona comandos de CSS
         * 
         * @param string $command
         * @return \ZendT_View
         */
        public function appendStyle($command,$name='') {
            $this->_headerStyle.= '
            <style type="text/css">
                '.$command.'
            </style>';
            return $this;
        }
        /**
         * Adiciona um arquivo de JavaScript
         * 
         * @param string $filename
         * @return \ZendT_View 
         */
        public function appendScriptFile($filename,$putUrlPublic=false) {
            if ($putUrlPublic){
                $filename = str_replace(ZendT_Url::getBaseDiretoryPublic(),'',$filename);
                $filename = ZendT_Url::getBaseDiretoryPublic() . $filename;
            }            
            $this->_headerScript.= '<script language="javascript" type="text/javascript" src="'.$filename.'"></script>'."\n";
            return $this;
        }
        /**
         * Adiciona um arquivo de CSS
         * 
         * @param string $filename
         * @return \ZendT_View 
         */
        public function appendStyleFile($filename,$putUrlPublic=false) {
            if ($putUrlPublic){
                $filename = str_replace(ZendT_Url::getBaseDiretoryPublic(),'',$filename);
                $filename = ZendT_Url::getBaseDiretoryPublic() . $filename;
            }
            $this->_headerStyle.= '<link rel="stylesheet" href="'.$filename.'" type="text/css">'."\n";
            return $this;
        }
        /**
         * Configura o nome da Tela
         * 
         * @param string $value
         * @return \ZendT_View 
         */
        public function setScreenName($value){
            $this->_screenName = $value;
            return $this;
        }
        /**
         * Retorna o nome da tela
         * 
         * @return string
         */
        public function getScreenName(){
            return $this->_screenName;
        }
        /**
         * Configura o nome da aplicação
         * 
         * @param string $value
         * @return \ZendT_View 
         */
        public function setApplicationName($value){
            $this->_applicationName = $value;
            return $this;
        }
        /**
         * Retorna o nome da aplicação
         * 
         * @return string
         */
        public function getApplicationName(){
            return $this->_applicationName;
        }
        /**
         * Configura o header title da página
         * 
         * @param string $value
         * @return \ZendT_View 
         */
        public function setHeaderTitle($value){
            $this->_headerTitle = $value;
            return $this;
        }
        /**
         * Retorna o header title da página
         * 
         * @return string
         */
        public function getHeaderTitle(){
            return $this->_headerTitle;
        }
        /**
         * Retorna o Header do Html
         * 
         * @return string
         */
        public function getHeader(){
            $header = $this->_headerScript;
            $header.= $this->_headerStyle;
            $header.= $this->getOnLoad();
            return $header;
        }
        /**
         * @return \ZendT_View 
         */
        public function setView($name=''){
            if ($name)
                $aux = explode('/',$name);
            else
                $aux = array();
            unset($aux[0]);
            if (count($aux) == 2){
                $module = $this->_module;
                $controller = $aux[1];
                $action = $aux[2];
            }else if (count($aux) == 1){
                $module = $this->_module;
                $controller = $this->_controller;
                $action = $aux[2];
            }else if (count($aux) == 0){
                $module = $this->_module;
                $controller = $this->_controller;
                $action = $this->_action;
            }else{
                $module = $aux[1];
                $controller = $aux[2];
                $action = $aux[3];
            }
            $action = str_replace('.phtml','',$action);
            
            $this->_view = $this->_moduleDirectory.'/'.ZendT_Lib::formatNameObject($module).'/View/'.ZendT_Lib::formatNameObject($controller).'/'.ZendT_Lib::formatNameObject($action).'.phtml';
            return $this;
        }
        /**
         * @return \Zend_Translate
         */
        public function getTranslate(){
            if (!$this->_translate instanceof Zend_Translate){
                $this->_translate = new Zend_Translate(
                        'array',
                        $this->_moduleDirectory.'/'.ZendT_Lib::formatNameObject($this->_module). '/Language/pt_BR.php',
                        'pt_BR'
                );
            }
            return $this->_translate;
        }
        /**
         * Configura o Layout
         *
         * @param string $value 
         * @return \ZendT_View 
         */
        public function setLayout($name){
            $this->_layout = $name;
            return $this;
        }
        /**
         *
         * @param string $name
         * @param string $value
         * @return \ZendT_View 
         */
        public function setOption($name,$value){
            $name = '_'.$name;
            $this->{$name} = $value;
            return $this;
        }
        /**
         *
         * @param array $options
         * @return \ZendT_View 
         */
        public function setOptions($options){
            foreach($options as $key=>$value){
                $this->setOption($key,$value);
            }
            $this->setView();
            return $this;
        }
        /**
         * Renderiza o script phtml
         * 
         * @return bool
         */
        private function _renderView(){
            if (!$this->_noRenderView){
                require $this->_view;
            }
        }
        /**
         * Renderiza a visão
         * 
         * @return bool
         */
        public function renderLayout(){            
            ob_start();
            $this->_renderView();
            if (!$this->_noRenderLayout){
                $filename = $this->_layoutDirectory . '/' . ZendT_Lib::formatNameObject($this->_layout) . '.phtml';
                $result = require $filename;
                if (!$result){
                    throw new ZendT_Exception('Invalid Layout in "'.$filename.'" ');
                }
                $reponse = ob_get_clean();
            }else{
                $reponse = ob_get_clean();
            }
            return $reponse;
        }
        /**
         * Renderiza a visão
         */
        public function render(){
            return $this->renderLayout();
        }
        /**
         *
         * @param string $name
         * @param array $arguments
         * @return stdClass
         * @throws ZendT_Exception 
         */
        public function __call($name, $arguments) {
            if (method_exists($this, $name)){
                $obj = $this;
            }else{                
                foreach($this->_helperPath as $value){
                    $className = $value.'_'.ucfirst($name);
                    if (ZendT_Loader::loadFile($className)){
                        break;
                    }else{
                        $className = null;
                    }
                }
                if ($className == null){
                    $obj = null;
                }else{
                    $obj = new $className();
                }
            }
            if ($obj == null){
                throw new ZendT_Exception('Plugin "'.$name.'" not found in "'.implode(',',$this->helperPath).'" ');
            }
            return call_user_method($name, $obj, $arguments);
        }        
        /**
         * Singleton instance
         *
         * @return \ZendT_View
         */
        public static function getInstance(){
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
    }