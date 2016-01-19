/**
 * Transforma uma string en format Json para um
 * objeto javascript
 * 
 * @param string p_cmd_str
 * @return object
 */
function decodeJson(p_cmd_str) {
    try {
        var vResult = '';
        var str = ' vResult = ' + p_cmd_str;
        eval(str);
        return vResult;
    } catch (erro) {
        return false;
    }
}
/**
 * Dispara um ajax e retorna um json
 */
function ajaxJson(options) {
    if (!options.url) {
        alert('É necessário informar o parâmetro "options.url"!');
    }
    if (!options.data) {
        alert('É necessário informar o parâmetro "options.data" que representa os dados a serem postados!');
    }

    var result = $.ajax({
        type: 'POST',
        url: options.url,
        data: options.data,
        async: false
    }).responseText;

    var vJson = decodeJson(result);
    if (!vJson) {
        $.DialogT.open(result, 'Error', {title: 'Erro!'});
    } else if (vJson.exception) {
        $.DialogT.exception(vJson.exception);
    } else {
        return vJson;
    }
    return false;
}

function fullWindow(self, palco) {
    var icon = self.find('span');
    var iframe = palco.find('iframe');
    var height = jQuery(window).height() - 45;
    if (!iframe.attr('min-height-orig')) {
        iframe.attr('min-height-orig', iframe.css('min-height'));
    }
    if (!palco.hasClass('ui-full')) {
        palco.addClass('ui-full');
        icon.removeClass('ui-icon-arrow-4-diag');
        icon.addClass('ui-icon-arrow-4');
        iframe.css('min-height', height + 'px');
    } else {
        palco.removeClass('ui-full');
        icon.removeClass('ui-icon-arrow-4');
        icon.addClass('ui-icon-arrow-4-diag');
        iframe.css('min-height', iframe.attr('min-height-orig'));
    }
    jQuery(window).trigger('resize');
}

function setProfile(profileId, profileName) {
    jQuery.AjaxT.json({
        url: '/Mais/index.php/profile/object-view/set-default',
        data: 'id=' + profileId + '&objeto=' + profileName,
        success: function (result) {
            var profile = jQuery("input[name='profile']").val();
            if (profile) {
                jQuery("input[name='profile']").val(profileId);
                jQuery('form').submit();
            } else {
                if (result) {
                    document.location.reload(true);
                }
            }
        }
    });
}
/**
 * Busca o primeiro objeto de carregamento
 * 
 * Usado nas chamadas de Window Modal
 */
function getSuper() {
    var objRef = this;
    var numPass = 0;
    while (!objRef.document.getElementById('div-super') && numPass <= 50) {
        objRef = objRef.parent;
        numPass++;
    }
    return objRef;
}

function winSuper() {
    var obj = getSuper();
    return obj.jQuery.WindowT;
}

function focusFirstElement(formSelector) {
    var elements = jQuery(formSelector);
    var idElement = '';
    for (index = 0; index < elements.length; index++) {
        try {
            idElement = elements.eq(index).attr('id');
            if (jQuery('#group-' + idElement).css('display') == 'block') {
				if(!elements.eq(index).hasClass('item') && !elements.eq(index).hasClass('hasDatepicker') && elements.eq(index).is('input')){
					elements.eq(index).focus();
					break;
				}
            }
        } catch (err) {

        }
    }
}
/**
 *
 */
