<?php
/**
 * Description of Paginator
 *
 * @author rsantos
 */
class ZendT_Grid_Paginator {
    /**
     *
     * @var string
     */
    private $_orderby;
    /**
     *
     * @var int
     */
    private $_limitCount;
    /**
     *
     * @var int
     */
    private $_limitOffset;
    /**
     *
     * @var int
     */
    private $_numPage;
    /**
     *
     * @param array $postData 
     */
    public function __construct($postData) {
        if (!isset($postData['sidx']) || !$postData['sidx']) {
            $postData['sidx'] = 1;
        }
        if (!isset($postData['sord'])){
            $postData['sord'] = 'DESC';
        }
        if (!isset($postData['rows'])){
            $postData['rows'] = 1000;
        }
        if (!isset($postData['page'])){
            $postData['page'] = 1;
        }
        $this->_orderby     = " ".$postData['sidx']." ".$postData['sord'];
        $this->_limitCount  = $postData['rows'];
        $this->_limitOffset = ($postData['rows']*$postData['page'] - $postData['rows']);
        $this->_numPage = $postData['page'];         
        if ($this->_limitOffset <= 0) $this->_limitOffset = 0;
    }
    /**
     * Retorna a quantidade de registros
     * que deve ser filtrado
     * 
     * @return int
     */
    public function getLimitCount(){
        if ($this->_limitCount <= 0){
            $this->_limitCount = 1000;
        }
        return $this->_limitCount;
    }
    /**
     * Retorna o limite de registro informado no grid
     * 
     * @return int
     */
    public function getLimitOffset(){
        return $this->_limitOffset; 
    }
    /**
     * Retorna o campo para ordenação
     * 
     * @return string
     */
    public function getOrderBy(){
        return $this->_orderby;
    }
    /**
     * Retorna o número da página
     * 
     * @return int
     */
    public function getNumPage(){
        return $this->_numPage;
    }
}

?>
