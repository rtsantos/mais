<?php
    /**
     * Procedimento criado para anexar arquivos ao e-mail
     * 
     * @package ZendT
     * @subpackage Mail
     * @author rsantos
     */
    class ZendT_Mail_Attachment {
        /**
         *
         * @var type 
         */
        private $_path;
        /**
         *
         * @var ZendT_Type_Clob 
         */
        private $_content;
        /**
         *
         * @var string
         */
        private $_name;
        /**
         *
         * @var string
         */
        private $_fileName;
        /**
         *
         * @param string $content
         * @param string $name
         * @param string $type @example Clob, Blob
         */
        public function __construct($content,$name,$type='Clob',$path='/oradb/oraftp/pub/temp') {
            $objectName = 'ZendT_Type_' . ucfirst($type);
            $this->_content = new $objectName($content);
            $this->_name = $name;
            $this->_path = $path;
            if (is_file($content)){
                $this->_fileName = $content;
            }
        }
        /**
         * Salva o conteúdo do arquivo no servidor Oracle
         * Caso seja possível salvar o arquivo, será retornado
         * o filename completo de onde o arquivo será armazenado
         * 
         * @param Zend_Db $db
         * @return string
         */
        public function save($db=null) {
            if ($db == null){
                $db = Zend_Registry::get('db.projta');
            }
            if ($this->_content instanceof ZendT_Type_Blob){
                $sql = "
                    declare
                      v_blob BLOB;
                    begin
                       insert into tmp_blob(content) values (:content);
                       select content into v_blob FROM tmp_blob;
                       arquivo_pkg.write_to_disk(p_data => v_blob,
                                                 p_file_name => :name,
                                                 p_path_name => :path);
                    end;                
                ";
                @$conn = ftp_connect('192.168.1.251');
                if (!$conn) {
                    throw new ZendT_Exception(error_get_last());
                }
                @$result = ftp_login($conn,'anonymous','anonymous');
                if (!$result) {
                    throw new ZendT_Exception(error_get_last());
                }
                $fileNameServer = 'pub/temp/' . $this->_name;
                @ftp_delete($conn, $fileNameServer);
                @$result = ftp_put($conn, $fileNameServer, $this->_fileName, FTP_BINARY);
                if (!$result) {
                    throw new ZendT_Exception(error_get_last(). ". Name Server: {$fileNameServer} || Name Local: {$this->_fileName}");
                }
                @$result = ftp_close($conn);                    
            }else{
                $sql = "
                    begin
                    arquivo_pkg.write_to_disk(p_data => :content,
                                              p_file_name => :name,
                                              p_path_name => :path);
                    end;                
                ";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':content',$this->_content);
                $stmt->bindValue(':name',$this->_name);
                $stmt->bindValue(':path',$this->_path);
                $stmt->execute();
            }
            $filename = $this->_path.'/'.$this->_name;
            return $filename;
        }
    }