function submitDownloadFile(options) {
    if (typeof options == 'string') {
        options = {
            selector: options
        };
    }
    var onSuccess = function (result) {
        if (typeof options.success == 'function') {
            options.success(result);
        }
    };

    var oForm = jQuery(options.selector);
    var sAction = oForm.attr('action');
    var sData = '';
    var aData = oForm.serializeArray();
    var oJson = {};
    var iIndex = 0;

    for (iIndex = 0; iIndex < aData.length; iIndex++) {
        sData = sData + '&' + aData[iIndex].name + '=' + aData[iIndex].value;
    }
    sData = sData.substr(1);

    /*
     $.BlockT.open();
     oJson = ajaxJson({url:sAction, data:sData});
     $.BlockT.close();
     
     if (oJson.filename){
     if (!document.getElementById('iframe-download')){
     $('#div-windows').append('<iframe id="iframe-download" name="iframe_download_file" src="aboutabout:blank"></iframe>');
     }
     sAction = '/Mais/index.php/file/download?decode=1&delete=1';
     sAction = sAction + '&filename=' + oJson.filename;
     sAction = sAction + '&name=' + oJson.name;
     sAction = sAction + '&type=' + oJson.type;
     document.getElementById('iframe-download').src = sAction;
     }
     */

    $.ajax({
        type: 'POST',
        url: sAction,
        data: sData,
        beforeSend: function (xhr) {
            $.BlockT.open();
        },
        complete: function (xhr) {
            $.BlockT.close();
        },
        success: function (result) {
            var vJson = decodeJson(result);
            if (vJson.exception) {
                $.DialogT.exception(vJson.exception);
            } else {
                onSuccess(result);
                if (vJson.filename) {
                    if (!document.getElementById('iframe-download')) {
                        $('#div-windows').append('<iframe id="iframe-download" name="iframe_download_file" src="aboutabout:blank"></iframe>');
                    }
                    var sAction = '/Mais/index.php/file/download?decode=1&delete=1';
                    sAction = sAction + '&filename=' + vJson.filename;
                    sAction = sAction + '&name=' + vJson.name;
                    sAction = sAction + '&type=' + vJson.type;
                    document.getElementById('iframe-download').src = sAction;
                }
            }
        }
    });
}

function downloadFile(options) {
    if (!options.url) {
        alert('É necessário informar o parâmetro "options.url"!');
    }
    if (!options.data) {
        alert('É necessário informar o parâmetro "options.data" que representa os dados a serem postados!');
    }

    if (!options.message) {
        options.message = 'Aguarde...Criando arquivo para download!';
    }

    if (!options.idDialog) {
        if (!document.getElementById('div-dialog-message-download')) {
            $('#div-windows').append('<div id="div-dialog-message-download" title="Aguarde!"></div>');
        }
        options.idDialog = 'div-dialog-message-download';
    }

    var $dialog = $('#' + options.idDialog);
    $dialog.html('<div class="container ui-state-default ui-state-highlight ui-corner-all" style="padding:5px;"><p><span class="message">' + options.message + '</span></p></div>');
    $dialog.dialog({
        width: 380,
        height: 110,
        modal: true
    });

    var $ajaxResult = $.ajax({
        type: 'POST',
        url: options.url,
        data: options.data,
        async: false
    }).responseText;
    var $json = decodeJson($ajaxResult);
    if (!$json) {
        $dialog.dialog({
            width: 600,
            height: 450
        });
        $dialog.html($ajaxResult);
    } else if ($json.exception) {
        $dialog.dialog({
            width: 600,
            height: 450
        });
        $dialog.dialog('close');
        $.DialogT.exception($json.exception);
    } else {
        if ($json.filename) {
            if (!document.getElementById('iframe-download')) {
                $('#div-windows').append('<iframe id="iframe-download" name="iframe_download_file" src="aboutabout:blank"></iframe>');
            }
            var $action = '/Mais/index.php/file/download?decode=1&delete=1';
            $action = $action + '&filename=' + $json.filename;
            $action = $action + '&name=' + $json.name;
            $action = $action + '&type=' + $json.type;
            //this.iframe_download_file.src = $action;
            document.getElementById('iframe-download').src = $action;
        }
        $dialog.dialog('close');
    }
}
/**
 * Faz replace em uma string
 * 
 * @param value
 * @param textOld
 * @param textNew
 * @return
 */
function replace(text, textOld, textNew) {
    var varLen = textOld.length;
    var varTextNew = '';
    text = text + '';
    for (var iText = 0; iText < text.length; iText++) {
        if (text.substr(iText, varLen) == textOld) {
            varTextNew = varTextNew + textNew;
            iText = iText + (varLen - 1);
        } else {
            varTextNew = varTextNew + text.substr(iText, 1);
        }
    }
    return varTextNew;
}

