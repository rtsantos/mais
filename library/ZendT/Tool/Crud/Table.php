<?php
/**
 * Classe para geração do arquivo Table do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Table {
    /**
     * Cria o modelo do crud na qual o desenvolvedor não coloca a mão
     * Esses dados são sempre substituído
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function crudTable($pathBase, $config) {
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }        
        $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);

        $strPrimary = '';
        if (is_string($config['table']['primary'])) {
            $upPrimary = strtoupper($config['table']['primary']);
            $strPrimary = "'{$upPrimary}'";
        } else {
            foreach ($config['table']['primary'] as $primary) {
                $upPrimary = strtoupper($primary);
                $strPrimary .= ",'{$upPrimary}'";
            }
            $strPrimary = substr($strPrimary, 1);
        }

        $strUnique = '';
        if (isset($config['table']['unique'])){            
            foreach ($config['table']['unique'] as $unique) {
                $upUnique = strtoupper($unique);
                $strUnique .= ",'{$upUnique}'";
            }
            $strUnique = substr($strUnique, 1);
        }

        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/models/Crud';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/models/' . $modelName . '/Crud';
        }
        $ucModuleName = ucfirst($config['table']['moduleName']);
        ZendT_Lib::createDirectory($pathBase, $path);

        $filename = $pathBase . '/' . $path . '/Table.php';

        $strDependentTables = '';
        foreach ($config['table']['dependentTables'] as $value) {
            $strDependentTables.= ",
                '" . $value . "_Table'";
        }
        $strDependentTables = substr($strDependentTables, 1);


        $strReferenceMap = '';
        foreach ($config['table']['referenceMaps'] as $prop) {
            $referenceName = ZendT_Lib::convertTableNameToClassName($prop['columnName']);
            $strReferenceMap.= ",
                '" . $referenceName . "' => array(
                    'columns' => '" . $prop['columnName'] . "',
                    'refTableClass' => '" . $prop['objectNameReference'] . "_Table',
                    'refColumns' => '" . $prop['columnReference'] . "'
                )";
        }
        $strReferenceMap = substr($strReferenceMap, 1);
        /**
         * Gera a lista de opções de colunas de status
         */
        $firstOptions = true;
        $strListOptions = '';
        $strCols = '';
        $strRequired = '';
        $strColumnMappers = "array('default'=>array('mapper'=>'{$ucModuleName}_Model_{$modelName}_Mapper'),";
        foreach ($config['table']['columns'] as $column => $prop) {
            $upColumn = strtoupper($column);
            $strCols.= ",'$upColumn'";
            $listOptions = $prop['object']['listOptions'];
            
            if ($prop['object']['required']) {
                $strRequired .= ",'" . strtoupper($column) . "'";
            }
            
            if (count($listOptions) > 0) {
                $firstItem = true;
                $strListItem = '';
                if ($firstOptions) {
                    $strListOptions.= "'$column'=>array(";
                    $firstOptions = false;
                }else
                    $strListOptions.= "\n                                    ,'$column'=>array(";
                foreach ($listOptions as $key => $value) {
                    if ($firstItem) {
                        $strListItem.= "'{$key}'=>'{$value}'";
                        $firstItem = false;
                    }else
                        $strListItem.= "\n                                                    ,'{$key}'=>'{$value}'";
                }
                $strListOptions.= $strListItem;
                $strListOptions.= ")";
            }
            /**
             * faz o mapeamento das colunas padrão e seus
             * respectivos mappers 
             */
            if ($prop['object']['type'] == 'Seeker') {
                foreach ($config['table']['referenceMaps'] as $reference) {
                    if (strtolower($reference['columnName']) == strtolower($column)) {
                        $mapperName = $reference['objectNameReference'] . '_Mapper';
                    }
                }
                
                if (substr(strtolower($column),0,3) == 'id_'){
                    $tableColumn = substr(strtolower($column),3);
                }else if (substr(strtolower($column),0,2) == 'id'){
                    $tableColumn = substr(strtolower($column),2);
                }else{
                    $tableColumn = $prop['object']['seeker']['tableName'];
                }
                
                $strColumnMappers.= "
                                  '{$prop['object']['seeker']['field']['search']}_{$tableColumn}'=>array('mapper'=>'{$mapperName}','column'=>'{$prop['object']['seeker']['field']['search']}'),
                ";
                
                if ($prop['object']['seeker']['field']['display'] != '') {
                    $strColumnMappers.= "
                                  '{$prop['object']['seeker']['field']['display']}_{$tableColumn}'=>array('mapper'=>'{$mapperName}','column'=>'{$prop['object']['seeker']['field']['display']}'),
                    ";
                }
            }
        }
        $strCols = substr($strCols, 1);
        $strRequired = ltrim($strRequired, ',');

        $upTableName = strtoupper($config['table']['name']);
        $upSchemaName = strtoupper($config['table']['schema']);
        $upSequenceName = strtoupper($config['table']['sequenceName']);
        if ($upSequenceName == ''){
            $upSequenceName = '';
        }else{
            $upSequenceName = "protected \$_sequence = '{$upSequenceName}';";
        }
        
        $tableName = strtoupper($config['table']['modelName']);
        if (!$tableName){
            $tableName = $upTableName;
        }

        $contentText = <<<EOS
