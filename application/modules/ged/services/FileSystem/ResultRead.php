<?php

    /**
     * Mapeamento dos parâmetros
     */
    class Ged_Service_FileSystem_ResultRead extends ZendT_Service_Result{

        /**
         * Nome do Arquivo.
         * 
         * @var string
         */
        public $fileName;
        
        /**
         * Tipo do Arquivo.
         * 
         * @var string
         */
        public $fileType;
        
        /**
         * Conteudo do Arquivo.
         * 
         * @var string
         */
        public $fileContent;
        
        /**
         * Id do Arquivo.
         * 
         * @var string
         */
        public $fileId;
        
        /**
         * ParentID do Processo.
         * 
         * @var int
         */
        public $parentId;
        
        /**
         * ID do Tipo de Documento
         * 
         * @var int
         */
        public $typeId;
        
        /**
         * Describe do Processo.
         * 
         * @var string
         */
        public $desc;
        /**
         *
         * @var int
         */
        public $userId;

    }
    