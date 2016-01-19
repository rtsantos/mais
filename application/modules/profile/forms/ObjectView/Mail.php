<?php
    class Profile_Form_ObjectView_Mail extends ZendT_Form {
        /**
         * Carrega os elementos no formulário para serem renderizado
         * @return void
         */
        public function loadElements($action='') {
            $this->setName('form_confirm');
            
            $to = new ZendT_Form_Element_Text('to');
            $to->setLabel('Destinatários: <i> Para mais de um destinatário use ",". Exemplo: contato@tanet.com.br,contato@talog.com.br </i>');
            $to->setRequired(true);
            $to->addStyle('width', '340px');
            $this->addElement($to);
            
            $subject = new ZendT_Form_Element_Text('subject');
            $subject->setLabel('Assunto:');
            $subject->setRequired(true);
            $subject->addStyle('width', '340px');
            $this->addElement($subject);
            
            $comment = new ZendT_Form_Element_Textarea('comment');
            $comment->setLabel('Mensagem:');
            $comment->setRequired(true);
            $comment->addStyle('width', '340px');
            $comment->addStyle('height', '55px');
            $this->addElement($comment);
        }
    }
?>