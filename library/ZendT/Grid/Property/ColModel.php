<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */

class ZendT_Grid_Property_ColModel implements ZendT_JS_Interface {

    /**
     *
     * @var type \ZendT_Grid_Column[]
     */
    private $_columns;

    /**
     *
     * @var type string
     */
    private $_js;

    /**
     *
     * @param type $array
     */
    public function __construct( $array = null ){
        if( $array ){
            $this->setColumns($array);
        }
    }

    /**
     *
     * @param type $array
     * @return \ZendT_Grid_ColModel 
     */
    public function setColumns( $array ){
        $this->_columns = $array;
        return $this;
    }

    /**
     *
     * @param type ZendT_Grid_Column
     * @return \ZendT_Grid_ColModel 
     */
    public function addColumn( $column ){
        $this->_columns[] = $column;
        return $this;
    }

    /**
     * Retorna as colunas
     *
     * @return \ZendT_Grid_Column[]
     */
    public function getColumns(){
        if (!is_array($this->_columns)){
            return array();
        }
        return $this->_columns;
    }

    /**
     *
     * @param type $key
     * @return type \ZendT_Grid_Column
     */
    public function getColumn( $key ){
        return $this->_columns[$key];
    }
    
    public function setJS( $_js ){
        $this->_js = $_js;
        return $this;
    }

    public function getJS(){
        return $this->_js;
    }

    /**
     * Crio o JS para retornar ao objeto Grid
     * para renderização
     * 
     * @return type string
     */
    public function createJS(){
        $js = '';

        foreach( $this->getColumns() as $property ){
            /**
             * Identifico se alguma propriedade desta classe
             * é um objeto, se for chamo o render dele para
             * juntar ao js desta classe
             */
            if( is_object($property) ){
                $js .= $property->render() . ',';
            }
        }
        $js = rtrim($js, ', ');

        return $js;        
    }

    public function render(){
        $this->setJS($this->createJS());
        return $this->getJS();
    }

}

?>
