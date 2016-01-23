<?php

   /**
    * Classe de mapeamento do registro da tabela ca_numeracao
    */
   class Ca_Model_Numeracao_Mapper extends Ca_Model_Numeracao_Crud_Mapper {

       public function proximo($nome) {
           $this->newRow()->setIdEmpresa(Auth_Session_User::getInstance()->getIdEmpresa())
                 ->setNome($nome)
                 ->retrieve();
           if (!$this->getId(true)->toPhp()) {
               $this->setTamanho(10)
                     ->setNumero(0)
                     ->insert();
           }

           $numero = $this->getNumero()->toPhp();
           $numero = $numero + 1;
           $this->setNumero($numero)->update();

           $numero = str_pad($numero, $this->getTamanho(true)->toPhp());

           return $numero;
       }

   }
?>