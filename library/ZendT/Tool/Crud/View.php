<?php
/**
 * Classe para geração do arquivo View do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_View {
    /**
     * Cria o script de visualização do grid
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function gridView($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $nameViewController = str_replace('_', '-', $config['table']['modelName']);

        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/views/scripts/' . $nameViewController;
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/views/scripts/' . $nameViewController;
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/grid.phtml';

        $contentText = <<<EOS
<?php
    echo \$this->grid;
?>
EOS;
        if (!file_exists($filename)) {
            file_put_contents($filename, $contentText);
        }
    }    
    /**
     * Cria o script de edição dos dados
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function formEditView($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $nameViewController = str_replace('_', '-', $config['table']['modelName']);

        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/views/scripts/' . $nameViewController;
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/views/scripts/' . $nameViewController;
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/form.phtml';

        $contentText = <<<EOS
<?php
    echo \$this->form;
?>
EOS;
        if (!file_exists($filename)) {
            file_put_contents($filename, $contentText);
        }
    } 
    /**
     * Cria o script de pesquisa dos dados
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function formSearchView($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $nameViewController = str_replace('_', '-', $config['table']['modelName']);

        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/views/scripts/' . $nameViewController;
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/views/scripts/' . $nameViewController;
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/search.phtml';

        $contentText = <<<EOS
<?php
    echo \$this->form;
?>
EOS;
        if (!file_exists($filename)) {
            file_put_contents($filename, $contentText);
        }
    } 
    /**
     * Cria os scripts de visualização
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config){
        ZendT_Tool_Crud_View::gridView($pathBase, $config);
        ZendT_Tool_Crud_View::formEditView($pathBase, $config);
        #ZendT_Tool_Crud_View::formSearchView($pathBase, $config); //depreciado
    }
}
?>
