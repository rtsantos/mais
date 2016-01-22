<?php
/**
 * Classe para geração do arquivo Mapper do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Mapper {
    /**
     * Cria as classes de Mappero 
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $config){
        if (!isset($config['table']['modelName'])){
            $config['table']['modelName'] = $config['table']['name'];
        }
        $modelName = ZendT_Lib::convertTableNameToClassName($config['table']['modelName']);
        if ($config['table']['moduleName'] == '' || $config['table']['moduleName'] == 'Application') {
            $config['table']['moduleName'] = 'Application';
            $path = 'application/models/Crud';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/models/' . $modelName . '/Crud';
        }
        $ucModuleName = ucfirst($config['table']['moduleName']);
        ZendT_Lib::createDirectory($pathBase, $path);
        
        
        $strReferenceMap = '';
        foreach ($config['table']['referenceMaps'] as $prop) {
            $referenceName = ZendT_Lib::convertTableNameToClassName($prop['columnName']);
            $strReferenceMap.= ",
                '" . $prop['columnName'] . "' => array(
                    'mapper' => '" . str_replace('_Model_','_DataView_',$prop['objectNameReference']) . "_MapperView',
                    'column' => '" . $prop['columnReference'] . "'
                )";
        }
        $strReferenceMap = substr($strReferenceMap, 1);

        $strBody = '';
        $strRequired = '';
        foreach ($config['table']['columns'] as $column => $prop) {
            //print_r($prop['object']['filter']);
            $strFilter = 'array(';
            if (isset($prop['object']['filter'])){
                foreach ($prop['object']['filter'] as $key=>$value){
                    if (is_array($value)){
                        $strFilter.= "'{$key}' => array('".  implode("','", $value)."'), ";
                    }else{
                        $strFilter.= "'{$value}', ";
                    }                
                }
            }
            $strFilter.= ')';            
            
            $set = "\$this->_data['{$column}'] = \$value;";
            if (in_array($prop['object']['type'], array('Date', 'DateTime', 'Time'))) {
                $set = "\$this->_data['{$column}'] = new ZendT_Type_Date(\$value,'{$prop['object']['type']}');";
                $set.= "
         if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                    ";
            } elseif (in_array($prop['object']['type'], array('Numeric','Integer')) || in_array($prop['type'], array('Numeric','Integer'))) {
                #echo $column . "\n";
                $numDecimal = $prop['object']['numeric']['numDecimal'];                
                if (strtolower($prop['object']['type']) == strtolower('Seeker') || in_array(strtolower($column), $config['table']['primary'])) {
                    $numDecimal = 'null';
                }else if (!$numDecimal){
                    $numDecimal = 0;
                }
                $set = "\$this->_data['{$column}'] = new ZendT_Type_Number(\$value,array('numDecimal'=>{$numDecimal}));";
                $set.= "
         if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                    ";
            }else if (in_array($prop['type'], array('StringLong'))) {
                $set = "
         \$this->_data['{$column}'] = new ZendT_Type_Clob(\$value);";
                $set.= "
         if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";
            } else if (in_array($prop['object']['type'], array('File'))) {
                $set = "\$this->_data['{$column}'] = new ZendT_Type_Blob(\$value);
         if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";
            } else if ($prop['object']['mask'] != NULL) {
                $set = "\$this->_data['{$column}'] = new ZendT_Type_String(\$value,array('mask'=>".var_export($prop['object']['mask'],true)."
                                                                   ,'charMask'=>".var_export($prop['object']['charMask'],true)."
                                                                   ,'filterDb'=>".var_export($prop['object']['filterDb'],true)."
                                                                   ,'filter'=>".$strFilter."));
        if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";
            }else if (in_array($prop['object']['type'], array('Text'))) {
                $set = "\$this->_data['{$column}'] = new ZendT_Type_String(\$value,array('mask'=>''
                                                                   ,'charMask'=>''
                                                                   ,'filterDb'=>".var_export($prop['object']['filterDb'],true)."
                                                                   ,'filter'=>".$strFilter."));
        if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";
            }else if (in_array($prop['object']['type'], array('Select'))) {
                $varListOptions = array();
                foreach($prop['object']['listOptions'] as $key=>$value){
                    if((string)$key != ''){
                        $varListOptions[] = "'".$key."'=>'".$value."'";
                    }
                }
                $set = "
        \$options['listOptions']=array(".implode(',',$varListOptions).");
        \$this->_data['{$column}'] = new ZendT_Type_String(\$value,\$options);
        if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";                
            }else{
                $set = "\$this->_data['{$column}'] = new ZendT_Type_String(\$value);
        if (\$options['db'])
            \$this->_data['{$column}']->setValueFromDb(\$value);
                ";                
            }


            $strValidators = '';
            if ($prop['object']['required']) {
                $strRequired.= ",'$column'";
                $strValidators.= "
         if (\$options['required'])
            \$this->isRequired(\$value,'$column');
                    ";
            }

            if (is_array($prop['object']['validators'])) {
                foreach ($prop['object']['validators'] as $validator) {
                    $strValidators.= "
            \$valid = new " . $validator['name'] . "(" . str_replace("\n", " ", var_export($validator['param'], true)) . " );
            \$valueValid = \$this->_data['{$column}']->getValueToDb();
            if (\$valueValid && !\$valid->isValid(\$valueValid)){
                throw new ZendT_Exception_Business(implode(\"\\n\",\$valid->getMessages()));
            }
                    ";
                }
            }

            $strBody.= "
    /**
     * Retorna os dados da coluna {$column}
     *
     * @return string
     */
    public function get" . ZendT_Lib::convertTableNameToClassName($column) . "(\$instance=false){
        if (\$instance && !is_object(\$this->_data['{$column}'])){
            \$this->set" . ZendT_Lib::convertTableNameToClassName($column) . "('',array('required'=>false));
        }
        return \$this->_data['{$column}'];
    }
    /**
     * Seta o valor da coluna {$column}
     *
     * @param string \$value
     * @return {$ucModuleName}_Model_{$modelName}_Crud_Mapper
     */
    public function set" . ZendT_Lib::convertTableNameToClassName($column) . "(\$value,\$options=array('required'=>true)){        
        {$set}
        if (!\$options['db']){
            {$strValidators}
        }
        return \$this;
    }

            ";
        }
        
        if (!isset($config['table']['columns']['id'])){
            $get = '';
            $set = "
            \$this->_id = \$value;
            \$values = explode('-',\$value);\n";
            
            foreach ($config['table']['primary'] as $key=>$column){
                $get.= ".'-'.\$this->_data['{$column}']";
                $set.= "
            \$this->_data['{$column}'] = \$values[{$key}];";
            }
            $get = substr($get,5);
            $strBody.= "
    /**
     * Retorna o dado da coluna ID
     *
     * @return string
     */
    public function getId(\$instance=false,\$retDataId=true){
        if (\$retDataId && \$this->_id){
            \$string = \$this->_id;
        }else{            
            \$string = {$get};
            \$this->_id = \$string;
        }
        \$result = new ZendT_Type_Default(\$string);
        return \$result;
    }
    /**
     * Configura o dado na coluna ID
     *
     * @param string \$value
     * @return {$ucModuleName}_Model_{$modelName}_Crud_Mapper
     */
    public function setId(\$value,\$options=array('required'=>true)){
        #if (!\$options['db']){
            {$set}
        #}
        return \$this;
    }
    /**
     * Altera o registro da tabela
     *
     * @param ZendT_Db_Where
     * @return int|array
     */
    public function update(\$where=null){
        if (\$where == null){
            \$where = \$this->getValueOld()->getWhere();
        }
        return parent::update(\$where);
    }
            ";            
        }

        $strRequired = substr($strRequired, 1);
        $contentText = <<<EOS