function resizeGrid(idGrid, marginTop, marginLeft) {
    var vGrid = jQuery('#' + idGrid);
    vGrid.setGridWidth(jQuery(window).width() - 50 - marginLeft);
    vGrid.setGridHeight(jQuery(window).height() - 310 - marginTop);
}

function resizeGrid(idGrid) {
    var vGrid = jQuery('#' + idGrid);
    vGrid.setGridWidth(jQuery(window).width() - 50);
    vGrid.setGridHeight(jQuery(window).height() - 295);
}
/**
 * Limpa determinados caracteres de uma string
 * 
 * @param options
 * @return string
 */
function clearChars(options) {
    if (!options.value)
        options.value = '';
    if (!options.chars)
        options.chars = '';
    if (!options.regExp)
        options.regExp = null;
    var vChar = '';
    var vResult = options.value;

    for (var vIndex = 0; vIndex < options.chars.length; vIndex++) {
        vChar = options.chars.substr(vIndex, 1);
        vResult = replace(vResult, vChar, '');
    }

    if (options.regExp !== null) {
        options.regExp = new RegExp(options.regExp, 'gm');
        vResult = vResult.replace(options.regExp, '');
    }
    return vResult;
}
/**
 * Formata uma string
 * 
 * @param options
 * @return
 */
function formatString(options) {
    if (!options.value)
        options.value = '';
    if (!options.mask)
        options.mask = '';
    if (!options.masks)
        options.masks = [options.mask];
    if (!options.charMask)
        options.charMask = '@';

    var string = options.value;
    var charsFormat = '';
    var char = '';
    var start = '';
    var finish = '';
    /**
     * descobre os caracteres de formatação
     */
    charsFormat = '';
    for (var index = 0; index < options.masks.length; index++) {
        charsFormat = charsFormat + replace(options.masks[index], options.charMask, '');
    }
    /**
     * Limpa a formatação caso tenha
     */
    for (var index = 0; index < charsFormat.length; index++) {
        string = replace(string, charsFormat.substr(index, 1), '');
    }
    /**
     * descobre a máscara
     */
    for (var iMask = 0; iMask < options.masks.length; iMask++) {

        /**
         * Limpa a formatação da mascara
         */
        var stringMask = options.masks[iMask];
        for (var index = 0; index < charsFormat.length; index++) {
            stringMask = replace(stringMask, charsFormat.substr(index, 1), '');
        }

        if (string.length == stringMask.length) {
            options.mask = options.masks[iMask];
            for (var index = 0; index < options.mask.length; index++) {
                char = options.mask.substr(index, 1);
                if (char != options.charMask) {
                    start = string.substr(0, index);
                    finish = string.substr(index);
                    string = start + char + finish;
                }
            }

            options.value = string;
            index = options.masks.length;
            break;
        }
    }
    return options.value;
}

function formatCnpjCpf(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' .-/',
        regExp: '[a-z]|[A-Z]'
    });
    if (obj.value.length == 11) {
        obj.value = formatString({
            value: obj.value,
            mask: '@@@.@@@.@@@-@@'
        });
    } else {
        obj.value = formatString({
            value: obj.value,
            mask: '@@.@@@.@@@/@@@@-@@'
        });
    }
}

function formatCep(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' .-/',
        regExp: '[a-z]|[A-Z]'
    });
    if (obj.value.length == 8) {
        obj.value = formatString({
            value: obj.value,
            mask: '@@.@@@-@@@'
        });
    } else {
        obj.value = formatString({
            value: obj.value,
            mask: '@@@@@@@@'
        });
    }
}

/**
 * 
 * @param obj
 * @return
 */
function formatTelefone(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' .-/()',
        regExp: '[a-z]|[A-Z]'
    });
    if (obj.value.length == 10) {
        obj.value = formatString({
            value: obj.value,
            mask: '(@@) @@@@-@@@@'
        });
    } else if (obj.value.length == 11) {
        obj.value = formatString({
            value: obj.value,
            mask: '(@@) @@@@@-@@@@'
        });
    } else if (obj.value.length == 8) {
        obj.value = formatString({
            value: obj.value,
            mask: '@@@@-@@@@'
        });
    } else if (obj.value.length == 9) {
        obj.value = formatString({
            value: obj.value,
            mask: '@@@@@-@@@@'
        });
    }
}

