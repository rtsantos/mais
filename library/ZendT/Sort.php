<?php
    /**
     * Classe para ordenação de um array
     *
     * @package ZendT
     * @subpackage SortArray
     * @author rsantos
     */
    class ZendT_Sort {
        /**
         *
         * @param type $array
         * @param type $columnOrder
         * @return type 
         */
        public static function sortArray($array,$columnOrder){
            if (count($array) > 0){
                /**
                * Pega a coluna a ser ordenada 
                */
                $columnsOrder = array();
                foreach($array as $value){
                    $columnsOrder[] = $value[$columnOrder];
                }
                sort($columnsOrder);
                /**
                * Coloca as chaves na ordem 
                */
                $keyOrder = array();
                foreach($columnsOrder as $order){
                    foreach($array as $key=>$value){
                        if ($order == $value[$columnOrder]){
                            $keyOrder[$key] = $key;
                        }
                    }
                }
                /**
                * Monta do array com as chaves ordenadas 
                */
                $dataOrder = array();
                foreach($keyOrder as $key){
                    $dataOrder[$key] = $array[$key];
                }
                /**
                * Retorna o array ordenado 
                */
                return $dataOrder;
            }else{
                return $array;
            }
        }
    }
?>