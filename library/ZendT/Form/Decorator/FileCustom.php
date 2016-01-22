<?php

class ZendT_Form_Decorator_FileCustom extends ZendX_JQuery_Form_Decorator_UiWidgetContainer {

    protected $_style = array();
    protected $_format = '<div id="group-%1$s" class="form-group">
                                    <label for="%1$s">%2$s</label><br />
                                    <input id="%3$s" name="%3$s" type="hidden" />
                                    <input id="%3$s_type" name="%3$s_type" type="hidden" />
                                    <input id="%3$s_name" name="%3$s_name" type="text" readonly="true" value="%4$s" class="width:180px;%5$s %6$s" %7$s/>

<button id="buttonUpload_%1$s" onClick="jQuery(\'#%1$s\').TFile(\'uploadFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Subir arquivo">
<span class="ui-button-icon-primary ui-icon ui-icon-arrowthickstop-1-n"></span>
<span class="ui-button-text"> </span>
</button>

<button id="buttonDownload_%1$s" onClick="jQuery(\'#%1$s\').TFile(\'downloadFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Baixar arquivo">
<span class="ui-button-icon-primary ui-icon ui-icon-arrowthickstop-1-s"></span>
<span class="ui-button-text"> </span>
</button>

<button id="buttonDelete_%1$s" onClick="jQuery(\'#%1$s\').TFile(\'deleteFile\');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" nofocus="true" style="width:35px;height:20px;" type="button" role="button" aria-disabled="false" title="Limpar arquivo">
<span class="ui-button-icon-primary ui-icon ui-icon-trash"></span>
<span class="ui-button-text"> </span>
</button>

                                    <div style="clear:both"></div>
                                </div>';

    /**
     * Convert options to tag attributes
     *
     * @return string
     */
    protected function _htmlAttribs(array $attribs) {
        $xhtml = '';
        foreach ((array) $attribs as $key => $val) {
            $key = htmlspecialchars($key);
            if (is_array($val)) {
                if (array_key_exists('callback', $val)
                        && is_callable($val['callback'])
                ) {
                    $val = call_user_func($val['callback'], $this);
                } else {
                    $val = implode(' ', $val);
                }
            }
            $val = htmlspecialchars($val);
            $xhtml .= $this->_attribsMask($key,$val);
        }
        return $xhtml;
    }

    public function render($content) {
        $element = $this->getElement();
        $name = htmlentities($element->getFullyQualifiedName());
        $label = $element->getLabel();
        $id = htmlentities($element->getId());
        $value = htmlentities($element->getValue());
        $required = $element->isRequired();
        
        $xhtmlAttribs = $this->_htmlAttribs($element->getAttribs());
        
        $urlUpload = $xhtmlAttribs['urlUpload'];
        $urlDownload = $xhtmlAttribs['urlDownload'];
        $urlDelete = $xhtmlAttribs['urlDelete'];
        
        if ($required) {
            $required = ' required ';
        }
        $css = '';

        $markup = sprintf($this->_format, 
                          $id, 
                          $label, 
                          $name, 
                          $value, 
                          $css, 
                          $required, 
                          $xhtmlAttribs.' style="'.$this->_style['default'].'"');
        return $markup;
    }

    private function _attribsMask($key, $value, $elemento = 'default') {
        if (substr($key, 0, 4) == 'css-') {
            $this->_style[$elemento].= '' . substr($key, 4) . ':' . $value . ';';
        } else {
            $retorno = ' ' . $key . '="' . $value . '" ';
        }
        return $retorno;
    }

}