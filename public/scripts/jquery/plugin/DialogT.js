/**
 * Procedimento tem como finalidade exibir mensagens de alerta ao usuário
 * 
 * Usar as chamadas 
 * $.DialogT.open()
 * $.DialogT.exception()
 * $.DialogT.close()
 * 
 * @example $.DialogT.open('Mensagem de Teste','Alert');
 *          $.DialogT.open('Mensagem de Teste','Error');
 *          $.DialogT.open('Mensagem de Teste','Information');
 *          $.DialogT.open('Mensagem de Teste',{id:'dialog-teste',modal:true,width:400,heigth:400});
 *          $.DialogT.exception(json.exception);
 *          $.DialogT.exception(json.exception,{id:'dialog-teste',modal:true,width:400,heigth:400});
 *          $.DialogT.close();
 *          $.DialogT.close('dialog-teste');
 * 
 * Não usar <<<< IMPORTANTE >>>>>
 * $.TDialog será depreciado
 */
(function ($) {
    $.TDialog = function (type, options, title, message) {
        if (title == type) {
            if ($.DialogT.i18n[title]) {
                title = $.DialogT.i18n[title];
            }
        }
        if (!options) {
            options = [];
        }
        var id = (options.id) ? options.id : 'dialog-message';
        var htmlDialog = $('<div id="' + id + '" title="' + title + '" style="width:400px;height:400px;"></div>');
        var containerClass = '';


        var settings = {
            modal: true,
            width: 400,
            height: 300
        }

        if (message.length <= 500 && settings.height == 300) {
            settings.height = 250;
        }

        if (type.toString().toLowerCase() == 'confirm') {
            settings.buttons = {
                'OK': function () {
                    var form = $(this).find('form');
                    var objDialog = this;

                    if (form.attr('action') && form.attr('id') != 'form_confirm') {
                        if (!form.find('input[name=dialog_name]').attr('name')) {
                            var hidden = $('<input type="hidden" name="dialog_name" value="' + $(this).attr('id') + '" />');
                            form.append(hidden);
                        }
                        var dialogName = form.find('input[name=dialog_name]');
                        dialogName.val($(this).attr('id'));

                        if (!form.find('div .zend_form').attr('class')) {
                            form.append($(this).find('div .zend_form'));
                        }

                        var successCallback = null;
                        if (typeof options.success == 'function') {
                            successCallback = options.success;
                        }

                        var validadeFormSave = {
                            submitHandler: function (form) {
                                jQuery(form).ajaxSubmit({
                                    beforeSubmit: function () {
                                        $.BlockT.open();
                                    },
                                    success: function (result, status, form) {

                                        if (successCallback != null) {
                                            successCallback(result);
                                        }

                                        $.BlockT.close();

                                        $(objDialog).dialog('close');
                                        $(objDialog).html('');
                                        $(objDialog).remove();

                                        var vJson = decodeJson(result);
                                        var idDialog = $(form).find('input[name=dialog_name]').val();

                                        if (!vJson.exception) {
                                            $.DialogT.close(idDialog);
                                            $.DialogT.open(result, 'Alert');
                                        } else {
                                            var date = new Date();
                                            date = date.getDay() + '-' + date.getMonth() + '-' + date.getFullYear() + '-' + date.getHours() + '-' + date.getMinutes() + '-' + date.getMilliseconds();
                                            $.DialogT.exception(vJson.exception, {id: 'dialog-message-' + date});
                                        }
                                    }
                                });
                            }
                        };
                        form.validate(validadeFormSave);
                        form.submit();
                    } else if (typeof $(this).dialog('option').onConfirm == 'function') {
                        $(this).dialog('option').onConfirm(true);
                    }
                    $(this).dialog('close');
                    $(this).html('');
                    $(this).remove();
                },
                'Cancel': function () {
                    if (typeof $(this).dialog('option').onConfirm == 'function') {
                        $(this).dialog('option').onConfirm(false);
                    }
                    $(this).dialog('close');
                    $(this).html('');
                    $(this).remove();
                }
            };
        } else {
            if (!settings.buttons) {
                settings.buttons = {
                    OK: function () {
                        $(this).dialog('close');
                        $(this).html('');
                        $(this).remove();
                    }
                };
            }
        }

        options = $.extend(settings, options);
        $('#' + id).dialog("destroy");
        $('#' + id).html('');
        $('#' + id).remove();

        switch (type.toString().toLowerCase()) {
            case 'success':
                containerClass = 'ui-state-success ui-corner-all';
                iconClass = 'ui-icon ui-icon-circle-check';
                break;
            case 'warning':
                containerClass = 'ui-state-highlight ui-corner-all';
                iconClass = 'ui-icon ui-icon-info';
                break;
            case 'alert':
                containerClass = 'ui-state-highlight ui-corner-all';
                iconClass = 'ui-icon ui-icon-info';
                break;
            case 'alerttarja':
                containerClass = 'ui-state-highlight ui-corner-all';
                iconClass = 'ui-icon ui-icon-info';
                break;
            case 'business':
                containerClass = 'ui-corner-all';
                iconClass = 'ui-icon ui-icon-info';
                break;
            case 'information':
                containerClass = 'ui-corner-all';
                iconClass = 'ui-icon ui-icon-info';
                break;
            case 'error':
                containerClass = 'ui-state-error ui-corner-all';
                iconClass = 'ui-icon ui-icon-alert';
                break;
            case 'confirm':
                containerClass = 'ui-state-highlight ui-corner-all';
                iconClass = 'ui-icon ui-icon-help';
                break;
            case 'load':
                containerClass = 'ui-state-highlight ui-corner-all';
                iconClass = 'ui-icon ui-icon-refresh';
                break;
            default:
                containerClass = 'ui-corner-all';
                iconClass = 'ui-icon ui-icon-comment';
                break;
        }

        htmlDialog.html('<div class="container ' + containerClass + ' ui-helper-clearfix" style="padding:5px;margin-left:5px;"><p><span class="message">' + message + '</span></p></div>');
        htmlDialog.dialog(options);
        //if (settings.modal){
        htmlDialog.parent().addClass('border-shadow');
        //}
    }

    $.DialogT = {
        i18n: {
            Confirm: 'Confirmação',
            Information: 'Informação',
            Alert: 'Alerta',
            AlertTarja: 'Alerta',
            Error: 'Erro',
            Business: 'Informação'
        },
        options: {
        },
        open: function (message, type, settings) {
            var optionsDefault = {
                title: 'Alert'
            }
            if (!settings) {
                settings = optionsDefault;
            }
            if (!settings.title) {
                settings.title = title;
            }
            $.DialogT.options = settings;
            $.TDialog(type, settings, settings.title, message);
        },
        exception: function (exception, settings) {
            $.DialogT.options = settings;
            $.TDialog(exception.notification, settings, exception.notification, exception.message);
        },
        ajax: function(url, settings){
            var message = $.ajax({url:url,async:false}).responseText;
            $.DialogT.options = settings;
            if(!settings.title){
                settings.title = 'Informação';
            }
            $.TDialog('Information', settings, settings.title, message);
        },
        iframe: function(url, settings){
			if (typeof settings.id == 'undefined'){
				settings.id = 'dialog-message';
			}
            if(!settings.title){
                settings.title = 'Informação';
            }
			
            $.DialogT.options = settings;

			var message = '<iframe width="100%" height="100%" align="left" frameborder="0" name="ifr-'+ settings.id +'" id="ifr-'+ settings.id +'" src="' + url + '" border="0" noresize="noresize" scrolling="off"></iframe>&nbsp;';
            $.TDialog('blank', settings, settings.title, message);
        },
        close: function (id) {
            if (!id) {
                id = $.DialogT.options.id;
            }

            $('#' + id).dialog("close");
            $('#' + id).dialog("destroy");
            $('#' + id).remove();
            //$('#' + id).html('');
        }
    }
})(jQuery);