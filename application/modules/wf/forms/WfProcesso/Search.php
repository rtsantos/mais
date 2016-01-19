<?php
    class Wf_Form_WfProcesso_Search extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_wf');
            $model = new Wf_Model_WfProcesso_Table();
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
                $element->setValue('wf_processo.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Wf_Model_WfProcesso_Mapper');
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
                $fields->setLegend($translate->_('wf_processo.id') . ':')->setAttrib('id', 'id-fieldset');
            /**
             * Pesquisa na coluna descricao
             */
            
                $element = new ZendT_Form_Element_Hidden('descricaofield');
                $element->setBelongsTo('filter[descricao][field]');
                $element->setValue('wf_processo.descricao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('descricaomapper');
                $element->setBelongsTo('filter[descricao][mapper]');
                $element->setValue('Wf_Model_WfProcesso_Mapper');
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
                $fields->setLegend($translate->_('wf_processo.descricao') . ':')->setAttrib('id', 'descricao-fieldset');
            /**
             * Pesquisa na coluna id_aplicacao
             */
            
                $element = new ZendT_Form_Element_Hidden('id_aplicacaofield');
                $element->setBelongsTo('filter[id_aplicacao][field]');
                $element->setValue('wf_processo.id_aplicacao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('id_aplicacaomapper');
                $element->setBelongsTo('filter[id_aplicacao][mapper]');
                $element->setValue('Wf_Model_WfProcesso_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('id_aplicacaoop');
                $element->setBelongsTo('filter[id_aplicacao][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('id_aplicacao');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[id_aplicacao][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'id_aplicacaoop',$nameElement
                    ),'id_aplicacao.id_aplicacaoop'
                );

                $fields = $this->getDisplayGroup('id_aplicacao.id_aplicacaoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('wf_processo.id_aplicacao') . ':')->setAttrib('id', 'id_aplicacao-fieldset');
        }
    }
?>