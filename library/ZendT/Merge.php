<?php
    /**
     * Classe criada para juntar conteúdo de dois arquivos
     * 
     * A criação dela 
     *  
     */
    class ZendT_Merge{
        /**
         * Avalia se o valor está contido dentro o array de dados informado
         * 
         * @param string $value
         * @param array $arrayData
         * @param int $indexStart
         * @return int 
         */
        public static function exists($value, $arrayData, $indexStart=null){
            $index = -1;
            if ($indexStart == null)
                $indexStart = 0;
            
            for($i=$indexStart; $i<count($arrayData); $i++){
                if (rtrim(ltrim($value)) == rtrim(ltrim($arrayData[$i]))){
                    $index = $i;
                    break;
                }
            }
            return $index;
        }
        /**
         * Junta os dados das duas variáveis, retornado a mesma
         * @example merge(array('a','c'),array('b'));
         * @example merge("a\nc\n"),"b\nd\n");
         * 
         * @param string|array $a
         * @param string|array $b
         * @return string|array
         */
        public function merge($a,$b){
            $returnString = false;
            if (is_string($a)){
                $a = explode("\n", $a);
                $returnString = true;
            }
            if (is_string($b)){
                $b = explode("\n", $b);
                $returnString = true;
            }
            $merge = array();
            foreach ($a as $index=>$value){
                if (rtrim(ltrim($value)) == rtrim(ltrim($b[$index]))){
                    $merge[] = $b[$index];
                    $lastIndexB = $index;
                }else{
                    $indexB = ZendT_Merge::exists($value, $b, ($lastIndexB+1));
                    if ($indexB == -1){
                        $merge[] = $value;
                    }else{
                        for($indexB=($lastIndexB+1);$indexB<count($b);$indexB++){
                            $indexExists = ZendT_Merge::exists($b[$indexB], $a, ($index+1));
                            if (rtrim(ltrim($value)) == rtrim(ltrim($b[$indexB]))){
                                break;
                            }
                            if ($indexExists == -1){
                                $merge[] = $b[$indexB];
                                $lastIndexB = $indexB;                                
                            }
                        }
                    }
                }
            }
            if (ZendT_Merge::exists($value, $merge) == -1){
                $merge[] = $value;
            }
            if ($returnString){
                return implode("\n", $merge);
            }else{
                return $merge;
            }
        }
    }
?>
