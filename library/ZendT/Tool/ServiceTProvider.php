<?php
/**
 * ZendT Tool Provider
 *
 * @author rsantos
 */
class ZendT_Tool_ServiceTProvider extends Zend_Tool_Project_Provider_Abstract
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     * @return array
     */
    public function getContextClasses()
    {
        return array(
            'ZendT_Tool_Context_ServicesDirectory'
        );
    }
    /**
     *
     * @return void
     * @throws Zend_Tool_Project_Exception
     * @throws Exception 
     */
    public function enable()
    {
        $profile = $this->_loadProfileRequired();

        $a = new ZendT_Tool_Context_ServicesDirectory();
        $applicationConfigResource = $profile->search('ApplicationConfigFile');

        if (!$applicationConfigResource) {
            throw new Zend_Tool_Project_Exception('A project with an application config file is required to use this provider.');
        }
        $configsDirectory = $profile->search(array('configsDirectory'));

        if ($configsDirectory == null) {
            throw new Exception("No Config directory in Zend Tool Project.");
        }
        
        $globalResources = array('ServicesDirectory');
        $changes = false;
        foreach ($globalResources AS $resourceName) {
            $this->_print($resourceName);
            if (!$profile->search(array('configsDirectory', $resourceName))) {
                if ($this->_registry->getRequest()->isPretend()) {
                    $this->_print("Would add ".$resourceName." to the application config directory.");
                } else {
                    $resource = $configsDirectory->createResource($resourceName);
                    if (!$resource->exists()) {
                        $resource->create();
                        $this->_print('Created Resource: '.$resourceName, array('color' => 'green'));
                    } else {
                        $this->_print('Registered Resource: '.$resourceName, array('color' => 'green'));
                    }
                    $changes = true;
                }
            }
        }

        if ($changes) {
            $profile->storeToFile();
        }
    }
    /**
     * @param string $line
     * @param array $decoratorOptions
     */
    protected function _print($line, array $decoratorOptions = array())
    {
        $this->_registry->getResponse()->appendContent("[ZendT] " . $line, $decoratorOptions);
    }
}