/**
 * 
 * @param obj
 * @return
 */
function clearTelefone(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' ()- ',
        regExp: '[a-z],[A-Z]'
    });
}


/**
 * 
 * @param obj
 * @return
 */
function clearCnpjCpf(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' .-/_',
        regExp: '[a-z],[A-Z]'
    });
}
/**
 * 
 * @param obj
 * @return
 */
function clearCep(obj) {
    obj.value = clearChars({
        value: obj.value,
        chars: ' .-/_',
        regExp: '[a-z],[A-Z]'
    });
}
/**
 * 
 * @param obj
 * @return
 */
function onFocusInput(obj) {
    jQuery(obj).css('border', '1px solid #73AE03');
}
/**
 * 
 * @param obj
 * @return
 */
function onBlurInput(obj) {
    jQuery(obj).css('border', '1px solid #cccccc');
}
/**
 * 
 * @param string data json
 * @param postdata
 * @return array
 */
function grid_afterSubmit(data, postdata) {
    try {
        var ret = [];
        var v_data = decodeJson(data.responseText);
        if (v_data.id * 1 == 0) {
            ret[0] = false;
            ret[1] = v_data.message;
            ret[2] = v_data.id;
        } else {
            ret[0] = true;
            ret[1] = 'Ok!';
            ret[2] = v_data.id;
        }
    } catch (e) {
        var ret = [];
        ret[0] = false;
        ret[1] = 'Erro ao processar os dados!';
    }
    return ret;
}

function Object2Param(pObj, pFieldName) {
    var vParam = '';
    var vFieldName = '';
    for (var Field in pObj) {
        if (pFieldName != '') {
            vFieldName = pFieldName + '[' + Field + ']';
        } else {
            vFieldName = Field;
        }
        if (typeof pObj[Field] == 'object') {
            vParam = vParam + '&' + Object2Param(pObj[Field], vFieldName);
        } else {
            vParam = vParam + '&' + vFieldName + '=' + pObj[Field];
        }
    }
    return vParam.substr(1);
}

function ObjectMultForObjectSigle(pObj, pFieldName) {
    var vObject = [];
    var vFieldName = '';
    for (var vField in pObj) {
        if (pFieldName != '') {
            vFieldName = pFieldName + '[' + vField + ']';
        } else {
            vFieldName = vField;
        }
        if (typeof pObj[vField] == 'object') {
            var newObject = ObjectMultForObjectSigle(pObj[vField], vFieldName);
            for (var newFiled in newObject) {
                vObject[newFiled] = newObject[newFiled];
            }
        } else {
            vObject[vFieldName] = pObj[vField];
        }
    }
    return vObject;
}

function seeker_search_close_window(options) {
    var vPostData = jQuery('#grid-' + options.id_grid).getGridParam('postData');
    var sData = jQuery('#win-search-' + options.id_grid).find('form').serializeArray();
    var vName = null;

    for (var idx = 0; idx < sData.length; idx++) {
        vName = 'filter_' + sData[idx].name;
        try {
            delete vPostData[vName];
        } catch (e) {
        }
        vPostData[vName] = sData[idx].value;
    }
    sData = null;
    jQuery('#grid-".$this->gridId."').setGridParam({
        postData: vPostData
    }).trigger('reloadGrid');
}
/**
 * Usado no select que monta as opera��es 
 * 
 * @param obj
 * @return
 */
function seeker_select_op_change(obj) {
    var v_name = obj.name;
    v_name = v_name.split('[');
    v_name = v_name[0];
    if (obj.value == 'between' || obj.value == '!between') {
        jQuery('#' + v_name + '-other-field').show();
    } else {
        jQuery('#' + v_name + '-other-field').hide();
    }
}
/**
 * 
 * @param chars
 * @param e usar "e" no caso de netscape passando o obj. "event"
 * @returns
 */
