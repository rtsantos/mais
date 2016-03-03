<?php

   /**
    * Classe de visão da tabela cv_vistoria
    */
   class Vendas_DataView_Vistoria_MapperView extends Vendas_DataView_Vistoria_Crud_MapperView {

       protected $_arquivo = null;

       /**
        * 
        * @return Ged_Model_Arquivo_FileSystem
        */
       protected function _getArquivo() {
           if ($this->_arquivo == null) {
               $this->_arquivo = new Ged_Model_Arquivo_FileSystem();
           }
           return $this->_arquivo;
       }

       /**
        * 
        * @param array $row
        * @param ZendT_Report_PdfForm $pdf
        */
       public function addRowForm($row, $pdf) {
           $filename = $this->_getArquivo()->getFileName($row['laudo']->getValueToDb());
           $pdf->importPdf($filename);
       }

   }

?>