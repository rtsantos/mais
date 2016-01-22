<?php

    /**
     * 
     * @category    ZendT
     * @author      preis
     */

    /**
     * jQuery para geração do Query
     *
     */
    class ZendT_View_Helper_Query extends ZendX_JQuery_View_Helper_UiWidget {

        public function query($id, $value = null, array $attribs = array()) {
            $_mapperView = $attribs['mapperView'];
            if (!$_mapperView instanceof ZendT_Db_View) {
                $_mapperView = new $_mapperView();
            }

            $columns = $_mapperView->getColumns()->toQuery();

            $_parse = new ZendT_Db_Adapter_ParseSQL();
            $command = $_parse->toArray($value);

            $param = array();
            $param['jsonElement'] = $command;
            $param['columns'] = $columns;
            $param['mapper'] = get_class($_mapperView);
            $param['urlQuote'] = ZendT_Url::getUri(true) . '/quote';

            $urlPublic = ZendT_Url::getBaseDiretoryPublic();
            $this->view->headScript()->appendFile($urlPublic . '/scripts/jquery/widget/TQueryBuilder.js');
            $this->view->headLink()->appendStylesheet($urlPublic . '/scripts/jquery/widget/TQueryBuilder/TQueryBuilder.css');
            $js = "jQuery('#$id').TQueryBuilder(" . ZendT_JS_Json::encode($param) . ");";
            $this->jquery->addOnLoad($js);

            return $this->view->formHidden($id, $value, $attribs);
        }

    }

?>
