<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para validação de email
     *
     */
    class ZendT_View_Helper_SubmitAjax extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria um campo texto com validador de email
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function submitAjax($id, $value = null, array $params = array(), array $attribs = array()) {
            $attribs = $this->_prepareAttributes($id, $value, $attribs);

            $params = ZendX_JQuery::encodeJson($params);

            $js = sprintf('%s("#%s").click(function(){
                        var formFields = $(".required");
                        var requiredNull = "";
                        if(formFields.length > 1){
                            for(i=0;i<formFields.length;i++){
                                if(formFields[i].value == ""){
                                    requiredNull = $("label[for=\'"+formFields[i].id+"\']").text();
                                }
                            }
                        }else{
                            if(formFields.val() == ""){
                                requiredNull = $("label[for=\'"+formFields.attr(\'id\')+"\']").text();
                            }   
                        }
                        if(requiredNull != ""){
                            alert("O campo "+requiredNull+" é obrigatório");
                        }
                        //$("form").submit();
                     });', ZendX_JQuery_View_Helper_JQuery::getJQueryHandler(), $attribs['id'], $params);

            #$js = sprintf('%s("#%s").TEmail(%s);', ZendX_JQuery_View_Helper_JQuery::getJQueryHandler(), $attribs['id'], $params);

            $this->jquery->addOnLoad($js);

            return $this->view->formText($id, $value, $attribs);
        }

    }
    