<?php
/**
 * Classe para geração do arquivo Bootstrap do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Bootstrap {
    /**
     * Cria a classe de Bootstrapo 
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config, $overwrite=0){
        $module = $config['table']['moduleName'];
        $ucModule = ucfirst($module);
        $filename = $pathBase . '/application/modules/' . $module . '/Bootstrap.php';
            $context = "<?php
    /**
     * Arquivo de inicialização do módulo $ucModule
     * 
     * @package Zend
     * @subpackage ZendT
     * @category $ucModule
     * @copyright Transportadora Americana Ltda
     */
    class {$ucModule}_Bootstrap extends Zend_Application_Module_Bootstrap{
        /**
         * Inicializa a configuração de tradução ao módulo
         */
        protected function _initTranslate(){
            \$translate = new Zend_Translate(
                    'array',
                    APPLICATION_PATH . '/modules/$module/languages/pt_BR.php',
                    'pt_BR'
            );

            Zend_Registry::set('translate_$module', \$translate);
        }
    
        protected function _initResourceLoader() 
        { 
            \$this->_resourceLoader->addResourceType( 'report', 'reports', 'Report' ); 
            \$this->_resourceLoader->addResourceType( 'context', 'contexts', 'Context' ); 
            \$this->_resourceLoader->addResourceType( 'dataview', 'data-views', 'DataView' ); 
        }    
    }
?>";
        $replace = null;
        if (file_exists($filename)) {
            if ($overwrite){
                $replace = true;
            }else{
                $replace = false;
            }
        }
        if ($replace === null || $replace === true) {
            file_put_contents($filename, $context);
        }
            
    }
}
?>
