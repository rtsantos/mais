<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    class ZendT_Type_Blob_File{
        /**
        * Tempo de vida dos arquivos em horas
        * 
        * @var int
        */
        protected $_lifeTime = 1;
        
        public function getPath(){
            $this->_clearFiles();
            
            Zend_Session::start();
            $path = ZendT_Lib::getTmpDir().'/files';
            if (!is_dir($path)){
                @$result = mkdir($path);
                if (!$result){
                    throw new ZendT_Exception_Error('Não foi possível criar o diretório temporário. Path: '.$path.'!');
                }                
            }
            $idSession = Zend_Session::getId();
            if (!$idSession){
                $idSession = date('dmyhis');
            }

            if ($idSession && !is_dir($path.'/'.$idSession)){
                @$result = mkdir($path.'/'.$idSession);
                if (!$result){
                    throw new ZendT_Exception_Error('Não foi possível criar o diretório temporário. Path: '.$path.'!');
                }                
            }
            $path.= '/'.$idSession.'/';
            return str_replace('\\', '/', $path);
        }

        private function _clearFiles(){
            $folder = ZendT_Lib::getTmpDir().'/files/';
            $dh  = opendir($folder);
            while ($handle = readdir($dh)) {
                if (is_dir($folder.$handle) && $handle != '.' && $handle != '..'){
                    $files = glob($folder.$handle."/*.*");
                    if (count($files) == 0){
                        $path = $folder.$handle;
                        @rmdir($path);
                    }else{
                        foreach ($files as $file){
                            $lastAccess = filemtime($file);
                            // 30 minutos
                            if ((time()-$lastAccess) > 30 * 60 * 1){
                                @unlink($file);
                            }
                        }
                    }
                }
            }
            closedir($dh);
        }
    
        public function create($name,$content,$encode=array()){
            if ($content instanceof ZendT_Type){
                $content = $content->get();
            }
            //if ($content){
                $filename = $this->getPath().$name;
                file_put_contents($filename, $content);
                if ($encode){
                    if (is_array($encode)){
                        foreach($encode as $func){
                            $filename = $func($filename);
                        }                        
                    }else{
                        $filename = base64_encode($filename);
                    }
                }
                return $filename;
            /*}else{
                return '';
            }*/
        }
    }
?>
