<?php
/**
 * Classe para geração do arquivo Form do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Form {
    /**
     * Cria o formulário de edição
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function editForm($pathBase, $config) {
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);

        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/forms';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/forms/' . $modelName.'/Crud';
        }
        $ucModuleName = ucfirst($config['table']['moduleName']);
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/Edit.php';

        $strBody = '';
        foreach ($config['table']['columns'] as $column => $prop) {
            if (strpos($column, '_type') !== false || strpos($column, '_name') !== false){
                $name = str_replace(array('_type','_name'),'',$column);
                $_propLob = $config['table']['columns'][$name];
                if ($_propLob['object']['type'] == 'File') {
                    continue;
                }
            }            
            
            if ($prop['multiple']) {
                $strBody.= "
        for(\$i=0; \$i<\$this->_multiple['{$column}']; \$i++){
            \$element = \$model->getElement('{$column}[\$i]');";
                if ($prop['object']['required']) {
                    $strBody.= "
            \$element->setRequired(true);";
                }
                $strBody.= "
            \$element->setBelongsTo('{$column}');
        }
                ";
            } else {
                $strBody.= "
            \$element = \$model->getElement('{$column}');";
                if ($prop['object']['required']) {
                    $strBody.= "
            \$element->setRequired(true);";
                }
            }

            if (count($config['table']['primary']) == 1) {
                if (strtolower($config['table']['primary'][0]) == strtolower($column)) {
                    $strBody.= "
            \$element->addDecorator(new ZendT_Form_Decorator_Hidden());
            \$element->setRequired(false);
                    ";
                }
            }
            $strBody.= "
            \$this->addElement(\$element);

            ";
        }
        $elementId = '';
        if (count($config['table']['primary']) > 1) {
            $elementId.= "
            \$element = new ZendT_Form_Element_Hidden('id');
            \$element->addDecorator(new ZendT_Form_Decorator_Hidden());
            \$element->setRequired(false);
            \$this->addElement(\$element);
            ";
        }

        $contentText = <<<EOS
<?php
    class {$ucModuleName}_Form_{$modelName}_Crud_Edit extends ZendT_Form {
        /**
         * Configura se uma coluna é multipla
         * @var array
         */
        protected \$_multiple;
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements(\$action='insert') {
            {$elementId}
    
            \$model = new {$ucModuleName}_Form_{$modelName}_Elements();
            {$strBody}
        }
        /**
         * Configura uma coluna para ser multipla, ou seja,
         * transformar um dado em array
         *
         * @return void
         */        
        public function setMultiple(\$column,\$numRepeat){
            \$this->_multiple[\$column] = \$numRepeat;
        }
    }
?>
EOS;
        file_put_contents($filename, $contentText);
        
        
        $contentText = <<<EOS
<?php
    class {$ucModuleName}_Form_{$modelName}_Edit extends {$ucModuleName}_Form_{$modelName}_Crud_Edit {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements(\$action='insert') {
            parent::loadElements(\$action);
        }
    }
?>
EOS;
        if(!file_exists(str_replace('/Crud','',$filename))){
            file_put_contents(str_replace('/Crud','',$filename), $contentText);
        }
    }
    /**
     * Cria as classes de formulário
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config){
        ZendT_Tool_Crud_Form::editForm($pathBase, $config);
        //ZendT_Tool_Crud_Form::searchForm($pathBase, $config); #deprecionado
    }
}
?>
