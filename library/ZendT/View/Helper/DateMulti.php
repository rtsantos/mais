<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação do Date
     *
     */
    class ZendT_View_Helper_DateMulti extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto com validador de data e datepicker
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function dateMulti($id, $value = null, array $attribs = array()) {
            $data = date('dmy');
            #$this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TCursor.js?'.$data);
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TDateMulti.js?' . $data);

            $this->jquery->addOnLoad('jQuery("#' . $id . '").TDateMulti();');

            #$button = new ZendT_View_Button('bt-calend-'.$id,'');
            #$button->setIcon('ui-icon-calculator');
            $attribs['style'].= ';float:left;';
                    
            $_toolbar = new ZendT_View_Toolbar('calend-toolbar-' . $id);
            $_toolbar->addStyle('width', '390px');
            $_toolbar->addStyle('height', '34px');
            $_toolbar->addStyle('display', 'none');
            $_toolbar->setAttr('align', 'center');
            
            $padrao = explode(' ', $value);
            
            $hoje = new ZendT_Type_Date('SYSDATE', 'Date');
            $ultimoMes[0] = clone $hoje;
            $ultimoMes[0]->addMonth(-1)->firstDayMonth();
            $ultimoMes[1] = clone $hoje;
            $ultimoMes[1]->addMonth(-1)->lastDayMonth();
            
            $mesCorrente[0] = clone $hoje;
            $mesCorrente[0]->firstDayMonth();
            $mesCorrente[1] = clone $hoje;
            $mesCorrente[1]->lastDayMonth();

            $ultimaSemana[0] = clone $hoje;
            $ultimaSemana[0]->addWeek(-1)->firstDayWeek();
            $ultimaSemana[1] = clone $hoje;
            $ultimaSemana[1]->addWeek(-1)->lastDayWeek();
            
            $semanaCorrente[0] = clone $hoje;
            $semanaCorrente[0]->firstDayWeek();
            $semanaCorrente[1] = clone $hoje;
            $semanaCorrente[1]->lastDayWeek();

            $options = "var option = jQuery('#calend_select_".$id."').val();

                        if(option != ''){
                            var data1 = '', data2 = '';
                            if(option == '0'){
                                data1 = '".$padrao[0]."';
                                data2 = '".$padrao[1]."';
                            }
                            else if(option == '1'){
                                data1 = '".$hoje."';
                                data2 = '".$hoje."';
                            } else if(option == 2){
                                data1 = '".$ultimoMes[0]."';
                                data2 = '".$ultimoMes[1]."';
                            } else if(option == 3){
                                data1 = '".$mesCorrente[0]."';
                                data2 = '".$mesCorrente[1]."';
                            } else if(option == 4){
                                data1 = '".$ultimaSemana[0]."';
                                data2 = '".$ultimaSemana[1]."';
                            } else if(option == 5){
                                data1 = '".$semanaCorrente[0]."';
                                data2 = '".$semanaCorrente[1]."';
                            }
                            jQuery('#calend-". $id ."-1').datepicker('setDate', data1);
                            jQuery('#calend-". $id ."-2').datepicker('setDate', data2);

                            jQuery('#".$id."').val(
                                jQuery('#calend-". $id ."-1').datepicker({ dateFormat: 'yy-mm-dd' }).val() + ' ' +
                                jQuery('#calend-". $id ."-2').datepicker({ dateFormat: 'yy-mm-dd' }).val()
                            );
                        }
                        ";

            $close = "  jQuery('#calend-".$id."-1').hide('fast');
                        jQuery('#calend-".$id."-2').hide('fast');
                        jQuery('#calend-toolbar-".$id."').hide('fast');";

            $element = new ZendT_Form_Element_Select("calend_select_" . $id);
            #$element->setLabel('Seleção');
            $element->addMultiOption('', '');
            $element->addMultiOption('1', 'Hoje');
            $element->addMultiOption('2', 'Último Mês');
            $element->addMultiOption('3', 'Mês corrente');
            $element->addMultiOption('4', 'Última Semana');
            $element->addMultiOption('5', 'Semana corrente');
            $element->addAttr('breakline', 'none');
            $element->setAttrib('onClick', $options);
            $element->addStyle('float', 'left');
            $element->addStyle('height', '25px');
            $element->addStyle('margin', '3px');
            $_toolbar->add($element);
            
            $_button = new ZendT_View_Button('bt_ok' . $id, 'OK', $close);
            $_button->setIcon('ui-icon-check');
            $_button->addStyle('float', 'right');
            $_button->addStyle('height', '25px');
            $_button->addStyle('margin', '3px');
            $_toolbar->addButton($_button);
            
            return $this->view->formText($id, $value, $attribs)
                    . '<span id="bt-calend-' . $id . '" style="margem:0px; float:left; height: 18px; width: 20px;" class="ui-button ui-state-default ui-corner-right ui-button-icon-only"><span id="icon-bt-calend-' . $id . '" class="ui-button-icon-primary ui-icon ui-icon-calculator"></span></span>'
                    . '<br style="clear:both;" /><table><tr><td><div id="calend-' . $id . '-1" style="display:none"></div></td><td><div id="calend-' . $id . '-2" style="display:none"></div></td></tr></table>'
                    . $_toolbar->render()
                    . '<label class="error" for="dt_emissao_ctrc" generated="true" style="display:none"></label>'
                    . '<div id="hour-' . $id . '" style="display:none"></div>';
        }

    }

    