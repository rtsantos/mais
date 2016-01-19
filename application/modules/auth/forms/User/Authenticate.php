<?php

    class Auth_Form_User_Authenticate extends ZendT_Form {

        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements() {
            $this->setName('frm_auth');
            $this->setAction(ZendT_Url::getBaseUrl() . '/auth/user/authenticate');


            $_elements = new Auth_Form_Usuario_Elements();

            $element = $_elements->getLogin();
            $element->setLabel(_i18n('E-Mail'));
            $element->setRequired(true);
            $this->addElement($element);

            $element = $_elements->getSenha();
            $element->setRequired(true);
            $this->addElement($element);

            $element = new ZendT_Form_Element_Button('btn_auth');
            $element->setIcon('ui-icon-check');
            $element->setLabel(_i18n('Autenticar'));
            $element->setAttrib('onClick', 'jQuery.AjaxT.submitJson({selector: \'#frm_auth\', success: function(result){console.log(result);}})');
            $this->addElement($element);
        }

    }
    