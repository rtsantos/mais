<?php
/**
 * Classe para geração do arquivo Language do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Language {
    /**
     * Cria o script de linguagem :: dicionário de dados
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }        
        
        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/languages';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/languages';
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        
        $filename = $path . '/pt_BR.php';
        $dataTranslate = array();
        if (file_exists($filename)) {
            $dataTranslate = require $filename;
        }

        if (!isset($dataTranslate['operacao'])) {
            $dataTranslate['operacao'] = 'Operação';
        }

        if (!isset($dataTranslate['valor'])) {
            $dataTranslate['valor'] = 'Valor';
        }
    
        if (!isset($dataTranslate['portalName'])) {
            $dataTranslate['portalName'] = 'Portal TA';
        }

        if (!isset($dataTranslate['moduleName'])) {
            $dataTranslate['moduleName'] = ZendT_Tool_Crud::getModuleName($pathBase, $config['table']['moduleName']);
        }        
        $controllerName = str_replace('_','-',$config['table']['modelName']);
        
        $form = $config['table']['moduleName'].'.'.$controllerName.'.form';        
        if (!isset($dataTranslate[$form])) {
            $dataTranslate[$form] = 'Cadastro de '.$config['table']['description'];
        }
        
        $grid = $config['table']['moduleName'].'.'.$controllerName.'.grid';
        if (!isset($dataTranslate[$grid])) {
            $dataTranslate[$grid] = 'Listagem de '.$config['table']['description'];
        }
        
        //{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}
        
        /* depreciado
         * $search = $config['table']['moduleName'].'.'.$controllerName.'.search';
        if (!isset($dataTranslate[$search])) {
            $dataTranslate[$search] = 'Pesquisa de '.$config['table']['description'];
        }*/

        $index = $config['table']['name'];
        if (!isset($dataTranslate[$index])) {
            $dataTranslate[$index] = $config['table']['description'];
        }

        foreach ($config['table']['columns'] as $column => $prop) {
            if ($dataTranslate["{$config['table']['name']}.{$column}"] == $column){
                unset($dataTranslate["{$config['table']['name']}.{$column}"]);
            }
            if (!isset($dataTranslate["{$config['table']['name']}.{$column}"])){
                $dataTranslate["{$config['table']['name']}.{$column}"] = $prop['label'];
            }
            if ($prop['object']['type'] == 'Seeker'){
                $reference = ZendT_Tool_Crud::getReference($config, $column);
                $configRelation = ZendT_Tool_Crud::getConfig($pathBase, $reference['tableNameReference'], $reference['schemaNameReference']);
                /**
                 * Busca o label da tabela de relacionamento, indo no dicionário de dados da tabela de referência
                 */
                    if ($configRelation['table']['moduleName'] == '' || $configRelation['table']['moduleName'] == 'Application') {
                        $configRelation['table']['moduleName'] = 'Application';
                        $pathRelation = 'application/languages';
                    } else {
                        $pathRelation = 'application/modules/' . $configRelation['table']['moduleName'] . '/languages';
                    }
                    $filenameRelation = $pathRelation . '/pt_BR.php';
                    if (file_exists($filenameRelation)) {
                        $dataTranslateRelation = require $filenameRelation;
                    }
                    $label['search'] = $dataTranslateRelation["{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}"];
                    if ($prop['object']['seeker']['field']['display']){
                        $label['display'] = $dataTranslateRelation["{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}"];
                    }
                    /**
                     * Pega os campos de relação 2 nível do display
                     */
                    
                        if (isset($prop['object']['seeker']['relation']) && $label['display'] == '') {
                            foreach ($prop['object']['seeker']['relation'] as $relation) {
                                if ($relation['moduleNameReference'] == '' || $relation['moduleNameReference'] == 'Application') {
                                    $relation['moduleNameReference'] = 'Application';
                                    $pathRelation = 'application/languages';
                                } else {
                                    $pathRelation = 'application/modules/' . $relation['moduleNameReference'] . '/languages';
                                }
                                $filenameRelation = $pathRelation . '/pt_BR.php';
                                if (file_exists($filenameRelation)) {
                                    $dataTranslateRelation = require $filenameRelation;
                                }                                
                                foreach ($relation['columnDisplay'] as $columnDisplay){
                                    $label['display'] = $dataTranslateRelation["{$relation['tableNameReference']}.$columnDisplay"];
                                }
                            }
                        }                    
                    /**
                     * fim da busca do 2º nível 
                     */
                    
                /**
                 * fim da busca do label da tabela de referência
                 */
                if (!isset($dataTranslate["{$config['table']['name']}.{$column}.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}"])){
                    $dataTranslate["{$config['table']['name']}.{$column}.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}"] = $label['search']. ' ' . $prop['label'];
                }
                if ($prop['object']['seeker']['field']['display'] && !isset($dataTranslate["{$config['table']['name']}.{$column}.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}"])){
                    $dataTranslate["{$config['table']['name']}.{$column}.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}"] = $label['display'] . ' ' . $prop['label'];
                }
            }
        };

        file_put_contents($filename, "<?php\n return \n" . var_export($dataTranslate, true) . "\n?>");        
    }
}
?>
