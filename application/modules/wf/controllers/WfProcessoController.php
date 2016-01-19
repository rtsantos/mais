<?php
    class Wf_WfProcessoController extends ZendT_Controller_ActionCrud {
        public function init() {
            //$this->_startupAcl();
            $this->_init();
            $this->_serviceName = 'Wf_Service_WfProcesso';            
            $this->_formName = 'Wf_Form_WfProcesso_Edit';
            $this->_formSearchName = 'Wf_Form_WfProcesso_Search';            
            $this->_mapper = new Wf_Model_WfProcesso_Mapper();
            /**
             * Configuração do Grid
             */
            $name = $this->getRequest()->getParam('name');
            if (!$name)
                $name = 'wfprocesso';
            $this->setGrid( new ZendT_Grid('grid_'.$name));
            
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_processo.id'))
                ->setName('id')
                ->setTableAndFieldName('wf_processo.id')
                ->setType('Text')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
            $this->getGrid()->setSortName($column->getTableAndFieldName());
            $this->getGrid()->setSortOrder('DESC');
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_processo.descricao'))
                ->setName('descricao')
                ->setTableAndFieldName('wf_processo.descricao')
                ->setType('String')
                ->setMapper($this->_mapper)
                ->setWidth(200)
                ->setMask('')
                ->setAlign('left');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_processo.id_aplicacao').' '.$this->getTranslate()->_('aplicacao.sigla'))
                ->setName('sigla_aplicacao')
                ->setTableAndFieldName('aplicacao.sigla')
                ->setType('String')
                ->setMapperName('Prouser_Model_Aplicacao_Mapper')
                ->setWidth(200)
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                
            $column = new ZendT_Grid_Column();
            $column
                ->setHeaderTitle($this->getTranslate()->_('wf_processo.id_aplicacao').' '.$this->getTranslate()->_('aplicacao.nome'))
                ->setName('nome_aplicacao')
                ->setTableAndFieldName('aplicacao.nome')
                ->setType('String')
                ->setMapperName('Prouser_Model_Aplicacao_Mapper')
                ->setWidth(200)
                ->setAlign('center');
            $this->getGrid()->addColumn($column);
                    
        }
    }
?>
