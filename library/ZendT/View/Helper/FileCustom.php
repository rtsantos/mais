<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery ativação do seeker
     *
     */
    class ZendT_View_Helper_FileCustom extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Cria cria um campo hidden, um campo para id, um para descrição e um botão para a busca no seeker.
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function fileCustom($id, $value = null, array $attribs = array()) {
            $params = $attribs['jQueryParams'];
            unset($attribs['jQueryParams']);

            if (!isset($attribs['name'])) {
                $attribs['name'] = $attribs['id'];
            }

            $attribs['style'].= 'width:180px;';
            $attribs['readonly'] = 'true';
            $name = $attribs['name'];

            $xhtml = '<input type="text"'
                    . ' name="' . $this->view->escape($name) . '_name"'
                    . ' id="' . $this->view->escape($id) . '_name"'
                    . ' value="' . $this->view->escape($value) . '"'
                    . $this->_htmlAttribs($attribs)
                    . $this->getClosingBracket();

            $xhtml = '
            <input id="' . $id . '" name="' . $attribs['name'] . '" type="hidden" />
            <input id="' . $id . '_type" name="' . $attribs['name'] . '_type" type="hidden" />
            ' . $xhtml . '
            <button id="buttonUpload_' . $id . '" onClick="jQuery(\'#' . $id . '\').TFile(\'uploadFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Subir arquivo">
            <span class="ui-button-icon-primary ui-icon ui-icon-arrowthickstop-1-n"></span>
            <span class="ui-button-text"> </span>
            </button>
            <button id="buttonDownload_' . $id . '" onClick="jQuery(\'#' . $id . '\').TFile(\'downloadFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Baixar arquivo">
            <span class="ui-button-icon-primary ui-icon ui-icon-arrowthickstop-1-s"></span>
            <span class="ui-button-text"> </span>
            </button>
            <button id="buttonDelete_' . $id . '" onClick="jQuery(\'#' . $id . '\').TFile(\'deleteFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Limpar arquivo">
            <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span>
            <span class="ui-button-text"> </span>
            </button>
        ';

            $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/widget/TFile.js?date=' . date('dmy'));
            $this->jquery->addOnLoad('jQuery("#' . $id . '").TFile(' . $params . ');');
            return $xhtml;
        }

    }