<?php

   /**
    * Classe para geração do arquivo Mapper do módulo
    * 
    * @package ZendT
    * @subpackage Tool
    * @category Crud
    * @author rsantos
    */
   class ZendT_Tool_Crud_MapperView {

       /**
        * Cria as classes de Mappero 
        * 
        * @param string $pathBase
        * @param array $config 
        */
       public static function create($pathBase, $config) {
           if (!isset($config['table']['modelName'])) {
               $config['table']['modelName'] = $config['table']['name'];
           }
           $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);
           if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
               $config['table']['moduleName'] = 'Application';
               $path = 'application/data-views/Crud';
           } else {
               $path = 'application/modules/' . $config['table']['moduleName'] . '/data-views/' . $modelName . '/Crud';
           }
           $ucModuleName = ucfirst($config['table']['moduleName']);
           ZendT_Lib::createDirectory($pathBase, $path);

           $dataObject = array();

           $strLoadColumns = "\n";
           $strOrder = '';
           $strWidth = '';
           $strAlign = '';
           $strHidden = '';
           $strRemove = '';
           $strBase = '';
           $strAttr = '';
           $strAttrInit = "\n";

           if (!isset($config['table']['columns']['id'])) {

               $expression = '';
               foreach ($config['table']['primary'] as $column) {
                   $expression.= "||\'-\'||{$config['table']['name']}.{$column}";
               }
               $strLoadColumns.= "            \$this->_columns->addExpression('id', '" . substr($expression, 9) . "', '{$ucModuleName}_Model_{$modelName}_Mapper', ZendT_Lib::translate('{$config['table']['name']}.id'),null,'=');\n";
               $strOrder.= ',\'id\'';
               $strWidth.= ',' . "'id'=>120";
               $strAlign.= ',' . "'id'=>'left'";
               $strHidden.= ',\'id\'';
           }

           foreach ($config['table']['columns'] as $column => $prop) {
               /**
                * @todo só não deve ir no grid
                */
               if ($prop['type'] == "StringLong" || $prop['object']['type'] == 'File' || strpos($column, '_type') !== false) {
                   $strRemove.= ',' . "'" . $column . "'";
               }

               if ($prop['object']['type'] == 'Seeker') {
                   /**
                    * Colocação da Coluna ID 
                    */
                   $columnAlias = $column;
                   if (substr($column, 0, 2) == 'id' && substr($column, 0, 3) != 'id_') {
                       $columnAlias = 'id_' . substr($column, 2);
                   }
                   
                   $tableAlias = $config['table']['alias'];
                   if (!$tableAlias){
                       $tableAlias = $config['table']['name'];
                   }

                   $strLoadColumns.= "            \$this->_columns->add('{$columnAlias}', '{$tableAlias}', '{$column}', \$this->getModel()->getMapperName(), ZendT_Lib::translate('{$tableAlias}.{$column}'), null, '=');\n";
                   $strOrder.= ',' . "'" . $column . "'";
                   $strWidth.= ',' . "'{$column}'=>120";
                   $strAlign.= ',' . "'{$column}'=>'left'";
                   $strHidden.= ',' . "'" . $column . "'";


                   if ($strBase == '') {
                       $strBase = "\$sql = \$this->getModel()->getTableName().' '.\$this->getModel()->getAlias() .\" ";
                   }

                   $tableColumn = str_replace(array('_id'), '', strtolower($column));
                   if (strtolower(substr($tableColumn, 0, 3)) == 'id_') {
                       $tableColumn = substr($tableColumn, 3);
                   } else if (strtolower(substr($tableColumn, 0, 2)) == 'id') {
                       $tableColumn = substr($tableColumn, 2);
                   }

                   if (strtolower($tableColumn) == strtolower($config['table']['name'])) {
                       $tableColumn = $tableColumn . '_p';
                   }

                   //echo $column . '  -> '. $tableColumn . "\n";

                   $reference = ZendT_Tool_Crud::getReference($config, $column);
                   $mapperNameSeeker = str_replace('_Table', '', $reference['objectNameReference']) . '_Mapper';
                   $varMapperName = explode('_', $mapperNameSeeker);
                   $funcMapperName = '_get' . $varMapperName[2];
                   $varMapperName = '_' . strtolower(substr($varMapperName[2], 0, 1)) . substr($varMapperName[2], 1);

                   $dataObject[$varMapperName]['method'] = "
                
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return {$mapperNameSeeker}
         */
        protected function {$funcMapperName}(){
            if (!is_object(\$this->{$varMapperName})){
                \$this->{$varMapperName} = new {$mapperNameSeeker}();
            }
            return \$this->{$varMapperName};
        }
                ";
                   $dataObject[$varMapperName]['attrib'] = "
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return {$mapperNameSeeker}
         */
        protected \${$varMapperName};
                ";

                   $strBase.= "\n                   ";
                   if ($prop['nullable'] == true) {
                       $strBase.= ' LEFT ';
                   }
                   $strBase.= " JOIN \".\$this->{$funcMapperName}()->getModel()->getTableName().\" " . $tableColumn . " ON ( ";
                   if ($config['table']['alias']){
                       $strBase.= $config['table']['alias'];
                   }else{
                       $strBase.= $config['table']['name'];
                   }
                   $strBase.= ".";
                   $strBase.= strtolower($reference['columnName']);
                   $strBase.= " = ";
                   $strBase.= $tableColumn;
                   $strBase.= ".";
                   $strBase.= strtolower($reference['columnReference']);
                   $strBase.= " ) ";

                   $search = strtolower($prop['object']['seeker']['field']['search']);
                   $configRelation = ZendT_Tool_Crud::getConfig($pathBase, $reference['tableNameReference'], $reference['schemaNameReference']);

                   $last = false;
                   $column = strtolower($column);
                   if (substr($column, strlen($column) - 3) == '_id') {
                       $last = true;
                   }
                   if (isset($configRelation['table']['columns'][$search])) {

                       if ($last) {
                           $strLoadColumns.= "            \$this->_columns->add('{$tableColumn}_{$prop['object']['seeker']['field']['search']}', '{$tableColumn}', '{$prop['object']['seeker']['field']['search']}', \$this->{$funcMapperName}()->getModel()->getMapperName(), ZendT_Lib::translate('{$config['table']['name']}.$column.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}'),null,'?%');\n";
                           $strOrder.= ',\'' . $tableColumn . '_' . $prop['object']['seeker']['field']['search'] . "'";
                           $strWidth.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['search']}'=>200";
                           $strAlign.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['search']}'=>'left'";
                           if ($configRelation['table']['columns'][$search]['object']['type'] == 'Select') {
                               $strListOptions.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['search']}'=>\$this->{$funcMapperName}()->getModel()->getListOptions('{$search}')";
                           }
                       } else {
                           $strLoadColumns.= "            \$this->_columns->add('{$prop['object']['seeker']['field']['search']}_{$tableColumn}', '{$tableColumn}', '{$prop['object']['seeker']['field']['search']}', \$this->{$funcMapperName}()->getModel()->getMapperName(), ZendT_Lib::translate('{$config['table']['name']}.$column.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['search']}'),null,'?%');\n";
                           $strOrder.= ',\'' . $prop['object']['seeker']['field']['search'] . '_' . $tableColumn . "'";
                           $strWidth.= ',' . "'{$prop['object']['seeker']['field']['search']}_{$tableColumn}'=>200";
                           $strAlign.= ',' . "'{$prop['object']['seeker']['field']['search']}_{$tableColumn}'=>'left'";
                           if ($configRelation['table']['columns'][$search]['object']['type'] == 'Select') {
                               $strListOptions.= ',' . "'{$prop['object']['seeker']['field']['search']}_{$tableColumn}'=>\$this->{$funcMapperName}()->getModel()->getListOptions('{$search}')";
                           }
                       }
                   }

                   if ($prop['object']['seeker']['field']['display'] != '') {
                       $display = strtolower($prop['object']['seeker']['field']['display']);
                       if (isset($configRelation['table']['columns'][$display])) {
                           if ($last) {
                               $strLoadColumns.= "            \$this->_columns->add('{$tableColumn}_{$prop['object']['seeker']['field']['display']}', '{$tableColumn}', '{$prop['object']['seeker']['field']['display']}', \$this->{$funcMapperName}()->getModel()->getMapperName(), ZendT_Lib::translate('{$config['table']['name']}.$column.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}'),null,'?%');\n";
                               $strOrder.= ',\'' . $tableColumn . '_' . $prop['object']['seeker']['field']['display'] . "'";
                               $strWidth.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['display']}'=>200";
                               $strAlign.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['display']}'=>'left'";
                               if ($configRelation['table']['columns'][$display]['object']['type'] == 'Select') {
                                   $strListOptions.= ',' . "'{$tableColumn}_{$prop['object']['seeker']['field']['display']}'=>\$this->{$funcMapperName}()->getModel()->getListOptions('{$display}')";
                               }
                           } else {
                               $strLoadColumns.= "            \$this->_columns->add('{$prop['object']['seeker']['field']['display']}_{$tableColumn}', '{$tableColumn}', '{$prop['object']['seeker']['field']['display']}', \$this->{$funcMapperName}()->getModel()->getMapperName(), ZendT_Lib::translate('{$config['table']['name']}.$column.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}'),null,'?%');\n";
                               $strOrder.= ',\'' . $prop['object']['seeker']['field']['display'] . '_' . $tableColumn . "'";
                               $strWidth.= ',' . "'{$prop['object']['seeker']['field']['display']}_{$tableColumn}'=>200";
                               $strAlign.= ',' . "'{$prop['object']['seeker']['field']['display']}_{$tableColumn}'=>'left'";
                               if ($configRelation['table']['columns'][$display]['object']['type'] == 'Select') {
                                   $strListOptions.= ',' . "'{$prop['object']['seeker']['field']['display']}_{$tableColumn}'=>\$this->{$funcMapperName}()->getModel()->getListOptions('{$display}')";
                               }
                           }
                       }
                   }

                   //print_r($prop['object']['seeker']['relation']);
                   if (isset($prop['object']['seeker']['relation'])) {
                       foreach ($prop['object']['seeker']['relation'] as $relation) {
                           $propCol = $config['table']['columns'][$relation['columnName']];
                           $strBase.= "\n                   ";
                           if ($propCol['nullable'] == true || $prop['nullable'] == true) {
                               $strBase.= ' LEFT ';
                           }
                           /**
                            * 
                            */
                           $relModule = ucfirst($relation['moduleNameReference']);
                           $relObject = ZendT_Lib::convertTableNameToClassName($relation['tableNameReference']);
                           $relMethod = '_get' . $relObject;
                           $relAttr = '_' . strtolower(substr($relObject, 0, 1)) . substr($relObject, 1);
                           $relMapper = $relModule . '_Model_' . $relObject . '_Mapper';


                           $dataObject[$relAttr]['method'] = "
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return {$relMapper}
         */
        protected function {$relMethod}(){
            if (!is_object(\$this->{$relAttr})){
                \$this->{$relAttr} = new {$relMapper}();
            }
            return \$this->{$relAttr};
        }
                ";
                           $dataObject[$relAttr]['attrib'] = "
        /**
         * Objeto de Mapeamento da Tabela
         *
         * @return {$relMapper}
         */
        protected \${$relAttr};
                ";

                           $strBase.= " JOIN \".\$this->{$relMethod}()->getModel()->getTableName().\" " . $relation['tableAliasReference'] . " ON ( ";
                           $strBase.= $relation['tableAlias'];
                           $strBase.= ".";
                           $strBase.= strtolower($relation['columnName']);
                           $strBase.= " = ";
                           $strBase.= $relation['tableAliasReference'];
                           $strBase.= ".";
                           $strBase.= strtolower($relation['columnNameReference']);
                           $strBase.= " ) ";

                           foreach ($relation['columnDisplay'] as $columnDisplay) {
                               //echo $columnDisplay . "\n";
                               $strLoadColumns.= "            \$this->_columns->add('{$columnDisplay}_{$relation['tableAliasReference']}', '{$relation['tableAliasReference']}', '{$columnDisplay}', \$this->{$relMethod}()->getModel()->getMapperName(), ZendT_Lib::translate('{$config['table']['name']}.$column.{$reference['tableNameReference']}.{$prop['object']['seeker']['field']['display']}'),null,'?%');\n";
                               $strOrder.= ',\'' . $columnDisplay . '_' . $relation['tableAliasReference'] . "'";
                               $strWidth.= ',' . "'{$columnDisplay}_{$relation['tableAliasReference']}'=>200";
                               $strAlign.= ',' . "'{$columnDisplay}_{$relation['tableAliasReference']}'=>'left'";
                           }
                           /**
                            * 
                            */
                       }
                   }
               } else {
                   if ($prop['object']['type'] == 'Date') {
                       $strWidth.= ',' . "'{$column}'=>100";
                       $strAlign.= ',' . "'{$column}'=>'center'";
                       $_type = 'Date';
                       $_operation = '=';
                   } else if ($prop['object']['type'] == 'DateTime') {
                       $strWidth.= ',' . "'{$column}'=>150";
                       $strAlign.= ',' . "'{$column}'=>'center'";
                       $_type = 'DateTime';
                       $_operation = '=';
                   } else if ($prop['object']['type'] == 'Time') {
                       $strWidth.= ',' . "'{$column}'=>100";
                       $strAlign.= ',' . "'{$column}'=>'center'";
                       $_type = 'Time';
                       $_operation = '=';
                   } else if ($prop['object']['type'] == 'Select') {
                       $strWidth.= ',' . "'{$column}'=>150";
                       $strAlign.= ',' . "'{$column}'=>'center'";
                       $_type = 'String';
                       $_operation = '=';
                   } else if ($prop['object']['type'] == 'Numeric') {
                       $strWidth.= ',' . "'{$column}'=>150";
                       $strAlign.= ',' . "'{$column}'=>'right'";
                       $_type = 'Numeric';
                       $_operation = '=';
                   } else {
                       $width = str_replace('px', '', $config['table']['columns'][$column]['object']['text']['css-width']);
                       if (!$width)
                           $width = 200;
                       $strWidth.= ',' . "'{$column}'=>" . $width;
                       $strAlign.= ',' . "'{$column}'=>'left'";
                       $_type = 'String';
                       $_operation = '%?%';
                   }

                   $tableAlias = $config['table']['alias'];
                   if (!$tableAlias){
                       $tableAlias = $config['table']['name'];
                   }
                   $strLoadColumns.= "            \$this->_columns->add('{$column}', '{$tableAlias}', '{$column}', \$this->getModel()->getMapperName(), ZendT_Lib::translate('{$tableAlias}.{$column}'),'{$_type}','{$_operation}');\n";
                   $strOrder.= ',' . "'" . $column . "'";

                   if ($prop['object']['type'] == 'Select') {
                       $strListOptions.= ',' . "'{$column}'=>\$this->getModel()->getListOptions('{$column}')";
                   }
               }
           }
           if (!$strBase)
               $strBase = '$sql = parent::_getSqlBase();';
           else
               $strBase.= ' "; ';

           $strOrder = substr($strOrder, 1);
           $strWidth = substr($strWidth, 1);
           $strAlign = substr($strAlign, 1);
           $strHidden = substr($strHidden, 1);
           $strRemove = substr($strRemove, 1);
           $strListOptions = substr($strListOptions, 1);

           $strMethod = '';
           foreach ($dataObject as $data) {
               $strAttr.= $data['attrib'];
               $strMethod.= $data['method'];
           }

           $contentText = <<<EOS
