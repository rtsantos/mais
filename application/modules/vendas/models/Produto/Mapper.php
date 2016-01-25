<?php

   /**
    * Classe de mapeamento do registro da tabela cv_produto
    */
   class Vendas_Model_Produto_Mapper extends Vendas_Model_Produto_Crud_Mapper {

       public function _beforeSave() {
           parent::_beforeSave();

           if ($this->_action == 'insert' && !$this->getCodigo(true)->toPhp()) {
               $_numeracao = new Ca_Model_Numeracao_Mapper();
               $codigo = $_numeracao->proximo(self::$table . '.codigo'
                                             ,$this->getIdEmpresa());
               $this->setCodigo($codigo);
           }
       }

   }

?>