<?php
    /**
     * 
     */
    require_once 'Extra/ImapMailBox/ImapMailbox.php';
    /**
     * 
     */
    class ZendT_Mail_Storage_Imap extends ImapMailbox{
        /**
         *
         * @param string $host
         * @param string $user
         * @param string $pass
         * @param string $mailBox
         */
        public function __construct($host, $user, $pass, $mailBox='INBOX') {
            $imapPath = "{".$host."/notls}" . $mailBox;
            parent::__construct($imapPath, $user, $pass, null, 'iso-8859-1');
            #parent::__construct($imapPath, $user, $pass, null, 'utf-8');
        }
        /**
         * Lista o cabeÃ§alho das 100 primeiras mensagens armazenadas
         *
         * @param string $textSearch
         * @return \ZendT_Mail_Service_HeaderMessage[]
         */
        public function listHeaderMessages($textSearch='ALL'){
            $itens = array();
            $messages = $this->getMailsInfo($this->searchMailbox($textSearch));
            
            $limitMessage = 100;
            $iMessage = 0;
            foreach($messages as $message){
                if ($iMessage == $limitMessage){
                    break;
                }
                $head = imap_rfc822_parse_headers(imap_fetchheader($this->getImapStream(), $message->uid, FT_UID));
                
                $item = new ZendT_Mail_HeaderMessage();
                $item->id = $head->message_id;
                $item->dateTime = date('Y-m-d H:i:s', isset($head->date) ? strtotime($head->date) : time());
                $item->subject = $this->decodeMimeStr($head->subject, $this->serverEncoding);
                $item->from = strtolower($head->from[0]->mailbox . '@' . $head->from[0]->host);
                
                $toStrings = array();
                foreach ($head->to as $to) {
                    if (!empty($to->mailbox) && !empty($to->host)) {
                        $toEmail = strtolower($to->mailbox . '@' . $to->host);
                        $toName = isset($to->personal) ? $this->decodeMimeStr($to->personal, $this->serverEncoding) : null;
                        $toStrings[] = $toName ? "$toName <$toEmail>" : $toEmail;
                    }
                }
                $item->to = implode(', ', $toStrings);
                
                $itens[] = $item;
                $iMessage++;
            }
            return $itens;
        }
        /**
         * Retorna o número da mensagem para remover ou deletar
         *
         * @param string $mailId
         * @return int 
         */
        private function _getNumMessage($mailId){
            $found = false;
            $messages = $this->getMailsInfo($this->searchMailbox());
            $numMessage = 0;
            foreach($messages as $message){
                if ($message->message_id == $mailId){
                    $numMessage = $message->uid;
                    $found = true;
                    break;
                }
            }
            if (!$found){
                throw new ZendT_Exception_Alert('E-Mail não encontrado, verifique a identificação e pasta!');
            }
            return $numMessage;
        }
        /**
         *
         * @param string $mailId
         * @return IncomingMail 
         */
        public function getMail($mailId) {
            $mail = parent::getMail($this->_getNumMessage($mailId));
            return $mail;
        }
        /**
         * Move uma mensagem da caixa postal
         *
         * @param string $mailId
         * @param string $mailBox
         * @return bool
         * @throws Exception 
         */
        public function moveMail($mailId, $mailBox) {
            @$result = parent::moveMail($this->_getNumMessage($mailId), $mailBox);
            if (!$result){
                set_time_limit(3);
                throw new Exception('moveMail Error: ' . imap_last_error());
            }
            return $result;
        }
        /**
         * Remove uma mensagem da caixa postal
         *
         * @param string $mailId
         * @return bool
         * @throws Exception 
         */
        public function deleteMail($mailId) {
            @$result = parent::deleteMail($this->_getNumMessage($mailId));
            if (!$result){
                set_time_limit(3);
                throw new Exception('deleteMail Error: ' . imap_last_error());
            }
            return $result;
        }
    }