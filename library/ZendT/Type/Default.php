<?php

/**
 * Essa classe tem como finalidade trabalhar com de texto
 * formatados. 
 * 
 * Também tem como finalidade filtrar os dados para chegar no
 * banco de dados da forma correta.
 *
 * @package ZendT
 * @subpackage String
 * @author ksantoja
 */
class ZendT_Type_Default implements ZendT_Type {
    /**
     * 
     * @var string|int|float
     */
    protected $_value;

    /**
     *
     * @var array
     */
    protected $_options;

    /**
     *
     * @param string $value
     * @param array $options
     * @param Zend_Locale $locale 
     */
    public function __construct($value = null, $options = array(), $locale = null) {
        if (isset($options['listOptions']) && $value instanceof ZendT_Type){
            $value = $value->getValueToDb();
        }
        $this->_value = $value;
        $this->_options = $options;
    }

    /**
     * Retorna o conteúdo filtrado para o banco de dados
     * 
     * @return string
     */
    public function getValueToDb() {
        return $this->_value;
    }
    /**
     * Retorna o conteúdo no formato do banco de dados
     * 
     * @param string $value
     * @return string
     */
    public function setValueFromDb($value) {
        $this->_value = $value;
        return $this;
    }

    /**
     * Configura o valor de String vindo do usuário
     * 
     * @param string $value
     * @param array $options
     * @param string|Zend_Locale $locale 
     * @return \ZendT_Type_Clob
     */
    public function set($value, $options = null, $locale = null) {
        $this->_value = $value;
        return $this;
    }

    /**
     * Retorna o valor do String, no formato do usuário
     * @param array $options
     * @param string|Zend_Locale $locale 
     * @return string
     */
    public function get($options = null, $locale = null) {
        $value = $this->_value;
        if($options  == null){
            $options = $this->_options;
        }
        if(isset($options['listOptions']) && isset($options['listOptions'][$this->_value])){
            $value = $options['listOptions'][$this->_value];
        }
        return $value;
    }

    /**
     * Retorna o valor do String, no formato do usuário
     * @return string
     */
    public function __toString() {
        return $this->get();
    }
    /**
     * Retorna se o objeto está com valor nulo
     * 
     * @return bool
     */
    public function isNull() {
        return $this->_value == '';
    }
    /**
     * Retorna o valor no formato php para calculo
     *
     * @return string 
     */
    public function toPhp(){
        return $this->getValueToDb();
    }
    /**
     * Retorna o tipo do Objeto, sendo String
     * 
     * @return string 
     */
    public function getType(){
        return 'String';
    }
}

?>