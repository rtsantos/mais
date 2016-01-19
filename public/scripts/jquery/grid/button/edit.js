(function ($) {
    $.gridButtonEdit = function (options) {
        if (!options.idGrid)
            options.idGrid = null;
        if (!options.url)
            options.url = null;
        if (!options.urlRetrive)
            options.urlRetrive = 'retrive';
        if (!options.onAfterLoad)
            options.onAfterLoad = null;
        if (!options.onBeforeClose)
            options.onBeforeClose = null;
        if (!options.windowHeight)
            options.windowHeight = 250;
        if (!options.windowWidth)
            options.windowWidth = 570;
        if (!options.type)
            options.type = 'WINDOW';
        if (!options.modal)
            options.modal = false;
        if (!options.afterLoad)
            options.afterLoad = true;

        options = $.extend(options, options || {});

        var vIdSelRow = jQuery('#' + options.idGrid).getGridParam('selrow');
        if (vIdSelRow == null) {
            alert('Favor selecionar uma linha!');
            return false;
        }

        options.idRow = vIdSelRow;


        if (options.afterLoad) {
            options._onAfterLoad = "editIdGrid = '" + options.idGrid + "';\n\
                                    editIdRow = '" + options.idRow + "';\n\
                                    editUrlRetrive = '" + options.urlRetrive + "';\n";

            if (options.AfterLoad != null) {
                options._onAfterLoad += options.AfterLoad.replace(/function/, "function editOnAfterLoad");
            }

            options._onAfterLoad += "_editOnAfterLoad();\n";
        } else {
            options._onAfterLoad = null;
        }



        options.buttons = {
            'Salvar': {
                onClick: function () {
                    editSaveButton(editIdGrid);
                },
                icon: 'ui-icon-disk'
            },
            'Cancelar': {
                onClick: function () {
                    window.close();
                },
                icon: 'ui-icon-cancel'
            },
            'Próximo': {
                onClick: function () {
                    editProximoButton(editIdGrid);
                },
                icon: 'ui-icon-seek-next'
            },
            'Anterior': {
                onClick: function () {
                    editAnteriorButton(editIdGrid);
                },
                icon: 'ui-icon-seek-prev'
            }
        };
        $.WindowT.open({
            id: 'win-edit-' + options.idGrid,
            url: options.url,
            type: options.type,
            param: 'id=' + vIdSelRow + '&action_form=update',
            height: options.windowHeight,
            width: options.windowWidth,
            onAfterLoad: options._onAfterLoad,
            beforeClose: options.onBeforeClose,
            buttons: options.buttons,
            modal: options.modal
        });

    };
})(jQuery);


