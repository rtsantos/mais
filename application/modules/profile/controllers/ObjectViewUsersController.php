<?php

   class Profile_ObjectViewUsersController extends ZendT_Controller_Action {

       public function init() {
           $this->_init();
           $this->_startupAcl();
           $this->_mapper = new Profile_DataView_ObjectViewPriv_Usuarios();
       }

   }

?>