function validaChar(chars, e) {
    var RE = new RegExp("[" + chars + "]");

    e = (netscape || mozilla) ? e : event;
    tecla = (netscape) ? e.which : e.keyCode;
    if (netscape || mozilla)
    {
        var teclas_ex = ((tecla == 8) || (tecla == 13) || (tecla == 0));  // 0 =>'ESC-DEL'
        return ((-1 == String.fromCharCode(tecla).search(RE)) && (!teclas_ex)) ? e.cancelBubble = true : e.cancelBubble = false;
    }
    else
        return (-1 == String.fromCharCode(tecla).search(RE)) ? e.returnValue = false : e.returnValue = true;
}
/**
 * 
 */
function reconfigEscEnter() {
    configTabIndex();
    jQuery("input").taEscEnter();
    jQuery("select").taEscEnter();
    jQuery("textarea").taEscEnter();
    jQuery("button").taEsc();
}

function loadButtons() {
    var elements = jQuery('.t-ui-button');
    for (var Idx = 0; Idx < elements.length; Idx++) {
        elements.eq(Idx).hover(
                function () {
                    $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                },
                function () {
                    $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                }
        );
    }
    /*
     var elements = jQuery('.ui-datepicker-trigger');	
     for (var Idx=0; Idx<elements.length; Idx++){
     elements.eq(Idx).button({
     icons: {
     primary: 'ui-datepicker-trigger'
     }			
     });
     }*/
}

function AbreJanela(link, altura, largura) {
    if (navigator.appName != 'Microsoft Internet Explorer') {
        jQuery.WindowT.open({
            type: 'WINDOW',
            id: 'AbreJanela',
            url: link,
            height: altura,
            width: largura
        });
    } else {
        var d = new Date();
        window.open(link, 'AbreJanela' + d.getTime() + Math.floor((Math.random() * 10000) + 1), 'toolbar=yes,location=no,directories=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,menubar=yes,top=0,left=0,width=' + largura + ',height=' + altura);
    }
}

var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap,
        indent,
        meta = {// table of character substitutions
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"': '\\"',
            '\\': '\\\\'
        },
rep;

function quote(string) {
    escapable.lastIndex = 0;
    return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
        var c = meta[a];
        return typeof c === 'string' ? c :
                '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
    }) + '"' : '"' + string + '"';
}
/**
 * Exemplo de Uso
 * 
 * var where = new TWhere('AND') 
 * where.addFilter({
 *  field: 'tabela.campo',
 *  value: $('#valor').val(),
 *  operation: '=',
 *  mapper: 'Application_Model_Tabela_Mapper',
 * });
 * var url = '/module/controller/action?filter_json=' + where.toJson();
 */
function TWhere(groupOp) {
    this.groupOp = groupOp;
    this.filter = [];
    this.iElem = 0;
    this.addFilter = function (options) {
        if (!options.field)
            throw new Exception('Propriedade field não informado!');
        if (!options.value)
            options.value = '';
        if (!options.operation)
            options.operation = '';
        if (!options.mapper)
            options.mapper = '';

        if (typeof options.value == 'object') {
            options.value = 'expression:' + options.value;
        }

        this.filter[this.iElem] = {
            field: options.field,
            value: options.value,
            operation: options.operation,
            mapper: options.mapper
        };
        this.iElem++;
    };

    this.toJson = function () {
        vFilter = '';
        var vVirgIdx = false;
        for (var vIdx in this.filter) {
            if (vVirgIdx)
                vFilter = vFilter + ',';
            else
                vVirgIdx = true;
            vFilter = vFilter + '{';
            var vVirgProp = false;
            for (var vProp in this.filter[vIdx]) {
                if (vVirgProp)
                    vFilter = vFilter + ',';
                else
                    vVirgProp = true;
                if ($.isArray(this.filter[vIdx][vProp])) {
                    vFilter = vFilter + '"' + vProp + '":["' + this.filter[vIdx][vProp].join('","') + '"]';
                } else {
                    vFilter = vFilter + '"' + vProp + '":' + quote(this.filter[vIdx][vProp]);
                }

            }
            vFilter = vFilter + '}';
        }
        return Base64.encode('{"ZendT_Db_Where":{"groupOp":"' + this.groupOp + '","filter":[' + vFilter + ']}}');
    }
}

/**
 * Extrai os filtros de uma url e os exibe como um Where
 *    
 */
