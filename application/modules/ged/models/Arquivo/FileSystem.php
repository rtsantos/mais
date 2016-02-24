<?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of FileSystem
     *
     * @author rsantos
     */
    class Ged_Model_Arquivo_FileSystem {

        protected $_config = array();

        public function __construct() {
            //$this->validateFilesExpires();
            $this->_config = include 'file-system-dirs.php';
        }

        /**
         * Valida e remove os arquivos que estão com data de expiração vencida
         * 
         */
        public function validateFilesExpires() {
            $_where = new ZendT_Db_Where();
            $_where->addFilter('dt_expira', ZendT_Type_Date::nowDate(), '<=');
            $_arquivo = new Ged_DataView_Arquivo_Crud_MapperView();
            $_arquivo->findAll($_where);
            while ($_arquivo->fetch()) {
                $this->remove($_arquivo->getId()->toPhp());
            }
        }

        /**
         * Escrita do arquivo
         * 
         * @param Ged_Service_FileSystem_ParamWrite $param parâmetros do arquivo
         * @return int
         */
        public function write($param) {


            $file = new ZendT_File($param->fileName, $param->fileContent, $param->fileType, $param->fileId);
            $configs = $this->_getConfigProp($param->propName);

            if (count($configs)) {
                $this->_isValidExtension($file, $configs['extension']);
                $this->_convertFileExtRes($file, $configs['extReplace'], $configs['resolution'], $configs['width'], $configs['height'], $configs['resize_ratio'][0]);
                $this->_isValidFileSize($file, $configs['maxSize'], $configs['maxSizeUnit']);
                $idArquivo = $this->_saveFile($file, $configs, $param);
            } else {
                throw new ZendT_Exception("Não foram definidas configurações para o processo!");
            }
            return $idArquivo;
        }

        /**
         * Leitura do arquivo
         * 
         * @param int $idArquivo
         * @return stdClass
         * @throws ZendT_Exception
         */
        public function read($idArquivo) {
            $_arquivo = $this->_getArquivo($idArquivo);
            $_result = new stdClass();

            if ($_arquivo) {
                $x = $_arquivo->getIdPropDocto()->get();
                $_propDocto = $this->_getPropDocto($_arquivo->getIdPropDocto()->toPhp());
                $configs = $_propDocto->getConfig(false, true);
                if (count($configs)) {
                    $path = $this->_getArquivoPath($idArquivo);
                    if (file_exists($path['full'])) {
                        $content = file_get_contents($path['full']);
                        $_result->fileName = $_arquivo->getConteudoName()->toPhp();
                        $_result->fileContent = $content;
                        $_result->fileType = $_arquivo->getConteudoType()->toPhp();
                        $_result->fileId = $_arquivo->getId()->toPhp();
                    } else {
                        throw new ZendT_Exception("Arquivo não localizado no servidor!");
                    }
                } else {
                    throw new ZendT_Exception("Não foram definidas configurações para o processo!");
                }
            }
            return $_result;
        }

        /**
         * Remove o arquivo
         * 
         * @param int $idArquivo
         * @param int $delete - deleta ou não o registro do banco
         * @return int
         * @throws ZendT_Exception
         */
        public function remove($idArquivo, $delete = 1) {
            $_arquivo = $this->_getArquivo($idArquivo);
            if ($_arquivo) {
                $_propDocto = $this->_getPropDocto($_arquivo->getIdPropDocto()->toPhp());
                $configs = $_propDocto->getConfig(false, true);
                if (count($configs)) {
                    $path = $this->_getArquivoPath($idArquivo);
                    if (file_exists($path['full'])) {
                        unlink($path['full']);
                    }
                    if ($delete) {
                        $_arquivo->delete();
                    }
                } else {
                    throw new ZendT_Exception("Não foram definidas configurações para o processo!");
                }
            }
            return 1;
        }

        /**
         * Busca e retorna o registro do arquivo
         * 
         * @param integer $idArquivo
         * @return boolean|\Ged_Model_Arquivo_Crud_Mapper
         */
        private function _getArquivo($idArquivo) {
            $_arquivo = new Ged_Model_Arquivo_Crud_Mapper();
            $_arquivo->setId($idArquivo);
            if (!$_arquivo->exists()) {
                return false;
            }
            $_arquivo->retrieve();
            return $_arquivo;
        }

        /**
         * Retorna o caminho em que o arquivo encontra-se
         * 
         * @param integer $idArquivo
         * @return string
         */
        private function _getArquivoPath($idArquivo) {
            $_arquivo = $this->_getArquivo($idArquivo);
            $result['full'] = $this->_config['pathDir'] .
                    $_arquivo->getPathArq()->toPhp() . "/" .
                    $this->_formatFileName($_arquivo->getHashcode()->toPhp()
                            , $_arquivo->getConteudoName()->toPhp());
            return $result;
        }

        /**
         * Retorna o caminho em que o arquivo encontra-se
         * 
         * @param integer $idArquivo
         * @return string
         */
        public function getFileName($idArquivo) {
            $_arquivo = $this->_getArquivo($idArquivo);
            if ($_arquivo) {
                $path = $this->_getArquivoPath($idArquivo);
                return $path['full'];
            }
            return false;
        }

        /**
         * Retorna o diretório em que o arquivo encontra-se
         * 
         * @param integer $idArquivo
         * @return string
         */
        public function getDirectoryAdress($idArquivo) {
            $_arquivo = $this->_getArquivo($idArquivo);

            if ($_arquivo) {
                $urlFile = $_arquivo->getPathArq()->toPhp() . "/" .
                        $this->_formatFileName($_arquivo->getHashcode()->toPhp()
                                , $_arquivo->getConteudoName()->toPhp());

                return $this->_config['uri'] . $this->_config['pathUri'] . $urlFile;
            }
            return false;
        }

        /**
         * 
         * @param int $value
         * @return boolean|string
         */
        public function getUrl($value) {
            $_arquivo = $this->_getArquivo($value);

            if ($_arquivo) {
                $urlFile = $_arquivo->getPathArq()->toPhp() . "/" .
                        $this->_formatFileName($_arquivo->getHashcode()->toPhp()
                                , $_arquivo->getConteudoName()->toPhp());

                return $this->_config['uri'] . $this->_config['pathUri'] . $urlFile;
            }
            return false;
        }

        /**
         * Retorna o path do arquivo baseado no tipo de backup informado
         * 
         * @param string $bkpProp - tipo de backup
         * @param string $propName - nome da propriedade
         * @param string $fileName - nome do arquivo
         * @return array path do arquivo
         * 
         */
        private function getFilePath($bkpProp, $propName = '', $fileName = '') {
            $result = array();

            switch ($bkpProp) {
                case 1:
                    $base = $this->_config['temp'];
                    break;
                case 2:
                    $base = $this->_config['backup'];
                    break;
                case 3:
                    $base = $this->_config['incremental'];
                    break;
            }

            $result['base'] = $base;
            if ($propName) {
                $now = ZendT_Type_Date::nowDate();
                $now = explode("/", $now->get());
                $allocated = $now[2] . $now[1] . $now[0];
                $allocated .= "/" . $propName;
                $result['allocated'] = $allocated;
                $result['path'] = $base . "/" . $allocated;
            }
            if ($fileName) {
                $fileNames = explode(".", $fileName);
                $_arquivo = new Ged_DataView_Arquivo_MapperView();
                $fileNames[0] = $_arquivo->setHashcode($fileNames[0])->getHashcode()->toPhp();
                $fileName = implode(".", $fileNames);
                $result['file'] = $fileName;
                $result['full'] = $this->_config['pathDir'] . $base . "/" . $allocated . "/" . $fileName;
            }

            $result['pathBase'] = $this->_config['pathDir'] . $result['path'];

            /* Verifica se o diretório é valido */
            $_arquivo = new Ged_DataView_Arquivo_MapperView();
            $_arquivo->setPathArq($result['path']);

            return $result;
        }

        /**
         * Converte arquivo para outras extensões e/ou resoluções
         * 
         * @param string $file - nome do arquivo a ser convertido
         * @param string $ext - extensão que será gerada o novo arquivo
         * @param string $resolution - resolução em DPI que será gerado o novo arquivo
         * @param string $resize - tamanho que será gerado o novo arquivo
         * @param string $resizeRatio - mantém ou não a proporção do novo arquivo na conversão de tamanho
         * 
         * @return \ZendT_File
         */
        private function _convertFile($file, $ext = "", $resolution = "", $resize = "", $resizeRatio = "") {
            if ($ext) {
                $newFileName = reset(explode(".", basename($file))) . "." . $ext;
            } else {
                $newFileName = basename($file);
            }
            $dir = dirname($file);

            $pathNewFile = $dir . "/" . $newFileName;
            if ($resolution) {
                $resolution = " -resample " . $resolution;
            }
            if ($resize) {
                //$identify = shell_exec('identify -verbose "' . $file . '"');
                $props['size'] = $this->_execCmd('identify -format %[fx:w]x%[fx:h] "' . $file . '"');
                if ($props['size'] != $resize) {
                    $resize = " -resize " . $resize;
                    if (!$resizeRatio) {
                        $resize .= "!";
                    }
                }
            }
            $this->_execCmd('convert "' . $file . '"' . $resolution . $resize . ' "' . $pathNewFile . '"');

            $newFile = new ZendT_File();
            $newFile->create($newFileName, file_get_contents($pathNewFile));
            return $newFile;
        }

        /**
         * Executa um comando via shell
         * 
         * @param string $cmd - comando para execução
         * @return string - retorno da execução
         */
        private function _execCmd($cmd) {
            return shell_exec($cmd);
        }

        /**
         * Retorna as propriedades de configuração do arquivo
         * 
         * @param string $propName - nome da propriedade
         * @return \Ged_DataView_PropDocto_MapperView
         */
        private function _getPropDocto($propName) {
            $_propDocto = new Ged_DataView_PropDocto_MapperView();
            if (is_numeric($propName)) {
                $_propDocto->setId($propName);
            } else {
                $_propDocto->setNome($propName);
            }
            if (!$_propDocto->exists()) {
                throw new ZendT_Exception("Propriedades de configuração " . $propName . " não encontrada!");
            }
            $_propDocto->retrieve();
            return $_propDocto;
        }
        
        private function _toNum($value){
            $value = str_replace(array('.',','), array('','.'), $value);
            return ($value * 1);
        }

        /**
         * Obtém as configurações de um registro de propriedades de documento
         * 
         * @param string $propName - nome da propriedade
         * @return array
         */
        private function _getConfigProp($propName) {
            $_propDocto = $this->_getPropDocto($propName);
            $configs = $_propDocto->getConfig(false, true);
            $configs['width'] = $this->_toNum($configs['width']);
            $configs['height'] = $this->_toNum($configs['height']);
            $configs['horizontal'] = $this->_toNum($configs['horizontal']);
            $configs['vertical'] = $this->_toNum($configs['vertical']);
            $configs['maxSize'] = $this->_toNum($configs['maxSize']);
            $configs['lifeTime'] = $this->_toNum($configs['lifeTime']);
            return $configs;
        }

        /**
         * Converte um arquivo para uma nova extensão e/ou resolução
         * 
         * @param ZendT_File $file - arquivo origem
         * @param string $extReplace - nova extensão
         * @param string $resolution - nova resolução
         * @param string $height - nova altura
         * @param string $width - nova largura
         * @param string $resizeRatio - mantém ou não a proporção do tamanho
         */
        private function _convertFileExtRes(&$file, $extReplace = '', $resolution = '', $width = '', $height = '', $resizeRatio = '') {
            if ($extReplace || $resolution || $width) {
                $width = intval($width);
                $resize = $width;
                $height = intval($height);
                if ($height) {
                    $resize .= "x" . $height;
                }
                $file = $this->_convertFile($file->getFilename(), $extReplace, $resolution, $resize, $resizeRatio);
            }
        }

        /**
         * Verifica se a extensão do arquivo é valida
         * 
         * @param ZendT_File $file - arquivo
         * @param array $extValids - extensões válidas
         * @throws ZendT_Exception
         */
        private function _isValidExtension($file, $extValids) {
            $ext = $file->getFileExtension();
            if (is_array($extValids) && count($extValids)) {
                if (!in_array(strtolower($ext), $extValids)) {
                    $msg = "Extensão inválida para esse processo!<br/><br/>Extensões válidas: " . implode(", ", $extValids);
                    throw new ZendT_Exception($msg);
                }
            }
        }

        /**
         * Verifica se o tamanho do arquivo está dentro do máximo permitido
         * 
         * @param ZendT_File $file - arquivo
         * @param integer $maxSize - tamanho máximo
         * @param string $maxSizeUnit - unidade do tamanho
         * @throws ZendT_Exception
         */
        private function _isValidFileSize($file, $maxSize, $maxSizeUnit) {
            $size = $file->getSize($maxSizeUnit, 2);
            if ($maxSize != '' && $size > $maxSize) {
                throw new ZendT_Exception("Tamanho do arquivo inválido! ({$file->getName()} - {$size}{$maxSizeUnit}).<br/<br/>Favor selecionar um arquivo com o tamanho inferior a {$maxSize}{$maxSizeUnit}!");
            }
        }

        /**
         * Salva o arquivo no diretório e na tabela (inclui / altera)
         * 
         * @param ZendT_File $file - arquivo
         * @param array $configs - configurações de propriedades do arquivo
         * @param array $param - propriedades do arquivo
         * @return integer - id do arquivo salvo
         */
        private function _saveFile($file, $configs, &$param) {
            $_propDocto = $this->_getPropDocto($param->propName);

            $param->fileName = $file->getName();
            $fileContent = $file->getContent();
            $fileType = $file->getContentType();
            $hashCode = md5($fileContent);
            $fileName = $this->_formatFileName($hashCode, $param->fileName);
            $propName = $param->propName;
            $dtExpira = '';

            $_arquivo = new Ged_DataView_Arquivo_MapperView();
            $_arquivo->setHashcode($hashCode);
            $path = $this->getFilePath($configs['bkpProp'], $propName, $fileName);
            $_arquivo->setPathArq($path['path']);
            if (!$_arquivo->exists()) {
                #$_arquivo->setPathArq($path['path']);
            } else {
                $_arquivo_aux = clone $_arquivo;
                $dtExpira = $_arquivo_aux->retrieve()->getDtExpira()->toPhp();
            }
            if ($configs['lifeTime'] && !$dtExpira) {
                $dtExpira = ZendT_Type_Date::nowDate()->addDay($configs['lifeTime']);
                $_arquivo->setDtExpira($dtExpira);
            }
            $_arquivo->setConteudoName($param->fileName);
            $_arquivo->setIdPropDocto($_propDocto->getId());
            $_arquivo->setConteudoType($fileType);

            if ($configs['bkpProp'] == 2 && $param->fileId) {
                $_arquivo->setId($param->fileId);
                $_arquivo_aux = new Ged_DataView_Arquivo_MapperView();
                $_arquivo_aux->setId($_arquivo->getId());
                if ($_arquivo_aux->exists()) {
                    $_arquivo_aux->retrieve();
                    if ($_arquivo_aux->getHashCode()->toPhp() != $_arquivo->getHashcode()->toPhp()) {
                        $this->remove($_arquivo->getId(), false);
                        $_arquivo->update();
                        //$path_aux = $this->_getArquivoPath($_arquivo->getId()->toPhp());
                    }
                }
            }
            $idArquivo = $_arquivo->save(true);
            if (!file_exists($path['full'])) {
                if (!file_exists($path['pathBase'])) {
                    //mkdir($path['pathBase'], null, true);
                    $this->mkdirRecursive($path['pathBase']);
                }
                $result = file_put_contents($path['full'], $file->getContent());
                if (!$result) {
                    throw new ZendT_Exception('Erro ao armazenar o arquivo no servidor "' . $path['full'] . '". Erro: "' . $php_errormsg . '" ');
                }
                $this->mkdirRecursive($path['full']);
                if (!$result) {
                    throw new ZendT_Exception('Não foi possível salvar o arquivo "' . $path['full'] . '"');
                }
            }

            if ($param->parentId) {
                $_docto = new Ged_DataView_Docto_MapperView();
                $_docto->setIdPropRelac($param->parentId);
                $_docto->setDescricao($param->desc);
                $_docto->setDhInclusao("SYSDATE");
                $_docto->setIdArquivo($idArquivo);
                $_docto->setIdTipoDocto($param->typeId);
                $_docto->setIdUsuIncl($param->userId);
                $idDocto = $_docto->save();
            }
            return $idArquivo;
        }

        /**
         * Obtém o nome do arquivo formatado
         * 
         * @param string $hashCode - hashCode do arquivo
         * @param string $conteudoName - nome do conteúdo do arquivo
         * @return String - nome do arquivo formatado
         */
        private function _formatFileName($hashCode, $conteudoName) {
            return $hashCode . "." . end(explode(".", $conteudoName));
        }

        /**
         * Cria pasta e libera permissões do arquivo / pasta especificado
         * 
         * @param String $filename - nome do arquivo / pasta
         * @param integer $mode - permissão
         * @return boolean
         */
        public function mkdirRecursive($filename, $mode = '777') {
            $filename = trim($filename);
            $before = "";
            if (substr($filename, 0, 1) == '/') {
                $before = "/";
            }
            $paths = explode("/", $filename);
            $qtd = 0;
            while ($qtd <= count($paths)) {
                $result = "";
                for ($i = 0; $i < $qtd; $i ++) {
                    if ($paths[$i]) {
                        $result .= $paths[$i] . "/";
                    }
                }
                if ($result) {
                    $result = $before . $result;
                    if (!is_dir($result)) {
                        @mkdir($result);
                    }
                    $this->_execCmd("chmod {$mode} {$result} -R");
                }
                $qtd ++;
            }
            return true;
        }

    }
    