<?php

    class Cms_Helper_Feeds {

        public static function feeds($array) {
            if (count($array) > 0) {
                $xhtml = '<div class="content ui-comment">';
                $xhtml.= '<ul id="feeds-messages" class="facescroll" style="height: 500px; width: 360px; overflow: auto;">';

                foreach ($array as $row) {
                    $row['avatar_usuario_conteudo'] = '/Mais/public/layout/images/user.png';

                    $xhtml.= '   <li class="ui-helper-clearfix" id="comment-text">&nbsp;';
                    $xhtml.= '      <div class="header ui-helper-clearfix">&nbsp;';
                    $xhtml.= '         <span class="name">' . $row['nome_usuario_conteudo'] . '</span>';
                    $xhtml.= '         <span class="date">' . $row['dh_conteudo'] . '</span>';
                    $xhtml.= '      </div>';
                    $xhtml.= '      <div class="content ui-helper-clearfix">&nbsp;';
                    $xhtml.= '         <span class="avatar">';
                    $xhtml.= '            <img src="' . $row['avatar_usuario_conteudo'] . '">';
                    $xhtml.= '         </span>';
                    $xhtml.= '         <span class="message comment" style="width:250px;">';
                    if (strip_tags($row['id_conteudo_pai']->get())) {
                        $xhtml.= substr($row['corpo_conteudo'], 0, 100) . '...';
                        $xhtml.= '               <br /><div><span class="ui-icon ui-icon-arrowreturnthick-1-w" style="float:left;">';
                        $xhtml.= '               </span>';
                        $xhtml.= '               <span style="float:left;"><a href="' . $row['url_pai'] . '">';
                        $xhtml.= $row['titulo_conteudo_pai'];
                        $xhtml.= '               </a></span></div>';
                    } else {
                        $xhtml.= '               <a href="' . $row['url'] . '">' . $row['titulo_conteudo'] . '</a>';
                        $xhtml.= '               <br />' . $row['descricao_categoria'];
                    }
                    $xhtml.= '         </span>';
                    $xhtml.= '      </div>';
                    $xhtml.= '   </li>';
                }

                $xhtml.= '</ul><button type="button" style="float:right;" class="ui-button ui-state-default" onClick="clearNotifications();"><span class="ui-icon ui-icon-close" /><span>Limpar</span></button><br />';
                $xhtml.= '</div><script>jQuery(\'#feeds-messages\').alternateScroll();</script>';
            } else {
                
            }

            return $xhtml;
        }

        public static function button($id) {
            if ($id instanceof ZendT_Type) {
                $id = $id->get();
            }
            return '<span id="comment-' . $id . '" class="ui-button-icon">
                       <span class="ui-icon-20 icon-comment">&nbsp;</span>
                       <label id="comment-' . $id . '-qtd">
                           0
                       </label>
                   </span>
                   <script>
                        jQuery(document).ready(function(){
                            jQuery("#comment-' . $id . '").TPopoverTitle({url: \'/Mais/index.php/cms/conteudo/comments/id/' . $id . '\',direction:\'right\'});
                        });
                   </script>';
        }

    }
    