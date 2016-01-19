<?php

    class Cms_Helper_Comments {

        public static function comments($idConteudo) {
            $_conteudo = new Cms_DataView_Conteudo_MapperView();
            $comments = $_conteudo->getComments($idConteudo);
            $xhtml = '';
            foreach ($comments as $row) {
                $xhtml .= '
                    <li class="ui-helper-clearfix" id="comment-text">&nbsp;
                        <div class="header ui-helper-clearfix">&nbsp;
                            <span class="name">' . $row['nome_usuario_inc'] . '</span>
                            <span class="date">' . $row['dh_ini_pub'] . '</span>
                        </div>
                        <div class="content ui-helper-clearfix">&nbsp;
                            <span class="avatar">
                                <img src="' . $row['avatar_usuario_inc'] . '">
                            </span>
                            <span class="message comment" calc-width="-100" calc-width-parent="comment-text">
                                ' . $row['corpo'] . '
                            </span>
                        </div>
                    </li>';
            }
            return $xhtml;
        }

        public static function form($idConteudoPai) {
            $xhtml = '';
            if (Auth_Session_User::getInstance()->authenticated()) {
                $_comentarForm = new Cms_Form_Conteudo_Edit();
                $_comentarForm->loadElements("", "comment");

                $_profile = ZendT_Profile::get('Cms_Form_Conteudo_Edit', '', 'comentario');
                $_comentarForm->loadProfile($_profile);
                $_comentarForm->getElement('corpo')->editorHtml('comment')->setLabel('');
                $_comentarForm->populate(array('id_conteudo_pai' => $idConteudoPai));
                $_comentarForm->loadButtons();

                $nomeUsuario = Auth_Session_User::getInstance()->getName();
                $avatarUsuario = Auth_Session_User::getInstance()->getAvatar();
                $xhtml = '
                <li class="ui-helper-clearfix" id="comment-text">&nbsp;
                    <div class="header ui-helper-clearfix">&nbsp;
                        <span class="name">' . $nomeUsuario . '</span>
                    </div>
                    <div class="content ui-helper-clearfix">&nbsp;
                        <span class="avatar">
                            <img src="' . $avatarUsuario . '">
                        </span>
                        <span class="message comment" calc-width-parent="" calc-width="-100">
                            ' . $_comentarForm . '
                        </span>
                    </div>
                </li>';
            }
            return $xhtml;
        }

    }
    