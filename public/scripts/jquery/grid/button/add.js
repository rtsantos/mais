(function($) {	
    $.gridButtonAdd = function(options){
        if (!options.idGrid) options.idGrid = null;
        if (!options.url) options.url = null;
        if (!options.windowHeight) options.windowHeight = 250;
        if (!options.windowWidth) options.windowWidth = 570;
        if (!options.onAfterLoad) options.onAfterLoad = null;
        if (!options.onBeforeClose) options.onBeforeClose = null;		
        if (!options.RowParent) options.RowParent = false;
        if (!options.type) options.type = 'WINDOW';
        if (!options.modal) options.modal = false;		

        options = $.extend(options, options ||{});

        if (options.RowParent == true){
            var vIdSelRow = jQuery('#' + options.idGrid ).getGridParam('selrow');
            options.idRowParent = vIdSelRow;
            if (vIdSelRow == null){
                $.TDialog('error', {}, 'Erro', 'Por favor, selecione somente uma linha!');
                return false;
            }
        } else {
            options.idRowParent = '';
        }
        if(!options.onAfterLoad){
            options.onAfterLoad = '';
        }
        options.onAfterLoad+= "\n addIdGrid = '"+options.idGrid+"';\n";
        
        var paramSearch = '';
        if (options.idGrid != null){
            var inputs = jQuery('#gview_'+ options.idGrid +' input');
            for(var index=0; index<inputs.length; index++){
				var element = inputs.eq(index);
				var value = element.val();
				var attrId = element.attr('id');
				if(attrId){
					attrId = attrId.replace('gs_','');
				}
				var fieldName = element.attr('fieldname');
                if (value && attrId != 'id' && fieldName != 'id'){
					if(!fieldName){
						fieldName = attrId;
					}
                    paramSearch = paramSearch + '&' + fieldName + '=' + value;
                }
            }
        }

        options.buttons = {
            'Salvar': {
                onClick: function(){
                    addSaveButton(addIdGrid);
                },
                icon: 'ui-icon-disk'
            },
            'Cancelar': {
                onClick: function(){
                    window.close();
                },
                icon: 'ui-icon-cancel'
            }
        };
		               
        $.WindowT.open({
            id: 'win-add-' + options.idGrid,
            url: options.url,
            type: options.type,
            param: 'action_form=insert&id_parent=' + options.idRowParent + paramSearch,
            height: options.windowHeight,
            width: options.windowWidth,
            onAfterLoad: options.onAfterLoad,
            beforeClose: options.onBeforeClose,
            buttons: options.buttons,
            modal: options.modal
        });
    };
})(jQuery);

function addSaveButton(addIdGrid) {
    var vForm = jQuery('form');
    var validadeFormSave = {
        submitHandler: function(form) {
            jQuery(form).ajaxSubmit({
                success: function (result){
                    var vJson = decodeJson(result);
                    if (!vJson){
                        $.DialogT.open(result, 'Error', {title:'Erro!'});
                    }else{
                        if (vJson.exception){
                            $.DialogT.exception(vJson.exception, {id:'dialog-add-' + addIdGrid});
                        }else{
                            jQuery('#id').val(result);
                            jQuery('#id').trigger('change');
                            
                            top.opener.reloadGrid(addIdGrid);
                            
                            if (typeof window.onAfterSave == 'function'){
                                window.onAfterSave(result);
                            }
                            
                            if (typeof window.closeAfterSave == 'function'){
                                if (window.closeAfterSave()){
                                    window.close();
                                }
                            }else{
                                window.close();
                            }
                        }
                    }
                }
            });
        },
        showErrors: function(){
            jQuery('.zend_form .form-group').css('min-height','60px');
        }
    };

    vForm.validate(validadeFormSave);
    jQuery(vForm).find(':disabled').attr('desativado', true).attr('readonly', true).removeAttr('disabled');
    vForm.submit();
    jQuery(vForm).find('[desativado]').attr('disabled', 'disabled').removeAttr('desativado').removeAttr('readonly');
}