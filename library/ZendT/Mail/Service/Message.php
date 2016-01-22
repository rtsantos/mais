<?php
    class ZendT_Mail_Service_Message extends ZendT_Service_Result{
        /**
         *
         * @var string
         */
        public $to;
        /**
         *
         * @var string
         */
        public $from;
        /**
         *
         * @var bool
         */
        public $html;
        /**
         *
         * @var string
         */
        public $subject;
        /**
         *
         * @var string
         */
        public $dateTime;
        /**
         *
         * @var string
         */
        public $body;
        /**
         *
         * @var array
         */
        public $bodyArray;
        /**
         *
         * @var ZendT_Mail_Service_Attachment[]
         */
        public $attachments;
    }