<?php

/**
 * 
 * @category    ZendT
 * @author      tesilva
 */
class ZendT_View_Helper_SpreadSheet extends ZendX_JQuery_View_Helper_UiWidget {

    public function spreadSheet($id, $value = null, array $attribs = array()) {

        #var_dump($attribs);die;
        $params = $attribs['jQueryParams'];
        #var_dump($params);die;
        unset($attribs['jQueryParams']);

        $xhtml = "<div id='{$id}'";
        if ($attribs['divParams']) {
            foreach ($attribs['divParams'] as $key => $val) {
                $xhtml .= " {$key}='{$val}'";
            }
        }
        $xhtml .= "><input type=\"hidden\" TSpreadSheet=\"1\" id=\"{$id}_json\" name=\"{$id}\" /></div>";

        $params['elements']['id'] = $id;

        $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/handsontable-master/dist/handsontable.full.js?');
        $this->view->headLink()->appendStylesheet(ZendT_Url::getBaseDiretoryPublic() . '/scripts/jquery/extra/handsontable-master/dist/handsontable.full.css');
        $this->view->headScript()->appendFile(ZendT_Url::getBaseDiretoryPublic() . "/scripts/jquery/widget/TSpreadSheet.js?date=" . strtotime("now"));

        $this->jquery->addOnLoad('jQuery("#' . $id . '").TSpreadSheet(' . ZendT_JS_Json::encode($params) . ');');
        return $xhtml;
    }

}
