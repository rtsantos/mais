(function($) {	
    $.gridButtonXls = function( options ){
        var vPostData = jQuery('#' + options.idGrid).getGridParam('postData');
        var vParam = '';
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
            data: vParam.substr(1)
        });
    }
})(jQuery);
