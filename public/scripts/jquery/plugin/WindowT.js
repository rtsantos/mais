if (!loadedWindowT) {
    var loadedWindowT = true;
    (function ($) {
        $.WindowT = {
            open: function (options) {
                var settings = {
                    type: 'AJAX',
                    id: 'NewWindow',
                    url: 'about:blank',
                    param: 'ajaxModal=1',
                    method: 'GET',
                    name: '',
                    title: null,
                    height: 500,
                    width: 600,
                    modal: true,
                    buttons: null,
                    onClose: null,
                    close: null,
                    scrolling: 'auto',
                    onLoad: null,
                    beforeClose: null,
                    onAfterLoad: null,
                    onCreate: null,
                    refSuper: false
                };

                if (options) {
                    jQuery.extend(settings, options);
                }

                if (!options.name) {
                    options.name = Math.random();
                }

                var v_create_dialog = false;
                if (!document.getElementById(options.id)) {
                    if (!document.getElementById('div-windows')) {
                        $('<div></div>')
                                .attr('id', 'div-windows')
                                .css('display', 'none')
                                .prependTo('body');
                    }
                    $('#div-windows').append('<div id="' + options.id + '"></div>');
                    v_create_dialog = true;
                }

                if (options.refSuper) {

                }
                var vDiv = jQuery('#' + options.id);
                vDiv.attr('typeWindow', options.type);

                if (!options.height)
                    options.height = 400;
                if (!options.width)
                    options.width = 600;
                if (!options.type)
                    options.type = 'AJAX';
                if (!options.method)
                    options.method = 'POST';
                if (!options.scrolling)
                    options.scrolling = 'auto';
                if (!options.title)
                    options.title = null;

                options.result = null;

                options.height = options.height + 15;
                options.width = options.width + 15;


                if (!options.param)
                    options.param = 'idWindow=' + options.id + '&typeModal=' + options.type;
                else
                    options.param = 'idWindow=' + options.id + '&typeModal=' + options.type + '&' + options.param;

                if (options.type == 'AJAX') {
                    options.onClose = function () {
                        $("body").css({"overflow": "auto", "overflow-y": "scroll"});
                        if (typeof beforeClose == 'function') {
                            options.beforeClose();
                        }
                    }

                    $.ajax({
                        type: options.method,
                        url: options.url,
                        data: options.param,
                        success: function (p_html) {
                            vDiv.html(p_html);
                            var v_title = vDiv.find('.title-ajax-modal').eq(0).html();
                            vDiv.attr('title', v_title);

                            $('button.ui-state-default').hover(
                                    function () {
                                        $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                                    },
                                    function () {
                                        $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                                    }
                            );

                            try {
                                var vForm = vDiv.find('form');
                                for (var vIndexForm = 0; vIndexForm < vForm.length; vIndexForm++) {
                                    var vElements = vForm.eq(vIndexForm).find('input,select,textarea');
                                    for (var vIndexElement = 0; vIndexElement < vElements.length; vIndexElement++) {
                                        vElements.eq(vIndexElement).taEscEnter();
                                    }
                                }
                                configTabIndex({
                                    form: vForm
                                });
                            } catch (erro) {

                            }

                            options.close = function (event, ui) {
                                this.innerHTML = '';
                            };

                            if (v_create_dialog) {
                                vDiv.dialog({
                                    bgiframe: false,
                                    autoOpen: true,
                                    height: options.height,
                                    width: options.width,
                                    modal: options.modal,
                                    buttons: options.buttons,
                                    close: options.close,
                                    beforeClose: options.onClose,
                                    closeOnEscape: false
                                });
                            } else {
                                var theDialog = vDiv.dialog(options);
                                theDialog.dialog('open');
                            }

                            var height = vDiv.css('height');
                            if (!height){
                                height = (options.height-50) + 'px';
                            }
                            vDiv.removeAttr('style');
                            vDiv.css('width', '100%');
                            vDiv.css('height', height);

                            //blockAjax({id:options.id});
                            //unblock({id:options.id});

                            if (options.onAfterLoad != null) {
                                options.onAfterLoad();
                            }
                            $("body").css({"overflow": "hidden"});

                            try {
                                eval(vDiv.find('.scripts-js').eq(0).html());
                            } catch (ex) {
                                alert(ex);
                            }
                            /**
                             * Posicionado o focus no primeiro elemento
                             */
                            try {
                                var fieldFocus = vForm.eq(0).find('input[name=fieldFocus]').val();
                                if (fieldFocus) {
                                    vForm.eq(0).find('input[name=' + fieldFocus + ']').focus();
                                }
                            } catch (erro) {

                            }
                        }
                    });
                } else if (options.type == 'WINDOW') {
                    //Desabilitando modal
                    options.modal = false;
                    var v_properties = '';

                    var v_top = Math.ceil((screen.height - options.height) / 2);
                    var v_left = Math.ceil((screen.width - options.width) / 2);
                    if (v_top < 0)
                        v_top = 0;
                    if (v_left < 0)
                        v_left = 0;

                    v_properties = 'width=' + options.width;
                    v_properties = v_properties + ',height=' + options.height;
                    v_properties = v_properties + ',top=' + v_top;
                    v_properties = v_properties + ',left=' + v_left;
                    v_properties = v_properties + ',toolbar=no';
                    v_properties = v_properties + ',location=no';
                    v_properties = v_properties + ',directories=no';
                    v_properties = v_properties + ',status=yes';
                    v_properties = v_properties + ',menubar=no';
                    v_properties = v_properties + ',scrollbars=yes';
                    v_properties = v_properties + ',resizable=yes';
                    if (options.modal && !window.showModalDialog) {
                        v_properties = v_properties + ',modal=yes';
                    }
                    var nameWindow = 'windoName_' + options.name;
                    nameWindow = nameWindow.replace('.', '');
                    nameWindow = nameWindow.replace(' ', '');

                    for (var index in options.buttons) {
                        if (options.buttons[index]['onClick']) {
                            options.param += '&buttons[' + index + '][icon]=' + encodeURIComponent(options.buttons[index]['icon']);
                            options.param += '&buttons[' + index + '][onClick]=' + encodeURIComponent('base64:' + Base64.encode(options.buttons[index]['onClick'] + ''));
                        } else if (options.buttons[index]) {
                            options.param += '&buttons[' + index + '][onClick]=' + encodeURIComponent('base64:' + Base64.encode(options.buttons[index] + ''));
                        }
                    }
                    if (options.onAfterLoad) {
                        options.param += '&afterLoad=' + encodeURIComponent('base64:' + Base64.encode(options.onAfterLoad + ''));
                    }
                    if (options.onClose) {
                        options.param += '&onClose=' + encodeURIComponent('base64:' + Base64.encode(options.onClose + ''));
                    }

                    if (options.method == 'GET' && $.browser.msie && substr($.browser.version, 0, 1) * 1 == 9) {
                        var vSepParam = '?';
                        if (options.url.indexOf('?') > 0)
                            vSepParam = '&';
                        vDiv[0].objWindow = window.open(options.url + vSepParam + options.param, nameWindow, v_properties);
                    } else {
                        vDiv[0].objWindow = window.open('about:blank', nameWindow, v_properties);

                        options.name = 'x' + options.id.replace('-', '_').replace('-', '_').replace('-', '_');
                        vDiv[0].objWindow.document.body.innerHTML = '';
                        vDiv[0].objWindow.document.write('<font size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#8FBF00" style="font-weight:bold">Carregando...</font>');
                        vDiv[0].objWindow.document.write('<script>window.focus();</script>');


                        vDiv[0].objWindow.document.write('<form method="' + options.method + '" action="' + options.url + '">');
                        var v_params = options.param.split('&');

                        var v_param = null;
                        for (var iParam = 0; iParam < v_params.length; iParam++) {
                            try {
                                v_param = v_params[iParam].split('=');
                                if (v_param[0] == 'postData') {
                                    v_param[1] = encodeURIComponent(v_param[1]);
                                }
                                if (v_param[1]) {
                                    vDiv[0].objWindow.document.write('<input type="hidden" name="' + v_param[0] + '" value="' + v_param[1] + '">');
                                }
                            } catch (err) {
                            }
                        }
                        vDiv[0].objWindow.document.write('</form>');
                        vDiv[0].objWindow.document.forms[0].submit();
                    }

                    if (vDiv[0].objWindow != null) {
                        if (options.onClose) {
                            vDiv[0].objWindow.onbeforeunload = options.onClose;
                            vDiv[0].objWindow.onunload = options.onClose;
                        }
                        if (options.onLoad) {
                            vDiv[0].objWindow.onload = options.onLoad;
                        }
                        vDiv[0].objWindow.focus();
                    }
                } else {
                    if (options.title == null) {
                        vDiv.attr('title', 'Carregando...');
                    } else {
                        vDiv.attr('title', options.title);
                    }

                    for (var index in options.buttons) {
                        if (options.buttons[index]['onClick']) {
                            options.param += '&buttons[' + index + '][icon]=' + encodeURIComponent(options.buttons[index]['icon']);
                            options.param += '&buttons[' + index + '][onClick]=' + encodeURIComponent('base64:' + Base64.encode(str_replace([chr(10), chr(13), '  '], ['', '', ''], options.buttons[index]['onClick']) + ''));
                        } else if (options.buttons[index]) {
                            options.param += '&buttons[' + index + '][click]=' + encodeURIComponent('base64:' + Base64.encode(options.buttons[index] + ''));
                        }
                    }

                    if (options.onAfterLoad) {
                        options.param += '&afterLoad=' + encodeURIComponent('base64:' + Base64.encode(options.onAfterLoad + ''));
                    }

                    var vSepParam = '?';
                    if (options.url.indexOf('?') > 0)
                        vSepParam = '&';

                    var htmlDiv = '';
                    var idMsgLoad = 'msgload' + options.id;
                    var idIframe = 'ifr' + options.id;
                    htmlDiv = htmlDiv + '<p id="' + idMsgLoad + '" style="padding-left:10px;">Aguarde, carregando...</p>';
                    htmlDiv = htmlDiv + '<iframe id="' + idIframe + '" name="' + idIframe + '" src="' + options.url + vSepParam + options.param + '" width="100%" height="100%" border="0" frameborder="0" align="left" noresize="noresize" scrolling="' + options.scrolling + '"></iframe>';
                    vDiv.html(htmlDiv);
                    //$('#' + idIframe).hide();
                    jQuery('#' + options.id).css({"overflow": "hidden"});
                    $('#' + idIframe).load(function () {
                        $('#' + idMsgLoad).hide();
                        $(this).show();
                        jQuery('#' + options.id).css({"overflow": "auto"});
                    });
                    if (v_create_dialog) {
                        //alert(options.height);
                        //alert($(document).height());
                        if ((options.height + 50) >= $(document).height()) {
                            options.height = options.height - 50;
                        }
                        vDiv.dialog({
                            bgiframe: false,
                            autoOpen: true,
                            height: options.height,
                            width: options.width,
                            modal: options.modal,
                            close: options.close,
                            beforeClose: options.onClose,
                            create: options.onCreate
                        });
                    } else {
                        var theDialog = vDiv.dialog(options);
                        theDialog.dialog('open');
                    }
                    var height = vDiv.css('height');
                    if (!height){
                        height = (options.height-50) + 'px';
                    }
                    vDiv.removeAttr('style');
                    vDiv.css('width', '100%');
                    vDiv.css('height', height);
                }
            },
            close: function (options) {
                var settings = {
                    id: 'NewWindow',
                    access: null
                };

                if (options) {
                    jQuery.extend(settings, options);
                }
                if (!options.access)
                    options.access = null;

                if (options.access !== null) {
                    var vDiv = options.access.jQuery('#' + options.id);
                } else {
                    var vDiv = jQuery('#' + options.id);
                }
                var theDialog = vDiv.dialog(options);
                theDialog.dialog('close');
                vDiv.html('');
                if (vDiv[0].objWindow != null) {
                    vDiv[0].objWindow.close();
                    vDiv[0].objWindow = null;
                }
                //blockAjax();
            },
            getDocument: function (id) {
                var vDiv = jQuery('#' + id);
                var vType = vDiv.attr('typeWindow');
                var objDocument = document;
                if (vType == 'WINDOW') {
                    objDocument = vDiv[0].objWindow.document;
                } else if (vType == 'IFRAME') {
                    if (vDiv.find('#ifr' + id)[0]) {
                        if (vDiv.find('#ifr' + id)[0].contentDocument) {
                            objDocument = vDiv.find('#ifr' + id)[0].contentDocument;
                        } else {
                            objDocument = vDiv.find('#ifr' + id)[0].contentWindow.document;
                        }
                    }
                }
                return objDocument;
            },
            getWindow: function (id) {
                var vDiv = jQuery('#' + id);
                var vType = vDiv.attr('typeWindow');
                var objDocument = window;
                if (vType == 'WINDOW') {
                    objDocument = vDiv[0].objWindow;
                } else if (vType == 'IFRAME') {
                    if (vDiv.find('#ifr' + id)[0]) {
                        objDocument = vDiv.find('#ifr' + id)[0].contentWindow;
                    }
                }
                return objDocument;
            }
        };
    })(jQuery);

    /*$.taWindow = */
    (function ($) {
        $.taWindow = $.WindowT;
    })(jQuery);
}