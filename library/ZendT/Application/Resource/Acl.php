<?php
/**
 * @see Zend_Application_Resource_ResourceAbstract
 */
require_once 'Zend/Application/Resource/ResourceAbstract.php';
require_once 'ZendT/Acl.php';
/**
 * Resource for setting up Acl and default adapter
 *
 * @uses       Zend_Application_Resource_ResourceAbstract
 * @category   ZendT
 * @package    ZendT_Application
 * @subpackage Resource
 */
class ZendT_Application_Resource_Acl extends Zend_Application_Resource_ResourceAbstract{

    /**
     * @var array
     */
    private $_defaultOptions = null;
    /**
     * Inicializa a classe
     * @return type 
     */
    public function init() {
        return $this->configAcl();
    }
    /**
     * Configura as opções do ACL
     * 
     * @return array|null
     */
    public function configAcl()
    {
        if (null === $this->_defaultOptions) {
            $this->_defaultOptions = $this->getOptions();
            ZendT_Acl::setOptions($this->_defaultOptions);
        }

        return $this->_defaultOptions;
    }
}
