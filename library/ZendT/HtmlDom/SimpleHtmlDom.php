<?php
require_once 'Extra/SimpleHtmlDom/Simple_html_dom.php';
require_once 'Extra/SimpleHtmlDom/Simple_html_dom_node.php';

class ZendT_HtmlDom_SimpleHtmlDom extends Simple_html_dom {
    /**
        *
        * @param string $selector 
        * @return string
        */
    public function findOne($selector,$prop=''){
        $object = $this->find($selector);
        $value  = false;
        if(count($object)){
            foreach($object as $node){
                $value = $node;
                break;
            }
            if ($prop){
                $value = $value->{$prop};
            }
        }
        return $value;
    }
}
?>
