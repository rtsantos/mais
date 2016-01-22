<?php

/**
 * Essa classe tem como finalidade trabalhar com campos binários
 * grande. No oracle existe um tratamento especial para trabalhar
 * com esse tipo de dado
 * 
 * Também tem como finalidade filtrar os dados para chegar no
 * banco de dados com segurança.
 *
 * @package ZendT
 * @subpackage Clob
 * @author ksantoja
 */
class ZendT_Type_Blob implements ZendT_Type {

    /**
     * Valor
     * 
     * @var float
     */
    protected $_value;

    /**
     *
     * @var array
     */
    protected $_options;

    /**
     * Local para tratar conversão do valor
     * @var Zend_Locale
     */
    protected $_locale;

    /**
     * Filtro para não deixar colocar executáveis
     */

    const FILTER_EXECUTABLE = 'exe';

    /**
     *
     * @param string $value
     * @param array $options
     * @param string|Zend_Locale $locale 
     */
    public function __construct($value = null, $options = array('extension' => FILTER_EXECUTABLE, 'maxSize' => '5MB', 'minSize' => 0), $locale = null) {
        if ($value instanceof ZendT_Type){
            $value = $value->getValueToDb();
        }
        $value = urldecode($value);
        $this->_value = $value;
        $this->_locale = $locale;
        $this->_options = $options;
    }

    /**
     * Retorna o valor no formato do usuário
     * 
     * @param array $options
     * @param string|Zend_Locale $locale
     * @return string
     */
    public function get($options = null, $locale = null) {
        return $this->_value;
    }

    /**
     * Configura o campo de valor vindo do usuário
     * 
     * @param string $value
     * @param array $options
     * @param string|Zend_Locale $locale
     * @return \ZendT_Type_Blob 
     */
    public function set($value, $options = null, $locale = null) {
        $this->_value = $value;
        return $this;
    }

    /**
     * Adiciona um validador
     * 
     * @param string $valitador
     * @return \ZendT_Type_Blob 
     */
    public function addValidator($validator) {
        $this->_options['validators'][] = $validator;
        return $this;
    }

    /**
     * Adiciona um array para validação
     * 
     * @param array $validators 
     * @return \ZendT_Type_Blob 
     */
    public function addValidators($validators) {
        foreach ($validators as $value) {
            $this->addValidator($value);
        }
        return $this;
    }

    /**
     * Retorna o valor no famato do banco de dados
     * 
     * @return string
     */
    public function getValueToDb() {
        if (strpos($this->_value, ZendT_File::ZENDT_FILE_PREFIX_FILENAME) !== false){
            $file = ZendT_File::fromFilenameCrypt($this->_value);
            return $file->getContent();
        }else if (file_exists($this->_value)){
            return file_get_contents($this->_value);
        }else{
            return $this->_value;
        }
    }

    /**
     * Configura o valor vindo do banco de dados
     * 
     * @param string $value
     * @return \ZendT_Type_Blob 
     */
    public function setValueFromDb($value) {
        $this->_value = $value;
        return $this;
    }

    /**
     * Retona o conteúdo no formato locale
     */
    public function __toString() {
        return $this->_value;
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
     * Retorna que o objeto tem conteúdo do tipo String
     */
    public function getType(){
        return 'String';
    }
}
?>
