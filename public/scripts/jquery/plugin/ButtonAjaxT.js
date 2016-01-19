if (!loadButtonAjaxT){
    var loadButtonAjaxT = true;
    (function($) {	
        $.ButtonAjaxT = function(options){
            if (!options.url) options.url = null;
            if (!options.param) options.param = '';
            if (!options.method) options.method = 'GET';
            if (!options.onConfirm) options.onConfirm = function(confirm){alert(confirm)};
            if (!options.onAfterLoad) options.onAfterLoad = function(){};

            options = $.extend(options, options ||{});

            var vParam = 'ajaxModal=1';
            var confirmacao = $('#confirmacao_comentario').val();
            if (confirmacao){
                vParam+= '&confirmacao_comentario=' + confirmacao;
            }
            if (options.param != ''){
                vParam+= '&' + options.param;
            }

            $.ajax({
                type: options.method,
                url: options.url,
                data: vParam,
                beforeSend: function ( xhr ) {
                    $.BlockT.open();
                },
                complete: function ( xhr ) {
                    $.BlockT.close();
                },
                success: function(result){
                    $.BlockT.close();
                    
                    var vJson = decodeJson(result);
                    if (vJson.exception){
                        $.DialogT.exception(vJson.exception, {onConfirm: options.onConfirm});
                    }else{
                        $.DialogT.open(result, 'Alert', {title:'Aviso!'});
                    }
                }
            });

        };
    })(jQuery);
}