<?php
    /**
    * Classe de visão da tabela {$config['table']['name']}
    */
    class {$ucModuleName}_DataView_{$modelName}_Crud_MapperView extends {$ucModuleName}_Model_{$modelName}_Mapper implements ZendT_Db_View
    {
        {$strAttr}
        {$strMethod}
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           \$profile = array();
           \$profile['order'] = array({$strOrder});
           \$profile['width'] = array({$strWidth});
           \$profile['align'] = array({$strAlign});
           \$profile['hidden'] = array({$strHidden});
           \$profile['remove'] = array({$strRemove});
           \$profile['listOptions'] = array({$strListOptions});
           return \$profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            \$this->_columns = new ZendT_Db_Column_View('{$ucModuleName}_DataView_{$modelName}_MapperView',\$this->_getSettingsDefault());
            {$strLoadColumns}
        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            {$strBase}
            return \$sql;
        }
    }
?>
EOS;
           $filename = $path . '/MapperView.php';
           file_put_contents($filename, $contentText);

           $contentText = <<<EOS
<?php
    /**
     * Classe de visão da tabela {$config['table']['name']}
     */
    class {$ucModuleName}_DataView_{$modelName}_MapperView extends {$ucModuleName}_DataView_{$modelName}_Crud_MapperView
    {

    }
