<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para criação de um campo Text 
     *
     */
    class ZendT_View_Helper_Printer extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         *  Cria um campo texto
         *
         * @param  string $id
         * @param  string $value
         * @param  array  $params jQuery Widget Parameters
         * @param  array  $attribs HTML Element Attributes
         * @return string
         */
        public function printer($id, $value = null, array $attribs = array()) {
            $_printer = new ZendT_View_Printer($id);
            
            $_printer->setServerPrinters($attribs['serverPrinters']);
            unset($attribs['serverPrinters']);
            
            $_printer->setFilter($attribs['filter']);
            unset($attribs['filter']);
            
            foreach ($attribs as $name => $value) {
                $_printer->setAttr($name, $value);
            }
            return $_printer->render();
        }

    }