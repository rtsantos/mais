<?php
/**
 * ZFDoctrine
 *
 * LICENSE
 *
 */
/**
 * Doctrine Tool Provider
 *
 * @author Benjamin Eberlei (kontakt@beberlei.de)
 */
class ZendT_Tool_Manifest implements Zend_Tool_Framework_Manifest_ProviderManifestable{
    public function getProviders(){
        return array(
            new ZendT_Tool_ModelTProvider(),
            new ZendT_Tool_CrudTProvider()
        );
    }
}