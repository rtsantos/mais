<?php

/**
 * Classe para geração do arquivo Element do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Element {

    /**
     * Cria as classes de Elemento 
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
            $path = 'application/forms/Crud';
        } else {
            $path = 'application/modules/' . $config['table']['moduleName'] . '/forms/' . $modelName . '/Crud';
        }
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $pathBase . '/' . $path . '/Elements.php';

        $strBody = '';
        foreach ($config['table']['columns'] as $column => $prop) {
            if (strpos($column, '_type') !== false || strpos($column, '_name') !== false) {
                $name = str_replace(array('_type', '_name'), '', $column);
                $_propLob = $config['table']['columns'][$name];
                if ($_propLob['object']['type'] == 'File') {
                    continue;
                }
            }
            $tableColumn = $column;
            $strValidators = '';
            if (is_array($prop['object']['validators'])) {
                foreach ($prop['object']['validators'] as $validator) {
                    $strValidators.= ",'{$validator['name']}'";
                }
            }
            $strValidators = 'array(' . substr($strValidators, 1) . ')';
            if ($prop['object']['type'] == 'Seeker') {

                $strAttrId = '';
                if (isset($prop['object']['seeker']['id'])) {
                    foreach ($prop['object']['seeker']['id'] as $key => $value) {
                        if ($value)
                            $strAttrId.= ",'$key'=>'$value'";
                    }
                }
                $strAttrId = 'array(' . substr($strAttrId, 1) . ')';

                $strAttrSearch = '';
                if ($prop['object']['seeker']['search']) {
                    foreach ($prop['object']['seeker']['search'] as $key => $value) {
                        if ($value)
                            $strAttrSearch.= ",'$key'=>'$value'";
                    }
                    //$strAttrSearch.= ",'id'=>'$tableColumn'";
                    $strAttrSearch = 'array(' . substr($strAttrSearch, 1) . ')';
                }
                $strAttrDisplay = '';
                if ($prop['object']['seeker']['display']) {
                    foreach ($prop['object']['seeker']['display'] as $key => $value) {
                        if ($value)
                            $strAttrDisplay.= ",'$key'=>'$value'";
                    }
                }
                $strAttrDisplay = 'array(' . substr($strAttrDisplay, 1) . ')';

                $namePrepare = '';
                if (substr(strtolower($tableColumn), 0, 3) == 'id_') {
                    $nameSeeker = substr(strtolower($tableColumn), 3);
                    $namePrepare = "\$element->setSuffix('{$nameSeeker}');";
                } elseif (substr(strtolower($tableColumn), 0, 2) == 'id') {
                    $nameSeeker = substr(strtolower($tableColumn), 2);
                    $namePrepare = "\$element->setSuffix('{$nameSeeker}');";
                } elseif (substr(strtolower($tableColumn), strlen($tableColumn)-3, 3) == '_id') {
                    $nameSeeker = substr(strtolower($tableColumn), 0, strlen($tableColumn)-3);
                    $namePrepare = "\$element->setPrefix('{$nameSeeker}');";
                } elseif (substr(strtolower($tableColumn), strlen($tableColumn)-2, 2) == 'id') {
                    $nameSeeker = substr(strtolower($tableColumn), 0, strlen($tableColumn)-2);
                    $namePrepare = "\$element->setPrefix('{$nameSeeker}');";
                } else {
                    $nameSeeker = $tableColumn;
                    $namePrepare = "\$element->setSuffix('{$nameSeeker}');";
                }
//
                if (!isset($prop['object']['seeker']['url']['mapperView'])) {
                    $mapperViewAux = explode('/', $prop['object']['seeker']['url']['grid']);

                    $mapperView['module'] = ucfirst($mapperViewAux[1]);
                    $mapperViewAux = explode('-', $mapperViewAux[2]);
                    $mapperView['name'] = '';
                    foreach ($mapperViewAux as $mapperViewName) {
                        $mapperView['name'].= ucfirst($mapperViewName);
                    }
                    $prop['object']['seeker']['url']['mapperView'] = $mapperView['module'] . '_DataView_' . $mapperView['name'] . '_MapperView';
                }
                $commentElement = 'ZendT_Form_Element_Seeker';
                if ($prop['object']['seeker']['url']['retrieve'] == '') {
                    $prop['object']['seeker']['url']['retrieve'] = $prop['object']['seeker']['url']['retrive'];
                }
                
                $suffix = '';
                if (substr($column,0,3) == 'id_'){
                    
                }
                
                $strElement = "
        \$element = new ZendT_Form_Element_Seeker('{$column}');
        {$namePrepare}
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setIdField('{$prop['object']['seeker']['field']['id']}');
        \$element->setIdAttribs({$strAttrId});
        \$element->setSearchField('{$prop['object']['seeker']['field']['search']}');
        \$element->setSearchAttribs({$strAttrSearch});
        \$element->modal()->setWidth({$prop['object']['seeker']['modal']['width']});
        \$element->modal()->setHeight({$prop['object']['seeker']['modal']['height']});
        \$element->url()->setGrid('{$prop['object']['seeker']['url']['grid']}');
        \$element->url()->setSearch('{$prop['object']['seeker']['url']['search']}');
        \$element->url()->setRetrieve('{$prop['object']['seeker']['url']['retrieve']}');
        \$element->setMapperView('{$prop['object']['seeker']['url']['mapperView']}');
        \$element->addValidators({$strValidators});
                ";
                if ($prop['object']['seeker']['field']['display']) {
                    $strElement.= "
        \$element->setDisplayField('{$prop['object']['seeker']['field']['display']}');
        \$element->setDisplayAttribs({$strAttrDisplay});";
                }

                /* $strElement.= "
                  \$element->renderSeeker();"; */
            } elseif ($prop['object']['type'] == 'Hidden') {
                $commentElement = 'ZendT_Form_Element_Hidden';
                $strElement = "
        \$element = new ZendT_Form_Element_Hidden('{$tableColumn}');
        \$element->addValidators({$strValidators});
                ";
            } elseif ($prop['object']['type'] == 'Select') {
                $strOptions = '';
                foreach ($prop['object']['listOptions'] as $key => $value) {
                    $strOptions.= "
        \$element->addMultiOption('{$key}', '{$value}');";
                }
                $commentElement = 'ZendT_Form_Element_Select';
                $strElement = "
        \$element = new ZendT_Form_Element_Select('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');{$strOptions}        
                ";
            } elseif ($prop['object']['type'] == 'Date') {
                $strAttrbs = '';
                foreach ($prop['object']['date'] as $key => $value) {
                    if ($value)
                        $strAttrbs.= ",'$key'=>'$value'";
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_Date';
                $strElement = "
        \$element = new ZendT_Form_Element_Date('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});
        \$element->addValidators({$strValidators});
                ";
            }elseif ($prop['object']['type'] == 'DateTime') {
                $strAttrbsDate = '';
                if ($prop['object']['date']) {
                    foreach ($prop['object']['date'] as $key => $value) {
                        if ($value)
                            $strAttrbsDate.= ",'$key'=>'$value'";
                    }
                }
                $strAttrbsDate = 'array(' . substr($strAttrbsDate, 1) . ')';

                $strAttrbsTime = '';
                if ($prop['object']['time']) {
                    foreach ($prop['object']['time'] as $key => $value) {
                        $strAttrbsTime.= ",'$key'=>'$value'";
                    }
                    $strAttrbsTime = 'array(' . substr($strAttrbsTime, 1) . ')';
                }
                $commentElement = 'ZendT_Form_Element_DateTime';
                $strElement = "
        \$element = new ZendT_Form_Element_DateTime('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setDateAttribs({$strAttrbsDate});
        \$element->setTimeAttribs({$strAttrbsTime});
        \$element->addValidators({$strValidators});
        /*\$element->renderDateTime();*/
                ";
            } elseif ($prop['object']['type'] == 'Time') {
                $strAttrbs = '';
                if ($prop['object']['time']) {
                    foreach ($prop['object']['time'] as $key => $value) {
                        if ($value)
                            $strAttrbs.= ",'$key'=>'$value'";
                    }
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_Time';
                $strElement = "
        \$element = new ZendT_Form_Element_Time('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});
        \$element->addValidators({$strValidators});
                ";
            } elseif ($prop['object']['type'] == 'Textare' || $prop['object']['type'] == 'Textarea') {
                if (!$prop['object']['textare']) {
                    $prop['object']['textare'] = $prop['object']['textarea'];
                }
                if ($prop['object']['textare']['html']) {
                    $prop['object']['textare']['html'] = 1;
                } else {
                    $prop['object']['textare']['html'] = 0;
                }
                $strAttrbs = '';
                if ($prop['object']['textare']) {
                    foreach ($prop['object']['textare'] as $key => $value) {
                        if ($value)
                            $strAttrbs.= ",'$key'=>'$value'";
                    }
                    $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                }
                $commentElement = 'ZendT_Form_Element_Textarea';
                $strElement = "
        \$element = new ZendT_Form_Element_Textarea('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->enableEditorHtml({$prop['object']['textare']['html']});
        \$element->setAttribs({$strAttrbs});        
        \$element->addValidators({$strValidators});
                ";
            } elseif ($prop['object']['type'] == 'File') {
                $strAttrbs = '';
                if ($prop['object']['file']) {
                    foreach ($prop['object']['file'] as $key => $value) {
                        if ($value)
                            $strAttrbs.= ",'$key'=>'$value'";
                    }
                    $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                }
                $commentElement = 'ZendT_Form_Element_FileUpload';
                $strElement = "
        \$element = new ZendT_Form_Element_FileUpload('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});
        \$element->enableMultiple(false);
        \$element->addValidators({$strValidators});
                ";
            }elseif ($prop['object']['type'] == 'Numeric') {
                $strAttrbs = '';
                foreach ($prop['object']['numeric'] as $key => $value) {
                    if (!in_array($key, array('numDecimal', 'numInteger'))) {
                        if ($value)
                            $strAttrbs.= ",'$key'=>'$value'";
                    }
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_Numeric';
                $strElement = "
        \$element = new ZendT_Form_Element_Numeric('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});
        \$element->setJQueryParam('numDecimal','{$prop['object']['numeric']['numDecimal']}');
        \$element->setJQueryParam('numInteger','{$prop['object']['numeric']['numInteger']}');
        \$element->addValidators({$strValidators});
                ";
            }elseif ($prop['object']['type'] == 'Text') {
                $strAttrbs = '';
                foreach ($prop['object']['text'] as $key => $value) {
                    if ($value)
                        $strAttrbs.= ",'$key'=>'$value'";
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_Text';
                $strElement = "
        \$element = new ZendT_Form_Element_Text('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});        
        \$element->addValidators({$strValidators});";
                if (count($prop['object']['filter']) > 0) {
                    $onBlur = '';
                    foreach ($prop['object']['filter'] as $function => $param) {
                        if (is_numeric($function)) {
                            $function = $param;
                            $param = array();
                        }
                        $function = $function . '(this.value';
                        if (count($param) > 0) {
                            $function.= ",'" . implode("','", $param) . "'";
                        }
                        $onBlur.= 'this.value=' . $function . ');';
                    }
                    $strElement.= "
        \$element->addAttr('onBlur',\"" . $onBlur . "\");";
                }
                if ($prop['object']['mask']) {
                    if (!is_array($prop['object']['mask'])) {
                        $prop['object']['mask'] = array($prop['object']['mask']);
                    }

                    $charMask = $prop['object']['charMask'];
                    if (!is_array($charMask)) {
                        $charMask = "'" . $charMask . "'";
                    } else {
                        $charMask = " " . var_export($charMask, true) . " ";
                    }
                    $strElement.= "
        \$element->setMask(" . var_export($prop['object']['mask'], true) . ");
        \$element->setCharMask($charMask);";
                }
            } elseif ($prop['object']['type'] == 'CgcCpf') {
                $strAttrbs = '';
                foreach ($prop['object']['text'] as $key => $value) {
                    if ($value)
                        $strAttrbs.= ",'$key'=>'$value'";
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_CgcCpf';
                $strElement = "
        \$element = new ZendT_Form_Element_CgcCpf('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});        
        \$element->addValidators({$strValidators});
                ";
            } elseif ($prop['object']['type'] == 'Password') {
                $strAttrbs = '';
                if (isset($prop['object']['password'])) {
                    $prop['object']['text'] = $prop['object']['password'];
                }
                foreach ($prop['object']['text'] as $key => $value) {
                    if ($value)
                        $strAttrbs.= ",'$key'=>'$value'";
                }
                $strAttrbs = 'array(' . substr($strAttrbs, 1) . ')';
                $commentElement = 'ZendT_Form_Element_Password';
                $strElement = "
        \$element = new ZendT_Form_Element_Password('{$tableColumn}');
        \$element->setLabel(\$this->_translate->_('{$config['table']['name']}.{$tableColumn}') . ':');
        \$element->setAttribs({$strAttrbs});        
        \$element->addValidators({$strValidators});
                ";
            }
            $strBody.= "
    /**
     *
     * @return \\" . $commentElement . "
     */
    public function get" . ZendT_Lib::convertTableNameToClassName($column) . "(){
{$strElement}
        return \$element;
    }
            ";
        }

        $ucModuleName = ucfirst($config['table']['moduleName']);

        $contentText = <<<EOS
<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela {$config['table']['name']}
 */
class {$ucModuleName}_Form_{$modelName}_Crud_Elements
{
    protected \$_translate;

    public function __construct(){
        \$this->_translate = Zend_Registry::get('translate_{$config['table']['moduleName']}');
    }
        
    /**
     * Retorna as configurações do elemento HTML
     *
     * @param string \$columnName
     * @return {$ucModuleName}_Form_{$modelName}_Elements
     */
    public function getElement(\$columnName){
        \$method = 'get' . ZendT_Lib::convertTableNameToClassName(\$columnName);
        return \$this->\$method();
    }
     
    {$strBody}
}
?>
EOS;
        file_put_contents($filename, $contentText);

        $contentText = <<<EOS
<?php
/**
 * Classe de mapeamento dos pontos de entrada da tabela {$config['table']['name']}
 */
class {$ucModuleName}_Form_{$modelName}_Elements extends {$ucModuleName}_Form_{$modelName}_Crud_Elements
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
