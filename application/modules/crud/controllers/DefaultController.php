<?php
    /**
     * Description of DefaultController
     *
     * @author rsantos
     */
    class Crud_DefaultController extends ZendT_Controller_ActionCrud {
        public function init() {
            $moduleName = $this->getRequest()->getModuleName();
            $tableName  = $this->getRequest()->getParam('table');
            $objectName  = ZendT_Lib::convertTableNameToClassName($tableName);
            
            var_dump($moduleName,$tableName,$objectName);
            exit;
        }
    }
?>