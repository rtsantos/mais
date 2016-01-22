<?php

    /**
     * Cria a opção de profile, usado em Formulários e Grids
     * 
     * @package ZendT
     * @subpackage Profile
     * @category View
     *  
     */
    class ZendT_View_Profile extends ZendT_View_Html {

        /**
         * Construtor da classe de criação de Toolbar
         *
         * @param string $name Identificação da Toolbar
         * @param array $attribs 
         */
        public function __construct($name, $value, $options, $type, $object) {
            $this->_name = $name;
            $this->_value = $value;
            $this->_options = $options;
            $this->_type = $type;
            $this->_object = $object;
        }

        /**
         * Renderiza o objeto para uma string html
         */
        public function render(&$profileName = '') {


            $name = '';
            $itens = '';            
            foreach ($this->_options as $value => $config) {
                $class = '';
                if ($value == $this->_value) {
                    $name = $config['nome'];
                    $class='focus';
                }
                $itens.= '<li onclick="setProfile(this.value,\'' . $this->_object . '\');" value = "' . $value . '" class="link '.$class.'">' . $config['nome'] . '</li>';
            }

            if (ZendT_Acl::getInstance()->isAllowed('object-view', 'profile')) {

                $urlAdmin = ZendT_Url::getBaseUrl() . '/profile/object-view/list-config/objeto/' . $this->_object . '/tipo/' . $this->_type . '/id/' . $this->_value;

                $itens.= '<li role = "separator" class = "divider"></li>';
                $itens.= '<li>';
                $itens.= '   <a href="' . $urlAdmin . '" target="_new" class="ui-helper-clearfix">';
                $itens.= '      ' . _i18n('Administrar');
                $itens.= '   </a>';
                $itens.= '</li>';
            }

            if ($name) {
                $profileName = $name;
            }

            $xhtml = '<div style="height: 30px; float:left;" class="default ui-button ui-no-radius-bottom " id="title-profile-' . $this->_name . '">';            
            $xhtml.= '   <span class="ui-icon ui-icon-transfer-e-w" />';
            $xhtml.= '   <ul role="title-profile-' . $this->_name . '" align="left" class="dropdown-menu position ui-helper-clearfix ui-no-radius-tr">';
            $xhtml.= $itens;
            $xhtml.= '   </ul>';
            $xhtml.= '</div>';

            return $xhtml;
        }

    }
    