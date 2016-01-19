var gGridResizeLoad = [];
function gridResize(idGrid) {
    if (!gGridResizeLoad[idGrid]) {
        jQuery.gridResize({
            idGrid: idGrid
        });
        /*jQuery(window).resize(function () {
         jQuery.gridResize({
         idGrid: idGrid
         });
         });*/
        gGridResizeLoad[idGrid] = true;
    }
}

(function ($) {
    $.gridResize = function (options) {
        var vGrid = jQuery('#' + options.idGrid);
        var containerGrid = vGrid.parent().parent().parent().parent().parent().parent().parent();
        var width = 0;
        var height = 0;
        var box = jQuery('#gbox_' + options.idGrid);

        //Se na chamada não for setada largura
        //Defina o valor resgatando a largura do pai do grid em questão
        //Faça o mesmo a altura
        if (!options.width) {
            if ($(window).width() <= 640) {
                width = $(window).width() + 15;
                jQuery('#pager-' + options.idGrid + '_left').hide();
            } else if (jQuery('#layout-main').hasClass('window')) {
                width = jQuery(window).width() - 35;
                height = jQuery(window).height() - 210;
            } else {
                jQuery('#pager-' + options.idGrid + '_left').show();
                var parentId = containerGrid.attr('id');
                if (parentId) {
                    width = containerGrid.width() - 45;
                } else {
                    width = jQuery(window).width() - 85;
                }
            }
        } else if (typeof options.width == 'function') {
            width = options.width();
        } else {
            width = options.width;
        }

        if (width) {
            width = Math.round(width);
            vGrid.setGridWidth(width);
        }

        if (!options.height && height == 0) {
            var parentId = containerGrid.attr('id');

            if (parentId) {
                height = jQuery(window).height() - 400;
            } else {
                height = jQuery(window).height() - 350;
            }

            if (height <= 200) {
                height = 200;
            }
        } else if (typeof options.height == 'function') {
            height = options.height();
        } else if (!height) {
            height = options.height;
        }
        if (height) {
            vGrid.setGridHeight(height);
        }


        box.width(box.width() + 2);
    }

    $.gridRadioFocus = function (obj) {
        var vGrid = jQuery('#' + $(obj).attr("nameGrid"));
        var vIdSel = vGrid.getGridParam('selrow');
        if (vIdSel != obj.value)
            vGrid.setSelection(obj.value);

        $(obj).keypress(function (e) {
            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            if (key == 13) {
                var seeker = jQuery('#' + $(this).attr("nameSeeker"))[0];
                seeker.seekerRetriveById({
                    value: this.value
                });
                seeker.seekerWindowClose();
            }
        });
    };

    $.gridSelectOneRow = function (options) {
        var vGrid = jQuery('#' + options.nameGrid);
        var vIDs = vGrid.getDataIDs();
        if (vIDs.length > 0) {
            vGrid.setSelection(vIDs[0]);
        }
    };

    $.gridAlertNewRow = function (options) {
        var vGrid = jQuery('#' + options.nameGrid);
        var vIDs = vGrid.getDataIDs();
        if (vIDs.length == 0) {
            if (confirm('Registro não encontrado, deseja inclui-lo?')) {
                options.newRow();
            }
        }
    };

    var autoSelectCreateds = [];

    $.gridAtivaNavKey = function (options) {
        var vGrid = jQuery('#' + options.idGrid);

        for (var i in vGrid[0].p.colModel) {
            var listOptions = vGrid[0].p.colModel[i]['listOptions'];
            if (listOptions) {
                var array = [];
                for (var value in listOptions) {
                    array.push({value: value, desc: listOptions[value], level: 0});
                }
                if (array.length) {
                    var elementId = "#gs_" + vGrid[0].p.colModel[i]['name'];
                    var elementIdDisplay = "#display_gs_" + vGrid[0].p.colModel[i]['name'];
                    //console.log(elementId);
                    if (!$(elementIdDisplay).Tdata('TAutoSelect')) {
                        $(elementId).TAutoSelect({sourceData: array, changeId: true, multiple: true, okClick: function () {
                                var e = $.Event("keypress", {keyCode: 13});
                                $(elementIdDisplay).trigger(e);
                            }});
                        autoSelectCreateds.push(elementId);
                    }
                }
            }
            //autoSelectCreateds = [];
        }

        $.gridSelectOneRow({
            nameGrid: options.idGrid
        });
        vGrid.keypress(function (e) {
            if (e.keyCode == 40 || e.keyCode == 38) {
                e.preventDefault();
            }
        });
        vGrid.jqGrid('bindKeys', {"onEnter": options.functionEnter});
        vGrid.focus();
    };

    $.jgrid.extend({
        appendToolbar: function (elem, cmdHtml) {
            $("#t_" + elem).append(cmdHtml).css('border-top', '0px');
            return this;
        },
        appendNavigatorHtml: function (elem, cmdHtml) {
            $(elem + '_left').append(cmdHtml);
            return this;
        }
    });


    $.jgrid.extend({
        filterToolbar: function (p) {
            p = $.extend({
                autosearch: true,
                showFilter: true,
                searchOnEnter: true,
                beforeSearch: null,
                afterSearch: null,
                beforeClear: null,
                afterClear: null,
                searchurl: '',
                stringResult: false,
                groupOp: 'AND',
                defaultSearch: "bw"
            }, p || {});
            return this.each(function () {
                var $t = this;
                if (this.ftoolbar) {
                    return;
                }
                var triggerToolbar = function () {
                    var sdata = {}, j = 0, v, nm, sopt = {}, so;
                    $.each($t.p.colModel, function (i, n) {
                        nm = replace(this.index || this.name, '.', '-');
                        so = (this.searchoptions && this.searchoptions.sopt) ? this.searchoptions.sopt[0] : this.stype == 'select' ? 'eq' : p.defaultSearch;
                        v = $("#gs_" + $.jgrid.jqID(this.name), (this.frozen === true && $t.p.frozenColumns === true) ? $t.grid.fhDiv : $t.grid.hDiv).val();
                        if (v) {
                            sdata[nm] = v;
                            sopt[nm] = so;
                            j++;
                        } else {
                            try {
                                delete $t.p.postData[nm];
                            } catch (z) {
                            }
                        }
                    });
                    delete $t.p.postData['filter'];
                    var sd = j > 0 ? true : false;
                    if (p.stringResult === true || $t.p.datatype == "local") {
                        var ruleGroup = "{\"groupOp\":\"" + p.groupOp + "\",\"rules\":[";
                        var gi = 0;
                        $.each(sdata, function (i, n) {
                            if (gi > 0) {
                                ruleGroup += ",";
                            }
                            ruleGroup += "{\"field\":\"" + i + "\",";
                            ruleGroup += "\"op\":\"" + sopt[i] + "\",";
                            n += "";
                            ruleGroup += "\"data\":\"" + n.replace(/\\/g, '\\\\').replace(/\"/g, '\\"') + "\"}";
                            gi++;
                        });
                        ruleGroup += "]}";
                        $.extend($t.p.postData, {
                            filters: ruleGroup
                        });
                        $.each(['searchField', 'searchString', 'searchOper'], function (i, n) {
                            if ($t.p.postData.hasOwnProperty(n)) {
                                delete $t.p.postData[n];
                            }
                        });
                    } else {
                        $.extend($t.p.postData, sdata);
                    }
                    var saveurl;
                    if ($t.p.searchurl) {
                        saveurl = $t.p.url;
                        $($t).jqGrid("setGridParam", {
                            url: $t.p.searchurl
                        });
                    }
                    var bsr = false;
                    if ($.isFunction(p.beforeSearch)) {
                        bsr = p.beforeSearch.call($t);
                    }
                    if (!bsr) {
                        $($t).jqGrid("setGridParam", {
                            search: sd
                        }).trigger("reloadGrid", [{
                                page: 1
                            }]);
                    }
                    if (saveurl) {
                        $($t).jqGrid("setGridParam", {
                            url: saveurl
                        });
                    }
                    if ($.isFunction(p.afterSearch)) {
                        p.afterSearch();
                    }
                };
                var clearToolbar = function (trigger) {
                    var sdata = {}, v, j = 0, nm;
                    trigger = (typeof trigger != 'boolean') ? true : trigger;
                    $.each($t.p.colModel, function (i, n) {
                        v = (this.searchoptions && this.searchoptions.defaultValue) ? this.searchoptions.defaultValue : "";
                        nm = this.index || this.name;
                        nm = replace(nm, '.', '-');
                        switch (this.stype) {
                            case 'select' :
                                var v1;
                                $("#gs_" + $.jgrid.jqID(this.name) + " option", (this.frozen === true && $t.p.frozenColumns === true) ? $t.grid.fhDiv : $t.grid.hDiv).each(function (i) {
                                    if (i === 0) {
                                        this.selected = true;
                                    }
                                    if ($(this).text() == v) {
                                        this.selected = true;
                                        v1 = $(this).val();
                                        return false;
                                    }
                                });
                                if (v1) {
                                    // post the key and not the text
                                    sdata[nm] = v1;
                                    j++;
                                } else {
                                    try {
                                        delete $t.p.postData[nm];
                                    } catch (e) {
                                    }
                                }
                                break;
                            case 'text':
                                $("#gs_" + $.jgrid.jqID(this.name), (this.frozen === true && $t.p.frozenColumns === true) ? $t.grid.fhDiv : $t.grid.hDiv).val(v);
                                if (v) {
                                    sdata[nm] = v;
                                    j++;
                                } else {
                                    try {
                                        delete $t.p.postData[nm];
                                    } catch (y) {
                                    }
                                }
                                break;
                        }
                    });
                    var sd = j > 0 ? true : false;
                    if (p.stringResult === true || $t.p.datatype == "local") {
                        var ruleGroup = "{\"groupOp\":\"" + p.groupOp + "\",\"rules\":[";
                        var gi = 0;
                        $.each(sdata, function (i, n) {
                            if (gi > 0) {
                                ruleGroup += ",";
                            }
                            ruleGroup += "{\"field\":\"" + i + "\",";
                            ruleGroup += "\"op\":\"" + "eq" + "\",";
                            n += "";
                            ruleGroup += "\"data\":\"" + n.replace(/\\/g, '\\\\').replace(/\"/g, '\\"') + "\"}";
                            gi++;
                        });
                        ruleGroup += "]}";
                        $.extend($t.p.postData, {
                            filters: ruleGroup
                        });
                        $.each(['searchField', 'searchString', 'searchOper'], function (i, n) {
                            if ($t.p.postData.hasOwnProperty(n)) {
                                delete $t.p.postData[n];
                            }
                        });
                    } else {
                        $.extend($t.p.postData, sdata);
                    }
                    var saveurl;
                    if ($t.p.searchurl) {
                        saveurl = $t.p.url;
                        $($t).jqGrid("setGridParam", {
                            url: $t.p.searchurl
                        });
                    }
                    var bcv = false;
                    if ($.isFunction(p.beforeClear)) {
                        bcv = p.beforeClear.call($t);
                    }
                    if (!bcv) {
                        if (trigger) {
                            $($t).jqGrid("setGridParam", {
                                search: sd
                            }).trigger("reloadGrid", [{
                                    page: 1
                                }]);
                        }
                    }
                    if (saveurl) {
                        $($t).jqGrid("setGridParam", {
                            url: saveurl
                        });
                    }
                    if ($.isFunction(p.afterClear)) {
                        p.afterClear();
                    }
                };
                var toggleToolbar = function () {
                    var trow = $("tr.ui-search-toolbar", $t.grid.hDiv),
                            trow2 = $t.p.frozenColumns === true ? $("tr.ui-search-toolbar", $t.grid.hDiv) : false;
                    if (trow.css("display") == 'none') {
                        trow.show();
                        if (trow2) {
                            trow2.show();
                        }
                    } else {
                        trow.hide();
                        if (trow2) {
                            trow2.hide();
                        }
                    }
                };
                // create the row
                function bindEvents(selector, events) {
                    var jElem = $(selector);
                    if (jElem[0]) {
                        jQuery.each(events, function () {
                            if (this.data !== undefined) {
                                jElem.bind(this.type, this.data, this.fn);
                            } else {
                                jElem.bind(this.type, this.fn);
                            }
                        });
                    }
                }
                if (p.showFilter) {
                    var tr = $("<tr class='ui-search-toolbar' role='rowheader'></tr>");
                } else {
                    var tr = $("<tr class='ui-search-toolbar' style='display:none;' role='rowheader'></tr>");
                }
                var timeoutHnd;
                $.each($t.p.colModel, function (i, n) {
                    var cm = this, thd, th, soptions, surl, self;
                    //console.log(cm);
					cm.fieldName = cm.name;
                    cm.name = replaceAll('.', '_', cm.index);
                    /*
                     * Alterado também em:
                     AppWeb\htdocs\framework\library\ZendT\Controller\Action.php
                     */
                    th = $("<th role='columnheader' class='ui-state-default ui-th-column ui-th-" + $t.p.direction + "'></th>");
                    thd = $("<div style='width:100%;position:relative;height:100%;padding-right:0.3em;'></div>");
                    if (this.hidden === true) {
                        $(th).css("display", "none");
                    }
                    this.search = this.search === false ? false : true;
                    if (typeof this.stype == 'undefined') {
                        this.stype = 'text';
                    }
                    soptions = $.extend({}, this.searchoptions || {});
                    if (this.search) {
                        var fieldName = '';
                        try {
                            if (!soptions.defaultValue) {
                                var contador = 0;
                                soptions.defaultValue = '';
                                
                                //console.log($t.p.postData['filter']);

                                for (contador in $t.p.postData['filter']) {
                                    fieldName = $t.p.postData['filter'][contador]['field'][contador + 'field'];
                                    if (fieldName){
                                        fieldName = fieldName.toLowerCase();
                                    }

                                    if (fieldName == cm.index) {
                                        var v_op = $t.p.postData['filter'][contador]['op'][contador + 'op'];
                                        var filters = ["=", "<", ">", "<=", ">=", "!=", "!"];
                                        var separator = ';';

                                        if (v_op === 'BETWEEN') {
                                            v_op = '';
                                            separator = ' ';
                                        } else if (filters.indexOf(v_op) == -1) {
                                            v_op = '';
                                        }

                                        var v_value = $t.p.postData['filter'][contador]['value'][contador];
                                        for (var index in v_value) {
                                            soptions.defaultValue += separator + v_op + v_value[index];
                                        }
                                    }
                                }

                                if (soptions.defaultValue == '') {
                                    for (contador in $t.p.postData) {
                                        if (contador == cm.index) {
                                            soptions.defaultValue += ';' + $t.p.postData[contador];
                                        } else if (contador == cm.index.replace('.', '-')) {
                                            soptions.defaultValue += ';' + $t.p.postData[contador];
                                        }

                                    }
                                }

                                if (soptions.defaultValue == '') {
                                    if (contador == cm.index) {
                                        if ($t.p.postData && $t.p.postData['filter'] && $t.p.postData['filter'][cm.name] && $t.p.postData['filter'][cm.name]['value'] && $t.p.postData['filter'][cm.name]['value'][cm.name]) {
                                            for (contador in $t.p.postData['filter'][cm.name]['value'][cm.name]) {
                                                if ($t.p.postData['filter'][cm.name]['value'][cm.name][contador] != '') {
                                                    soptions.defaultValue += ';' + $t.p.postData['filter'][cm.name]['value'][cm.name][contador];
                                                }
                                            }
                                        }
                                    }
                                }
                                soptions.defaultValue = soptions.defaultValue.substr(1);
                            }
                        } catch (err) {

                        }
                        switch (this.stype)
                        {
                            case "select":
                                surl = this.surl || soptions.dataUrl;
                                if (surl) {
                                    // data returned should have already constructed html select
                                    // primitive jQuery load
                                    self = thd;
                                    $.ajax($.extend({
                                        url: surl,
                                        dataType: "html",
                                        success: function (res, status) {
                                            if (soptions.buildSelect !== undefined) {
                                                var d = soptions.buildSelect(res);
                                                if (d) {
                                                    $(self).append(d);
                                                }
                                            } else {
                                                $(self).append(res);
                                            }
                                            if (soptions.defaultValue) {
                                                $("select", self).val(soptions.defaultValue);
                                            }
                                            $("select", self).attr({
                                                name: cm.index || cm.name,
                                                id: "gs_" + cm.name
                                            });
                                            if (soptions.attr) {
                                                $("select", self).attr(soptions.attr);
                                            }
                                            $("select", self).css({
                                                width: "100%"
                                            });
                                            // preserve autoserch
                                            if (soptions.dataInit !== undefined) {
                                                soptions.dataInit($("select", self)[0]);
                                            }
                                            if (soptions.dataEvents !== undefined) {
                                                bindEvents($("select", self)[0], soptions.dataEvents);
                                            }
                                            if (p.autosearch === true) {
                                                $("select", self).change(function (e) {
                                                    triggerToolbar();
                                                    return false;
                                                });
                                            }
                                            res = null;
                                        }
                                    }, $.jgrid.ajaxOptions, $t.p.ajaxSelectOptions || {}));
                                } else {
                                    var oSv;
                                    if (cm.searchoptions && cm.searchoptions.value) {
                                        oSv = cm.searchoptions.value;
                                    } else if (cm.editoptions && cm.editoptions.value) {
                                        oSv = cm.editoptions.value;
                                    } else if (cm.editoptions) {
                                        oSv = replace(replace(cm.editoptions, '}', ''), '{', '');
                                    }
                                    if (oSv) {
                                        var elem = document.createElement("select");
                                        elem.style.width = "100%";
                                        $(elem).attr({
                                            name: cm.index || cm.name,
                                            id: "gs_" + cm.name
                                        });
                                        var so, sv, ov;
                                        if (typeof oSv === "string") {
                                            so = oSv.split(";");
                                            for (var k = 0; k < so.length; k++) {
                                                sv = so[k].split(":");
                                                ov = document.createElement("option");
                                                ov.value = sv[0];
                                                ov.innerHTML = sv[1];
                                                elem.appendChild(ov);
                                            }
                                        } else if (typeof oSv === "object") {
                                            for (var key in oSv) {
                                                if (oSv.hasOwnProperty(key)) {
                                                    ov = document.createElement("option");
                                                    ov.value = key;
                                                    ov.innerHTML = oSv[key];
                                                    elem.appendChild(ov);
                                                }
                                            }
                                        }
                                        if (soptions.defaultValue) {
                                            $(elem).val(soptions.defaultValue);
                                        }
                                        if (soptions.attr) {
                                            $(elem).attr(soptions.attr);
                                        }
                                        if (soptions.dataInit !== undefined) {
                                            soptions.dataInit(elem);
                                        }
                                        if (soptions.dataEvents !== undefined) {
                                            bindEvents(elem, soptions.dataEvents);
                                        }
                                        $(thd).append(elem);
                                        if (p.autosearch === true) {
                                            $(elem).change(function (e) {
                                                triggerToolbar();
                                                return false;
                                            });
                                        }
                                    }
                                }
                                break;
                            case 'text':
                                var df = soptions.defaultValue ? soptions.defaultValue : "";
                                $(thd).append("<input type='text' style='width:100%' fieldname='"+ cm.fieldName +"' name='" + (cm.index || cm.name) + "' id='gs_" + cm.name + "' value='" + df + "' />");

                                //$(thd).append("<input type='text' style='width:95%;padding:0px;' name='"+(cm.index || cm.name)+"' id='gs_"+cm.name+"' value='"+df+"'/>");
                                if (soptions.attr) {
                                    $("input", thd).attr(soptions.attr);
                                }
                                if (soptions.dataInit !== undefined) {
                                    soptions.dataInit($("input", thd)[0]);
                                }
                                if (soptions.dataEvents !== undefined) {
                                    bindEvents($("input", thd)[0], soptions.dataEvents);
                                }
                                if (p.autosearch === true) {
                                    if (p.searchOnEnter) {
                                        $("input", thd).keypress(function (e) {
                                            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
                                            if (key == 13) {
                                                triggerToolbar();
                                                return false;
                                            }
                                            return this;
                                        });
                                    } else {
                                        $("input", thd).keydown(function (e) {
                                            var key = e.which;
                                            switch (key) {
                                                case 13:
                                                    return false;
                                                case 9 :
                                                case 16:
                                                case 37:
                                                case 38:
                                                case 39:
                                                case 40:
                                                case 27:
                                                    break;
                                                default :
                                                    if (timeoutHnd) {
                                                        clearTimeout(timeoutHnd);
                                                    }
                                                    timeoutHnd = setTimeout(function () {
                                                        triggerToolbar();
                                                    }, 500);
                                            }
                                        });
                                    }
                                }
                                break;
                        }
                    }
                    $(th).append(thd);
                    $(tr).append(th);
                });
                $("table thead", $t.grid.hDiv).append(tr);
                this.ftoolbar = true;
                this.triggerToolbar = triggerToolbar;
                this.clearToolbar = clearToolbar;
                this.toggleToolbar = toggleToolbar;
            });
        }
    });
})(jQuery);


function reloadGrid(idGrid) {
    $("#" + idGrid).trigger('reloadGrid');
}


var htmlBackup = [];

function updateGroupRepeat(name, newAdd) {
    var div_grupos = '';
    $("div").find("[id^=display-group-][group_repeat=" + name + "]").each(function () {
        div_grupos = getGroupRepeat(name, true);
        $(div_grupos).each(function (index) {
            var mainGroup = $(this).find('div');
            $(this).find('div').find('[id][name]').each(function () {
                if (!$(this).attr('original')) {
                    $(this).attr('original', $(this).attr('id'));
                    $(this).attr('name', $(this).attr('name') + '[]');
                }
                $(this).attr('id', $(this).attr('original') + '-' + index);

                var original = $(this).attr('original');
                var newOriginal = $(this).attr('id');
                $(mainGroup).find('[parent]').each(function () {
                    if (!$(this).attr('parent_original')) {
                        $(this).attr('parent_original', $(this).attr('parent'));
                    }
                });
                $(mainGroup).find('[parent_original=' + original + ']').attr('parent', newOriginal);

                if ($(this).hasClass('hasDatepicker')) {
                    $(this).removeClass('hasDatepicker');
                    $(this).datepicker().datepicker('disable');
                    $(this).datepicker().datepicker('enable');
                }
                /*if($(this).attr('widget_instance')){
                 var widget = $(this).attr('widget_instance');
                 $("body").append("<script> $('#" + $(this).attr('id') + "')." + widget + "; </script>");
                 }*/
            });
            $(this).find('div').find('[id^="btn_add_"],[id^="btn_del_"]').attr('idx', index);
            $(this).attr('idx', index);
            if (!$(this).find('hr').size()) {
                $(this).append('<hr/>');
            }
        });

        $(div_grupos).find('[id^="btn_add_"]').hide();
        $(div_grupos).find('[id^="btn_del_"]').show();
        var hasRequired = false;
        $(div_grupos).first().find('[id]').each(function () {
            if ($(this).hasClass('required')) {
                hasRequired = true;
            }
        });
        if ($(div_grupos).size() <= 1 && hasRequired) {
            $(div_grupos).first().find('[id^="btn_del_"]').hide();
        }
        $(div_grupos).last().find('hr').remove();
        $(div_grupos).last().find('[id^="btn_add_"]').show();
    });
    if (newAdd) {
        div_grupos = getGroupRepeat(name, true);
        $(div_grupos).last().find('[id]').each(function () {
            if ($(this).val()) {
                $(this).val('');
            }
            setScriptGroupRepeat($(this));
        });
        $(div_grupos).last().find('input[id]').last().focus();
    }
    reconfigEscEnter();
}

function setScriptGroupRepeat(element) {
    var novoId = $(element).attr('id');
    var original = $(element).attr('original');
    if (original != undefined) {
        var scripts = document.getElementsByTagName("script");
        var src = '';
        for (var i in scripts) {
            if (scripts[i].outerHTML != undefined && scripts[i].outerHTML.indexOf('ready') != -1) {
                var index = scripts[i].outerHTML.indexOf('#' + original);
                if (index != -1) {
                    src = scripts[i].outerHTML;
                    src = src.substr(index);
                    src = src.substr(0, src.indexOf(';') + 1);
                    while (src.indexOf("'") != -1) {
                        src = src.replace("'", '"');
                    }
                    src = '$("' + src;
                    src = src.replace(original, novoId);
                    try {
                        $("body").append('<script>' + src + '</script>');
                    } catch (ex) {
                    }
                    break;
                }
            }
        }
    }
}

function getGroupRepeat(name, childs) {
    var div = $("#display-group-" + name);
    if (childs) {
        return $(div).find('.form-group-content');
    }
    return $(div);
}

function setGroupRepeat(name, acao, id) {
    var div_main = getGroupRepeat(name);
    var div_grupos = getGroupRepeat(name, true);
    $(div_main).find("#div_btns_" + name + "-principal").remove();
    if (acao == 'add') {
        var htmlDiv = '';
        if (htmlBackup[name]) {
            htmlDiv = htmlBackup[name];
            htmlBackup[name] = '';
        } else {
            htmlDiv = $("<div/>").append($(div_grupos).last().clone()).html();
        }
        $(div_main).append(htmlDiv);
        updateGroupRepeat(name, true);
    } else if (acao == 'del') {
        var htmlButtons = '';
        if ($(div_grupos).size() == 1) {
            htmlBackup[name] = $("<div/>").append($(div_grupos).first().clone()).html();
            htmlButtons = $("<div/>").append($(div_grupos).first().find('[id^="btn_add_"]').clone()).html();
        }
        $(div_grupos).parent().find('[idx=' + id + ']').remove();
        if (htmlButtons) {
            $(div_main).append('<div class="form-group-content" id = "div_btns_' + name + '-principal">' + htmlButtons + '<div style="clear:both;"></div><br/></div>');
            htmlButtons = '';
        }
        updateGroupRepeat(name);
    }
}

function getGroupRepeatButtons(name) {
    var htmlButtons = '';
    htmlButtons = htmlButtons + '<div id="div_btns_' + name + '" style="margin-top:10px;float:left;">';
    htmlButtons = htmlButtons + '  <span id="btn_del_' + name + '" style="margem:0px; float:left; height: 25px; width: 25px;margin-left:0px;" class="ui-button ui-state-default ui-corner-right ui-button-icon-only" title="Remover" onclick="setGroupRepeat(\'' + name + '\', \'del\', $(this).attr(\'idx\'))">';
    htmlButtons = htmlButtons + '      <span class="ui-button-icon-primary ui-icon ui-icon-minus">';
    htmlButtons = htmlButtons + '      </span>';
    htmlButtons = htmlButtons + '  </span>';
    htmlButtons = htmlButtons + '  <span id="btn_add_' + name + '" style="margem:0px; float:left; height: 25px; width: 25px;margin-left:-2px;" class="ui-button ui-state-default ui-corner-right ui-button-icon-only" title="Adicionar" onclick="setGroupRepeat(\'' + name + '\', \'add\')">';
    htmlButtons = htmlButtons + '      <span class="ui-button-icon-primary ui-icon ui-icon-plus">';
    htmlButtons = htmlButtons + '      </span>';
    htmlButtons = htmlButtons + '  </span>';
    htmlButtons = htmlButtons + '</div>';
    return htmlButtons;
}

function setConfigGroupRepeat(element) {
    var name = $(element).attr('group_repeat');
    var div_grupo = getGroupRepeat(name, true);
    var table = $(div_grupo).find("div").first().find('[id]').first().attr('id').split('-')[0];
    $(element).attr('group_repeat_table', table);
    var fields = ['mapper', 'controller', 'column', 'id'];
    for (var i in fields) {
        var tmp = $('#' + 'group-' + table + '-' + fields[i]);
        if (tmp.size()) {
            var htmlDiv = $("<div/>").append($(tmp).clone()).html();
            $(tmp).remove();
            if (fields[i] == 'id') {
                $(div_grupo).prepend(htmlDiv);
            } else {
                $(element).prepend(htmlDiv);
            }
        }
    }
    $(div_grupo).find('div').last().before(getGroupRepeatButtons(name));
    updateGroupRepeat(name);
}

$(document).ready(function () {
    $("div").find("[id^=display-group-][group_repeat!='']").each(function () {
        setConfigGroupRepeat($(this));
    });
});