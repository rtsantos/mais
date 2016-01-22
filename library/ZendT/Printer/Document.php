<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document
 *
 * @author rsantos
 */
class ZendT_Printer_Document {
    private $_content;
    private $_duplex;
    private $_paper;
    private $_formName;
    private $_fileName;
    private $_param;
    private $_cmdPrinter;
    private $_resolution;
    private $_inputSlot;
    private $_mediaType;
    private $_copies;
    private $_printDriverName;
    
    public function __construct() {
        $this->_duplex = 0;
        $this->_paper = 'A4';
        $this->_param = 'via=1';
        $this->_resolution = 600;
        $this->_inputSlot = 1;
        $this->_mediaType = 'Plain';
        $this->_copies = 1;
    }
    /**
     * Content
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setContent($value){
        $this->_content = $value;
        return $this;
    }
    /**
     * Content
     * 
     * @return string 
     */
    public function getContent(){
        return $this->_content;
    }
    /**
     * Duplex
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setDuplex($value){
        $this->_duplex = $value;
        return $this;
    }
    /**
     * Duplex
     * 
     * @return string 
     */
    public function getDuplex(){
        return $this->_duplex;
    }
    
    /**
     * Paper
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setPaper($value){
        $this->_paper = $value;
        return $this;
    }
    /**
     * Paper
     * 
     * @return string 
     */
    public function getPaper(){
        return $this->_paper;
    }
    /**
     * FormName
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setFormName($value){
        $this->_formName = $value;
        return $this;
    }
    /**
     * FormName
     * 
     * @return string 
     */
    public function getFormName(){
        return $this->_formName;
    }
    /**
     * FileName
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setFileName($value){
        $this->_fileName = $value;
        return $this;
    }
    /**
     * FileName
     * 
     * @return string 
     */
    public function getFileName(){
        return $this->_fileName;
    }
    /**
     * Param
     * 
     * @param string $value
     * @return \ZendT_Printer_Document 
     */
    public function setParam($value){
        $this->_param = $value;
        return $this;
    }
    /**
     * Param
     * 
     * @return string 
     */
    public function getParam(){
        return $this->_param;
    }
    /**
     * CmdPrinter
     * 
     * @CmdPrinter string $value
     * @return \ZendT_Printer_Document 
     */
    public function setCmdPrinter($value){
        $this->_cmdPrinter = $value;
        return $this;
    }
    /**
     * CmdPrinter
     * 
     * @return string 
     */
    public function getCmdPrinter(){
        return $this->_cmdPrinter;
    }
    /**
     * Resolution
     * 
     * @Resolution string $value
     * @return \ZendT_Printer_Document 
     */
    public function setResolution($value){
        $this->_resolution = $value;
        return $this;
    }
    /**
     * Resolution
     * 
     * @return string 
     */
    public function getResolution(){
        return $this->_resolution;
    }
    /**
     * InputSlot
     * 
     * @InputSlot string $value
     * @return \ZendT_Printer_Document 
     */
    public function setInputSlot($value){
        $this->_inputSlot = $value;
        return $this;
    }
    /**
     * InputSlot
     * 
     * @return string 
     */
    public function getInputSlot(){
        return $this->_inputSlot;
    }
    /**
     * MediaType
     * 
     * @MediaType string $value
     * @return \ZendT_Printer_Document 
     */
    public function setMediaType($value){
        $this->_mediaType = $value;
        return $this;
    }
    /**
     * MediaType
     * 
     * @return string 
     */
    public function getMediaType(){
        return $this->_mediaType;
    }
    /**
     * Copies
     * 
     * @Copies string $value
     * @return \ZendT_Printer_Document 
     */
    public function setCopies($value){
        $this->_copies = $value;
        return $this;
    }
    /**
     * Copies
     * 
     * @return string 
     */
    public function getCopies(){
        return $this->_copies;
    }
    /**
     * PrintDriverName
     * 
     * @PrintDriverName string $value
     * @return \ZendT_Printer_Document 
     */
    public function setPrintDriverName($value){
        $this->_printDriverName = $value;
        return $this;
    }
    /**
     * PrintDriverName
     * 
     * @return string 
     */
    public function getPrintDriverName(){
        return $this->_printDriverName;
    }
}

?>
