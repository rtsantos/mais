<?php
    /**
     *  
     */
    class ZendT_Menu_Top {
        /**
        *
        * @var type 
        */
        protected static $_instance = null;
        /**
        * 
        * @return ZendT_Menu_Top
        */
        public static function getInstance() {
            if (null === self::$_instance) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
        /**
        * 
        * @return string
        */
        public function getHtml($app) {
            $_urlBase = "//" . $_SERVER["HTTP_HOST"];
            $menu_logon = array();

            if (isset($_SESSION['logon'])) {
                $menu['class'] = 'selected';
                $menu['href'] = "javascript:jQuery.taWindow.open({id:'winUsuario',url:'" . $_urlBase . "/Application/index.php/acl/index/form-usuario'});";
                $menu['caption'] = $_SESSION['logon']['nome'];
                $menu['title'] = 'Alterar seu cadastro';
                $menu_logon[] = $menu;

                $menu['class'] = 'ta65';
                $menu['href'] = "javascript:jQuery.taWindow.open({id:'winChangePass',url:'" . $_urlBase . "/Application/index.php/index/change-password'});";
                $menu['caption'] = 'Troca de Senha';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                $menu['href'] = "javascript:AbreJanela('" . $_urlBase . "/libext/versao.php?sigla_aplicacao=" . $app . "&amp;action=show&amp;id_usuario=" . $_SESSION['logon']['id_usuario'] . "',400,750)";
                $menu['caption'] = 'Histórico de versões';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                #$menu['href']    = $_urlBase."/intranet/home/index.php";
                $menu['href'] = "javascript:Home();";
                $menu['caption'] = 'Intranet';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                $menu['href'] = $_urlBase . "/sistemas/logon/list_app.php";
                $menu['caption'] = 'Meus sistemas';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                $menu['href'] = ($_SESSION['logon']['aplicacao'] == 'REPS') ? $_urlBase . '/Application/index.php/reps/logon/logout' : $_urlBase . '/Application/index.php/acl/index/logout';
                //$menu['href']    = $_urlBase.'/?logout=1';
                $menu['caption'] = 'Logout';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                #$menu['href']    = '?newPortal=0';
                #$menu['href']    = "javascript:AbreJanela('".$_urlBase."/Application/index.php/acl/index/form-change-version')";
                $menu['href'] = "javascript:AbreJanela('" . $_urlBase . "/libext/layout/change.php?newPortal=0',430,750,'changeLayout'); ";
                $menu['caption'] = 'Versão antiga';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;
            } else {
                $menu['class'] = 'default';
                $menu['href'] = $_urlBase . '/Application/index.php/acl/index/logout';
                $menu['href'] = $_urlBase;
                $menu['caption'] = 'Logar';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                $menu['href'] = $_urlBase . '/Application/index.php/index';
                $menu['caption'] = 'Criar uma conta';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'default';
                $menu['href'] = $_urlBase . '/Application/index.php/index';
                $menu['caption'] = 'Esqueci minha senha';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;

                $menu['class'] = 'ta65';
                $menu['href'] = "javascript:jQuery.taWindow.open({id:'winChangePass',url:'" . $_urlBase . "/Application/index.php/index/change-password'});";
                $menu['caption'] = 'Troca de senha';
                $menu['title'] = $menu['caption'];
                $menu_logon[] = $menu;
            }

            $html = '';
            $sep = false;
            foreach ($menu_logon as $menu) {
                if (!$sep) {
                    $sep = true;
                } else {
                    $html.= ' | ';
                }
                $html.= '<a class="' . $menu['class'] . '" href="' . $menu['href'] . '" title="' . $menu['title'] . '"> ' . $menu['caption'] . ' </a>';
            }
            return $html;
        }
    }
?>