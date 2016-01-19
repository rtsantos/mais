/**
 * Classe para abertura de janelas modais por AJAX ou janelas de navegador 
 * 
 * @author: rsantos
 * @author: ksantoja
 * @version 2.0 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 * Opções:
 * 
 * - type(str): Define o tipo de janela que será aberto. Possiveis: AJAX,WINDOW; Default AJAX
 * - id(str): Define um id para a o recepiente da nova janela; Default NewWindow;
 * - url(str): Define a url que será aberta pela janela; Default about:blank
 * - param(str): Parametros que serão passados para a nova janela; Default ajaxModal=1
 * - method(str): Metodo de envio das informações para a janela. Possiveis: POST,GET; ; Default 'POST'
 * - title(str): Titulo da janela que será aberta; Default null;
 * - height(int): Define a altura da nova janela; Default: 500;
 * - width(int): Define a largura da nova janela; Default: 600;
 * - modal(bol): Define se a janela será modal ou não; Default: true;
 * - buttons(): Define os botões da janela; Default: null; 
 * - scrolling(str): Permite ou não a barra de rolagem na janela; Default yes;
 * - onClose(): Define uma função que será executada quando a janela for fechada; Default: null;
 * - onBeforeClose(): Define uma função para ser executada antes da janela ser fechada; Default: null;
 * - onAfterLoad(): Define uma função para ser executada quando a janela for carregada; Default: null;
 * - onCreate(): Define uma função para ser executada quando a janela for criada;Default: null;
 *
 * @example
 *   $.TWindow({  id:'win-teste'
              ,  url:'teste.php'
			  ,param:'p1=a&p2=b' });
 */
