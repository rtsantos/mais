<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicesDirectory
 *
 * @author rsantos
 */
class ZendT_Tool_Context_ServicesDirectory  extends Zend_Tool_Project_Context_Filesystem_Directory {
    /**
     * @var string
     */
    protected $_filesystemName = 'services';

    /**
     * @return string
     */
    public function getName()
    {
        return 'ServicesDirectory';
    }
}

?>
