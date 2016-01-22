<?php

   /**
    * Form Element para montar combo das impressoras
    * 
    * @category    ZendT
    * @author      rsantos
    */
   class ZendT_Form_Element_Printer extends ZendT_Form_Element {

       public $helper = "printer";
       
       public function __construct($spec, $options = null) {
           parent::__construct($spec, $options);
           
           $_printer = new ZendT_Printer();
           $printers = $_printer->getPrintersByFilial();
           $this->setServerPrinters($printers);
       }

       /**
        * 
        * @param array $value
        * @return \ZendT_Form_Element_Printer
        */
       public function setServerPrinters($value) {
           $this->setAttrib('serverPrinters', $value);
           return $this;
       }
       
       /**
        * 
        * @param string $value
        * @return \ZendT_Form_Element_Printer
        */
       public function setFilter($value) {
           $this->setAttrib('filter', $value);
           return $this;
       }

   }
   