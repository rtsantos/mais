<?php
    class Auth_TesteRafaelController extends ZendT_Controller_ActionCrud {
        public function init() {
            $this->_serviceName = 'Auth_Service_TesteRafael';            
            $this->_formName = 'Auth_Form_TesteRafael';
            $this->_formSearchName = 'Auth_Form_TesteRafaelSearch';            
            $this->_mapper = new Auth_Model_TesteRafaelMapper();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'testerafael';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
            
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('id')
                ->setName('id')
                ->setTableAndFieldName('teste_rafael.id')
                ->setType('Number')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('right');
            $this->getGrid()->addColumn($column);
                
            $this->getGrid()->setSortName($column->getTableAndFieldName());
            $this->getGrid()->setSortOrder('DESC');
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('nome')
                ->setName('nome')
                ->setTableAndFieldName('teste_rafael.nome')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('dt_emissao')
                ->setName('dt_emissao')
                ->setTableAndFieldName('teste_rafael.dt_emissao')
                ->setType('DATE')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('dh_inc')
                ->setName('dh_inc')
                ->setTableAndFieldName('teste_rafael.dh_inc')
                ->setType('DATE')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('valor')
                ->setName('valor')
                ->setTableAndFieldName('teste_rafael.valor')
                ->setType('Number')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('2')
                ->setAlign('right');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle('aliq')
                ->setName('aliq')
                ->setTableAndFieldName('teste_rafael.aliq')
                ->setType('Number')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('4')
                ->setAlign('right');
            $this->getGrid()->addColumn($column);
                
        }
    }
?>
