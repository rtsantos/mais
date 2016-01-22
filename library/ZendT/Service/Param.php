<?php
/**
 * Classe utilizada para configurar como uma instrução SQL será executada pelo
 * Serviço
 *
 * @author rsantos
 */
class ZendT_Service_Param {
    /**
     *
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $serviceName;
    /**
     * @var ZendT_Service_Where[]
     */
    public $filters;
    /**
     * @var ZendT_Service_Where
     */
    public $filter;
    /**
     * Será usado para definir se a condição deve usar AND ou OR
     * 
     * @var string @example AND,OR
     */
    public $filterOp;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $mapperView;
    /**
     * @var string
     */
    public $orderBy;
    /**
     * @var ZendT_Service_Data[]
     */
    public $data;
    /**
     * Informar app ou user
     * @var string
     * @deprecated since 1.1 number
     */
    public $typeRetrive;
    /**
     * Informar app ou user
     * @var string
     */
    public $typeRetrieve;
}
