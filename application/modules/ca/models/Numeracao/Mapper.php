<?php

   /**
    * Classe de mapeamento do registro da tabela ca_numeracao
    */
   class Ca_Model_Numeracao_Mapper extends Ca_Model_Numeracao_Crud_Mapper {

       public function proximo($nome, $idEmpresa=false) {
           if (!$idEmpresa){
               $idEmpresa = Auth_Session_User::getInstance()->getIdEmpresa();
           }
           $this->newRow()->setIdEmpresa($idEmpresa)
                 ->setNome($nome)
                 ->retrieve();
           if (!$this->getId(true)->toPhp()) {
               $this->setIdEmpresa($idEmpresa)
                    ->setNome($nome)
                    ->setTamanho(10)
                    ->setNumero(0)
                    ->insert();
           }

           $numero = $this->getNumero()->toPhp();
           $numero = $numero + 1;
           $this->setNumero($numero)->update();

           $numero = str_pad($numero, $this->getTamanho(true)->toPhp(), '0', STR_PAD_LEFT);

           return $numero;
       }

   }
?>