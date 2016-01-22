<?php
/**
 * Classe para geração do arquivo Controller do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Controller {
    /**
     * Cria a classe de controle 
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config, $overwrite=0){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);

        $ucModuleName = ucfirst($config['table']['moduleName']);
        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/controllers';
            $moduleControllerName = $modelName . 'Controller';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/controllers';
            $moduleControllerName = $ucModuleName . '_' . $modelName . 'Controller';
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/' . $modelName . 'Controller.php';

        $contentText = "<?php
    class {$moduleControllerName} extends ZendT_Controller_ActionCrud {
        public function init() {
            \$this->_init();
            //\$this->_startupAcl();
            \$this->_serviceName = '{$ucModuleName}_Service_{$modelName}';            
            \$this->_formName = '{$ucModuleName}_Form_{$modelName}_Edit';
            \$this->_formSearchName = '{$ucModuleName}_Form_{$modelName}_Search';            
            \$this->_mapper = new {$ucModuleName}_DataView_{$modelName}_MapperView();
            /**
             * Configuração do Grid
             */
            \$name = \$this->getRequest()->getParam('name');
            if (!\$name)
                \$name = '" . strtolower($modelName) . "';
            \$this->setGrid( new ZendT_Grid('grid_'.\$name));
        }
    }
?>
";
        $replace = null;
        if (file_exists($filename)) {
            if ($overwrite){
                $replace = true;
            }else{
                $replace = false;
            }
        }
        if ($replace === null || $replace === true) {
            file_put_contents($filename, $contentText);
        }
    }
    
    /**
     * Remove o Controlador Gerado
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function remove($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $table = ucfirst($config['table']['modelName']);
        $module = $config['table']['moduleName'];
        $pathBase = $path.'/application/configs/modules/'.strtolower($module);
        $tableClass = ZendT_Lib::convertTableNameToClassName($table);
        /**
         * Controller 
         */
        @unlink($pathBase.'/controllers/'.$tableClass.'Controller.php');
    }
}
?>
