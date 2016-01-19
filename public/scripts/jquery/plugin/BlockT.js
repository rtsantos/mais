/**
 * Esse procedimento tem como finalidade bloquear a tela do usuário
 * para espera de um processamento
 * 
 * Usar o procedimento
 * $.BlockT.open()
 * $.BlockT.close()
 * 
 * Não usar <<<< IMPORTANTE >>>>>
 * $.TLoadOpen() será depreciado
 * $.TLoadClose() será depreciado
 * 
 * @example $.BlockT.open();
 *          $.BlockT.open({id:'block-teste',title:'Processando rotina ....'},message:'Aguarde o processamento...'});
 *          $.BlockT.close();
 *          $.BlockT.close('block-teste');
 */

(function($) {
    $.TLoadOpen = function (options){
        var optionsDefault = {
            modal: true,
            title: false,
            message: 'Em processamento, aguarde...',
            id: 'div-load'
        };
        if (typeof options != 'undefined'){
            if (typeof options.modal != 'undefined'){
                optionsDefault.modal = options.modal;
            }
            if (typeof options.id != 'undefined'){
                optionsDefault.id = options.id;
            }
            if (typeof options.message != 'undefined'){
                optionsDefault.message = options.message;
            }
            if (typeof options.title != 'undefined'){
                optionsDefault.title = options.title;
            }
        }        
        
        if($('#'+optionsDefault.id).length < 1){
            var content = optionsDefault.message;
            $('body').append(
                $('<div></div>')
                .attr('id',optionsDefault.id)
                .css('display','none')
                .css('text-align','center')
                .html(content)
                .css('color','#F79239')
                .css('font-weight','bold')
            );
            $('#'+optionsDefault.id).prepend(
                $('<div></div>').addClass('loadingIcon').css('float','left')
            );
            $('#'+optionsDefault.id).dialog({
                height: 40,
                width: 250,
                modal: optionsDefault.modal,
                autoOpen: false,
                dialogClass: 'alert',
                resizable: false,
                title: optionsDefault.title,
                close: function(){
                    $(".ui-dialog-titlebar").show();
                }
            });
        }
        if(!optionsDefault.title){
            $(".ui-dialog-titlebar").hide();
        }
        $('#'+optionsDefault.id).dialog('open');
    }
    
    $.TLoadClose = function (id){
        if (!id){
            id = 'div-load';
        }
        $('#' + id).dialog('close');
    }
    
    $.BlockT = {
        open: function(options){
            $.TLoadOpen(options);
            $('.ui-widget-overlay').html('<iframe src="" style="width: 100%; height: 100%; border: none;"></iframe>');
        },
        
        close: function(id){
            $.TLoadClose(id); 
        }
    }
})(jQuery);