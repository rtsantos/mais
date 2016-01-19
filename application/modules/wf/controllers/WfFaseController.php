<?php
    class Wf_WfFaseController extends ZendT_Controller_ActionCrud {
        public function init() {
            //$this->_startupAcl();
            $this->_init();
            $this->_serviceName = 'Wf_Service_WfFase';            
            $this->_formName = 'Wf_Form_WfFase_Edit';
            $this->_formSearchName = 'Wf_Form_WfFase_Search';            
            $this->_mapper = new Wf_Model_WfFase_Mapper();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'wffase';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
            
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.id'))
                ->setName('id')
                ->setTableAndFieldName('wf_fase.id')
                ->setType('Text')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $this->getGrid()->setSortName($column->getTableAndFieldName());
            $this->getGrid()->setSortOrder('DESC');
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.id_wf_processo').' '.$this->getTranslate()->_('wf_processo.descricao'))
                ->setName('descricao_wf_processo')
                ->setTableAndFieldName('wf_processo.descricao')
                ->setType('String')
                ->setMapperName('Wf_Model_WfProcesso_Mapper')
                ->setWidth(200)
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.valor'))
                ->setName('valor')
                ->setTableAndFieldName('wf_fase.valor')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.descricao'))
                ->setName('descricao')
                ->setTableAndFieldName('wf_fase.descricao')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.proc_prox_fase'))
                ->setName('proc_prox_fase')
                ->setTableAndFieldName('wf_fase.proc_prox_fase')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.proc_prox_usuario'))
                ->setName('proc_prox_usuario')
                ->setTableAndFieldName('wf_fase.proc_prox_usuario')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_fase.proc_notif'))
                ->setName('proc_notif')
                ->setTableAndFieldName('wf_fase.proc_notif')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
        }
    }
?>
