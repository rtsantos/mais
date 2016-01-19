<?php

    class FileController extends Zend_Controller_Action {

        public function indexAction() {
            Zend_Layout::getMvcInstance()->setLayout('window');

            $params = $this->getRequest()->getParams();
            if (is_array($params['options'])) {
                $params['options'] = serialize($params['options']);
            }
            $form = new Application_Form_File();
            $form->loadElements();
            $form->setAction(ZendT_Url::getUri(true) . '/upload');
            $form->populate($params);

            $this->view->form = $form;
        }
		
		public function clearAction(){
			$_file = new ZendT_File();
			$_file->clearFiles();
			exit;
		}

        public function uploadAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $json = new ZendT_Json_Result();
            try {
                $options = $this->getRequest()->getParam('options');
                if ($options && !is_array($options)) {
                    $options = unserialize($options);
                }
                /**
                 * @var Zend_File_Transfer_Adapter_Http 
                 */
                $uploads = new Zend_File_Transfer('Http', false, array('detectInfos' => false));
                if ($options['extension'] == ZendT_Type_Blob::FILTER_EXECUTABLE) {
                    $options['extension'] = array('text/php',
                        'text/x-php',
                        'text/asp',
                        'text/x-asp');
                }
                if ($options['maxSize'] || $options['minSize']) {
                    $uploads->addValidator('FilesSize', false, array('max' => $options['maxSize'],
                        'min' => $options['minSize']));
                }
                if (is_array($options['validators'])) {
                    array_merge($options['extension'], $options['validators']);
                }
                //$uploads->addValidator('ExcludeMimeType', false, $options['extension']);
                $uploads->receive();
                if ($uploads->hasErrors()) {
                    $message = $uploads->getMessages();
                    throw new ZendT_Exception_Information(current($message));
                } else {
                    
                }
                $infoFiles = $uploads->getFileInfo();

                @$content = file_get_contents($infoFiles['file']['tmp_name']);
                if ($content === false) {
                    throw new ZendT_Exception_Error('Não foi possível armazenar o arquivo informado!');
                }
                $_file = new ZendT_File($infoFiles['file']['name'], $content, $infoFiles['file']['type']);
                @unlink($infoFiles['file']['tmp_name']);
                $infoFile = $_file->toArrayJson();
                $infoFile['size'] = $infoFiles['file']['size'];
                $json->setResult($infoFile);
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        public function downloadAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $filename = $this->getRequest()->getParam('filename');
            $delete = $this->getRequest()->getParam('delete');

            $this->getResponse()->setHeader('Content-Type', 'application/x-download');
            $this->getResponse()->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
            $this->getResponse()->setHeader('Pragma', 'public');

            if (strpos($filename, ZendT_File::ZENDT_FILE_PREFIX_FILENAME) !== false) {

                $file = ZendT_File::fromFilenameCrypt($filename);
                $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename=' . $file->getName());

                echo $file->getContent();

                if ($delete) {
                    $file->delete();
                }
            } else {
                /**
                 * @todo remover bloco abaixo, depreciado em 15 dias
                 * data: 07/06/13
                 */
                $decode = $this->getRequest()->getParam('decode');
                if ($decode) {
                    $filename = base64_decode($filename);
                }
                $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename=' . basename($filename));
                echo file_get_contents($filename);
                if ($delete) {
                    unlink($filename);
                }
            }
        }

        function xlsConvertAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $filename = $this->getRequest()->getParam('filename');
            $format = $this->getRequest()->getParam('format');

            $this->getResponse()->setHeader('Content-Type', 'application/x-download');
            $this->getResponse()->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
            $this->getResponse()->setHeader('Pragma', 'public');

            $file = ZendT_File::fromFilenameCrypt($filename);
            $path = $file->getPath();
            $name = $file->getName();

            if ($format == ZendT_Report_Xls::FORMAT_XLSX) {
                $result['path'] = $file->getPath();
                $result['name'] = $file->getName();
            } else {
                $result = ZendT_Report_Xls::convert($path, $name, $format);
            }

            $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename=' . $result['name']);
            echo file_get_contents($result['path'] . '/' . $result['name']);
        }

        public function pdfAction() {
            try {
                $filename = $this->getRequest()->getParam('filename');
                $file = ZendT_File::fromFilenameCrypt($filename);

                Zend_Layout::getMvcInstance()->setLayout('pdf');
                $this->view->placeholder('name')->set($file->getName());
                $this->view->content = $file->getContent();
                #$file->delete();
            } catch (ZendT_Exception $ex) {
                Zend_Layout::getMvcInstance()->setLayout('window');
                $this->view->content = $this->view->exception($ex);
            }
            $this->renderScript('/index/render.phtml');
        }

        public function deleteAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $json = new ZendT_Json_Result();
            try {

                $filename = $this->getRequest()->getParam('filename');
                $decode = $this->getRequest()->getParam('decode');

                $files = explode(',', $filename);

                foreach ($files as $hashName) {

                    if ($decode) {
                        $file = base64_decode($hashName);
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    } else {
                        $file = ZendT_File::fromFilenameCrypt($hashName);
                        $file->delete();
                    }
                }

                $id = $this->getRequest()->getParam('id');
                if (!$id) {
                    $id = 1;
                }
                $json->setResult(array('id' => $id));
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->render();
        }

        public function pluploadAction() {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);

            $json = new ZendT_Json_Result();
            try {
                $targetDir = ZendT_Lib::getTmpDir() . '/files/' . DIRECTORY_SEPARATOR . "plupload";
                // Create target dir
                if (!file_exists($targetDir)) {
                    @$result = mkdir($targetDir);
                    if (!$result) {
                        throw new ZendT_Exception_Error('Não foi possível criar o diretório "$targetDir".', 1001);
                    }
                }
                if (!file_exists($targetDir)) {
                    @$result = mkdir($targetDir);
                    if (!$result) {
                        throw new ZendT_Exception_Error('Não foi possível criar o diretório "$targetDir".', 1001);
                    }
                }
                //$targetDir = 'uploads';

                $cleanupTargetDir = true; // Remove old files
                $maxFileAge = 1 * 3600; // Temp file age in seconds
                // 5 minutes execution time
                @set_time_limit(5 * 60);

                // Uncomment this one to fake upload time
                // usleep(5000);
                // Get parameters
                $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
                $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
                $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

                // Clean the fileName for security reasons
                $fileName = removeAccent(trim($fileName));
                $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
                $fileName = str_replace(' ', '_', $fileName);

                // Make sure the fileName is unique but only if chunking is disabled
                if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
                    $ext = strrpos($fileName, '.');
                    $fileName_a = substr($fileName, 0, $ext);
                    $fileName_b = substr($fileName, $ext);

                    $count = 1;
                    while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                        $count++;

                    $fileName = $fileName_a . '_' . $count . $fileName_b;
                }

                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


                // Remove old temp files	
                if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
                    while (($file = readdir($dir)) !== false) {
                        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                        // Remove temp file if it is older than the max age and is not the current file
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                            @unlink($tmpfilePath);
                        }
                    }

                    closedir($dir);
                } else {
                    throw new ZendT_Exception_Error('Failed to open temp directory.', 100);
                }

                // Look for the content type header
                if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
                    $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

                if (isset($_SERVER["CONTENT_TYPE"]))
                    $contentType = $_SERVER["CONTENT_TYPE"];

                // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
                if (strpos($contentType, "multipart") !== false) {
                    if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                        // Open temp file
                        $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                        if ($out) {
                            // Read binary input stream and append it to temp file
                            $in = fopen($_FILES['file']['tmp_name'], "rb");

                            if ($in) {
                                while ($buff = fread($in, 4096))
                                    fwrite($out, $buff);
                            } else {
                                throw new ZendT_Exception_Error('Failed to open input stream.', 101);
                            }
                            fclose($in);
                            fclose($out);
                            @unlink($_FILES['file']['tmp_name']);
                        } else {
                            throw new ZendT_Exception_Error('Failed to open output stream.', 102);
                        }
                    } else {
                        throw new ZendT_Exception_Error('Failed to move uploaded file.', 103);
                    }
                } else {
                    // Open temp file
                    $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                    if ($out) {
                        // Read binary input stream and append it to temp file
                        $in = fopen("php://input", "rb");

                        if ($in) {
                            while ($buff = fread($in, 4096))
                                fwrite($out, $buff);
                        } else {
                            throw new ZendT_Exception_Error('Failed to open input stream.', 104);
                        }
                        fclose($in);
                        fclose($out);
                    } else {
                        throw new ZendT_Exception_Error('Failed to open output stream.', 105);
                    }
                }

                // Check if file has been uploaded
                if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off 
                    @$result = rename("{$filePath}.part", $filePath);
                    if (!$result) {
                        throw new ZendT_Exception_Error('Não foi possível renomear o arquivo.', 1002);
                    }
                }

                if ($this->getRequest()->getParam('platform')) {
                    $_file = new ZendT_File($fileName, file_get_contents($filePath), $_FILES['file']['type']);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $infoFile = $_file->toArrayJson();
                    $infoFile['size'] = $_FILES['file']['size'];
                    $infoFile['type'] = $_FILES['file']['type'];
                    $json->setResult($infoFile);
                } else {
                    $json->setResult(base64_encode($filePath));
                }
            } catch (Exception $Ex) {
                $json->setException($Ex);
            }
            echo $json->toRpc();
        }

    }
    