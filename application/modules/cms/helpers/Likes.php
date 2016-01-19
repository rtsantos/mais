<?php

    class Cms_Helper_Likes {

        /**
         * 
         * @param array $likes
         * @return string
         */
        public static function likes($idConteudo) {
            $_conteudo = new Cms_DataView_Conteudo_MapperView();
            $likes = $_conteudo->getLikes($idConteudo);
            $itens = '';
            $itens .= '<div class="content">';
            if (count($likes)) {
                $count = 0;
                $maxCount = 5;
                $qtd = count($likes);
                $diff = $qtd - $maxCount;
                $style = "display:block";
                foreach ($likes as $data) {
                    $idConteudo = $data['id']->get();
                    if ($count == $maxCount) {
                        $s = ($diff > 1 ? "s" : "");
                        $itens .= '<label id = "like-' . $idConteudo . '-plus"><a href="javascript:void(0)" onclick="$.Cms_ConteudoController.showLike(' . $idConteudo . ')">e outra' . $s . ' ' . $diff . ' pessoa' . $s . '</a></label>' . "\n";
                        $style = "display:none";
                    }
                    $itens .= '<label style="color:black; ' . $style . '">' . $data['nome_usuario_inc'] . '</label>' . "\n";
                    $count ++;
                }
            } else {
                $itens .= '<label id = "like-' . $idConteudo . '-first" onClick=$("#like-' . $idConteudo . '").click();><a href = "#">Seja o primeiro a Curtir!</a></label>';
            }
            $itens .= '</div>';
            $result = '
                <div class="header">
                ' . $itens . '
                </div>';
            return $result;
        }

        public static function button($id) {
            if ($id instanceof ZendT_Type) {
                $id = $id->get();
            }
            return '<span id="like-' . $id . '" class="ui-button-icon" onclick="jQuery.Cms_ConteudoController.like(\'' . $id . '\')">
                       <span class="ui-icon-20 icon-like">&nbsp;</span>
                       <label id="like-' . $id . '-qtd">
                           0
                       </label>
                   </span>
                   <script>
                        jQuery(document).ready(function(){
                            jQuery("#like-' . $id . '").TPopoverTitle({url: \'/Mais/index.php/cms/conteudo/likes/id/' . $id . '\',direction:\'right\'});
                        });
                   </script>';
        }

    }
    