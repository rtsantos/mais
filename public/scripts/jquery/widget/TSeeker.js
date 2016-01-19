/**
 * jQuery.TSeeker
 *
 * Description:
 * Componente criado para implementação de um combo customizado
 * onde o usuário poderá inserir e excluir dados de uma tabela de uma
 * forma dinâmica, rápida e prática.
 *
 * @author: rsantos
 * @version: 0.1
 * 
 * Depends:
 *      jQuery.ui,
 *      jQuery.ui.TSeeker
 */
(function ($) {
    $.fn.extend({
        retrive: function (param) {
            var self = jQuery(this);
            self.TSeeker('retrive', param);
        },
        isValid: function () {
            var self = jQuery(this);
            return self.TSeeker('isLoaded');
        }
    });

    $.widget('ta.TSeeker', {
        options: {
            onFilter: null,
            onSearchValid: null,
            onChange: null,
            onNotFound: null,
            autoComplete: {
                onResult: null,
                onFormat: null,
                extraParams: null
            },
            elements: {
                id: null,
                display: null,
                button: null,
                div: null,
                others: [],
                nameid: null
            },
            name: null,
            url: {
                grid: null,
                retrive: null,
                retrieve: null,
                search: null,
                autoComplete: false
            },
            modal: {
                type: null,
                height: 850,
                width: 700
            },
            data: [],
            newdata: [],
            control: null,
            fields: [],
            multiple: 0,
            filterRefer: []
        },
        _create: function () {
            if (this.options.name == null) {
                this.options.name = this.element.attr('id');
            }

            if (this.options.url.retrieve == null && this.options.url.retrive != null) {
                this.options.url.retrieve = this.options.url.retrive;
            }

            this.options.elements.nameid = this.options.elements.id;

            if (typeof this.options.elements.id == 'string') {
                this.options.elements.id = $('#' + this.options.elements.id);
            }
            this.element.attr('valueold', this.element.val());


            if (typeof this.options.elements.display == 'string' && this.options.elements.display != '') {
                this.options.elements.display = $('#' + this.options.elements.display);
            } else {
                this.options.elements.display = null;
            }
            if (typeof this.options.elements.button == 'string') {
                this.options.elements.button = $('#' + this.options.elements.button);
            }
            if (typeof this.options.elements.div == 'string') {
                this.options.elements.div = $('#' + this.options.elements.div);
            }
            for (var index in this.options.elements.others) {
                if (typeof this.options.elements.others[index] == 'string') {
                    this.options.elements.others[index] = $('#' + this.options.elements.others[index]);
                    this.options.elements.others[index].attr('readonly', true);
                }
            }
            /**
             * 
             */
            if (this.options.elements.display != null) {
                this.options.elements.display.attr('readonly', true);
            }

            this.element.blur(this.execute);
            /**
             * 
             */
            this.options.elements.button.click(this.buttonOnClick)
                    .addClass('ui-corner-right')
                    .removeClass('ui-corner-all');
            this.buttonNoFocus();
            /**
             * Habilita auto complete na seeker
             */
            if (this.options.url.autoComplete && typeof this.options.autoComplete.onResult == 'function') {
                var varlistWidth = this.element.width();
                if (this.options.elements.display != null) {
                    varlistWidth = varlistWidth + this.options.elements.display.width();
                }
                for (index in this.options.elements.others) {
                    varlistWidth = varlistWidth + this.options.elements.others[index].width();
                }
                varlistWidth = varlistWidth + 15;
                if (this.options.onFilter != null) {
                    this.options.autoComplete.extraParams.filter_json = this.options.onFilter;
                }
                if (this.options.onSearchValid != null) {
                    this.options.autoComplete.extraParams.search_valid = this.options.onSearchValid;
                }
                this.element.TAutocomplete({
                    dataSource: this.options.url.autoComplete,
                    onResult: this.options.autoComplete.onResult,
                    extraParams: this.options.autoComplete.extraParams,
                    onFormatResult: this.options.autoComplete.onFormat,
                    onFormatItem: this.options.autoComplete.onFormat,
                    onFormatMatch: this.options.autoComplete.onFormat,
                    listWidth: varlistWidth
                });
            }

            if (typeof this.options.data == 'object') {
                for (var index in this.options.data) {
                    this.loadData(this.options.data[index], 'seeker');
                }
            }

            this.disabled(this.element.attr('disabled'));

            var controlClick = false;
            jQuery("#" + this.element.attr('id')).click(function () {
                if (!controlClick) {
                    controlClick = true;
                    $(this).click();
                    controlClick = false;
                }
            });
        },
        disabled: function (value) {
            if (value) {
                $("#group-" + this.element.attr('id') + " *").attr('disabled', true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        execute: function () {
            var self = $(this);
            self.TSeeker('option', 'control', 'search');
            if (self.val() == '') {
                self.TSeeker('clear');
                /*if (self.hasClass('required')){
                 self.TSeeker('search');
                 }*/
            } else {
                if (self.attr('valueold') == '') {
                    self.TSeeker('search');
                } else if (self.attr('valueold') != self.val()) {
                    self.TSeeker('search');
                }
            }
        },
        block: function () {
            document.body.style.cursor = 'wait';
            //ui-state-loading
            //this.element.addClass('ac_input');
            this.element.addClass('ac_loading');
            var icon = this.options.elements.button.find('span').eq(0);
            icon.removeClass('ui-icon-search');
            icon.addClass('ui-icon-refresh');
        },
        unBlock: function () {
            document.body.style.cursor = '';
            var icon = this.options.elements.button.find('span').eq(0);
            icon.removeClass('ui-icon-refresh');
            icon.addClass('ui-icon-search');
            this.element.removeClass('ac_loading');
        },
        /**
         * 
         * @param string param
         * @returns void
         * @deprecated since version 1.1
         */
        retrive: function (param) {
            this.retrieve(param);
        },
        retrieve: function (param) {
            var json = $.ajax({
                type: 'POST',
                url: this.options.url.retrieve,
                data: 'id=' + escape(param.value) + '&seekerAjax=1&seekerName=' + this.options.name,
                async: false
            }).responseText;
            json = decodeJson(json);
            if (json == false) {
                alert('Erro gerado na solicitação!');
                this.element.addClass("seeker");
                this.options.control = 'erro';
            } else {
                this.loadData(json, 'seeker');
            }
            this.unBlock();
            /**
             * Pula para o próximo campo
             */
            nextFocus(this.element);
        },
        search: function () {
            this.block();
            var field = '';
            var value = '';
            var paramData = 'paramData=1';
            var filterData = '';

            if (this.options.onFilter != null) {
                filterData = this.options.onFilter();
                if (filterData == false) {
                    this.unBlock();
                    return false;
                }
            }

            if (this.options.control == 'detail') {
                value = this.options.elements.id.val();
                field = 'id';
                paramData = 'makePostData=1';
            } else {
                this.options.elements.id.val('');
                value = this.element.val();
                field = '';
            }

            this.element.removeClass("seeker");

            if (this.options.onSearchValid != null) {
                var searchValid = this.options.onSearchValid();
                if (searchValid == false) {
                    return false;
                }
            }

            var json = $.ajax({
                type: 'POST',
                url: this.options.url.search,
                data: 'value=' + value + '&field=' + field + '&limit=10' + '&seekerAjax=1' + '&' + paramData + '&filter_json=' + filterData,
                async: false
            }).responseText;
            json = decodeJson(json);
            if (json == false) {
                alert('Erro gerado na solicitação!');
                this.element.addClass("seeker");
                this.options.control = 'erro';
            } else {
                if (json.error) {
                    alert('Erro: ' + json.exception.message);
                    this.element.addClass("seeker");
                    this.options.control = 'erro';
                } else if (json.row) {
                    this.loadData(json.row, 'seeker-no-window');
                    nextFocus(this.element);
                } else if (json.postData) {
                    if (json.numRows <= 1 && typeof this.options.onNotFound == 'function') {
                        this.unBlock();
                        this.options.onNotFound(value);
                        return false;
                    }
                    this.options.control = 'loading';

                    var param = 'name=' + this.options.name + '&postData=' + json.postData;
                    if (this.options.modal.type.toLowerCase() == 'div') {
                        this.divSearch(param, json.postData);
                    } else {
                        this.windowSearch(param);
                    }
                } else {
                    this.loadData(json, 'seeker');
                }
            }
            this.unBlock();
        },
        clear: function () {
            var data = [];
            var index = null;

            this.element.addClass("seeker").attr('valueold', '');
            this.options.control = '';

            for (index in this.options.fields) {
                data[this.options.fields[index]] = '';
            }
            this.element.val('');
            this.options.elements.id.val('');
            if (this.options.elements.display != null) {
                this.options.elements.display.val('');
            }
            for (index in this.options.elements.others) {
                this.options.elements.others[index].val('');
            }
            if (this.options.onChange != null) {
                this.options.onChange(data);
            }
            this.buttonNoFocus();
            this.unBlock();
        },
        isLoaded: function () {
            return true;// @todo plug-in do jQuery validate estava gerando problemas com essa validação
            //       estarei reservando um tempo futuramente para entender como resolver o bug.
            if (this.element.hasClass('required') && this.options.elements.id.val() == '') {
                return false;
            } else if (this.element.val() != '' && this.options.elements.id.val() == '') {
                return false
            } else {
                return true;
            }
        },
        existsData: function (data) {
            for (var index in this.options.newdata) {
                if (this.options.newdata[index] == data) {
                    return true;
                }
            }
            return false;
        },
        updateData: function (data, reset) {
            if (reset == true) {
                this.options.newdata = [];
            }

            data = data.split(';');
            for (var index in data) {
                if (this.existsData(data[index]) == false) {
                    this.options.newdata.push(data[index]);
                }
            }
        },
        change: function () {
            if (this.options.onChange != null) {
                var data = {};
                data.id = this.options.elements.id.val();
                data[this.element.attr('field')] = this.element.val();
                if (this.options.elements.display != null) {
                    data[this.options.elements.display.attr('field')] = this.options.elements.display.val();
                }
                for (var index in this.options.elements.others) {
                    data[this.options.elements.others[index].attr('field')] = this.options.elements.others[index].val();
                }
                this.options.onChange(data);
            }
        },
        loadData: function (data, access) {
            for (var index in data) {
                if (this.existsData(data[index]) == true) {
                    return;
                }
                break;
            }

            this.element.addClass("seeker");
            this.options.control = 'loading';
            var index = null;
            var value = null;

            /*var origData = data;
             if (access == 'edit') {
             data = [];
             if (origData[this.options.elements.id.attr('id')]) {
             data['id'] = origData[this.options.elements.id.attr('id')];
             }
             if (origData[this.element.attr('id')]) {
             data[this.element.attr('field')] = origData[this.element.attr('id')];
             }
             for (index in this.options.elements.others) {
             if (origData[this.options.elements.others[index].attr('field')]) {
             data[this.options.elements.others[index].attr('field')] = origData[this.options.elements.others[index].attr('field')];
             }
             }
             }*/

            /**
             * Trata o array para deixar tudo em caixa baixa
             */
            if (typeof data[0] == 'object') {
                var newData = [];
                var indexF = null;
                for (index in data) {
                    for (indexF in data[index]) {
                        value = data[index][indexF];
                        if (!newData[indexF]) {
                            newData[indexF] = '';
                        }
                        if (value != 'undefined') {
                            newData[indexF] = newData[indexF] + ',' + data[index][indexF];
                        }
                    }
                }
                for (index in newData) {
                    newData[index] = newData[index].substr(1);
                }
                data = newData;
            }
            for (index in data) {
                if (index.toLowerCase() != index) {
                    value = data[index];
                    delete data[index];
                    data[index.toLowerCase()] = value;
                }
            }

            this.options.elements.id.val(data[this.options.elements.id.attr('field').toLowerCase()]);
            if (this.options.elements.id.val() == '') {
                this.clear();
            } else {
                this.element.removeClass('erro');

                if (this.options.multiple) {
                    var id = this.element.attr('id');
                    var table = jQuery('#table-' + id + '-multiple');
                    jQuery('#table-title-' + id + '-multiple').show();
                    var tr = '<tr>';
                    tr = tr + '<td class="ac-multi" style="display:none;">';
                    tr = tr + data[this.options.elements.id.attr('field').toLowerCase()];
                    tr = tr + '</td>';
                    tr = tr + '<td style="width:' + this.element.css('width') + ';">';
                    tr = tr + data[this.element.attr('field')];
                    tr = tr + '</td>';
                    if (this.options.elements.display != null) {
                        tr = tr + '<td style="width:' + this.options.elements.display.css('width') + ';">';
                        tr = tr + data[this.options.elements.display.attr('field').toLowerCase()];
                        tr = tr + '</td>';
                    }
                    for (index in this.options.elements.others) {
                        tr = tr + '<td style="width:' + this.options.elements.others[index].css('width') + ';">';
                        tr = tr + data[this.options.elements.others[index].attr('field').toLowerCase()];
                        tr = tr + '</td>';
                        this.options.elements.others[index].val('');
                    }
                    tr = tr + '<td style="width:20px;">';

                    var funcDelElement = "jQuery('#" + id + "').Tdata('TSeeker').delElement(this);"

                    tr = tr + '<button type="button" onclick="' + funcDelElement + '" class="ui-button ui-state-default">';
                    tr = tr + '<span class="ui-icon ui-icon-circle-close"></span>';
                    tr = tr + '</button>';

                    tr = tr + '</td>';
                    tr = tr + '</tr>';
                    table.append(tr);
                    this._multipleChangeId();

                    this.element.val('');
                    this.element.attr('valueold', '');
                    this.options.elements.id.val('');
                    if (this.options.elements.display != null) {
                        this.options.elements.display.val('');
                    }
                } else {
                    this.element.val(data[this.element.attr('field')]);
                    this.element.attr('valueold', this.element.val());
                    if (this.options.elements.display != null) {
                        this.options.elements.display.val(data[this.options.elements.display.attr('field').toLowerCase()]);
                    }
                    for (index in this.options.elements.others) {
                        this.options.elements.others[index].val(data[this.options.elements.others[index].attr('field').toLowerCase()]);
                    }
                    for (index in this.options.filterRefer) {
                        var searchid = $("#" + this.options.filterRefer[index]).attr('searchid');
                        $("#" + searchid).val('').blur();
                        $('#table-' + searchid + '-multiple tr span').click();
                    }
                }
                this.options.seekerControl = 'loaded';
                if (access == 'seeker') {
                    this.element.focus();
                }
                if (this.options.onChange != null) {
                    this.options.onChange(data);
                }
                /**
                 * Objeto carregado não precisa dar o focus no botão para abrir janela.
                 **/
                this.buttonNoFocus();
                this.unBlock();
            }
        },
        _multipleChangeId: function () {
            var id = this.element.attr('id');
            var values = jQuery('#table-' + id + '-multiple').parent().find('.ac-multi');
            var newValue = '';
            for (var index = 0; index < values.length; index++) {
                newValue = newValue + ';' + values.eq(index).html();
                //alert(values.eq(index).html());
            }
            //this.elements.id.val(newValue.substr(1));
            newValue = newValue.substr(1);
            jQuery('#' + id + '-multiple').val(newValue);
            jQuery('#' + this.options.elements.nameid + '-multiple').val(newValue);
            if (!values.length) {
                jQuery('#table-title-' + id + '-multiple').hide();
            }
            this.updateData(newValue, true);
        },
        delElement: function (item) {
            jQuery(item).parent().parent().remove();
            this._multipleChangeId();
        },
        divSearch: function (param, paramPostData) {
            var filterData = '';
            $('.div-grid-seeker').css('display', 'none');

            if (this.options.onFilter != null) {
                filterData = this.options.onFilter();
                if (filterData == false) {
                    this.unBlock();
                    return false;
                }
            }

            if (!param)
                param = 'seekerAjax=1';
            else
                param = 'seekerAjax=1&' + param;
            param = param + '&filter_json=' + filterData;
            param = param + '&typeModal=AJAX';

            var grid = this.options.elements.div.find('#grid_' + this.options.elements.div.attr('searchId'));
            if (grid.length > 0) {
                this.options.elements.div.show();
                grid.jqGrid("setGridParam", {postData: decodeJson(paramPostData)}).trigger("reloadGrid", [{page: 1}]);
            } else {
                this.options.elements.div.css('position', 'absolute')
                        .css('z-index', '99999999')
                        .css('-moz-box-shadow', '5px 5px 5px #cecece')
                        .css('-webkit-box-shadow', '5px 5px 5px #cecece')
                        .css('box-shadow', '5px 5px 5px #cecece')
                        .show();
                if (this.options.onSearchValid != null) {
                    var searchValid = this.options.onSearchValid();
                    if (searchValid == false) {
                        return false;
                    }
                }

                var htmlBody = $.ajax({
                    type: 'POST',
                    url: this.options.url.grid,
                    data: param,
                    async: false
                }).responseText;
                this.options.elements.div.html(htmlBody);
            }
            if (this.options.control == 'loading' && this.options.elements.id.val() == '') {
                this.clear();
            }
        },
        divClose: function () {
            this.options.elements.div.css('display', 'none');
        },
        windowSearch: function (param) {
            var filterData = '';

            if (this.options.onFilter != null) {
                filterData = this.options.onFilter();
                if (filterData == false) {
                    this.unBlock();
                    return false;
                }
            }

            if (!param)
                param = 'seekerAjax=1';
            else
                param = 'seekerAjax=1&' + param;

            //@preis:Adicionado o Comportamento para casos que utilizem o Rename(agrupador-Nomeclasse);
            if (param.match(/(\&name)\=(.*\-)/)) {
                param = param.replace(/(\&name)\=(.*\-)/, "&name=");
            }

            param = param + '&seekerName=' + this.options.name;
            param = param + '&filter_json=' + filterData;
            var cmdAfterLoad = '';
            if (this.options.control == 'loading') {
                cmdAfterLoad = "if ( window.opener.jQuery('#" + this.options.elements.id.attr('id') + "').val() == ''){ window.opener.jQuery('#" + this.element.attr('id') + "').TSeeker('clear');}";
            }

            if (this.options.onSearchValid != null) {
                var searchValid = this.options.onSearchValid();
                if (searchValid == false) {
                    return false;
                }
            }

//            if(this.options.name){              
//              this.options.name = this.options.name.replace(/^.*\-/ig,"");
//            }


            $.WindowT.open({
                id: 'win-seeker-' + this.options.name,
                url: this.options.url.grid,
                onAfterLoad: cmdAfterLoad,
                type: this.options.modal.type,
                param: param,
                modal: true,
                height: this.options.modal.height,
                width: this.options.modal.width
            });
        },
        buttonOnClick: function () {
            var self = $('#' + $(this).attr('searchId'));
            if (self.TSeeker('option', 'modal').type == 'DIV') {
                var div = self.TSeeker('option', 'elements').div;
                if (div.css('display') == 'none') {
                    self.TSeeker('option', 'control', 'detail');
                    self.TSeeker('search');
                } else {
                    div.css('display', 'none');
                }
            } else {
                self.TSeeker('option', 'control', 'detail');
                self.TSeeker('search');
            }
            return false;
        },
        buttonNoFocus: function () {
            //this.options.elements.button.attr('nofocus',true);
            if (this.options.elements.id.val() != '') {
                this.options.elements.button.attr('nofocus', true);
            } else if (this.element.hasClass('required')) {
                this.options.elements.button.attr('nofocus', false);
            } else {
                this.options.elements.button.attr('nofocus', true);
            }
        }
    })
})(jQuery);