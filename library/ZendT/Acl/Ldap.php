<?php

   /**
    * 
    *
    * @author rsantos
    */
   class ZendT_Acl_Ldap {

       protected static $_ldap = null;

       public function __construct() {

           /* $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
             $config = $bootstrap->getOptions();
             $config = $config['ldap']['ta']; */

           $options = array(
              'host' => '192.168.1.199',
              'accountDomainName' => 'ta.local',
              'username' => 'ldapuser',
              'password' => 'tanet5294765',
              'baseDn' => 'DC=ta,DC=local'
           );

           $this->_ldap = new Zend_Ldap($options);
           $this->_ldap->bind();
       }

       private function _dateToTime($date) {
           $winInterval = round($date / 10000000);
           $unixTimestamp = ($winInterval - 11644473600);
           return $unixTimestamp;
       }
       
       /**
        * Busca um usuário através do login informado
        * 
        * @param string $username 
        * @example $this->getUsers('lmarquesi*')
        * @return Zend_Ldap_Collection 
        */
       public function getGroups() {
           $search = $this->_ldap->search("(&(objectCategory=group))");

           $resources = array();

           if ($search) {
               $i = 0;
               foreach($search as $resource){
                   $result = array();
                   $result['name'] = $resource['name'][0];
                   $result['department'] = '';                   
                   $result['last_logon'] = '';
                   $result['mail'] = '';
                   $result['member_of'] = $resource['memberof'];
                   $result['member'] = $resource['member'];
                   $result['source_name'] = $resource['dn'];
                   $result['source_id'] = bin2hex($resource['objectsid'][0]);
                   $result['username'] = $resource['samaccountname'][0];
                   $result['type'] = 'G';
                   $result['enable'] = 1;
                   if ($resource['msnpallowdialin'][0] == 'FALSE'){
                       $result['enable'] = 0;
                   }
                   
                   $resources[] = $result;
                   $i++;
                   
                   if ($i == 100){
                       break;
                   }
               }
           }

           return $resources;
       }

       /**
        * Busca um usuário através do login informado
        * 
        * @param string $username 
        * @example $this->getUsers('lmarquesi*')
        * @return Zend_Ldap_Collection 
        */
       public function getUsers($username = null) {

           $result = new ZendT_Acl_Ldap_Row();

           $samaccountname = '';
           if ($username) {
               $samaccountname = '(samaccountname=' . $username . ')';
           }

           $search = $this->_ldap->search("(&(objectCategory=person)(objectClass=user)" . $samaccountname . ")");

           $resources = array();

           if ($search) {
               $i = 0;
               foreach($search as $resource){
                   echo '<pre>';
                   print_r($resource);
                   echo '</pre>';
                   //exit;
                   $result = array();
                   $result['name'] = $resource['name'][0];
                   $result['department'] = $resource['department'][0];                   

                   $result['last_logon'] = date('d/m/Y H:i:s', $this->_dateToTime($resource['lastlogon'][0]));

                   $result['mail'] = $resource['mail'][0];
                   $result['member_of'] = $resource['memberof'];
                   
                   $result['source_name'] = $resource['dn'];
                   $result['source_id'] = bin2hex($resource['objectsid'][0]);
                   $result['username'] = $resource['samaccountname'][0];
                   $result['type'] = 'P';
                   $result['enable'] = 1;
                   if ($resource['msnpallowdialin'][0] == 'FALSE'){
                       $result['enable'] = 0;
                   }

                   $resources[] = $result;
                   //$resources[] = $result;
                   $i++;
               }
               #$grupos = $this->_ldap->search("(&(objectCategory=group)(mail=*)(member={$search['dn']}))");            

           }

           return $resources;
       }
       
       public function getUser($username){
           $info = $this->getUsers($username);
           return $info[0];
       }

       /**
        * Verifica se o login|usuario informado pertence a algum grupo informado
        * 
        * @param string|ZendT_Acl_Ldap_Row $login
        * @param array $groups 
        */
       public function belongsTo($param, array $groups) {

           $user = null;

           if (!$param instanceof ZendT_Acl_Ldap_Row) {
               $user = $this->getUser($param);
           }

           return in_array($user->listGroups(), $groups);
       }

   }
   