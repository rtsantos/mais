<?php

    /**
     * Helper para habilitar o menu de opções em um elemento com o botão direito
     * do mouse.
     * 
     * @package ZendT
     * @subpackage View
     * @category Helper
     * @author rsantos
     */
    class ZendT_View_Helper_ContextMenu extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo horas, com validador de horarios e opção de selecionar uma hora via Autcomplete
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         * 
         * @example $this->contextMenu('contentMenu','#columnSelected',array('delete'=>'Delete','add'=>'Add'),"function(action, el, pos){alert(action)}")
         */
        public function contextMenu($id, $selector = null, array $itens = array(), $eventFunc = null) {
            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/context-menu/jquery.contextMenu.js');
            $this->view->headLink()->appendStylesheet(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/context-menu/jquery.contextMenu.css');

            $handle = ZendX_JQuery_View_Helper_JQuery::getJQueryHandler();

            if ($eventFunc == null) {
                $eventFunc = "
                function(action, el, pos){
                    var cmd = action + '(el, pos);';
                    eval(cmd);
                }
            ";
            }

            $js = " 
            {$handle}('{$selector}').contextMenu(
                { menu: '{$id}' },
                {$eventFunc}
            );
        ";

            $this->jquery->addOnLoad($js);

            $xhtml = '<ul id="' . $id . '" class="contextMenu">' . "\n";
            foreach ($itens as $key => $param) {
                if (is_array($param)) {
                    $xhtml.= '  <li class="' . $param['class'] . '"><a href="#' . $param['value'] . '">' . $param['label'] . '</a></li>' . "\n";
                } else {
                    $xhtml.= '  <li class="separator"><a href="#' . $key . '">' . $param . '</a></li>' . "\n";
                }
            }
            $xhtml.= '</ul>' . "\n";

            return $xhtml;
        }

    }