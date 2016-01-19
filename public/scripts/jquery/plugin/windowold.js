(function($) {
    $.taWindow = {
        open: function (options){
            var settings = {
                type: 'AJAX',
                id: 'NewWindow',
                url: 'about:blank',
                param: 'ajaxModal=1',
                method: 'POST',
                title: null,
                height: 500,
                width:600,
                modal: true,
                buttons: null,
                close: null,
                scrolling:'yes',
                beforeClose: null,
                onAfterLoad: null,
                onCreate: null
            };
			
            if(options){
                jQuery.extend(settings, options);
            }
			
            var v_create_dialog = false;
            if (!document.getElementById(options.id)){
                $('#div-windows').append('<div id="'+options.id+'"></div>');
                v_create_dialog = true;
                $('#' + options.id)[0].objWindow = null;
            }
			
            var vDiv = $('#' + options.id);
			
            if (!options.height) options.height = 400;
            if (!options.width) options.width = 600;
            if (!options.type) options.type = 'AJAX';
            if (!options.method) options.method = 'POST';
            if (!options.scrolling) options.scrolling = 'yes';
            if (!options.title) options.title = null;
			
            options.result = null;
			
			
            if (!options.param) options.param = 'idWindow='+options.id+'&typeModal=' + options.type;			
            else options.param = 'idWindow='+options.id+'&typeModal='+ options.type + '&' + options.param;
			
			
            options.onClose = function (){
                var vForm = $('#' + options.id).find('form');
                /**
				 * Pega o resultado obtido
				 */
                options.result = vForm.eq(0).find('input[name=fieldResult]').val();				
				
                $('#' + options.id).html('');
                $('#' + options.id)[0].objWindow = null;
                if (options.beforeClose != null){
                    options.beforeClose(options.result);
                }
            };
			
            if (options.type == 'AJAX'){
                $.ajax({
                    type: options.method,
                    url: options.url,
                    data: options.param,
                    success: function(p_html){
                        vDiv.html(p_html);
                        var v_title = vDiv.find('.title-ajax-modal').eq(0).html();
                        vDiv.attr('title',v_title);
				   	
                        $('button.ui-state-default').hover(
                            function(){
                                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                            },
                            function(){
                                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                            }
                            );
				   	
                        try{
                            var vForm = vDiv.find('form');
                            for (var vIndexForm=0; vIndexForm<vForm.length; vIndexForm++){
                                var vElements = vForm.eq(vIndexForm).find('input,select,textarea');
                                for (var vIndexElement=0; vIndexElement<vElements.length; vIndexElement++){
                                    vElements.eq(vIndexElement).taEscEnter();
                                }	
                            }
                            configTabIndex({
                                form:vForm
                            });
                        }catch (erro){
				   		
                        }
				   	
                        options.close = function (event, ui){
                            this.innerHTML = '';
                        };
				   	
                        if (v_create_dialog){
                            vDiv.dialog({
                                bgiframe: false,
                                autoOpen: true,
                                height: options.height,
                                width:options.width,
                                modal: options.modal,
                                buttons: options.buttons,
                                close: options.close,
                                beforeClose: options.onClose,
                                closeOnEscape:false
                            });
                        }else{
                            vDiv.dialog('open');
                        }
                        //blockAjax({id:options.id});
                        //unblock({id:options.id});
				   	
                        if (options.onAfterLoad != null){
                            options.onAfterLoad();
                        }
					
                        try{
                            eval(vDiv.find('.scripts-js').eq(0).html());
                        }catch(ex){
                            alert(ex);
                        }
                        /**
					 * Posicionado o focus no primeiro elemento
					 */
                        try{
                            var fieldFocus = vForm.eq(0).find('input[name=fieldFocus]').val();
                            if (fieldFocus){
                                vForm.eq(0).find('input[name='+ fieldFocus +']').focus();
                            }
                        }catch(erro){
						
                        }
                    }
                });
            }else if (options.type == 'WINDOW'){
                var v_top =  Math.ceil(($(window).width()  - options.width ) /2 );
                var v_left = Math.ceil(($(window).height() - options.height) /2 );
                if (v_top < 0) v_top = 0;
                if (v_left < 0) v_left = 0;
				
                var v_properties = 'width='+ options.width;
                v_properties = v_properties + ',height=' + options.height;
                v_properties = v_properties + ',top=' + v_top;
                v_properties = v_properties + ',left=' + v_left;
                v_properties = v_properties + ',toolbar=no';
                v_properties = v_properties + ',location=no';
                v_properties = v_properties + ',directories=no';
                v_properties = v_properties + ',status=yes';
                v_properties = v_properties + ',menubar=no';
                v_properties = v_properties + ',scrollbars=yes';
                v_properties = v_properties + ',resizable=yes';
				
                var vNameWindow = 'x' + options.id.replace('-','_').replace('-','_').replace('-','_');
                if (vDiv[0].objWindow == null){
                    vDiv[0].objWindow = window.open('about:blank', vNameWindow, v_properties);
                }else if (vDiv[0].objWindow.closed){
                    vDiv[0].objWindow = window.open('about:blank', vNameWindow, v_properties);
                }
                vDiv[0].objWindow.document.body.innerHTML = '';
                vDiv[0].objWindow.document.write('<font size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#8FBF00" style="font-weight:bold">Carregando...</font>');
                vDiv[0].objWindow.document.write('<script>window.focus();</script>');
				
				
                vDiv[0].objWindow.document.write('<form method="'+ options.method +'" action="'+ options.url +'">');
                var v_params = options.param.split('&');
                var v_param  = null;
                for (var iParam=0; iParam<v_params.length; iParam++){
                    try{
                        v_param = v_params[iParam].split('=');
                        vDiv[0].objWindow.document.write('<input type="hidden" name="'+v_param[0]+'" value="'+v_param[1]+'">');
                    }catch (err){
                    }
                }
                vDiv[0].objWindow.document.write('</form>');
                vDiv[0].objWindow.document.forms[0].submit();
				
                if (vDiv[0].objWindow != null){
                    if (options.onClose){
                        vDiv[0].objWindow.onbeforeunload = options.onClose;
                        vDiv[0].objWindow.onunload = options.onClose;
                    }
                    if (options.onAfterLoad){
                        vDiv[0].objWindow.onload = options.onAfterLoad;
                    }
                }
                vDiv[0].objWindow.focus();
            }else{
                if (options.title == null){
                    vDiv.attr('title','Carregando...');
                }else{
                    vDiv.attr('title',options.title);
                }
                var vSepParam = '?';
                if (options.url.indexOf('?') > 0) vSepParam = '&';
                vDiv.html('<iframe id="ifr'+ options.id +'" name="ifr'+ options.id +'" src="'+ options.url + vSepParam + options.param +'" width="100%" height="100%" border="0" frameborder="0" align="left" noresize="noresize" scrolling="'+ options.scrolling +'"></iframe>');
			
                if (v_create_dialog){
                    vDiv.dialog({
                        bgiframe: false,
                        autoOpen: true,
                        height: options.height,
                        width:options.width,
                        modal: options.modal,
                        buttons: options.buttons,
                        close: options.close,
                        beforeClose: options.onClose,
                        create: options.onCreate
                    });
                }else{
                    vDiv.dialog('open');				   
                }
            }			
        },		
        close: function (options){
            var settings = {
                id: 'NewWindow',
                access:null
            };
			
            if(options){
                jQuery.extend(settings, options);
            }
            if (!options.access) options.access = null;
			
            if (options.access !== null){
                var vDiv = options.access.jQuery('#' + options.id);
            }else{
                var vDiv = jQuery('#' + options.id);
            }
            vDiv.dialog('close');
            vDiv.html('');
            if (vDiv[0].objWindow != null){
                vDiv[0].objWindow.close();
                vDiv[0].objWindow = null; 
            }
        //blockAjax();
        }
    };
})(jQuery);