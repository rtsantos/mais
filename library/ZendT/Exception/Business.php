<?php
   require_once('ZendT/Exception.php');
   class ZendT_Exception_Business extends ZendT_Exception{
      protected $_notification = 'Business';
      protected $_show = 1;
   }