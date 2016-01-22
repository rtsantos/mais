<?php

class ZendT_Form_Decorator_Password extends ZendT_Form_Decorator_Default {

    protected $_style = array();
    
    protected $_format = '<div id="group-%1$s" class="form-group">
                                    <label for="%1$s">%2$s</label><br />
                                    <input name="%3$s" type="password" value="%4$s" class="%5$s %6$s" %7$s/>
                                    <div style="clear:both"></div>
                                </div>';
}