<?php

   /**
    * ZendT_Report_Pdf
    * 
    * @package ZendT
    * @subpackage ZendT_Report 
    * @author rsantos
    * @version 1
    *
    */
   class ZendT_Report_Pdf_Form extends ZendT_Report_Pdf {

       public function __construct($options = false) {
           if ($options['template']) {
               $this->_driver = new $options['template']();
           } else {
               $this->_driver = new ZendT_Report_Pdf_Fpdf();
           }

           foreach ($options as $key => $value) {
               $this->{'_' . $key} = $value;
           }
           if ($this->_orientation == 'L') {
               $this->_pageWidth = 1625;
           } else {
               $this->_pageWidth = 1120;
           }
           $this->_driver->setOrientation($this->_orientation);
           $this->_driver->FPDF($this->_orientation);
           $this->_driver->SetMargins(5, 5, 5);
       }

   }

?>
