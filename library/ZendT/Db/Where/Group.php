<?php
/**
 * Classe para agrupar os Where
 *
 * @author rsantos
 */
class ZendT_Db_Where_Group {
    private $_wheres;
    private $_groupOp;
    
    public function __construct($groupOp='AND') {
        if (!in_array(strtoupper($groupOp), array('AND','OR'))){
            $groupOp = 'AND';
        }
        $this->_groupOp = strtoupper($groupOp);
        $this->_wheres = array();
    }
    /**
     *
     * @param ZendT_Db_Where $where 
     */
    public function addWhere(ZendT_Db_Where $where){
        $this->_wheres[] = $where;
    }
    /**
     * Retorna o comando SQL agrupado 
     * @return string 
     */
    public function getSqlWhere(){
        if($this->_groupOp == 'OR'){
            $sqlWhere = '(1 = 0';
        }else{
            $sqlWhere = '(1 = 1';
        }
        foreach ($this->_wheres as $where){
            $sqlWhere.= ' '.$this->_groupOp.' '.$where->getSqlWhere();
        }
        $sqlWhere.= ')';
        return $sqlWhere;
    }
    /**
     * Retorn um array de valores em Bind
     * @return array
     */
    public function getBinds(){
        $binds = array();
        $bindsName = array();
        foreach ($this->_wheres as $where){
            $binds+= $where->getBinds($bindsName);
            $bindsName = $where->getBindsName();
        }
        return $binds;
    }
    /**
     *
     * @param array $customName
     * @return array
     */
    public function getFriendlyFilter($customName = array()) {
        $friendlyFilter = array();
        foreach ($this->_wheres as $where){
            $friendly = $where->getFriendlyFilter($customName);
            if ($friendly){
                foreach($friendly as $field => $value){
                    $friendlyFilter[$field] = $value;
                }
            }
        }
        return $friendlyFilter;
    }
}

?>
