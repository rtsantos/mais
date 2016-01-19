(function ($) {
    $.gridResize = function (options) {
        var vGrid = jQuery('#' + options.idGrid);
        var containerGrid = vGrid.parent().parent().parent().parent().parent();
        var width = 0;
        var height = 0;

        //Se na chamada não for setada largura
        //Defina o valor resgatando a largura do pai do grid em questão
        //Faça o mesmo a altura
        if (!options.width) {
            width = $(window).width() - containerGrid.offset().left - 35;
        } else {
            width = options.width;
        }

        if (!options.height) {
            //Seto height do container e Grid com tirando a margem do topo - uma margem ( 35 )
            //de adaptação para se enquadar no layout da aplicação
            height = $(window).height() - containerGrid.offset().top - 35;
        } else {
            height = options.height;
        }

        //Se o valor da largura for menor que o limite estabelecido defina
        //um valor padrão
        //Faça o mesmo para altura
        if (width < 100) {
            width = 500;
        }

        if (height < 100) {
            height = 300;
        }

        //Defina a largura, altura do grid
        //e a altura da toolbar
        //containerGrid.height(height);

        if (containerGrid.attr('id') == 'windowContent') {
            vGrid.setGridHeight(height - 80);
            vGrid.setGridWidth(width - 20);
        } else {
            vGrid.setGridWidth(width - 5);
            if (containerGrid.attr('id') == 'tbBrConteudoCentro') {
                vGrid.setGridHeight(height - 150);
            } else {
                vGrid.setGridHeight(height - 160);
            }
        }
        $('#t_' + options.idGrid).height(35);
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
    $.gridAtivaNavKey = function (options) {
        var vGrid = jQuery('#' + options.idGrid);
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
        appendToolbar: function (elem, button) {
            options = {
                id: '',
                html: '',
                onClick: function () {
                }
            };
            $("#t_" + elem).append(button.html)
                    .css('min-height', '35px');
            $('#' + button.id).click(button.onClick)
                    .hover(
                            function () {
                                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                            },
                            function () {
                                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                            });
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
                            case 'check':
                                $("#gs_" + $.jgrid.jqID(this.name), (this.frozen === true && $t.p.frozenColumns === true) ? $t.grid.fhDiv : $t.grid.hDiv).val(v);
                                $("#innerDivSearch" + $.jgrid.jqID(this.name)).find(':checkbox').attr('checked', false);
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
                        try {
                            if (!soptions.defaultValue) {
                                var contador = 0;
                                soptions.defaultValue = '';

                                for (contador in $t.p.postData['filter']) {
                                    if ($t.p.postData['filter'][contador]['field'][contador + 'field'] == cm.index) {
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
                                    if ($t.p.postData && $t.p.postData['filter'] && $t.p.postData['filter'][cm.name] && $t.p.postData['filter'][cm.name]['value'] && $t.p.postData['filter'][cm.name]['value'][cm.name]) {
                                        for (contador in $t.p.postData['filter'][cm.name]['value'][cm.name]) {
                                            if ($t.p.postData['filter'][cm.name]['value'][cm.name][contador] != '') {
                                                soptions.defaultValue += ';' + $t.p.postData['filter'][cm.name]['value'][cm.name][contador];
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
                            case 'check':
                                var df = soptions.defaultValue ? soptions.defaultValue : "";
                                var pVal = df.split(';');
                                var tVal;
                                var eChecked = '';
                                df = '';
                                for (tVal in pVal) {
                                    if (cm.listOptions[pVal[tVal]]) {
                                        df += ';' + cm.listOptions[pVal[tVal]];
                                    }
                                }
                                df = df.substr(1);
                                var checkOptions;
                                if (cm.listOptions) {
                                    $('.searchCheck').die();
                                    $('#divSearch' + cm.name).remove();
                                    $('#gs_' + cm.name).remove();
                                    $(thd).append("<input type='text' style='width:" + (cm.width - 22) + "px;float:left;' title='Clique para abrir as opções de pesquisa' name='" + (cm.index || cm.name) + "' id='gs_" + cm.name + "' class='searchCheck' value='" + df + "' readonly='readonly'/><button onclick='javascript:triggerCheck(\"" + cm.name + "\");' style='width:18px;height:18px;margin-top:1px;margin-left:0px;' class='t-ui-button ui-button ui-corner-all ui-state-default'><span class='ui-icon ui-icon-triangle-1-s' style='width:15px;height:18px;margin-top:-4px'onclick='javascript:triggerCheck(\"" + cm.name + "\");'>&nbsp;</span></button>");
                                    $('body').append("<div id='divSearch" + cm.name + "' class='divSearchCheck'></div>");
                                    $('#divSearch' + cm.name).append("<div id='innerDivSearch" + cm.name + "' class='innerDivSearchCheck'></div>");
                                    for (checkOptions in cm.listOptions) {
                                        eChecked = '';
                                        if (jQuery.inArray(checkOptions, pVal) >= 0) {
                                            eChecked = ' checked="checked" ';
                                        }
                                        $('#innerDivSearch' + cm.name).append('<input type="checkbox"  value="' + cm.listOptions[checkOptions] + '" name="check' + cm.name + '" id="' + cm.name + cm.listOptions[checkOptions] + '" ' + eChecked + '/><label for="' + cm.name + cm.listOptions[checkOptions] + '">' + cm.listOptions[checkOptions] + '</label><br>');
                                    }
                                    $('#divSearch' + cm.name).append('<div class="ui-userdata ui-state-default"><input style="margin-left:5px;" type="checkbox" class="selAllbt" value="selAllbt" id="selAllbt' + cm.name + '"/>Todos<button class="t-ui-button ui-button ui-corner-all ui-state-default pesquisarCheck" style="margin-left:45px;margin-bottom:2px;width:40px;">Ok</button></div>');

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
                                    }
                                    $('.selAllbt').live('click', function () {
                                        $(this).parent().parent().find('.innerDivSearchCheck input:checkbox').attr('checked', $(this).attr('checked')).change();
                                    });
                                    $('.searchCheck').live('click', function () {
                                        if (this.name.lastIndexOf('.') >= 0) {
                                            var name = this.name.substr(this.name.lastIndexOf('.') + 1);
                                            triggerCheck(name);
                                        }
                                    });
                                    $('.pesquisarCheck').click(function () {
                                        triggerToolbar();
                                        hideDivSearch('.divSearchCheck');
                                    });
                                    $('.searchCheck').live('mouseleave', function () {
                                        if (this.name.lastIndexOf('.') >= 0) {
                                            var name = this.name.substr(this.name.lastIndexOf('.') + 1);
                                            if ($('#divSearch' + name).css('display') != 'none') {
                                                $('#divSearch' + name).attr('keep', '0');
                                                setTimeout(function () {
                                                    if ($('#divSearch' + name).attr('keep') != '1') {
                                                        hideDivSearch('#divSearch' + name);
                                                    }
                                                }, 2000);
                                            }
                                        }
                                    });
                                    $('.divSearchCheck').live('mouseleave', function () {
                                        var tid = this.id;
                                        if ($('#' + tid).css('display') != 'none') {
                                            $('#' + tid).attr('keep', '0');
                                            setTimeout(function () {
                                                if ($('#' + tid).attr('keep') != '1') {
                                                    hideDivSearch('#' + tid);
                                                }
                                            }, 2000);
                                        }
                                    });
                                    $('.divSearchCheck').live('mouseenter', function () {
                                        var tid = this.id;
                                        if ($('#' + tid).css('display') != 'none') {
                                            $('#' + tid).attr('keep', '1');
                                        }
                                    });
                                    $('.divSearchCheck input').live('change', function () {
                                        if ($(this).val() != 'selAllbt') {
                                            var divParent = $(this).parent();
                                            var checkeds = $('#' + divParent.attr('id') + ' input:checked');
                                            var strVal = '';
                                            for (i = 0; i < checkeds.length; i++) {
                                                if (checkeds[i].value != 'selAllbt') {
                                                    strVal += ';' + checkeds[i].value;
                                                }
                                            }
                                            if (strVal.length > 0) {
                                                strVal = strVal.substr(1);
                                            }
                                            $('#gs_' + replace($(this).attr('name'), 'check', '')).val(strVal);
                                        }
                                    });
                                    $('.divSearchCheck input').live('click', function () {
                                        if ($(this).val() != 'selAllbt') {
                                            var divParent = $(this).parent();
                                            var checkeds = $('#' + divParent.attr('id') + ' input:checked');
                                            var strVal = '';
                                            for (i = 0; i < checkeds.length; i++) {
                                                if (checkeds[i].value != 'selAllbt') {
                                                    strVal += ';' + checkeds[i].value;
                                                }
                                            }
                                            if (strVal.length > 0) {
                                                strVal = strVal.substr(1);
                                            }
                                            $('#gs_' + replace($(this).attr('name'), 'check', '')).val(strVal);
                                        }
                                    });
                                }
                                break;
                            case 'seeker':
                                var df = soptions.defaultValue ? soptions.defaultValue : "";
                                $(thd).append("<input type='hidden' name='" + (cm.index || cm.name) + "' id='filter_gs_" + cm.name + "' value='" + df + "'><input type='text' title='Utilize ponto-e-virgula(;) para procurar varios valores e espaço para invervalo de valores' style='width:80%;padding:0px;' name='search_" + (cm.index || cm.name) + "' id='gs_" + cm.name + "' value='" + df + "'/><button id='gs_" + cm.name + "_btSearch' style='width:18px;height:20px;'></button>");
                                /*
                                 * @TODO: É necessario pegar parametros para url do seeker
                                 *
                                 *if(p.autosearch===true){
                                 if(p.searchOnEnter) {
                                 $("input",thd).keypress(function(e){
                                 var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
                                 if(key == 13){
                                 triggerToolbar();
                                 return false;
                                 }
                                 return this;
                                 });
                                 }
                                 }*/
                                /*$(document).ready(function(){
                                 $("#gs_"+cm.name).seeker({"seekerOperationType":"?%","windowWidth":800,"windowHeight":450,"url":{"grid":"\/AppTA\/index.php\/ca\/filial\/grid","search":"\/AppTA\/index.php\/ca\/filial\/seeker-search","retrive":"\/AppTA\/index.php\/ca\/filial/retrive"},"fieldsReturn":["id","sigla"],"name":"gs_"+cm.name,"idButton":"gs_"+cm.name+"_btSearch","idHiddenId":(cm.index || cm.name),"typeModal":"WINDOW"})[0].seekerCreateEvents();
                                 });*/
                                break;
                            case 'text':
                                var df = soptions.defaultValue ? soptions.defaultValue : "";
                                $(thd).append("<input type='text' style='width:" + (cm.width - 22) + "px;float:left;' title='Clique para abrir as opções de pesquisa' name='" + (cm.index || cm.name) + "' id='gs_" + cm.name + "' class='searchCheck' value='" + df + "' /><button onclick='javascript:triggerSearchHelp();' style='margin-left:0px;width:18px;height:18px;margin-top:1px;' class='t-ui-button ui-button ui-corner-all ui-state-default'><span class='ui-icon ui-icon-help' style='width:15px;height:18px;margin-top:-4px'onclick='javascript:triggerSearchHelp();'>&nbsp;</span></button>");

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
function triggerCheck(nameGrid) {
    if ($("#divSearch" + nameGrid).css('display') == 'none') {
        showDivSearch(nameGrid);
    } else {
        hideDivSearch("#divSearch" + nameGrid);
    }
}
function hideDivSearch(nameGrid) {
    $(nameGrid).attr('keep', '0');
    $(nameGrid).slideUp('fast');
}

function showDivSearch(nameGrid) {
    var tpos = $("#gs_" + nameGrid).offset();
    var twidth = $("#gs_" + nameGrid).width();
    $("#divSearch" + nameGrid).css('left', tpos.left + 'px')
            .css('top', (tpos.top + 18) + 'px')
            .css('width', '150px');
    //.css('width',twidth+18+'px');
    $("#divSearch" + nameGrid).attr('keep', '1');
    $("#divSearch" + nameGrid).slideDown('fast');
}

function triggerSearchHelp() {
    $('body').append("<div id='help-grid' style='display:none;'></div>");
    var helpGrid = jQuery('#help-grid');

    var textTitle = '<h2>Exemplos de Pesquisa:</h2>';
    textTitle = textTitle + '<h3>&nbsp;</h3>';
    textTitle = textTitle + '<h3>Pesquisa em Texto</h3>';
    textTitle = textTitle + '<p><strong><em>  Opções: </em></strong><br />';
    textTitle = textTitle + '  1 - Informe uma palavra ou parte dela. <em>Exemplo: &quot;AMERIC&quot;;</em><br />';
    textTitle = textTitle + '2 - Coloque o operador &quot;=&quot; antes da palavra para obter um resultado idêntico ao digitado. <em>Exemplo: &quot;=TA&quot;.</em><br />';
    textTitle = textTitle + '3 - Coloque o operador &quot;NULO&quot; ou &quot;NULL&quot; para obter um resultado que seja nulo (vazio).</em></p>';
    textTitle = textTitle + '<h3>&nbsp;</h3>';
    textTitle = textTitle + '<h3>Pesquisa em Número</h3>';
    textTitle = textTitle + '<p><em><strong>  Opções: </strong></em><br />';
    textTitle = textTitle + '  1 - Informando um número, será pesquisado um resultado idêntico ao digitado. <em>Exemplo: &quot;1&quot;; </em><br />';
    textTitle = textTitle + '  2 - Informando dois números separado por espaço &quot; &quot;, será realizado uma pesquisa por período &quot;de 1 até 100&quot;. <em>Exemplo: &quot;1 100&quot;;</em><br />';
    textTitle = textTitle + '  3 - Informando números separados por ponto e vírgula &quot;;&quot;, será realizado uma pesquisa para obter resultados idêntico aos números digitados. <em>Exemplo: &quot;1;2;3&quot;</em>;<br />';
    textTitle = textTitle + '  4 - Coloque o operador &quot;=&quot; antes do número para obter um resultado idêntico ao digitado. <em>Exemplo: &quot;=100&quot;</em>;<br />';
    textTitle = textTitle + '  5 - Coloque o operador &quot;&gt;&quot; antes do número para obter um resultado maior que o digitado. <em>Exemplo: &quot;&gt;100&quot;;</em><br />';
    textTitle = textTitle + '  6 - Coloque o operador &quot;&gt;=&quot; antes do número para obter um resultado maior ou igual ao digitado. <em>Exemplo: &quot;&gt;=100&quot;</em>;<br />';
    textTitle = textTitle + '  7 - Coloque o operador &quot;&lt;&quot; antes do número para obter um resultado menor que o digitado. <em>Exemplo: &quot;&lt;100&quot;</em>;<br />';
    textTitle = textTitle + '  8 - Coloque o operador &quot;&lt;=&quot; antes do número para obter um resultado menor ou igual ao digitado. <em>Exemplo: &quot;&lt;=100&quot;</em>;</br />';
    textTitle = textTitle + '9 - Coloque o operador "!=" antes do número para obter um resultado diferente que o digitado. <em>Exemplo: "!="</em>.</p>';
    textTitle = textTitle + '<h3>Pesquisa em Data</h3>';
    textTitle = textTitle + '<p><em><strong>Opções: </strong></em><br />';
    textTitle = textTitle + '  1 - Informando uma data, será pesquisado um resultado idêntico ao digitado. <em>Exemplo: &quot;01/01/2012&quot;</em>; <br />';
    textTitle = textTitle + '  2 - Informando duas datas separado por espaço &quot; &quot;, será realizado uma pesquisa por período &quot;de 01/01/2012 até 31/01/2012&quot;. <em>Exemplo: &quot;01/01/2012 31/01/2012&quot;</em>;<br />';
    textTitle = textTitle + '  3 - Informando datas separadas por ponto e vírgula &quot;;&quot;, será realizado uma pesquisa para obter resultados idêntico as datas digitadas. <em>Exemplo: &quot;01/01/2012;31/01/2012&quot;</em>;<br />';
    textTitle = textTitle + '  4 - Coloque o operador &quot;=&quot; antes da data para obter um resultado idêntico ao digitado. <em>Exemplo: &quot;=01/01/2012&quot;</em>;<br />';
    textTitle = textTitle + '  5 - Coloque o operador &quot;&gt;&quot; antes da data para obter um resultado maior que o digitado. <em>Exemplo: &quot;&gt;01/01/2012&quot;</em>;<br />';
    textTitle = textTitle + '  6 - Coloque o operador &quot;&gt;=&quot; antes da data para obter um resultado maior ou igual ao digitado. <em>Exemplo: &quot;&gt;=01/01/2012&quot;;</em><br />';
    textTitle = textTitle + '  7 - Coloque o operador &quot;&lt;&quot; antes da data para obter um resultado menor que o digitado. <em>Exemplo: &quot;&lt;01/01/2012&quot;;</em><br />';
    textTitle = textTitle + '  8 - Coloque o operador &quot;&lt;=&quot; antes da data para obter um resultado menor ou igual ao digitado. <em>Exemplo: &quot;&lt;=01/01/2012&quot;;</em><br />';
    textTitle = textTitle + '9 - Coloque o operador "!=" antes da data para obter um resultado diferente que o digitado. <em>Exemplo: "!="</em>.';
    textTitle = textTitle + '</p>';
    textTitle = textTitle + '<h3>Pesquisa em Data e Hora</h3>';
    textTitle = textTitle + '<p><em><strong>Opções: </strong></em><br />';
    textTitle = textTitle + '  1 - Informando uma data, será pesquisado um resultado idêntico ao digitado. <em>Exemplo: &quot;01/01/2012-13:00&quot;</em>; <br />';
    textTitle = textTitle + '  2 - Informando duas datas separado por espaço &quot; &quot;, será realizado uma pesquisa por período &quot;de 01/01/2012 12:00 até 31/01/2012 17:00&quot;. <em>Exemplo: &quot;01/01/2012-12:00 31/01/2012-17:00&quot;</em>;<br />';
    textTitle = textTitle + '  3 - Informando datas separadas por ponto e vírgula &quot;;&quot;, será realizado uma pesquisa para obter resultados idêntico as datas digitadas. <em>Exemplo: &quot;01/01/2012-13:00;31/01/2012-13:00&quot;</em>;<br />';
    textTitle = textTitle + '  4 - Coloque o operador &quot;=&quot; antes da data para obter um resultado idêntico ao digitado. <em>Exemplo: &quot;=01/01/2012-13:00&quot;</em>;<br />';
    textTitle = textTitle + '  5 - Coloque o operador &quot;&gt;&quot; antes da data para obter um resultado maior que o digitado. <em>Exemplo: &quot;&gt;01/01/2012-13:00&quot;</em>;<br />';
    textTitle = textTitle + '  6 - Coloque o operador &quot;&gt;=&quot; antes da data para obter um resultado maior ou igual ao digitado. <em>Exemplo: &quot;&gt;=01/01/2012-13:00&quot;;</em><br />';
    textTitle = textTitle + '  7 - Coloque o operador &quot;&lt;&quot; antes da data para obter um resultado menor que o digitado. <em>Exemplo: &quot;&lt;01/01/2012-13:00&quot;;</em><br />';
    textTitle = textTitle + '  8 - Coloque o operador &quot;&lt;=&quot; antes da data para obter um resultado menor ou igual ao digitado. <em>Exemplo: &quot;&lt;=01/01/2012-13:00&quot;;</em><br />';
    textTitle = textTitle + '9 - Coloque o operador "!=" antes da data para obter um resultado diferente que o digitado. <em>Exemplo: "!="</em>.';
    textTitle = textTitle + '</p>';

    helpGrid.html(textTitle);
    //helpGrid.title('Ajuda?');
    helpGrid.dialog({
        title: '? Ajuda',
        modal: true,
        width: 700,
        height: 400
    });
}