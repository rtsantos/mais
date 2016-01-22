<?php

    /**
     * 
     * @category    ZendT
     * @author      ksantoja
     */

    /**
     * jQuery para geração do textarea com editor de texto
     *
     */
    class ZendT_View_Helper_Textarea extends ZendX_JQuery_View_Helper_UiWidget {

        public function textarea($id, $value = null, array $attribs = array()) {
            $urlPublic = ZendT_Url::getBaseDiretoryPublic();
            $editor = '';
            if (isset($attribs['editor'])){
                $editor = $attribs['editor'];
                unset($attribs['editor']);
            }
            if ($editor) {
                $this->view->headScript()->appendFile($urlPublic . '/scripts/tinymce/jscripts/tiny_mce/tiny_mce.js');
                $listBox = $editor['listBox'];
                $buttonsInline = $editor['buttons'];
                $width = $editor['width'];
                $height = $editor['height'];
                                
                if (!$width) $width = 730;
                if (!$height) $height = 268;                
                $instanceButtons = '';
                $htmlListOptions = '';
                
                if (count($listBox) > 0){
                    foreach($listBox as $name=>$itens){
                        $cmdItens = '';
                        foreach($itens as $item){
                            $cmdItens.= 'mlb.add("'.$item.'", "'.$item.'");';
                        }
                        $instanceButtons.= ','.$name;
                        $htmlListOptions.= '
                        case "'.$name.'":
                            var mlb = cm.createListBox("'.$name.'", {
                                 title : "'.$name.'",
                                 onselect : function(v) {
                                     cm.editor.execCommand("mceInsertContent", false, v);
                                 }
                            });
                            '.$cmdItens.'
                            return mlb;';
                    }
                }

                $htmlButtonsInline = '';
                if (count($buttonsInline) > 0){                    
                    foreach($buttonsInline as $name => $button){                        
                        $instanceButtons.= ','.$name;
                        $htmlButtonsInline.= '
                            editor.addButton("'.$name.'", {
                                title : "'.$button['label'].'",
                                image : "'.$urlPublic.'/scripts/extends/tinymce/img/'.$button['icon'].'",
                                onclick : function() {
                                    '.$button['command'].'
                                }
                            });';
                    }
                }
                        $htmlButtonsInline.= '                                               
                            editor.addButton(\'uiImage\', {
                                title : \'Imagem\',
                                image : "'.$urlPublic.'/scripts/extends/tinymce/img/image.gif",
                                onclick : function() {
                                    mceUploadImage(editor);
                                }
                        });';
                
                $buttons = 'theme_advanced_buttons1: "forecolor,backcolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,uiImage",
                    theme_advanced_buttons2: "bullist,numlist,|,outdent,indent,blockquote,sub,sup,|,formatselect,fontselect,fontsizeselect,fontSize|",
                    theme_advanced_buttons3: "undo,redo,|,cut,copy,paste,pastetext,pasteword,cleanup,|,search,replace,|,link,unlink,|,tablecontrols,newdocument,preview,code,fullscreen",';
                if ($attribs['editor-html'] == 'basic'){
                    $buttons = 'theme_advanced_buttons1: "forecolor,backcolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",';
                    $height = 50;
                }
                
                if ($attribs['editor-html'] == 'comment'){
                    $buttons = 'theme_advanced_buttons1: "emotions,|,bold,italic,underline,strikethrough",';
                    $height = 50;
                }
                
                $js = '
                tinymce.create("tinymce.plugins.'.$id.'ListBoxPlugin", {
                    createControl: function(n, cm) {
                        switch (n) {
                            '.$htmlListOptions.'
                        }
                        return null;
                    }
                });
                tinymce.create("tinymce.plugins.uiImage", {
                    createControl: function(n, cm) {
                        return null;
                    }
                });
                tinymce.PluginManager.add("'.$id.'ListBoxPlugin", tinymce.plugins.'.$id.'ListBoxPlugin);
                tinymce.PluginManager.add("uiImage", tinymce.plugins.uiImage);
                tinyMCE.init
                ({
                    selector: "#'.$id.'",
                    theme: "advanced",
                    plugins: "'.$id.'ListBoxPlugin,autolink,lists,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autoresize",
                    language: "pt",            
                    '.$buttons.'
                    theme_advanced_buttons4: "'.substr($instanceButtons,1).'",
                    theme_advanced_toolbar_location: "top",
                    theme_advanced_toolbar_align: "left",
                    theme_advanced_statusbar_location: "bottom",
                    theme_advanced_resizing: true,
                    content_css : "'.$urlPublic.'/layout/editor.css",
                    paste_text_sticky: true,
                    width : "100%",
                    height : "'.$height.'",
                    autoresize_min_height: "'.$height.'",
                    autoresize_max_height: "'.($height+100).'",
                    setup : function(editor) {
                        '.$htmlButtonsInline.'
                    }

                });';
                $this->jquery->addOnLoad($js);
            }
            $labelCount='';
            if (isset($attribs['maxlength'])){
                $this->view->headScript()->appendFile($urlPublic . '/scripts/jquery/widget/TTextarea.js');
                $js = "jQuery('#$id').TTextarea({maxLength:".$attribs['maxlength']."});";
                $labelCount = '<br /><label id="count_'.$id.'"/>';
                $this->jquery->addOnLoad($js);
            }
            return $this->view->formTextarea($id, $value, $attribs).$labelCount;
        }

    }

?>