function editRetriveSuccess(result) {
    var vJson = decodeJson(result);
    if (!vJson) {
        jQuery('#win-edit-' + editIdGrid).find('.ta-message-erro').html(result);
        jQuery('#win-edit-' + editIdGrid).find('.ui-state-error').show();
    } else {
        var vIndexName = '';
        var vForm = jQuery('form');
        var objField = null;
        for (var field in vJson) {
            try {
                if (vJson[field] == null){
                    vJson[field] = '';
                }
                
                 if (jQuery('input[name="'+ field.toLowerCase() +'[]"]').eq(0).attr('type') == 'checkbox') {                    
                    var vCheck = jQuery('input[name="'+ field.toLowerCase() +'[]"]');
                    for (var vIndex = 0; vIndex < vCheck.length; vIndex++) {
                        vCheck.removeAttr('checked');
                    }
                    
                    for (var vIndex = 0; vIndex < vCheck.length; vIndex++) {                        
                        for (var vValue in vJson[field]) {
                            if (vCheck.eq(vIndex).val() == vJson[field][vValue]) {
                                vCheck.eq(vIndex).prop('checked',"checked");                                
                            }
                        }
                    }
                } else if (jQuery(vForm[0].elements[field.toLowerCase()]).attr('type') == 'select' || jQuery(vForm[0].elements[field.toLowerCase()]).attr('type') == 'select-one' || jQuery(vForm[0].elements[field.toLowerCase()]).get(0).tagName.toLowerCase() == 'select') {
                    var select = jQuery(vForm[0].elements[field.toLowerCase()]).find('option');
                    for (var index = 0; index < select.length; index++) {
                        if (vJson[field] == select.eq(index).html()) {
                            vJson[field] = select.eq(index).val();
                            break;
                        }
                    }
                    $(vForm[0].elements[field.toLowerCase()]).val(vJson[field]);
                } else if (jQuery(vForm[0].elements[field.toLowerCase()]).attr('TAutoSelect') == '1') {
                    var role = jQuery(vForm[0].elements[field.toLowerCase()]).attr('role');
                    if (role != '') {
                        $(vForm[0].elements[role.toLowerCase()]).TAutoSelect('select', vJson[field], vJson[role]);
                    }
                } else if (vJson[field] != null) {
                    if (typeof vJson[field] == 'object') {                        
                        var searchField = jQuery(vForm[0].elements[field.toLowerCase()]).attr('searchid');
                        if (searchField != '') {
                            $('#' + searchField).TSeeker('loadData', vJson[field], 'edit');
                        }
                        var nameId = jQuery(vForm[0].elements[field.toLowerCase()]).attr('field');
                        if (!nameId){
                            nameId = 'id';
                        }
                        vJson[field] =  vJson[field][nameId];
                    }
                    objField = vForm[0].elements[field.toLowerCase()];
                    if (!objField) {
                        for (var index = 0; index < vForm[0].elements.length; index++) {
                            if (jQuery(vForm[0].elements[index]).attr('field') == field) {
                                objField = vForm[0].elements[index];
                                index = vForm[0].elements.length;
                            }
                        }
                    }
                    if (objField) {
                        objField.value = vJson[field];
                        /**
                         * Verifica se o campo possui instancia para o TSeeker
                         */
                        if ($(objField).Tdata('taTSeeker')) {
                            $(objField).Tdata('taTSeeker').buttonNoFocus();
                            objField.valueold = objField.value;
                            //$('#' + field.toLowerCase()).TSeeker('loadData', vJson, 'edit');
                        }
                    } else if (typeof vJson[field] == 'object') {
                        for (var i in vJson[field]) {
                            $(vForm[0]).find("#" + field + '-' + vJson[field][i]).attr('checked', true);
                        }
                    } else {
                        $(vForm[0]).find("#" + field).val(vJson[field]);
                    }
                }

                if (field == 'id') {
                    $('#' + field.toLowerCase()).trigger('change');
                }
            } catch (ex) {
            }
        }
        for (var field in vJson) {
            try {
                /**
                 * Verifica se o campo possui instancia de widget
                 */
                if ($('#' + field.toLowerCase()).Tdata('TFileUpload')) {
                    $('#' + field.toLowerCase()).TFileUpload('loadFiles', field.toLowerCase());
                } else if ($('#' + field.toLowerCase()).Tdata('TSpreadSheet')) {
                    $('#' + field.toLowerCase()).TSpreadSheet('loadData', vJson[field.toLowerCase()]);
                } else if ($('#' + field.toLowerCase()).Tdata('TQueryBuilder')) {
                    $('#' + field.toLowerCase()).TQueryBuilder('loadData', vJson[field.toLowerCase()]);
                } else if ($('#' + field.toLowerCase()).Tdata('TDateTime')) {
                    $('#' + field.toLowerCase()).TDateTime('loadData', vJson[field.toLowerCase()]);
                }
            } catch (ex) {
            }
        }
    }
}
;

function _editOnAfterLoad(result) {
    if (result == null) {
        result = editRetriveData(editIdRow);
    }
    ;
    if (typeof window.editOnAfterLoad == 'function') {
        window.editOnAfterLoad(result);
    }
}

