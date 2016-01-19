<?php
    class Auth_Form_TipoRecurso_Search extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_auth');
            $model = new Auth_Model_TipoRecurso_Table();
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
                $element->setValue('tipo_recurso.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Auth_Model_TipoRecurso_Mapper');
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
                $fields->setLegend($translate->_('tipo_recurso.id') . ':')->setAttrib('id', 'id-fieldset');
            /**
             * Pesquisa na coluna nome
             */
            
                $element = new ZendT_Form_Element_Hidden('nomefield');
                $element->setBelongsTo('filter[nome][field]');
                $element->setValue('tipo_recurso.nome');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('nomemapper');
                $element->setBelongsTo('filter[nome][mapper]');
                $element->setValue('Auth_Model_TipoRecurso_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('nomeop');
                $element->setBelongsTo('filter[nome][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('nome');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[nome][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'nomeop',$nameElement
                    ),'nome.nomeop'
                );

                $fields = $this->getDisplayGroup('nome.nomeop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('tipo_recurso.nome') . ':')->setAttrib('id', 'nome-fieldset');
            /**
             * Pesquisa na coluna descricao
             */
            
                $element = new ZendT_Form_Element_Hidden('descricaofield');
                $element->setBelongsTo('filter[descricao][field]');
                $element->setValue('tipo_recurso.descricao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('descricaomapper');
                $element->setBelongsTo('filter[descricao][mapper]');
                $element->setValue('Auth_Model_TipoRecurso_Mapper');
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
                $fields->setLegend($translate->_('tipo_recurso.descricao') . ':')->setAttrib('id', 'descricao-fieldset');
        }
    }
?>