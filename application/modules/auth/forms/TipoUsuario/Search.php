<?php
    class Auth_Form_TipoUsuario_Search extends ZendT_Form {
        public function loadElements() {
            $translate = Zend_Registry::get('translate_auth');
            $model = new Auth_Model_TipoUsuario_Table();
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
                $element->setValue('tipo_usuario.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Auth_Model_TipoUsuario_Mapper');
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
                $fields->setLegend($translate->_('tipo_usuario.id') . ':')->setAttrib('id', 'id-fieldset');
            /**
             * Pesquisa na coluna codigo
             */
            
                $element = new ZendT_Form_Element_Hidden('codigofield');
                $element->setBelongsTo('filter[codigo][field]');
                $element->setValue('tipo_usuario.codigo');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('codigomapper');
                $element->setBelongsTo('filter[codigo][mapper]');
                $element->setValue('Auth_Model_TipoUsuario_Mapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('codigoop');
                $element->setBelongsTo('filter[codigo][op]');
                $element->setLabel($translate->_('operacao').':');
                $this->addElement($element);

                $element = $model->getElement('codigo');
                $nameElement = $element->getName();
                $element->setLabel($translate->_('valor').':');
                $element->setBelongsTo('filter[codigo][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'codigoop',$nameElement
                    ),'codigo.codigoop'
                );

                $fields = $this->getDisplayGroup('codigo.codigoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend($translate->_('tipo_usuario.codigo') . ':')->setAttrib('id', 'codigo-fieldset');
            /**
             * Pesquisa na coluna descricao
             */
            
                $element = new ZendT_Form_Element_Hidden('descricaofield');
                $element->setBelongsTo('filter[descricao][field]');
                $element->setValue('tipo_usuario.descricao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('descricaomapper');
                $element->setBelongsTo('filter[descricao][mapper]');
                $element->setValue('Auth_Model_TipoUsuario_Mapper');
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
                $fields->setLegend($translate->_('tipo_usuario.descricao') . ':')->setAttrib('id', 'descricao-fieldset');
        }
    }
?>