function editRetriveGroupRepeatData(id) {
    $("div").find("[id^=display-group-][group_repeat!='']").each(function () {
        var table = $(this).attr('group_repeat_table');
        var urlRetrive = $(this).find('#' + table + '-controller').val();
        var column = $(this).find('#' + table + '-column').val();
        var ids = id.split('-');
        var filter = '';

        if (column) {
            var columns = column.split('-');
        } else {
            var columns = [];
        }

        for (var i in columns) {
            if (filter) {
                filter = filter + '&';
            }
            filter = filter + columns[i] + '=' + ids[i];
        }

        groupContent = $.ajax({
            type: 'POST',
            url: urlRetrive,
            data: filter + '&findAll=1',
            async: false
        }).responseText;

        //alert(groupContent);
        var vGroupRepeatJson = decodeJson(groupContent);
        //console.log(vGroupRepeatJson);

        if (vGroupRepeatJson['found'] != false) {
            var size = 0;
            for (var key in vGroupRepeatJson) {
                if (vGroupRepeatJson.hasOwnProperty(key))
                    size++;
            }
            var newvGroupRepeatJson = [];
            for (var i = size - 1, j = 0; i >= 0; i--, j++) {
                newvGroupRepeatJson[i] = vGroupRepeatJson[j];
            }
            vGroupRepeatJson = newvGroupRepeatJson;

            for (var i in vGroupRepeatJson) {
                if (i > 0) {
                    $(this).find('.form-group-content').last().find('[id^="btn_add_"]').click();
                }
                for (var j in vGroupRepeatJson[i]) {
                    var field = '#' + table + '-' + j + '-' + i;
                    var element = $(this).find('.form-group-content').find(field).val(vGroupRepeatJson[i][j]);
                }
            }
        }
    });
}

function editRetriveData(id) {
    bodyContent = $.ajax({
        type: 'POST',
        url: editUrlRetrive,
        data: 'id=' + id,
        async: false,
        success: editRetriveSuccess
    }).responseText;
    var vDecodeJson = decodeJson(bodyContent);
    editRetriveGroupRepeatData(id);
    return vDecodeJson;
}

function editSaveButton(editIdGrid) {
    var vForm = jQuery('form');
    var validadeFormSave = {
        submitHandler: function (form) {
            jQuery(form).ajaxSubmit({
                success: function (result) {
                    var vJson = decodeJson(result);
                    if (!vJson) {
                        $.DialogT.open(result, 'Error', {title: 'Erro!'});
                    } else {
                        if (vJson.exception) {
                            $.DialogT.exception(vJson.exception, {id: 'dialog-edit-' + editIdGrid});
                        } else {
                            jQuery('#id').val(result);
                            jQuery('#id').trigger('change');

                            top.opener.reloadGrid(editIdGrid);

                            if (typeof window.onAfterSave == 'function') {
                                window.onAfterSave(result);
                            }

                            if (typeof window.closeAfterSave == 'function') {
                                if (window.closeAfterSave()) {
                                    window.close();
                                }
                            } else {
                                window.close();
                            }
                        }
                    }
                }
            });
        },
        showErrors: function () {
            jQuery('.zend_form .form-group').css('min-height', '60px');
        }
    };
    vForm.validate(validadeFormSave);
    jQuery(vForm).find(':disabled').attr('desativado', true).removeAttr('disabled');
    vForm.submit();
    jQuery(vForm).find('[desativado]').attr('disabled', 'disabled').removeAttr('desativado');
}

function editProximoButton(editIdGrid) {
    var vGrid = jQuery('#' + editIdGrid, top.opener.document);
    var vDatas = vGrid.getDataIDs();
    var vIdSel = vGrid.getGridParam('selrow');
    var pos = jQuery.inArray(vIdSel, vDatas);
    var vResult = [pos, vDatas];
    var dataRetrive = null;
    if (vResult[0] != -1 && vResult[1][vResult[0] + 1]) {
        dataRetrive = editRetriveData(vResult[1][vResult[0] + 1]);
        _editOnAfterLoad(dataRetrive);
        vGrid.setSelection(vResult[1][vResult[0] + 1]);
    }
    return vResult;
}

function editAnteriorButton(editIdGrid) {
    var vGrid = jQuery('#' + editIdGrid, top.opener.document);
    var vDatas = vGrid.getDataIDs();
    var vIdSel = vGrid.getGridParam('selrow');
    var pos = jQuery.inArray(vIdSel, vDatas);
    var vResult = [pos, vDatas];
    var dataRetrive = null;
    if (vResult[0] != -1 && vResult[1][vResult[0] - 1]) {
        dataRetrive = editRetriveData(vResult[1][vResult[0] - 1]);
        _editOnAfterLoad(dataRetrive);
        vGrid.setSelection(vResult[1][vResult[0] - 1]);
    }
    return vResult;
}