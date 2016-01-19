(function($) {	
    $.gridButtonDefault = function(options){
        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;
        if (!options.param) options.param = '';

        options = $.extend(options, options ||{});

        var vPostData = jQuery('#' + options.idGrid ).getGridParam('selrow');       
        var vParam = '&id=' + vPostData;
        vParam+= '&noPage=true';
        if (options.param != ''){
            vParam+= '&' + options.param;
        }
        if(options.url != null){
            $.WindowT.open({
                id: 'win-default-' + options.idGrid,
                type:'WINDOW',
                url: options.url,
                param: vParam,
                height: options.windowHeight,
                width: options.windowWidth,
                buttons: options.buttons
            });
        }
    };
})(jQuery);

(function($) {
    $.gridButtonDownload = function(options){
        var vPostData = jQuery('#' + options.idGrid).getGridParam('postData');
                
        if (jQuery('#' + options.idGrid ).jqGrid('getGridParam','multiselect')) {
            var vParam = 'id=' + jQuery('#' + options.idGrid).getGridParam('selarrrow');
        } else {
            var vParam = 'id=' + jQuery('#' + options.idGrid).getGridParam('selrow');
        }
        
        var jsonFilter = getURLParameter('filter_json');
        if(jsonFilter && jsonFilter != 'null'){
            vPostData['filter_json'] = jsonFilter;
        }
        for (var field in vPostData){
            if(typeof(vPostData[field]) != 'object'){
                vParam+= '&' + field + '=' + vPostData[field];
            }else{
                for (var campo in vPostData[field]){
                    vParam+= '&'+replace(vPostData[field][campo]['field'][campo+'field'],'.','-')+ '=' + vPostData[field][campo]['value'][campo];
                }
            }
        }    

        if (jQuery('form')){
            var dataForm = jQuery('form').serializeArray();
            for(var index=0; index<dataForm.length; index++){
                vParam+= '&' + dataForm[index].name + '=' + dataForm[index].value;
            }
        }
        
        downloadFile({
            url: options.url,
            data: vParam
        });
    };
})(jQuery);

(function($) {	
    $.gridButtonWindow = function(options){
        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;
        if (!options.param) options.param = '';
        if (!options.paramFunction) options.paramFunction = null;
        if (!options.type) options.type = '';
        if (!options.method) options.method = 'GET';

        options = $.extend(options, options ||{});
        
        if (jQuery('#' + options.idGrid ).jqGrid('getGridParam','multiselect')) {
            var vPostData = jQuery('#' + options.idGrid ).getGridParam('selarrrow');
        } else {
            var vPostData = jQuery('#' + options.idGrid ).getGridParam('selrow');
        }
        
        var vParam = '&id=' + vPostData;
        //vParam+= '&page=false';
        if (options.param != ''){
            vParam+= '&' + options.param;
        }
        if (options.paramFunction != null){
            vParam+= '&' + options.paramFunction();
        }
        $.WindowT.open({
            id: 'win-default-' + options.idGrid,
            type:'WINDOW',
            url: options.url,
            param: vParam,
            height: options.windowHeight,
            width: options.windowWidth,
            method: options.method,
            buttons: options.buttons
        });
    };
})(jQuery);

(function($) {	
    $.gridButtonAjax = function(options){
        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;
        if (!options.param) options.param = '';
        if (!options.method) options.method = 'POST';
        if (!options.onConfirm) options.onConfirm = function(confirm){alert(confirm)};
        if (!options.onAfterLoad) options.onAfterLoad = function(){};

        options = $.extend(options, options ||{});

        if (jQuery('#' + options.idGrid ).jqGrid('getGridParam','multiselect')) {
            var vPostData = jQuery('#' + options.idGrid ).getGridParam('selarrrow');
        } else {
            var vPostData = jQuery('#' + options.idGrid ).getGridParam('selrow');
        }
     
        var vParam = '&id=' + vPostData;
        vParam+= '&noPage=true';
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
                    $.DialogT.exception(vJson.exception, {onConfirm: options.onConfirm, modal: true});
                }else{
                    $.DialogT.open(result, 'Alert', {title:'Aviso!', modal: true});
                    options.onAfterLoad();
                }
            }
        });
    };
})(jQuery);

(function($) {	
    $.gridButtonAjaxConfirm = function(options){
        if (!options.message) options.message = 'Deseja continuar com ação?';
        
        $.TDialog('confirm', {onConfirm: function(confirm){
                if (confirm){
                    $.gridButtonAjax(options);
                }
        }, modal: true}, 'Confirmação', options.message);
    };
})(jQuery);