(function($) {
    $.gridButtonSearch = function(options){

        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;
        if (!options.windowHeight) options.windowHeight = 250;
        if (!options.windowWidth) options.windowWidth = 570;
        //	
        options = $.extend(options, options ||{});
		
        var vPostData = jQuery('#' + options.idGrid).getGridParam('postData');
        var vParam = '';
        for (var field in vPostData){
            if (field.substr(0,6) == 'filter'){                
                if (typeof(vPostData[field]) == 'object'){
                    for (var fieldName in vPostData[field]){
                        var paramName = fieldName + '[field]['+fieldName+'field]';
                        eval('var valorPostData = vPostData.'+field+'.'+fieldName+'.field.'+fieldName+'field;');
                        vParam+= '&' + paramName + '=' + valorPostData;
                        var paramName = fieldName + '[mapper]['+fieldName+'mapper]';
                        eval('var valorPostData = vPostData.'+field+'.'+fieldName+'.mapper.'+fieldName+'mapper;');
                        vParam+= '&' + paramName + '=' + valorPostData;
                        var paramName = fieldName + '[op]['+fieldName+'op]';
                        eval('var valorPostData = vPostData.'+field+'.'+fieldName+'.op.'+fieldName+'op;');
                        vParam+= '&' + paramName + '=' + valorPostData;
                        var paramName = fieldName + '[value]['+fieldName+']';
                        eval('var valorPostData = vPostData.'+field+'.'+fieldName+'.value.'+fieldName+';');
                        vParam+= '&' + paramName + '=' + valorPostData;
                    }
                }else{
                    vParam+= '&' + field.substr(6).replace(/\[/,'').replace(/\]/,'') + '=' + vPostData[field];
                }
            }
        }
        vPostData = null;
        
        if(!options.customValidation){
            options.customValidation = '""';
        }
		
        options.fnSearch = function(){objSearchExecute(searchIdGrid,searchCustomValidation)};
        options.fnClear = function(){objSearchClear(searchIdGrid)};
        
        
        
        if (!options.showButtonSearch){
            options.buttons = {
                'Limpar': options.fnClear,
                'Cancelar': function() {
                    window.close();
                }			
            };
        }else{
            options.buttons = {
                'Pesquisar': options.fnSearch,
                'Limpar': options.fnClear,
                'Cancelar': function() {
                    window.close();
                }			
            };			
        }

        $.WindowT.open({
            id: 'win-search-' + options.idGrid,
            type:'WINDOW',
            url: options.url,
            onAfterLoad: "searchIdGrid = '"+options.idGrid+"';\n\
                          searchCustomValidation = "+options.customValidation+"\n;",
            param: 'action_form=search&id_parent=' + options.idRowParent + vParam,
            height: options.windowHeight,
            width: options.windowWidth,
            buttons: options.buttons
        });

    };
})(jQuery);

function objSearchExecute(searchIdGrid,searchCustomValidation){ 
    //var customValidation= options.customValidation+"';
    //var idGrid = '" + options.idGrid + "';
    var vPostData = jQuery('#' + searchIdGrid,top.opener.document).getGridParam('postData'); 
    var sData = jQuery(document).find('form').serializeArray(); 
    var vName = null; 
    for (var item in vPostData){ 
        if (item.substr(0,6) == 'filter' || item == 'postData'){ 
            try { 
                delete vPostData[item];
            } catch (e) {} 
        } 
    } 
    var vIndex = []; 
    for (var idx=0; idx<sData.length; idx++){ 
        vName = sData[idx].name; 
        if (sData[idx].name.indexOf('[]') > 0){ 
            if (vIndex[vName] >= 0){ 
                vIndex[vName] = vIndex[vName] + 1; 
            }else{ 
                vIndex[vName] = 0; 
            } 
            vPostData[vName.replace('[]','['+ vIndex[vName] +']')] = sData[idx].value; 
        }else{ 
            vPostData[vName] = sData[idx].value;	
        } 
    } 
    sData = null; 
    if (searchCustomValidation) 
    { 
        if (window[searchCustomValidation]()) 
        { 
            jQuery('#' + searchIdGrid,top.opener.document).setGridParam({ 
                postData:vPostData 
            });
            top.opener.reloadGrid(searchIdGrid);
            window.close(); 
        } 
    } 
    else 
    { 
        jQuery('#' + searchIdGrid,top.opener.document).setGridParam({ 
            postData:vPostData 
        }); 
        top.opener.reloadGrid(searchIdGrid);
        window.close(); 
    } 
}


function objSearchClear(searchIdGrid) { 
    //var idGrid = idGrid; 
    var vPostData = jQuery('#' + searchIdGrid,top.opener.document).getGridParam('postData');
    for (var item in vPostData){ 
        if (item.substr(0,6) == 'filter' || item == 'postData'){ 
            try { 
            delete vPostData[item]; 
            } catch (e) {} 
        } 
    } 
    jQuery('#' + searchIdGrid,top.opener.document).setGridParam({  
        postData:vPostData 
    }); 
    top.opener.reloadGrid(searchIdGrid);
    window.close(); 
}