(function( $ ) {
    $.widget( 'ta.TWindow',{
        options: {
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
        },
        /**
         * Método construtor
         *
	 * @access private
	 * @return void
	 */
        _create: function(){
            var self = this;           
            this.objWindow = false;
            if(self.options.autoLoad == true){
                self.open();
            }
            self.options.onClose = function (){
                var vForm = $('#' + self.options.id).find('form');
                /**
				 * Pega o resultado obtido
				 */
                self.options.result = vForm.eq(0).find('input[name=fieldResult]').val();				
				
                $('#' + self.options.id).html('');
                $('#' + self.options.id)[0].objWindow = null;
                if (self.options.beforeClose != null){
                    self.options.beforeClose(self.options.result);
                }
            }
                        
        },
        
        /**
         * Método para criar e abrir a janela 
         *
	 * @access public
	 * @return void
	 */
        
        open: function(){
            var self = this;
            var v_create_dialog = false;
            if (!document.getElementById(self.options.id)){
                this.vDiv = $('<div></div>')
                .attr('id',self.options.id)
                .appendTo('body');
                v_create_dialog = true;
                $('#' + self.options.id)[0].objWindow = null;
            }else{
                this.vDiv = $('#'+self.options.id);
            }
                        

            if (!self.options.param) self.options.param = 'idWindow='+self.options.id+'&typeModal=' + self.options.type;			
            else self.options.param = 'idWindow='+self.options.id+'&typeModal='+ self.options.type + '&' + self.options.param;
            
            if (self.options.type.toUpperCase() == 'AJAX'){
                var alertWindowTop = Math.ceil(($(window).height()  - 25 ) /2 );
                var alertWindowleft = Math.ceil(($(window).width()  - 130 ) /2 );
                if (alertWindowTop < 0) alertWindowTop = 0;
                if (alertWindowleft < 0) alertWindowleft = 0;
                $('<div></div>')
                .attr('id','alert-window-'+self.options.id)
                .html('Carregando..')
                .width(130)
                .css('text-align','center')
                .height(25)
                .addClass('loading ui-state-default ui-state-active  ui-corner-all')
                .css('top',alertWindowTop)
                .css('left',alertWindowleft)
                .css('position','absolute')
                .prependTo('body');
                $.ajax({
                    type: self.options.method,
                    url: self.options.url,
                    data: self.options.param,
                    success: function(p_html){
                        self.vDiv.html(p_html);
                        var v_title = self.vDiv.find('.title-ajax-modal').eq(0).html();
                        self.vDiv.attr('title',v_title);
                        $('button.ui-state-default').hover(
                            function(){
                                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                            },
                            function(){
                                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                            }
                            );
				   	
                        try{
                            var vForm = self.vDiv.find('form');
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
                            alert(erro);
                        }
				   	
                        self.options.close = function (event, ui){
                            this.innerHTML = '';
                        };
                        
                        if (v_create_dialog){
                            self.vDiv.dialog({
                                bgiframe: false,
                                autoOpen: true,
                                height: self.options.height,
                                width:self.options.width,
                                modal: self.options.modal,
                                buttons: self.options.buttons,
                                close: self.options.close,
                                beforeClose: self.options.onClose,  
                                closeOnEscape:false
                            });
                        }else{
                            self.vDiv.dialog('open');
                        }
				   	
                        if (self.options.onAfterLoad != null){
                            self.options.onAfterLoad();
                        }
					
                        try{
                            eval(self.vDiv.find('.scripts-js').eq(0).html());
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
                        $('#alert-window-'+self.options.id).html('').hide();
                    }
                    
                });

            }else if (self.options.type.toUpperCase()  == 'WINDOW'){
                var v_top =  Math.ceil(($(window).width()  - self.options.width ) /2 );
                var v_left = Math.ceil(($(window).height() - self.options.height) /2 );
                if (v_top < 0) v_top = 0;
                if (v_left < 0) v_left = 0;
				
                var v_properties = 'width='+ self.options.width;
                v_properties = v_properties + ',height=' + self.options.height;
                v_properties = v_properties + ',top=' + v_top;
                v_properties = v_properties + ',left=' + v_left;
                v_properties = v_properties + ',toolbar=no';
                v_properties = v_properties + ',location=no';
                v_properties = v_properties + ',directories=no';
                v_properties = v_properties + ',status=yes';
                v_properties = v_properties + ',menubar=no';
                v_properties = v_properties + ',scrollbars=yes';
                v_properties = v_properties + ',resizable=yes';
                if(!self.options.id){
                    self.options.id = 'x' + self.options.id.replace('-','_').replace('-','_').replace('-','_');
                }
                if (this.objWindow == false || this.objWindow.closed){
                    this.objWindow = window.open('about:blank', self.options.id, v_properties);
                }
                this.objWindow.document.body.innerHTML = '';
                this.objWindow.document.write('<font size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#8FBF00" style="font-weight:bold">Carregando...</font>');
                this.objWindow.document.write('<script>window.focus();</script>');
                
				
				
                this.objWindow.document.write('<form method="'+ self.options.method +'" action="'+ self.options.url +'">');
                var v_params = self.options.param.split('&');
                var v_param  = null;
                for (var iParam=0; iParam<v_params.length; iParam++){
                    try{
                        v_param = v_params[iParam].split('=');
                        this.objWindow.document.write('<input type="hidden" name="'+v_param[0]+'" value="'+v_param[1]+'">');
                    }catch (err){
                    }
                }
                this.objWindow.document.write('</form>');
                this.objWindow.document.forms[0].submit();
				
                if (this.objWindow != null){
                    this.objWindow.onbeforeunload = self.options.onClose;
                    this.objWindow.onunload = self.options.onClose;
                    if (self.options.onAfterLoad){
                        this.objWindow.onload = self.options.onAfterLoad;
                    }
                }
                this.objWindow.focus();
            }else{
                if (self.options.title == null){
                    self.vDiv.attr('title','Carregando...');
                }else{
                    self.vDiv.attr('title',self.options.title);
                }
                var vSepParam = '?';
                if (self.options.url.indexOf('?') > 0) vSepParam = '&';
                self.vDiv.html('<iframe id="ifr'+ self.options.id +'" name="ifr'+ self.options.id +'" src="'+ self.options.url + vSepParam + self.options.param +'" width="100%" height="100%" border="0" frameborder="0" align="left" noresize="noresize" scrolling="'+ self.options.scrolling +'"></iframe>');
			
                if (v_create_dialog){
                    self.vDiv.dialog({
                        bgiframe: false,
                        autoOpen: true,
                        height: self.options.height,
                        width:self.options.width,
                        modal: self.options.modal,
                        buttons: self.options.buttons,
                        close: self.options.close,
                        beforeClose: self.options.onClose,
                        create: self.options.onCreate
                    });
                }else{
                    self.vDiv.dialog('open');				   
                }
            }	
        },
        
        /**
         * Método para destruir o objeto 
         *
	 * @access private
	 * @return void
	 */
        _destroy: function(){
            var self = this;
            self.vDiv.dialog('destroy');
        },
        
        /**
         * Método habilitar o bloqueio a tela enquanto a janela estiver aberta 
         *
	 * @access public
	 * @return void
	 */
        modalOn: function(){
            var self = this;
            self.options.modal = true;
            self.vDiv.dialog('option','modal',self.options.modal);

        },
        
        
        /**
         * Método desabilitar o bloqueio a tela enquanto a janela estiver aberta 
         *
	 * @access public
	 * @return void
	 */
        modalOff:function(){
            var self = this;
            self.options.modal = false;
            self.vDiv.dialog('option','modal',self.options.modal);
        },
        
        /**
         * Método fechar a janela
         *
	 * @access public
	 * @return void
	 */
        close: function (){
            var self = this;
            self.vDiv.dialog('close');
            self.vDiv.html('');
            if (this.objWindow != false){
                this.objWindow.close();
                this.objWindow = false; 
            }
        }
        
        
    });
    
})(jQuery);