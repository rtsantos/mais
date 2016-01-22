<?php
   //include 'Layout/User.php';
   class Layout_Content {

       /**
        *
        * @var Layout_Content 
        */
       public static $_instance;

       /**
        *
        * @var string
        */
       private $_doctype;

       /**
        *
        * @var string
        */
       private $_header;

       /**
        *
        * @var string
        */
       private $_title;

       /**
        *
        * @var string
        */
       private $_menuTopApplication;

       /**
        *
        * @var string
        */
       private $_menuTopUser;

       /**
        *
        * @var string
        */
       private $_logo;

       /**
        *
        * @var string
        */
       private $_enviroment;

       /**
        *
        * @var string 
        */
       private $_applicationName;

       /**
        *
        * @var string 
        */
       private $_moduleName;

       /**
        *
        * @var string 
        */
       private $_screenName;

       /**
        *
        * @var string 
        */
       private $_menu;

       /**
        *
        * @var Layout_User
        */
       private $_user = null;

       /**
        *
        * @var string
        */
       private $_formMenu;

       /**
        *
        * @var string 
        */
       private $_body;

       /**
        *
        * @var int
        */
       private $_versionId;

       /**
        *
        * @var string
        */
       private $_versionNum;

       /**
        *
        * @var string
        */
       private $_charset = 'iso-8859-1';

       /**
        *
        * @var string
        */
       private $_buttons;

       /**
        * @var array
        */
       private $_onLoad;

       /**
        * @var boolean
        */
       private $_displayTopMenu;
	   
	   private $_noHeaderApp = false;

       /**
        *
        * @return Layout_Content 
        */
       public static function getInstance() {
           if (self::$_instance instanceof Layout_Content) {
               self::$_instance = new Layout_Content();
           }
           return self::$_instance;
       }

       /**
        *
        * @return string
        */
       public function getDoctype() {
           return $this->_doctype;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setDoctype($value) {
           $this->_doctype = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getHeader() {
           return $this->_header;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setHeader($value) {
           $this->_header = $value;
           return $this;
       }
	   
	   public function setNoHeaderApp($value=false){
           $this->_noHeaderApp = $value;
           return $this;
	   }
	   
	   public function getNoHeaderApp(){
		   return $this->_noHeaderApp;
	   }

       /**
        *
        * @return string
        */
       public function getTitle() {
           return $this->_title;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setTitle($value) {
           $this->_title = strip_tags($value);
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getMenuTopApplication() {
           if ($this->getCharset() == 'utf-8') {
               return utf8_encode($this->_menuTopApplication);
           } else {
               return $this->_menuTopApplication;
           }
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setMenuTopApplication($value) {
           $this->_menuTopApplication = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getMenuTopUser() {
           if ($this->getCharset() == 'utf-8') {
               return utf8_encode($this->_menuTopUser);
           } else {
               return $this->_menuTopUser;
           }
           //return $this->_menuTopUser;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setMenuTopUser($value) {
           $this->_menuTopUser = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getLogo() {
           if ($this->_logo == '') {
               $dns = $_SERVER["HTTP_HOST"];
               $dns = explode('.', $dns);
               $dns = $dns[1];
               if ($dns == 'localhost' || $dns == '' || $dns == '168') {
                   $dns = 'tanet';
               }
               $this->_logo = '/AppTA/public/images/logo-' . $dns . '.gif';
           }
           return $this->_logo;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setLogo($value) {
           $this->_logo = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getEnviroment() {
           if (!$this->_enviroment) {
               $appEnv = getenv('APPLICATION_ENV');
               if ($appEnv == 'development') {
                   $this->_enviroment = ('Homologação');
                   if ($this->getCharset() == 'utf-8') {
                       $this->_enviroment = utf8_encode($this->_enviroment);
                   }
               } elseif ($appEnv == 'testing') {
                   $this->_enviroment = 'Teste';
               }
           }
           return $this->_enviroment;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setEnviroment($value) {
           $this->_enviroment = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getApplicationName() {
           return $this->_applicationName;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setApplicationName($value) {
           $this->_applicationName = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getModuleName() {
           return $this->_moduleName;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setModuleName($value) {
           $this->_moduleName = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getScreenName() {
           return $this->_screenName;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setScreenName($value) {
           $this->_screenName = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getMenu() {
           return $this->_menu;
       }

       /**
        * 
        * @param array $data
        * @return \Layout_Content
        */
       public function setUser($data) {
           $this->_user = new Layout_User($data);
           return $this;
       }
       /**
        * 
        * @return \Layout_User
        */
       public function getUser(){
           if ($this->_user == null){
               $this->_user = new Layout_User(array());
           }
           return $this->_user;
       }

       /**
        *
        * @return string
        */
       public function getFormMenu() {
           if (!$this->_formMenu) {
               if (isset($_SESSION['logon'])) {
                   $this->_formMenu = '
                        <input type="button" id="btVoltar" name="btVoltar" class="inputStyle btVoltar" value="Voltar" title="Voltar" onClick="history.go(-1)">
                    ';
               } else {
                   $this->_formMenu = '
                        <form id="frmLogin" onSubmit="return validaFormLogin();" name="frmLogin" method="POST" action="/sistemas/logon/logon.php?datetime=' . $parametros . '" style="padding:0px; margin:0px;">

                        <input type="hidden" id="nome_campo_pessoal"      name="nome_campo_pessoal">
                        <input type="hidden" id="descricao_campo_pessoal" name="descricao_campo_pessoal">
                        <input type="hidden" id="valida_campo_pessoal"    name="valida_campo_pessoal">
                        <input type="hidden" id="tp_template"             name="tp_template" value="I">
                        <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                        <td class="label">
                                                E-mail/Login
                                        </td>
                                        <td class="label">
                                                Senha
                                        </td>
                                        <td class="label frmLoginResposta">
                                                Resposta
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                                <input type="text" id="usuario" name="usuario" class="cpUsuario" value="" title="E-mail/Login" size="16" maxlength="60" onBlur="onChangeUsuario(this)"/>
                                        </td>
                                        <td>
                                                <input type="password" id="senha" name="senha" class="cpSenha" title="Senha" size="16" maxlength="60" />
                                        </td>
                                        <td class="frmLoginResposta">
                                                <input type="password" id="valor_campo_pessoal" name="valor_campo_pessoal" class="cpReposta" title="Resposta" size="16" maxlength="50" />
                                        </td>
                                        <td rowspan="2">
                                            <button type="submit" id="btOkLogin">
                                                OK
                                            </button>
                                        </td>
                                </tr>
                        </table>
                        </form>
                    ';
               }
           }
           return $this->_formMenu;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setMenu($value, $layout = '') {
           if (is_array($value)) {
               $_menu = new Layout_Menu($value, "", true);
               $value = $_menu->render($layout);
           }
           $this->_menu = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getBody() {
           return $this->_body;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setFormMenu($value) {
           $this->_formMenu = $value;
           return $this;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setBody($value) {
           $this->_body = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getVersionId() {
           return $this->_versionId;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setVersionId($value) {
           $this->_versionId = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getVersionNum() {
           return $this->_versionNum;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setVersionNum($value) {
           $this->_versionNum = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getCharset() {
           return $this->_charset;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setCharset($value) {
           $this->_charset = $value;
           return $this;
       }

       /**
        *
        * @return string
        */
       public function getButtons() {
           return $this->_buttons;
       }

       /**
        *
        * @param string $value
        * @return \Layout_Content 
        */
       public function setButtons($value) {
           $this->_buttons = $value;
           return $this;
       }

       /**
        * @param string $value
        * @param string $index
        */
       public function addOnLoad($value, $index = null) {
           if ($index === null)
               $this->_onLoad[$index] = $value;
           else
               $this->_onLoad[] = $value;
       }

       /**
        * 
        */
       public function getOnLoad() {
           return $this->_onLoad;
       }

       /**
        *
        * @return boolean 
        */
       public function getDisplayTopMenu() {
           return $this->_displayTopMenu;
       }

       /**
        *
        * @param boolean $value
        * @return \Layout_Content 
        */
       public function setDisplayTopMenu($value) {
           $this->_displayTopMenu = $value;
           return $this;
       }

   }

?>
