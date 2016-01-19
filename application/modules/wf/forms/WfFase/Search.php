<?php
    class Wf_Form_WfFase_Search extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_wf');
            $model = new Wf_Model_WfFase_Table();
            $element = new ZendT_Form_Element_SelectSqlGroupOperation();
            $element->setLabel('Filtrar com:');
            $this->addElement($element);
            
        /**
         * Campo para identificar que a busca é do tipo Search de GRID
         */
         $element = new ZendT_Form_Element_Hidden('isSearch');
         $element->setValue('true');
         $this->addElement($element);
            /**
             * Pesquisa na coluna id
             */
            
                $element = new ZendT_Form_Element_Hidden('idfield');
                $element->setBelongsTo('filter[id][field]');
                $element->setValue('wf_fase.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idop');
                $element->setBelongsTo('filter[id][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idop',$nameElement
                    ),'id.idop'
                );

                $fields = $this->getDisplayGroup('id.idop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.id') . ':')->setAttrib('id', 'id-fieldset');
            /**
             * Pesquisa na coluna id_wf_processo
             */
            
                $element = new ZendT_Form_Element_Hidden('id_wf_processofield');
                $element->setBelongsTo('filter[id_wf_processo][field]');
                $element->setValue('wf_fase.id_wf_processo');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_wf_processomapper');
                $element->setBelongsTo('filter[id_wf_processo][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_wf_processoop');
                $element->setBelongsTo('filter[id_wf_processo][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_wf_processo');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_wf_processo][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_wf_processoop',$nameElement
                    ),'id_wf_processo.id_wf_processoop'
                );

                $fields = $this->getDisplayGroup('id_wf_processo.id_wf_processoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.id_wf_processo') . ':')->setAttrib('id', 'id_wf_processo-fieldset');
            /**
             * Pesquisa na coluna valor
             */
            
                $element = new ZendT_Form_Element_Hidden('valorfield');
                $element->setBelongsTo('filter[valor][field]');
                $element->setValue('wf_fase.valor');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('valormapper');
                $element->setBelongsTo('filter[valor][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('valorop');
                $element->setBelongsTo('filter[valor][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('valor');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[valor][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'valorop',$nameElement
                    ),'valor.valorop'
                );

                $fields = $this->getDisplayGroup('valor.valorop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.valor') . ':')->setAttrib('id', 'valor-fieldset');
            /**
             * Pesquisa na coluna descricao
             */
            
                $element = new ZendT_Form_Element_Hidden('descricaofield');
                $element->setBelongsTo('filter[descricao][field]');
                $element->setValue('wf_fase.descricao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('descricaomapper');
                $element->setBelongsTo('filter[descricao][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('descricaoop');
                $element->setBelongsTo('filter[descricao][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('descricao');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[descricao][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'descricaoop',$nameElement
                    ),'descricao.descricaoop'
                );

                $fields = $this->getDisplayGroup('descricao.descricaoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.descricao') . ':')->setAttrib('id', 'descricao-fieldset');
            /**
             * Pesquisa na coluna proc_prox_fase
             */
            
                $element = new ZendT_Form_Element_Hidden('proc_prox_fasefield');
                $element->setBelongsTo('filter[proc_prox_fase][field]');
                $element->setValue('wf_fase.proc_prox_fase');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('proc_prox_fasemapper');
                $element->setBelongsTo('filter[proc_prox_fase][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('proc_prox_faseop');
                $element->setBelongsTo('filter[proc_prox_fase][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('proc_prox_fase');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[proc_prox_fase][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'proc_prox_faseop',$nameElement
                    ),'proc_prox_fase.proc_prox_faseop'
                );

                $fields = $this->getDisplayGroup('proc_prox_fase.proc_prox_faseop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.proc_prox_fase') . ':')->setAttrib('id', 'proc_prox_fase-fieldset');
            /**
             * Pesquisa na coluna proc_prox_usuario
             */
            
                $element = new ZendT_Form_Element_Hidden('proc_prox_usuariofield');
                $element->setBelongsTo('filter[proc_prox_usuario][field]');
                $element->setValue('wf_fase.proc_prox_usuario');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('proc_prox_usuariomapper');
                $element->setBelongsTo('filter[proc_prox_usuario][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('proc_prox_usuarioop');
                $element->setBelongsTo('filter[proc_prox_usuario][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('proc_prox_usuario');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[proc_prox_usuario][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'proc_prox_usuarioop',$nameElement
                    ),'proc_prox_usuario.proc_prox_usuarioop'
                );

                $fields = $this->getDisplayGroup('proc_prox_usuario.proc_prox_usuarioop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.proc_prox_usuario') . ':')->setAttrib('id', 'proc_prox_usuario-fieldset');
            /**
             * Pesquisa na coluna proc_notif
             */
            
                $element = new ZendT_Form_Element_Hidden('proc_notiffield');
                $element->setBelongsTo('filter[proc_notif][field]');
                $element->setValue('wf_fase.proc_notif');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('proc_notifmapper');
                $element->setBelongsTo('filter[proc_notif][mapper]');
                $element->setValue('Wf_Model_WfFase_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('proc_notifop');
                $element->setBelongsTo('filter[proc_notif][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('proc_notif');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[proc_notif][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'proc_notifop',$nameElement
                    ),'proc_notif.proc_notifop'
                );

                $fields = $this->getDisplayGroup('proc_notif.proc_notifop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_fase.proc_notif') . ':')->setAttrib('id', 'proc_notif-fieldset');
        }
    }
?>