<?php
/**
 * Classe de mapeamento do registro da tabela {$config['table']['name']}
 */
class {$ucModuleName}_Model_{$modelName}_Crud_Mapper extends ZendT_Db_Mapper
{
    protected \$_required = array({$strRequired});
    protected \$_model = '{$ucModuleName}_Model_{$modelName}_Table';
    /**
     *
     * @var {$ucModuleName}_Model_{$modelName}_Mapper
     */
    protected \$_dataOld = null;     
    /**
     * Retorna o valor antigo do registro antes de realizar a atualização
     *
     * @return {$ucModuleName}_Model_{$modelName}_Mapper
     */
    public function getValueOld(){
        if (!\$this->_dataOld instanceof {$ucModuleName}_Model_{$modelName}_Mapper){
            \$this->_dataOld = new {$ucModuleName}_Model_{$modelName}_Mapper();
            \$this->_dataOld->setId(\$this->getId());
            \$this->_dataOld->retrive();
        }
        return \$this->_dataOld;
    }
    /**
     * Retorna as referências do objeto
     */
    public function getReferenceMap(){
        return array({$strReferenceMap});
    }
    
    {$strBody}
}
?>
EOS;
        $filename = $path.'/Mapper.php';
        file_put_contents($filename, $contentText);


        $contentText = <<<EOS
<?php
/**
 * Classe de mapeamento do registro da tabela {$config['table']['name']}
 */
class {$ucModuleName}_Model_{$modelName}_Mapper extends {$ucModuleName}_Model_{$modelName}_Crud_Mapper
{

}
?>
EOS;
        $filename = str_replace("/Crud", "", $filename);
        if (!file_exists($filename)) {
            file_put_contents($filename, $contentText);
        }
    }
}
?>