function extraiFiltroWhere(filtro) {
    var filtroAux = new Array();
    filtroAux = filtro.split('filter_json=');
    filtroAux[1] = replace(filtroAux[1], '%3D', '=');
    filtroAux[1] = Base64.decode(filtroAux[1]);
    filtroAux[1] = decodeJson(filtroAux[1]);
    return filtroAux;
}

/**
 * Adiciona um filtro a um where quando já existe um filtro em uma string.
 * 
 * Retorna uma string com a url e os filtros já em base64
 *
 */
function addFiltroWhere(filtros, novoFiltro) {
    filtros = extraiFiltroWhere(filtros);
    var where = new TWhere(filtros[1].ZendT_Db_Where.groupOp);
    for (x in filtros[1].ZendT_Db_Where.filter) {
        if (filtros[1].ZendT_Db_Where.filter[x].field != novoFiltro.field) {
            where.addFilter(filtros[1].ZendT_Db_Where.filter[x]);
        }
    }
    where.addFilter(novoFiltro);
    return filtros[0] + 'filter_json=' + where.toJson();
}


function My_Db_Sql_Filter(groupOp) {
    this.groupOp = groupOp;
    this.filter = [];
    this.iElem = 0;
    this.addFilter = function (options) {
        if (!options.field)
            throw new Exception('Propriedade field não informado!');
        if (!options.value)
            throw new Exception('Propriedade value não informado!');
        if (!options.operation)
            options.operation = '';
        this.filter[this.iElem] = {
            field: options.field,
            value: options.value,
            operation: options.operation
        };
        this.iElem++;
    };

    this.toJSON = function () {
        vFilter = '';
        var vVirgIdx = false;
        for (var vIdx in this.filter) {
            if (vVirgIdx)
                vFilter = vFilter + ',';
            else
                vVirgIdx = true;
            vFilter = vFilter + '{';
            var vVirgProp = false;
            for (var vProp in this.filter[vIdx]) {
                if (vVirgProp)
                    vFilter = vFilter + ',';
                else
                    vVirgProp = true;
                vFilter = vFilter + '"' + vProp + '":' + quote(this.filter[vIdx][vProp]);
            }
            vFilter = vFilter + '}';
        }
        return '{"My_Db_Sql_Filter":{"groupOp":"' + this.groupOp + '","filter":[' + vFilter + ']}}';
    }
}
/**
 * Função para retornar uma string sem acentos
 *
 */
