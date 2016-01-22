<?php

    /**
     * Classe tem como finalidade renderizar um Html com a mensagem de erro  
     * de uma exceção, formatando a mansagem conforme tipo.
     * 
     * @package ZendT
     * @subpackage View
     * @author rsantos 
     */
    class ZendT_View_Helper_Exception extends ZendX_JQuery_View_Helper_UiWidget {

        /**
         * Formata mensagem gerada no exception conforme tema do jQueryUI
         * 
         * @param ZendT_Exception $exception
         * @return string 
         */
        public function exception($exception, $type = 'Alert', $id='') {
            if (!$exception instanceof ZendT_Exception) {
                $class = 'ZendT_Exception_' . $type;
                $exception = new $class($exception);
            }
            $notification = $exception->getNotification();

            if (in_array($notification, array('Alert', 'AlertTarja', 'Business', 'Confirm', 'Information'))) {
                $icon = 'ui-icon-info';
                $state = 'ui-state-highlight';
            } else if (in_array($notification, array('Ok'))) {
                $icon = 'ui-icon-check';
                $state = 'ui-state-highlight';
            } else {
                $icon = 'ui-icon-alert';
                $state = 'ui-state-error';
            }

            if ($id){
                $id = 'id="'.$id.'" ';
            }
            $html = '
            <div '.$id.'class="' . $state . ' ui-corner-all" style="margin-top: 20px; padding: 10px;">
                <p>
                    <span class="ui-icon ' . $icon . '" style="float: left; margin-right: .3em;"></span>
                    <strong style="padding-right: 10px;">' . $notification . '</strong>
                    ' . $exception->getMessage() . '
                </p>
            </div>                
            ';
            return $html;
        }

    }

?>
