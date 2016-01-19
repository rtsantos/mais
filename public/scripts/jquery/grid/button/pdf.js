(function($) {	
    $.gridButtonPdf = function(options){
        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;

        options = $.extend(options, options ||{});

        var vPostData = jQuery('#' + options.idGrid).getGridParam('postData');
        var jsonFilter = getURLParameter('filter_json');
        if(jsonFilter && jsonFilter != 'null'){
            vPostData['filter_json'] = jsonFilter;
        }
        var vParam = '';
        for (var field in vPostData){
            vParam+= '&' + field + '=' + vPostData[field];
        }
        
        if (jQuery('form')){
            var dataForm = jQuery('form').serializeArray();
            for(var index=0; index<dataForm.length; index++){
                vParam+= '&' + dataForm[index].name + '=' + dataForm[index].value;
            }
        }

        vParam+= '&noPage=true';
        vPostData=null;
        $.WindowT.open({
            id: 'win-reportpdf-' + options.idGrid,
            type:'WINDOW',
            url: options.url,
            param: 'action_form=search&id_parent=' + options.idRowParent + vParam,
            height: options.windowHeight,
            width: options.windowWidth,
            buttons: options.buttons,
            method: 'GET'
        });
    };
})(jQuery);