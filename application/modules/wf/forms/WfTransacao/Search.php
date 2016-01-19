<?php
    class Wf_Form_WfTransacao_Search extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_wf');
            $model = new Wf_Model_WfTransacao_Table();
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
             * Pesquisa na coluna id_wf_fase
             */
            
                $element = new ZendT_Form_Element_Hidden('id_wf_fasefield');
                $element->setBelongsTo('filter[id_wf_fase][field]');
                $element->setValue('wf_transacao.id_wf_fase');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_wf_fasemapper');
                $element->setBelongsTo('filter[id_wf_fase][mapper]');
                $element->setValue('Wf_Model_WfTransacao_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_wf_faseop');
                $element->setBelongsTo('filter[id_wf_fase][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_wf_fase');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_wf_fase][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_wf_faseop',$nameElement
                    ),'id_wf_fase.id_wf_faseop'
                );

                $fields = $this->getDisplayGroup('id_wf_fase.id_wf_faseop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_transacao.id_wf_fase') . ':')->setAttrib('id', 'id_wf_fase-fieldset');
            /**
             * Pesquisa na coluna id_objeto
             */
            
                $element = new ZendT_Form_Element_Hidden('id_objetofield');
                $element->setBelongsTo('filter[id_objeto][field]');
                $element->setValue('wf_transacao.id_objeto');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_objetomapper');
                $element->setBelongsTo('filter[id_objeto][mapper]');
                $element->setValue('Wf_Model_WfTransacao_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_objetoop');
                $element->setBelongsTo('filter[id_objeto][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_objeto');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_objeto][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_objetoop',$nameElement
                    ),'id_objeto.id_objetoop'
                );

                $fields = $this->getDisplayGroup('id_objeto.id_objetoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_transacao.id_objeto') . ':')->setAttrib('id', 'id_objeto-fieldset');
            /**
             * Pesquisa na coluna id_usuario_aloc
             */
            
                $element = new ZendT_Form_Element_Hidden('id_usuario_alocfield');
                $element->setBelongsTo('filter[id_usuario_aloc][field]');
                $element->setValue('wf_transacao.id_usuario_aloc');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_usuario_alocmapper');
                $element->setBelongsTo('filter[id_usuario_aloc][mapper]');
                $element->setValue('Wf_Model_WfTransacao_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_usuario_alocop');
                $element->setBelongsTo('filter[id_usuario_aloc][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_usuario_aloc');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_usuario_aloc][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_usuario_alocop',$nameElement
                    ),'id_usuario_aloc.id_usuario_alocop'
                );

                $fields = $this->getDisplayGroup('id_usuario_aloc.id_usuario_alocop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_transacao.id_usuario_aloc') . ':')->setAttrib('id', 'id_usuario_aloc-fieldset');
            /**
             * Pesquisa na coluna dh_inc
             */
            
                $element = new ZendT_Form_Element_Hidden('dh_incfield');
                $element->setBelongsTo('filter[dh_inc][field]');
                $element->setValue('wf_transacao.dh_inc');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('dh_incmapper');
                $element->setBelongsTo('filter[dh_inc][mapper]');
                $element->setValue('Wf_Model_WfTransacao_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('dh_incop');
                $element->setBelongsTo('filter[dh_inc][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('dh_inc');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[dh_inc][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'dh_incop',$nameElement
                    ),'dh_inc.dh_incop'
                );

                $fields = $this->getDisplayGroup('dh_inc.dh_incop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_transacao.dh_inc') . ':')->setAttrib('id', 'dh_inc-fieldset');
            /**
             * Pesquisa na coluna observacao
             */
            
        }
    }
?>