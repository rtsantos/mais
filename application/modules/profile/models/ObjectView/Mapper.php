<?php

   /**
    * Classe de mapeamento do registro da tabela profile_object_view
    */
   class Profile_Model_ObjectView_Mapper extends Profile_Model_ObjectView_Crud_Mapper {

       /**
        * Seta o valor da coluna config
        *
        * @param string $value
        * @return Profile_Model_ObjectView_Crud_Mapper
        */
       public function setConfig($value, $options = array('required' => true)) {

           $this->_data['config'] = new ZendT_Type_Clob($value, array('noFilter' => true));
           if ($options['db'])
               $this->_data['config']->setValueFromDb($value);

           if (!$options['db']) {
               
           }
           return $this;
       }

       public function getIdPapelInformatica() {
           $_papel = new Auth_Model_Papel_Mapper();
           $_papel->newRow()->setNome("TA.INFORMATICA")->retrieve();
           return $_papel->getId();
       }

       public function getCountPrivilege($id, $exceptInfo = false) {
           $count = 0;
           $_objectViewPriv = new Profile_DataView_ObjectViewPriv_MapperView();
           $_where = new ZendT_Db_Where();
           $_where->addFilter('id_profile_object_view', $id, "=");
           $_objectViewPriv->findAll($_where, '*');
           $idInfo = $this->getIdPapelInformatica();
           while ($_objectViewPriv->fetch()) {
               $count ++;
               if ($exceptInfo && $_objectViewPriv->getIdPapel() == $idInfo) {
                   $existsInfo ++;
               }
           }
           if ($existsInfo == $count) {
               $count = 0;
           }
           return $count;
       }

       public function setDefaultPrivilege($id, $idCopyFrom = '') {
           if ($id) {
               $_objectViewPriv = new Profile_DataView_ObjectViewPriv_MapperView();
               if (!$idCopyFrom) {
                   $idInfo = $this->getIdPapelInformatica();
                   if ($idInfo) {
                       $_objectViewPriv->setIdProfileObjectView($id)->setIdPapel($idInfo)->setTipo("O")->insert();
                       return true;
                   }
               } else {
                   $_where = new ZendT_Db_Where();
                   $_where->addFilter("id_profile_object_view", $idCopyFrom);
                   $_objectViewPriv->findAll($_where, "*");
                   while ($_objectViewPriv->fetch()) {
                       $_objectViewPriv->setIdProfileObjectView($id)->insert();
                   }
               }
           }
           return false;
       }

   }

?>