<?php

   /**
    * Classe de mapeamento da tabela fr_veiculo
    */
   class Frota_Model_Veiculo_Table extends Frota_Model_Veiculo_Crud_Table {

       public function getWhereSeekerSearch($value, $field = '') {
           $where = new ZendT_Db_Where('AND');
           $result = array();
           $result['column'] = '';
           $result['operation'] = '';
           $result['mapper'] = $this->getMapperName();

           if (count($this->_primary) == 1) {
               if (is_numeric($value)) {
                   $result['column'] = $this->_name . "." . $this->_primary[0];
                   $result['operation'] = '=';
               }
           }
           
           if ($result['column'] == '') {
               $result['column'] = $this->_name . "." . $this->_search;
               $result['operation'] = '=';
               
               $idEmpresa = Auth_Session_User::getInstance()->getIdEmpresa();
               
               $_veiculo = new Frota_Model_Veiculo_Mapper();
               $_veiculo->setPlaca($value)
                        ->setIdEmpresa($idEmpresa);
               
               if (!$_veiculo->exists()){
                   $_veiculo->setPlaca($value)
                            ->setDescricao($_veiculo->getPlaca())
                            ->setIdEmpresa($idEmpresa)
                            ->insert();
               }
           }
           
           if ($value) {
               $where->addFilter($result['column']
                     , $value
                     , $result['operation']
                     , $result['mapper']);
           }
           
           return $where;
       }

   }

?>