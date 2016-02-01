<?php
    class Vendas_ProdutoController extends ZendT_Controller_ActionCrud {
        public function init() {
            $mapperName = $this->getRequest()->getParam('mapper');
            if (!$mapperName){
                $mapperName = 'produto';
            }
            
            //ZendT_Tool::
            
            $mapperName = ZendT_Lib::paramToMethod($mapperName);
            $mapperName = 'Vendas_DataView_'.$mapperName.'_MapperView';
            
            $this->_init();
            //$this->_startupAcl();
            $this->_serviceName = 'Vendas_Service_Produto';            
            $this->_formName = 'Vendas_Form_Produto_Edit';
            $this->_formSearchName = 'Vendas_Form_Produto_Search';
            $this->_mapper = new $mapperName();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'produto';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
        }
    }
?>
