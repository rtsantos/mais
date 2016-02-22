<?php

   /**
    * Classe de mapeamento do registro da tabela cv_vistoria
    */
   class Vendas_Model_Vistoria_Mapper extends Vendas_Model_Vistoria_Crud_Mapper {

       public function setLaudo($value, $options = array()) {
           $options+= array('prop_docto_name' => 'VISTORIA_LAUDO');
           $this->_data['laudo'] = $this->_setFileSystem($value, $options);
           return $this;
       }

   }

?>