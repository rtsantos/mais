<?php
/**
 * Classe para geração do arquivo Service do módulo
 * 
 * @package ZendT
 * @subpackage Tool
 * @category Crud
 * @author rsantos
 */
class ZendT_Tool_Crud_Report {
    /**
     * Cria as classes de Serviço 
     * 
     * @param string $pathBase
     * @param array $config 
     */
    public static function create($pathBase, $name, $module){
        $modelName = ZendT_Lib::convertTableNameToClassName($name);
        $moduleName = $module;

        if ($moduleName == '' || $moduleName == 'Application') {
            $moduleName = 'Application';
            $path = 'application/reports';
        } else {
            $path = 'application/modules/' . $moduleName . '/reports';
        }
        $ucModuleName = ucfirst($moduleName);
        ZendT_Lib::createDirectory($pathBase, $path);
        $filename = $path . '/' . $modelName . '.php';


        $contentText = <<<EOS
<?php
    /**
     * Classe de relatório $modelName
     *
     * @package ZendT
     * @subpackage Report
     */
    class {$ucModuleName}_Report_{$modelName}{
        /**
         * @var ZendT_Report_Abstract
         */
        protected \$_report;
        /**
         * @var ZendT_Db_Mapper
         */
        protected \$_mapper;
        /**
         * Construtor
         */
        public function __construct(\$driver,ZendT_Db_Mapper \$_mapper){
            \$this->_report = ZendT_Report::factory(\$driver);
            \$this->_mapper = \$_mapper;
            
            \$this->_report->setTitle('Título do Relatório');
            \$this->_report->addPage();
            
            \$row = array();
            \$row['column'] = 'column';
            \$this->_addRow(\$row,true);
            \$this->_report->drawLine();
        }
        /**
         *
         * @param array \$row
         * @param bool \$title
         */
        private function _addRow(\$row,\$title=false){
            \$_cell = new ZendT_Report_Cell();
            \$_cell->setValue(\$row['column']);
            \$_cell->setWidth(200);
            \$_cell->setType('String');
            \$_cell->setFontWeight(\$title);
            \$this->_report->addCell(\$_cell);
            
            \$this->_report->printCells();
        }
        /**
         *
         * @return ZendT_Db_Recordset
         */
        private function _getRecodset(){
            \$sql = "SELECT * FROM ".\$this->_mapper->getModel()->getTableName();
            \$stmt = \$this->_mapper->getModel()->getAdapter()->query(\$sql);
            \$columnMappers = new ZendT_Db_Column_Mapper();
            \$columnMappers->add('column', \$this->_mapper->getColumn(true));
            \$rs = new ZendT_Db_Recordset(\$stmt,\$columnMappers,true);
            return \$rs;
        }
        /**
         *
         */
        private function _make(){
            \$recordset = \$this->_getRecodset();
            while(\$row = \$recordset->getRow()){
                \$this->_addRow(\$row,false);
            }
            \$this->_report->drawLine();
        }
        /**
         *
         */
        public function show(\$dest='S'){
            \$this->_make();
            return \$this->_report->output('relatorio',\$dest);
        }
    }
?>
EOS;
        file_put_contents($filename, $contentText);
    }
}
?>