function removeAccent(p_value) {
    return str_replace(['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'à', 'á', 'â', 'ã', 'ä', 'å', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'Ç', 'ç', 'Ñ', 'ñ', 'Ý', 'Ÿ', 'ý', 'ÿ', 'Ž', 'ž']
            , ['A', 'A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'C', 'c', 'N', 'n', 'Y', 'Y', 'y', 'y', 'Z', 'z']
            , p_value);
}

/**
 * Função para retornar somente numeros 
 *  
 */
function filterNumber(p_value) {
    var numberPattern = /\d+/g;
    return p_value.match(numberPattern);
}
/**
 * 
 */
function plusApp() {
    var iconsApp = jQuery('#iconsApp');
    if (iconsApp.css('display') == 'none') {
        jQuery('#iconsAppContent').html('Aguarde...');
        jQuery.ajax({
            url: '/sistemas/iconsApp.php',
            success: function (result) {
                jQuery('#iconsAppContent').html(result);
                jQuery('#iconsApp').show('fast');
                jQuery('#menuPlusApp').html('-');
                jQuery('#menuPlusApp').addClass('menuSelected');
            }
        });
    } else {
        jQuery('#menuPlusApp').html('+');
        jQuery('#iconsApp').hide('fast');
        jQuery('#menuPlusApp').removeClass('menuSelected');
    }
}

function prepareAjaxSubmit(options) {
    if (!options.formId)
        options.formId = 'form';
    if (!options.returnType)
        options.returnType = 'json';
    if (!options.success)
        options.success = function (result) {
            alert(result)
        };

    var vForm = jQuery('#' + options.formId);
    var validadeFormSave = {
        submitHandler: function (form) {
            jQuery(form).ajaxSubmit({
                success: function (result) {
                    if (options.returnType == 'json') {
                        var vJson = decodeJson(result);
                        if (!vJson) {
                            $.TDialog('error', {}, 'Erro', result);
                        } else {
                            if (vJson.error) {
                                $.TDialog('error', {}, 'Erro', vJson.exception.message);
                            } else {
                                options.success(vJson);
                            }
                        }
                    } else {
                        options.success(result);
                    }
                }
            });
        }
    };
    vForm.validate(validadeFormSave);
}
/**
 * 
 */
function getIdGrid(idGrid) {
    var $grid = $('#' + idGrid);
    var $id = '';
    if ($grid.jqGrid('getGridParam', 'multiselect')) {
        $id = $grid.jqGrid('getGridParam', 'selarrrow');
    } else {
        $id = $grid.jqGrid('getGridParam', 'selrow');
    }
    return $id;
}

function getURLParameter(name) {
    return decodeURI(
            (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]
            );
}


function convertXls(fileCrypt, format) {
    if (!document.getElementById('ifr-download')) {
        var Iframe = document.createElement("iframe");
        Iframe.id = "ifr-download";
        Iframe.name = "ifr-download";
        Iframe.width = 0;
        Iframe.height = 0;
        document.body.appendChild(Iframe);
    }
    document.getElementById('ifr-download').src = '/Mais/index.php/file/xls-convert?filename=' + fileCrypt + '&format=' + format;
}

function download_arquivos_zip(sql, filename) {
    if (filename != undefined) {
        filename = 'filename=' + filename;
    }
    downloadFile({url: 'lista_download_arquivos.php', data: 'sql=' + sql + '&download=1+&' + filename});
}

/**
 * Função é um hack necessario para funcionar o Object.keyes no IE 7 e 8
 */
Object.keys = Object.keys || function (o) {
    var result = [];
    for (var name in o) {
        if (o.hasOwnProperty(name))
            result.push(name);
    }
    return result;
};


Object.keys = Object.keys || function (o) {
    var result = [];
    for (var name in o) {
        if (o.hasOwnProperty(name))
            result.push(name);
    }
    return result;
};

function block(param) {
    $.BlockT.open();
}

function unblock(param) {
    $.BlockT.close();
}

function replaceAll(find, replace, str)
{
	if(str){
		while (str.indexOf(find) > -1)
		{
			str = str.replace(find, replace);
		}
	}
    return str;
}

function isInternetExplorer() {
    var ua = window.navigator.userAgent;
    return (ua.indexOf("MSIE ") != -1 || ua.indexOf('Trident/') != -1);
}

function mceUploadImage(editor) {
    var actionUploadImage = '/Mais/index.php/cms/conteudo/upload-imagem';
    var imageUploadHtml = $.ajax({
        url: actionUploadImage + '?remove-header=1&typeModal=AJAX',
        data: "1=1",
        async: false}).responseText;

    jQuery.DialogT.open(imageUploadHtml, 'Information', {
        title: 'Inserção de Imagem',
        id: 'dialog-image-upload',
        width: 400,
        height: 350,
        buttons: {
            Inserir: function () {
                $("#message").html("<h3>Processando...</h3>");

                var form = jQuery("#form_upload_imagem");
                form.attr("action", actionUploadImage);
                jQuery.AjaxT.submitJson({
                    selector: form,
                    success: function (result) {
                        if (result.url) {
                            for(var index in result.url){
                                editor.execCommand("mceInsertContent", false, '<img src=" ' + result.url[index] + '" />');
                            }                            
                            jQuery.DialogT.close('dialog-image-upload');
                        }
                    },
                    error: function () {
                        $("#message").html("<h3>Erro no upload da imagem!</h3>");
                    }
                });
            },
        }
    });
}

function utf8_decode(str_data) {
  //  discuss at: http://phpjs.org/functions/utf8_decode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  //    input by: Aman Gupta
  //    input by: Brett Zamir (http://brett-zamir.me)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Norman "zEh" Fuchs
  // bugfixed by: hitwork
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: kirilloid
  //   example 1: utf8_decode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'

  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}
