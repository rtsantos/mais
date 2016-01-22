<?php

    /**
     * Zend Framework
     *
     * LICENSE
     *
     * This source file is subject to the new BSD license that is bundled
     * with this package in the file LICENSE.txt.
     * It is also available through the world-wide-web at this URL:
     * http://framework.zend.com/license/new-bsd
     * If you did not receive a copy of the license and are unable to
     * obtain it through the world-wide-web, please send an email
     * to license@zend.com so we can send you a copy immediately.
     *
     * @category   Zend
     * @package    Zend_View
     * @subpackage Helper
     * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
     * @version    $Id: Placeholder.php 23775 2011-03-01 17:25:24Z ralph $
     * @license    http://framework.zend.com/license/new-bsd     New BSD License
     */
    /** Zend_View_Helper_Placeholder_Registry */
    require_once 'Zend/View/Helper/Placeholder/Registry.php';

    /** Zend_View_Helper_Abstract.php */
    require_once 'Zend/View/Helper/Abstract.php';

    /**
     * Helper for passing data between otherwise segregated Views. It's called
     * Placeholder to make its typical usage obvious, but can be used just as easily
     * for non-Placeholder things. That said, the support for this is only
     * guaranteed to effect subsequently rendered templates, and of course Layouts.
     *
     * @package    Zend_View
     * @subpackage Helper
     * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
     * @license    http://framework.zend.com/license/new-bsd     New BSD License
     */
    class ZendT_View_Helper_Hotkeys extends Zend_View_Helper_Abstract {

        /**
         * Hotkeys helper
         *
         * @param  string $name
         * @return ZendT_View_Helper_Hotkeys_Container
         */
        public function hotkeys() {
            return ZendT_View_Helper_Hotkeys_Container::getInstance();
        }

    }

    