/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TTabs', {
        options: {
            msgLoad: 'Aguarde, carregando...',
            onSelect: null
        },
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function () {
            var self = this;
            var itens = self.getItens();
            for (var index = 0; index < itens.length; index++) {
                var item = itens.eq(index);
                item.attr('index', index);
                if (!self.options[index]) {
                    self.options[index] = {url: false, field: false, param: false, iframe: false};
                }
                item.click(function () {
                    self.change($(this).attr('index'));
                });
            }
            if (itens.length) {
                self.onSelect(0);
            }
        },
        /**
         * 
         * @param string item
         * @returns void
         */
        change: function (index) {
            var self = this;
            var itens = self.getItens();
            var item = itens.eq(index);
            //console.log(item);
            if ($(item).attr('disabled') == undefined) {
                self.onSelect(index);
                var panel = $('#' + item.attr('role'));

                var itens = self.getItens();
                for (var i = 0; i < itens.length; i++) {
                    itens.eq(i).removeClass('active');
                    $("#" + itens.eq(i).attr('role')).removeClass('active');
                }
                item.addClass('active');
                panel.addClass('active');

                if (item.attr('url')) {
                    self.options[index] = {url: item.attr('url'), field: false, param: false, iframe: false};
                }

                var id = item.attr('id');
                if (self.options[index]['url']) {
                    //var panel_0 = $('#' + itens.eq(0).attr('role'));
                    //panel.width(panel_0.width());
                    //panel.height(panel_0.height());

                    var idElement = this.element.attr('id');
                    var tabsParam = self.options;
                    var urlGrid = '';
                    if (tabsParam[index].field || tabsParam[index].param) {
                        var typeModal = 'AJAX';
                        if (tabsParam[index].iframe) {
                            typeModal = 'IFRAME';
                        }
                        var paramUrlGrid = '', valueUrlGrid = '';
                        var valueParam = '';
                        if (typeof tabsParam[index].value == 'function') {
                            valueParam = tabsParam[index].value();
                        } else {
                            valueParam = tabsParam[index].value;
                        }
                        if (tabsParam[index].field) {
                            var where = new TWhere('AND');
                            where.addFilter({field: tabsParam[index].field, value: valueParam, operation: tabsParam[index].operation, mapper: tabsParam[index].mapper});
                            paramUrlGrid = 'filter_json';
                            valueUrlGrid = encodeURIComponent(where.toJson());
                        } else if (tabsParam[index].param) {
                            paramUrlGrid = tabsParam[index].param;
                            valueUrlGrid = encodeURIComponent(valueParam);
                        }
                        urlGrid = tabsParam[index].url + '?typeModal=' + typeModal + '&' + paramUrlGrid + '=' + valueUrlGrid;
                    } else if (typeof tabsParam[index].url == 'function') {
                        urlGrid = tabsParam[index].url();
                    } else if (self.options[index]['url']) {
                        urlGrid = self.options[index]['url'];
                    }

                    if (urlGrid) {
                        if (tabsParam[index].iframe) {
                            $('#' + idElement).TTabs('changeUrlIframe', urlGrid, index);
                        } else {
                            $('#' + idElement).TTabs('changeUrl', urlGrid, index);
                        }
                    }
                }
            }
        },
        onSelect: function (index) {
            var self = this;
            if (self.options.onSelect != null && self.options.onSelect) {
                if (typeof self.options.onSelect == 'function') {
                    var event = null;
                    var ui = {index: index};
                    self.options.onSelect(event, ui);
                } else {
                    self.options.onSelect;
                }
            }
        },
        /**
         * Muda a url de uma aba
         * 
         * @param string url
         * @param numeric index
         */
        changeUrl: function (url, index) {
            var self = this;
            //self.options[index]['url'] = url;
            var itens = self.getItens();
            var item = itens.eq(index);
            var panel = $('#' + item.attr('role'));
            $(panel).html(self.options.msgLoad);
            jQuery.ajax({
                url: url,
                success: function (result) {
                    panel.html(result);
                }
            });
            //this.element.tabs('url', index, url);
        },
        changeUrlIframe: function (url, index) {
            var self = this;
            var idElement = self.element.attr('id') + '_' + index;
            var objWindow = document.getElementById(idElement).contentWindow;
            objWindow.document.body.innerHTML = '';
            objWindow.document.write(self.options.msgLoad);
            document.getElementById(idElement).src = url;
        },
        /**
         * 
         * @returns index|string
         */
        currentTab: function () {
            var self = this;
            var itens = self.getItens(true);
            return itens;
            //return this.element.tabs('option', 'selected');
        },
        /**
         * Desabilita uma aba
         * 
         * @param numeric index
         */
        disable: function (index) {
            var self = this;
            var itens = self.getItens();
            itens.eq(index).attr('disabled', true).addClass('ui-disabled');
            /*if(index == 1){
             this.element.tabs('select',2);
             }else{
             this.element.tabs('select',1);
             }*/
            //this.element.tabs('disable', index);
        },
        select: function (index) {
            var self = this;
            var itens = self.getItens();
            itens.eq(index).click();
            //this.element.tabs('select', index);
        },
        /**
         * Desabilita varias abas
         * 
         * @param array indexes
         */
        disableMulti: function (indexes) {
            var self = this;
            for (var i in indexes) {
                self.disable(i);
            }
            //this.element.tabs('options', 'disabled', indexes);
        },
        /**
         * Habilita as abas
         * 
         * @param numeric index
         */
        enable: function (index) {
            var self = this;
            var itens = self.getItens();
            itens.eq(index).removeAttr('disabled').removeClass('ui-disabled');
            //this.element.tabs('enable', index);
        },
        /**
         * Habilita todas as abas
         *  
         * @param array indexes
         */
        enableAll: function () {
            var self = this;
            var itens = self.getItens();
            for (var i = 0; i < itens.size(); i++) {
                self.enable(i);
            }
            //this.element.tabs('options', 'disabled', []);
        },
        getItens: function (active) {
            var self = this;
            var selector = '.ui-tabs-header li';
            if (active == true) {
                selector = selector + '.active';
            }
            return self.element.find(selector);
        }
    });
})(jQuery);