?>
EOS;
           $filename = str_replace('/Crud', '', $path) . '/MapperView.php';
           if (!file_exists($filename)) {
               file_put_contents($filename, $contentText);
           }
       }

       public static function createView($pathBase, $name, $configTable) {
           $modelName = ZendT_Lib::convertTableNameToClassName($configTable['table']['name']);
           $className = ZendT_Lib::convertTableNameToClassName($name);
           if ($configTable['table']['moduleName'] == '' || $configTable['table']['moduleName'] == 'Application') {
               $configTable['table']['moduleName'] = 'Application';
               $path = 'application/models/View';
           } else {
               $path = 'application/modules/' . $configTable['table']['moduleName'] . '/models/' . $modelName . '/View';
           }
           $ucModuleName = ucfirst($configTable['table']['moduleName']);
           ZendT_Lib::createDirectory($pathBase, $path);

           $contentText = <<<EOS
<?php
    /**
    * Classe de visão da tabela {$configTable['table']['name']}
    */
    class {$ucModuleName}_Model_{$modelName}_View_{$className} extends {$ucModuleName}_Model_{$modelName}_Mapper implements ZendT_Db_View
    {
        /**
         * Retorna as configurações padrão da visualização
         *
         * @return array
         */
        protected function _getSettingsDefault(){
           \$profile = array();
           \$profile['order'] = array();
           \$profile['width'] = array();
           \$profile['align'] = array();
           \$profile['hidden'] = array();
           \$profile['remove'] = array();
           \$profile['listOptions'] = array();
           return \$profile;
        }
        /**
         * Carrega as colunas com suas configurações 
         */
        protected function _loadColumns(){
            \$this->_columns = new ZendT_Db_Column_View('{$ucModuleName}_Model_{$modelName}_View_{$className}',\$this->_getSettingsDefault());
        }
        /**
         * Retorna o SQL Base
         */
        protected function _getSqlBase() {
            \$sql = \$this->getModel()->getTableName() . ' {$configTable['table']['name']} ';
            return \$sql;
        }
    }
?>
EOS;
           $filename = $path . '/' . $className . '.php';
           echo $filename;

           file_put_contents($filename, $contentText);
       }

   }

?>
