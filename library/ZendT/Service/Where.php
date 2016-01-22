<?php

/*
 * Essa classe tem como finalidade passar o filtro
 * a ser realizada na busca de dados no serviço
 * 
 * @package ZendT
 * @subpackage Service
 * @author rsantos
 */

class ZendT_Service_Where {

    /**
     * Nome da coluna a ser pesquisada
     * 
     * @var string
     */
    public $field;
    /**
     * Operação de pesquisa 
     * Exemplo "=",">","<","!=","?%","!?%","%?%","!%?%"
     * 
     * @var string @example "=",">","<","!=","?%","!?%","%?%","!%?%"
     */
    public $operation;
    /**
     * Valores para pesquisa
     * 
     * @var ZendT_Service_Value[] 
     */
    public $values;
    /**
     * Apenas um valor para a pesquisa, se haver mais valores utilizar o "values"
     * 
     * @var string
     */
    public $value;
    /**
     *
     * @var string
     */
    public $mapperName;
}

?>
