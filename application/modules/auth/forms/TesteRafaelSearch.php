<?php
    class Auth_Form_TesteRafaelSearch extends ZendT_Form {
        public function loadElements() {
            $model = new Auth_Model_TesteRafael();
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
                $element->setValue('teste_rafael.id');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('idmapper');
                $element->setBelongsTo('filter[id][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('idop');
                $element->setBelongsTo('filter[id][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('id');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[id][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'idop',$nameElement
                    ),'id.idop'
                );

                $fields = $this->getDisplayGroup('id.idop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('id:')->setAttrib('id', 'id-fieldset');
                
            /**
             * Pesquisa na coluna nome
             */
            
                $element = new ZendT_Form_Element_Hidden('nomefield');
                $element->setBelongsTo('filter[nome][field]');
                $element->setValue('teste_rafael.nome');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('nomemapper');
                $element->setBelongsTo('filter[nome][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('nomeop');
                $element->setBelongsTo('filter[nome][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('nome');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[nome][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'nomeop',$nameElement
                    ),'nome.nomeop'
                );

                $fields = $this->getDisplayGroup('nome.nomeop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('nome:')->setAttrib('id', 'nome-fieldset');
                
            /**
             * Pesquisa na coluna dt_emissao
             */
            
                $element = new ZendT_Form_Element_Hidden('dt_emissaofield');
                $element->setBelongsTo('filter[dt_emissao][field]');
                $element->setValue('teste_rafael.dt_emissao');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('dt_emissaomapper');
                $element->setBelongsTo('filter[dt_emissao][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('dt_emissaoop');
                $element->setBelongsTo('filter[dt_emissao][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('dt_emissao');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[dt_emissao][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'dt_emissaoop',$nameElement
                    ),'dt_emissao.dt_emissaoop'
                );

                $fields = $this->getDisplayGroup('dt_emissao.dt_emissaoop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('dt_emissao:')->setAttrib('id', 'dt_emissao-fieldset');
                
            /**
             * Pesquisa na coluna dh_inc
             */
            
                $element = new ZendT_Form_Element_Hidden('dh_incfield');
                $element->setBelongsTo('filter[dh_inc][field]');
                $element->setValue('teste_rafael.dh_inc');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('dh_incmapper');
                $element->setBelongsTo('filter[dh_inc][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('dh_incop');
                $element->setBelongsTo('filter[dh_inc][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('dh_inc');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[dh_inc][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'dh_incop',$nameElement
                    ),'dh_inc.dh_incop'
                );

                $fields = $this->getDisplayGroup('dh_inc.dh_incop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('dh_inc:')->setAttrib('id', 'dh_inc-fieldset');
                
            /**
             * Pesquisa na coluna valor
             */
            
                $element = new ZendT_Form_Element_Hidden('valorfield');
                $element->setBelongsTo('filter[valor][field]');
                $element->setValue('teste_rafael.valor');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('valormapper');
                $element->setBelongsTo('filter[valor][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('valorop');
                $element->setBelongsTo('filter[valor][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('valor');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[valor][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'valorop',$nameElement
                    ),'valor.valorop'
                );

                $fields = $this->getDisplayGroup('valor.valorop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('valor:')->setAttrib('id', 'valor-fieldset');
                
            /**
             * Pesquisa na coluna aliq
             */
            
                $element = new ZendT_Form_Element_Hidden('aliqfield');
                $element->setBelongsTo('filter[aliq][field]');
                $element->setValue('teste_rafael.aliq');
                $this->addElement($element);

                $element = new ZendT_Form_Element_Hidden('aliqmapper');
                $element->setBelongsTo('filter[aliq][mapper]');
                $element->setValue('Auth_Model_TesteRafaelMapper');
                $this->addElement($element);

                $element = new ZendT_Form_Element_SelectSqlOperation('aliqop');
                $element->setBelongsTo('filter[aliq][op]');
                $element->setLabel('Operação:');
                $this->addElement($element);

                $element = $model->getElement('aliq');
                $nameElement = $element->getName();
                $element->setLabel('Valor:');
                $element->setBelongsTo('filter[aliq][value]');
                $this->addElement($element);


                $this->addDisplayGroup(
                    array (
                        'aliqop',$nameElement
                    ),'aliq.aliqop'
                );

                $fields = $this->getDisplayGroup('aliq.aliqop');
                $fields->addDecorator('Fieldset');
                $fields->setLegend('aliq:')->setAttrib('id', 'aliq-fieldset');
                
        }
    }
?>