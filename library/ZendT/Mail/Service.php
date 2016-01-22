<?php

    /**
     * 
     */
    class ZendT_Mail_Service {

        /**
         *
         * @var ZendT_Mail_Read
         */
        private $_read;

        /**
         * Verifica se o token é valido
         *
         * @param string $token
         * @return boolean
         * @throws ZendT_Exception_Error 
         */
        private function _tokenIsValid($token) {
            #throw new ZendT_Exception_Error(utf8_decode('Token inválido'),'9999');
            #throw new ZendT_Exception_Error('Token inválido','9999');            
            if (base64_decode($token) != 'MAILSERVER') {
                throw new ZendT_Exception_Error('Token invalido', '9999');
            }
            return true;
        }

        /**
         * Retorna o cabeçalho das mensagens que estão armazenadas
         * em uma determinada pasta
         * Como padrão a pasta de entrada INBOX
         * 
         * @param string $token
         * @param ZendT_Mail_Service_Connection $conn
         * @param string $textSearch
         * @return ZendT_Mail_Service_HeaderMessage
         */
        public function listHeaderMessages($token, $conn, $textSearch = 'ALL') {
            $result = new ZendT_Mail_Service_HeaderMessage();
            $result->service = __METHOD__;
            try {
                #throw new ZendT_Exception(utf8_decode('ção'));
                $this->_tokenIsValid($token);
                $result->id = 1;
                $result->success = 1;
                $result->headerMessages = $this->_getRead($conn)->listHeaderMessages($textSearch);
                if (count($result->headerMessages) > 0) {
                    foreach ($result->headerMessages as $header) {
                        $header->subject = utf8_encode($header->subject);
                    }
                }
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * Remove uma mensagem da caixa de e-mail
         * 
         * @param string $token
         * @param ZendT_Mail_Service_Connection $conn
         * @param string $id
         * @return ZendT_Service_Result
         */
        public function removeMessage($token, $conn, $id) {
            $result = new ZendT_Service_Result();
            $result->service = __METHOD__;
            try {
                $this->_tokenIsValid($token);
                $result->id = $this->_getRead($conn)->deleteMail($id);
                $result->success = 1;
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * Move uma mensagem da caixa de e-mail
         * 
         * @param string $token
         * @param ZendT_Mail_Service_Connection $conn
         * @param string $id
         * @param string $box
         * @return ZendT_Service_Result
         */
        public function moveMessage($token, $conn, $id, $box) {
            $result = new ZendT_Service_Result();
            $result->service = __METHOD__;
            try {
                $this->_tokenIsValid($token);
                $result->id = $this->_getRead($conn)->moveMail($id, $box);
                $result->success = 1;
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * Remove uma mensagem da caixa de e-mail
         * 
         * @param string $token
         * @param ZendT_Mail_Service_Connection $conn
         * @param string $id
         * @param string $to
         * @return ZendT_Service_Result
         */
        public function forwardMessage($token, $conn, $id, $to) {
            $result = new ZendT_Service_Result();
            $result->service = __METHOD__;
            try {
                $this->_tokenIsValid($token);
                $message = $this->_getRead($conn)->getMail($id);
                /**
                 * Monta o e-mail
                 */
                $_mail = new Zend_Mail();
                $_mail->setFrom($message->fromAddress, $message->fromName);
                $_mail->addTo($to);
                $_mail->setSubject($message->subject);

                if ($message->textHtml) {
                    $_mail->setBodyHtml($message->textHtml);
                } else {
                    $_mail->setBodyText($message->textPlain);
                }
                /**
                 * Anexa os arquivos se existir anexo 
                 */
                foreach ($message->getAttachments() as $attachment) {
                    $_mail->createAttachment($attachment->content
                            , Zend_Mime::TYPE_OCTETSTREAM
                            , Zend_Mime::DISPOSITION_INLINE
                            , Zend_Mime::ENCODING_BASE64
                            , $attachment->name);
                }
                /**
                 * Envia o e-mail 
                 * 
                 * Cria o transporte do e-mail autenticado 
                 */
                $transport = new Zend_Mail_Transport_Smtp($conn->host, array(
                            'auth' => 'login',
                            'username' => $conn->user,
                            'password' => $conn->pass
                        ));
                $_mail->send($transport);

                $result->success = 1;
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * Retorna a mensagem de e-mail por completo
         * 
         * @param string $token
         * @param ZendT_Mail_Service_Connection $conn
         * @param string $id
         * @return ZendT_Mail_Service_Message
         */
        public function getMessage($token, $conn, $id) {
            $result = new ZendT_Mail_Service_Message();
            $result->service = __METHOD__;
            try {
                #throw new ZendT_Exception(utf8_decode('ção'));
                $this->_tokenIsValid($token);
                $message = $this->_getRead($conn)->getMail($id);

                #print_r($message);


                $result->dateTime = $message->date;
                $result->subject = utf8_encode($message->subject);
                $result->from = $message->fromAddress;
                $result->to = $message->toString;
                $result->id = $id;

                if ($message->textHtml) {
                    $result->html = 1;
                    $result->bodyArray = $this->_stringToArrayBase64($message->textHtml);
                } else {
                    $result->html = 0;
                    $result->bodyArray = $this->_stringToArrayBase64($message->textPlain);
                }

                foreach ($message->getAttachments() as $attachment) {
                    $_attachment = new ZendT_Mail_Service_Attachment();
                    $_attachment->name = $attachment->name;
                    $_attachment->contentArray = $this->_stringToArrayBase64($attachment->content);
                    $result->attachments[] = $_attachment;
                }
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * Envia uma mensagem de e-mail
         *
         * @param string $token
         * @param ZendT_Mail_Service_Message $message
         * @return ZendT_Service_Result 
         */
        public function sendMessage($token, $message) {
            $result = new ZendT_Service_Result();
            $result->service = __METHOD__;
            try {
                $conn = new ZendT_Mail_Service_Connection();
                $conn->host = 'postmail.tanet.net.br';
                $conn->user = 'ora.ta';
                $conn->pass = 'postmail1020';
                /**
                 * Cria o transporte do e-mail autenticado 
                 */
                $transport = new Zend_Mail_Transport_Smtp($conn->host, array(
                            'auth' => 'login',
                            'username' => $conn->user,
                            'password' => $conn->pass
                        ));
                /**
                 * Monta o e-mail
                 */
                $_mail = new Zend_Mail();
                $_mail->setFrom($message->from);                #@todo colocar nome do e-mail
                $_mail->addTo($message->to);
                $_mail->setSubject($message->subject);
                if ($message->html) {
                    $_mail->setBodyHtml($this->arrayBase64ToString($message->bodyArray));
                } else {
                    $_mail->setBodyText($this->arrayBase64ToString($message->bodyArray));
                }
                foreach ($message->attachments as $attachment) {
                    $_mail->createAttachment($this->arrayBase64ToString($attachment->contentArray)
                            , Zend_Mime::TYPE_OCTETSTREAM
                            , Zend_Mime::DISPOSITION_INLINE
                            , Zend_Mime::ENCODING_BASE64
                            , $attachment->name);
                }
                /**
                 * Envia o e-mail 
                 */
                $_mail->send($transport);

                $result->success = 1;
            } catch (ZendT_Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = $ex->getShow();
                $result->message->notification = $ex->getNotification();
            } catch (Exception $ex) {
                $result->success = 0;
                $result->message->code = $ex->getCode();
                $result->message->message = $ex->getMessage();
                $result->message->show = 1;
                $result->message->notification = 'Error';
            }
            return $result;
        }

        /**
         * 
         * @param ZendT_Mail_Service_Connection $conn
         * @return ZendT_Mail_Read
         */
        private function _getRead($conn) {
            if (!$this->_read instanceof ZendT_Mail_Read) {
                $this->_read = new ZendT_Mail_Read($conn->host, $conn->user, $conn->pass, $conn->box);
            }
            return $this->_read;
        }

        private function _base64Decode($string) {
            if (base64_encode(base64_decode($string)) === str_replace("\n", '', $string)) {
                $string = base64_decode($string);
            }
            return $string;
        }

        /**
         * Transforma uma string em um array de Base 64
         * 
         * @param string $string
         * @return array
         */
        private function _stringToArrayBase64($string) {
            //$contentCut = $this->_base64Decode($string);
            $contentCut = $string;
            $lenBytes = 15000;
            $arrayBase64 = array();
            while (strlen($contentCut) > 0) {
                $arrayBase64[] = base64_encode(substr($contentCut, 0, $lenBytes));
                $contentCut = substr($contentCut, $lenBytes);
            }
            return $arrayBase64;
        }

        /**
         * Transforma um array de Base 64 em string
         *
         * @param array $arrayBase64
         * @return string 
         */
        private function arrayBase64ToString($arrayBase64) {
            $string = '';
            foreach ($arrayBase64 as $base64) {
                $string.= base64_decode($base64);
            }
            return $string;
        }

    }