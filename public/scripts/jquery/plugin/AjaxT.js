/**
 * Esse procedimento tem como finalidade melhorar as chamas em Ajax,
 * tratando os retornos de erro, sobre um DialogT
 * 
 * @example $.AjaxT.json({url:'a.php',data:'a=1',success:function(result){}});
 *          $.AjaxT.submitJson({selector:'form',success:function(result){}});
 */

(function ($) {
    $.AjaxT = {
        options: {
            success: null,
            exception: null
        },
        self: this,
        successJson: function (result, url, data, form) {
            var successCallback = null;
            var json = decodeJson(result);
            if (this.options.success) {
                successCallback = this.options.success;
            }
            if (!json) {
                $.DialogT.open(result, 'Error', {
                    title: 'Erro!'
                });
            } else if (json.exception) {
                jQuery.BlockT.close();
                var options = {};
                if (json.exception.notification.toString().toLowerCase() == 'confirm') {
                    if (form != null || result.indexOf('form_confirm') > 0) {
                        options.onConfirm = function (confirm) {
                            if (confirm) {
                                jQuery.BlockT.open();
                                $.AjaxT.submitJson({
                                    selector: '#form_confirm',
                                    success: function (result) {
                                        jQuery.BlockT.close();
                                        if (successCallback != null) {
                                            successCallback(result);
                                        }
                                    }
                                });
                            }
                        };
                    } else {
                        options.onConfirm = function (confirm) {
                            if (confirm) {
                                $.AjaxT.json({
                                    url: url,
                                    data: data + '&confirm=1',
                                    success: function (result) {
                                        jQuery.BlockT.close();
                                        if (successCallback != null) {
                                            successCallback(result);
                                        }
                                    }
                                });
                            }
                        };
                    }
                }
                if (typeof this.options.exception == 'function') {
                    this.options.exception(json.exception, options);
                } else {
                    if (this.options.success) {
                        options.success = this.options.success;
                    }
                    $.DialogT.exception(json.exception, options);
                }
            } else {
                if (this.options.success) {
                    this.options.success(json);
                }
                return json;
            }
            return false;
        },
        json: function (options) {
            var ajaxT = this;

            if (!options.url) {
                jQuery.DialogT.alert('É necessário informar o parâmetro "options.url"!');
                return false;
            }
            if (!options.data) {
                jQuery.DialogT.alert('É necessário informar o parâmetro "options.data" que representa os dados a serem postados!');
                return false;
            }
            if (options.abort) {
                options.mode = 'abort';
                options.port = options.url;
            }
            if (options.success) {
                ajaxT.options.success = options.success;
            }
            if (typeof options.exception == 'function') {
                ajaxT.options.exception = options.exception;
            }

            ajaxT.options.complete = null;
            if (options.complete) {
                ajaxT.options.complete = options.complete;
            }

            var onComplete = function () {
                if (ajaxT.options.complete != null) {
                    ajaxT.options.complete();
                }
            }

            if (options.async != false) {
                $.ajax({
                    type: 'POST',
                    mode: options.mode,
                    port: options.port,
                    url: options.url,
                    data: options.data,
                    success: function (result) {
                        if (result != '') {
                            return ajaxT.successJson(result, options.url, options.data, null);
                        }
                    },
                    complete: onComplete
                });
            } else {
                var result = $.ajax({
                    type: 'POST',
                    async: options.async,
                    mode: options.mode,
                    port: options.port,
                    url: options.url,
                    data: options.data,
                    complete: onComplete
                }).responseText;
                return decodeJson(result);
            }
        },
        submitJson: function (options) {
            var ajaxT = this;
            if (!options.selector) {
                options.selector = 'form';
            }
            var form = jQuery(options.selector);


            if (options.success) {
                ajaxT.options.success = options.success;
            }

            ajaxT.options.complete = null;
            if (options.complete) {
                ajaxT.options.complete = options.complete;
            }
            ajaxT.options.beforeSubmit = null;
            if (options.beforeSubmit) {
                ajaxT.options.beforeSubmit = options.beforeSubmit;
            }

            var onBeforeSubmit = function () {
                if (ajaxT.options.beforeSubmit != null) {
                    ajaxT.options.beforeSubmit();
                }
            }

            var onSuccess = function (result) {
                ajaxT.successJson(result, null, null, '#form_confirm');
            }

            var onComplete = function () {
                if (ajaxT.options.complete != null) {
                    ajaxT.options.complete();
                }
            }

            var validadeFormSave = {
                submitHandler: function (form) {
                    jQuery(form).ajaxSubmit({
                        beforeSubmit: onBeforeSubmit,
                        success: onSuccess,
                        complete: onComplete
                    });
                }
            };
            /**
             * habilita a validação do formulário
             */
            form.validate(validadeFormSave);
            jQuery(form).find(':disabled').attr('desativado', true).removeAttr('disabled');
            form.submit();
            jQuery(form).find('[desativado]').attr('disabled', 'disabled').removeAttr('desativado');
        },
        submitJqGrid: function (options) {
            var vPostData = jQuery('#' + options.idGrid).getGridParam('postData');

            if ($('#' + options.idForm).valid()) {
                var dataForm = $('#' + options.idForm).serializeArray();
                for (var index = 0; index < dataForm.length; index++) {
                    vPostData[dataForm[index].name] = dataForm[index].value;
                }
            }

            $('#' + options.idGrid).setGridParam({
                postData: {
                    data: vPostData
                }
            });
            $('#' + options.idGrid).trigger('reloadGrid');
        }
    }
})(jQuery);