<?php
/**
 * Classe de mapeamento da tabela {$config['table']['name']}
 */
class {$ucModuleName}_Model_{$modelName}_Crud_Table extends ZendT_Db_Table_Abstract
{
    protected \$_name = '{$upTableName}';
    /*protected \$_alias = '{$tableName}';*/
    {$upSequenceName}
    protected \$_required = array({$strRequired});
    protected \$_primary = array({$strPrimary});
    protected \$_unique = array({$strUnique});
    protected \$_cols = array({$strCols});
    protected \$_search = '{$config['table']['seeker']['field']['search']}';
    protected \$_schema  = '{$upSchemaName}';
    protected \$_adapter = 'db.{$config['table']['schema']}';
    protected \$_dependentTables = array({$strDependentTables});
    protected \$_referenceMap = array({$strReferenceMap});
    protected \$_listOptions = array({$strListOptions});
    protected \$_mapper = '{$ucModuleName}_Model_{$modelName}_Mapper';
    protected \$_element = '{$ucModuleName}_Form_{$modelName}_Elements';
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string \$columnName
     * @return {$ucModuleName}_Model_{$modelName}_Element
     */
    public function getElement(\$columnName){
        \$_element = new {$ucModuleName}_Form_{$modelName}_Elements();        
        \$method = 'get' . ZendT_Lib::convertTableNameToClassName(\$columnName);
        return \$_element->\$method();
    }
    /**
     * Retorna o objeto Mapper do Modelo
     *
     * @return {$ucModuleName}_Model_{$modelName}_Mapper
     */
    public function getMapper(){    
        \$mapper = new {$ucModuleName}_Model_{$modelName}_Mapper();
        return \$mapper;
    }
    
    /**
     * Retorna um array contendo todas as colunas obrigatórias
     *
     * @return array
     */
    public function getRequired() {
        return \$this->_required;
    }
    
    /**
     * Informa se a coluna é obrigatória
     *
     * @param string \$field
     * @return boolean
     */
    public function isRequired(\$field) {
        return in_array(\$field, \$this->_required);
    }
    
}
?>
EOS;
        file_put_contents($filename, $contentText);
    }
    /**
     * Cria o modelo do desenvolvedor que pode manipular os dados
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function developerTable($pathBase, $config) {
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }        
        
        $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);
        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/models';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/models/' . $modelName;
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $pathBase . '/' . $path . '/Table.php';

        $ucModuleName = ucfirst($config['table']['moduleName']);

        $contentText = <<<EOS
<?php
    /**
     * Classe de mapeamento da tabela {$config['table']['name']}
     */
    class {$ucModuleName}_Model_{$modelName}_Table extends {$ucModuleName}_Model_{$modelName}_Crud_Table{

    }
?>
EOS;
        if (!file_exists($filename)) {
            file_put_contents($filename, $contentText);
        }
    }
    /**
     * Cria as classes de modelo 
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config){
        ZendT_Tool_Crud_Table::crudTable($pathBase, $config);
        ZendT_Tool_Crud_Table::developerTable($pathBase, $config);
    }
}
?>
