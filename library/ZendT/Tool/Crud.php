<?php
/**
 * Classe base do CRUD para busca informações da geração
 *
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud {
    /**
     * Busca o nome do Modelo
     * 
     * @param string $pathBase
     * @param striing $table
     * @return string 
     */
    public static function getModelName($pathBase, $table, $schema='', $config=false) {
        $path = $pathBase.'/application/configs/modules';
        $path = str_replace("\\", "/", $path);
        $myDirectory = opendir($path);
        while ($entryName = @readdir($myDirectory)) {
            $fileName = $path . '/' . $entryName . '/' . strtolower($table) . '.php';
            if (file_exists($fileName)) {
                $configTable = require($fileName);
                if (strtoupper($configTable['table']['name']) == strtoupper($table) && 
                    (strtoupper($configTable['table']['schema']) == strtoupper($schema) || $schema == '')) {
                    closedir($myDirectory);
                    if ($config){
                        return $configTable;
                    }else{
                        return $configTable['table']['objectName'];
                    }
                    
                }
            }
        }
        closedir($myDirectory);
    }
    /**
     * Busca o nome do módulo
     * 
     * @param string $pathBase
     * @param string $module 
     * @return string
     */
    public static function getModuleName($pathBase, $module) {
        $fileName = $pathBase . '/application/configs/modules/config.php';
        $config = array();
        if (file_exists($fileName)) {
            $config = require($fileName);
        }
        if (!isset($config[$module])) {
            $nameResponse = $this->_registry
                    ->getClient()
                    ->promptInteractiveInput("[ZendT] Informe a descricao do modulo?");
            $description = $nameResponse->getContent();
            $config[$module] = utf8_encode($description);
            file_put_contents($fileName, '<?php return ' . var_export($config, true) . '?>');
        }
        return $config[$module];
    }
    /**
     * Busca a configuração padrão do seeker
     * 
     * @param string $pathBase
     * @param array $config
     * @param string $column
     * @return array 
     */
    public static function getConfigSeeker($pathBase, $config, $column) {
        $tableName = '';
        $schemaNameReference = '';
        foreach ($config['table']['referenceMaps'] as $reference) {
            if (strtoupper($column) == strtoupper($reference['columnName'])) {
                $tableName = $reference['tableNameReference'];
                $schemaNameReference = $reference['schemaNameReference'];
            }
        }
        if (strtoupper($config['table']['name']) == strtoupper($tableName) &&
            strtoupper($config['table']['schema']) == strtoupper($schemaNameReference)) {
            return $config['table']['seeker'];
        } else {
            $path = $pathBase.'/application/configs/modules';
            $path = str_replace("\\", "/", $path);
            $myDirectory = opendir($path);
            while ($subDir = @readdir($myDirectory)) {
                $fileName = $path . '/' . $subDir . '/' . strtolower($tableName) . '.php';
                if (file_exists($fileName)) {
                    $configTable = require($fileName);
                    if (strtoupper($configTable['table']['name']) == strtoupper($tableName) &&
                        strtoupper($configTable['table']['schema']) == strtoupper($schemaNameReference)) {
                        closedir($myDirectory);
                        return $configTable['table']['seeker'];
                    }
                }
            }
            closedir($myDirectory);
        }
        $result = array();
        $result['search']['css-width'] = '200px';
        $result['display']['css-width'] = '200px';
        $result['field']['id'] = 'id';
        $result['field']['search'] = '';
        $result['field']['display'] = '';
        $result['url']['grid'] = '/module/controller/grid';
        $result['url']['search'] = '/module/controller/seeker/search';
        $result['url']['retrive'] = '/module/controller/retrive';
        $result['modal']['width'] = 800;
        $result['modal']['height'] = 450;
        return $result;
    }    
    /**
     * Busca o Join da tabela que está sendo criado no CRUD
     *
     * @param array $config
     * @param string $column 
     * @return string
     */
    public static function getJoin($config, $column) {
        $join = '';
        foreach ($config['table']['referenceMaps'] as $reference) {
            if (strtolower($reference['columnName']) == strtolower($column)) {
                
                if (substr(strtolower($column),0,3) == 'id_'){
                    $tableColumn = substr(strtolower($column),3);
                }elseif (substr(strtolower($column),0,2) == 'id'){
                    $tableColumn = substr(strtolower($column),2);
                }else{
                    $tableColumn = $config['table']['columns'][$column]['object']['seeker']['tableName'];
                }

                if ($config['table']['columns'][$column]['nullable'])
                    $join = "LEFT";

                $join.= " JOIN ";
                $join.= $reference['schemaNameReference'];
                $join.= ".";
                $join.= $reference['tableNameReference'];
                $join.= " ";
                $join.= $tableColumn;
                $join.= " ON (";
                $join.= $config['table']['name'];
                $join.= ".";
                $join.= strtolower($reference['columnName']);
                $join.= " = ";
                $join.= $tableColumn;
                $join.= ".";
                $join.= strtolower($reference['columnReference']);
                $join.= ") ";
            }
        }
        return $join;
    }
    
    public static function getReference($config, $column) {
        foreach ($config['table']['referenceMaps'] as $reference) {
            if (strtolower($reference['columnName']) == strtolower($column)) {
                return $reference;
            }
        }
        return false;
    }
    
    public static function getConfig($pathBase,$tableName,$schemaName,$moduleName=null){
        if ($pathBase == null){
            $pathBase = realpath('.');
        }
        $path = $pathBase.'/application/configs/modules';
        $path = str_replace("\\", "/", $path);
        $myDirectory = opendir($path);
        if ($moduleName !== null){
            $fileName = $path . '/' . $moduleName . '/' . strtolower($tableName) . '.php';
            if (file_exists($fileName)) {
                $configTable = require($fileName);
                return $configTable;
            }            
        }else{
            while ($subDir = @readdir($myDirectory)) {
                $fileName = $path . '/' . $subDir . '/' . strtolower($tableName) . '.php';
                if (file_exists($fileName)) {
                    $configTable = require($fileName);
                    if (strtoupper($configTable['table']['name']) == strtoupper($tableName) && 
                        strtoupper($configTable['table']['schema']) == strtoupper($schemaName)) {
                        closedir($myDirectory);
                        return $configTable;
                    }
                }
            }
            closedir($myDirectory);
        }
        return array();
    }
    
}

?>
