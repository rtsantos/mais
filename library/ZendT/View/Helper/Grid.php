<?php
    /**
     * 
     * @category    ZendT
     * @author      tesilva
     */

    /**
     * jQuery para criação do Grid em Formulário
     *
     */
    class ZendT_View_Helper_Grid extends ZendX_JQuery_View_Helper_UiWidget {

        private $_grid;
        
        /**
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function grid($id, $value = null, array $params = array(), array $attribs = array()) {
            
            if (is_array($params['postData'])){
                $params['postData'] = Zend_Json::encode($params['postData']);
            }
            
            $this->_grid = new ZendT_Grid($id);
            $this->_grid->setUrl($params['url'])
                        ->setCaption($params['label'])
                        ->setPostData($params['postData'])
                        ->setDataType('json')
                        ->setMType('POST')
                        ->setRowNum(600)
                        ->setRowList(array(300, 600, 1200, 2400))
                        ->setPager("#pager-" . $id)
                        ->setViewRecords('true')
                        ->setToolbar(array('true', 'top'))
                        ->setMType('POST')
                        ->setWidth($params['width'])
                        ->setShrinkToFit(false);
            
            $reloadGrid = "function(){ $('#$id').trigger('reloadGrid'); }";
            
            foreach ($params['buttons'] as $button) {
                foreach ($button as $name => $obj) {
                    $obj->setIdGrid($id)
                        ->setOnAfterLoad($reloadGrid);
                    $this->_grid->addToolbarButton($name, $obj);
                }
            }
            
            $order = true;
            
            foreach ($params['columns'] as $column) {
                $this->_grid->addColumn($column);
                if ($order) {
                    if (!$column->getHidden()) {
                        $this->_grid->setSortName($column->getTableAndFieldName());
                        $this->_grid->setSortOrder('DESC');
                        $order = false;
                    }
                }
            }
            
            return $this->_grid;
        }
    }