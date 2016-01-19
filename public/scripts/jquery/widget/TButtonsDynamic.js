/**
 * jQuery.ui.TButtonsDynamic
 * 
 * Description:
 *      Componente que implementa os botões de adicionar e remover elementos
 *
 * @author: tesilva
 * @version: 0.1
 *
 */
(function ($) {
    var widget_name = 'TButtonsDynamic';
    $.widget('ta.' + widget_name, {
        btn_group: "btn-dynamic-group-",
        btn_add: "btn-dynamic-add-",
        btn_del: "btn-dynamic-del-",
        menu_icon: "icon-menu-dynamic-",
        menu_value: "value-menu-dynamic-",
        menu_div: "div-menu-dynamic-",
        menu_href: "href-menu-dynamic-",
        menu_label: "label-menu-dynamic-",
        menu_div_sep: "div-menu-separador-dynamic-",
        separadores: [
            ["between", "até"],
            ["in", ","]
        ],
        operadores: [
            ["=", "="],
            [">", ">"],
            [">=", ">="],
            ["<", "<"],
            ["<=", "<="],
            ["!=", "!="],
            ["between", "Entre"],
            ["in", "Lista"]
        ],
        element_qtd: 0,
        widget_name: widget_name,
        options: {
            helper_script: '',
            max_periodo: '',
            fix_elements: '',
            show_buttons: true,
            change_menu: true,
            operadores_show: []
        },
        _create: function () {
            var self = this;
            this.id = this.element.attr('id');
            this.elements_sel = this.formatElementsSel(this.id);
            this.element_base = this.formatIdBase(0);

            if (!this.options.helper_script) {
                $("#" + this.id).remove();
                alert('"helper_script" não informado!');
                return false;
            }

            $(document).append(self.getScriptElement());
            $(document).append(self.getHtmlElement());
            $("#group-" + self.id + " " + this.elements_sel).first().before(self.getHtmlMenu());
            $("#group-" + self.id + " div").first().after(self.getHtmlButtons());

            $("#" + self.btn_add + self.id).click(function () {
                self.addElement();
            });
            $("#" + self.btn_del + self.id).click(function () {
                self.delElement();
            });
            $("#" + self.menu_value + self.id).change(function () {
                self.changeValueMenu();
            });
            $("#" + self.id).change(function () {
                self.changeValueHidden();
            });

            $(document).append(this.getScriptChange());
            $(document).ready(function () {
                self.formatElementsValue();
            });
        },
        formatIdBase: function (n) {
            var id = this.element.attr('id');
            if (n != null) {
                return id + "-" + n;
            } else {
                return id;
            }
        },
        formatElementsSel: function (id) {
            return "[id^=" + id + "][type!=hidden]";
        },
        addElement: function () {
            var self = this;
            this.element_qtd++;
            var html = $("<div/>").append($("#" + this.element_base).clone()).html();
            var idNovo = this.formatIdBase(this.element_qtd);
            while (html.indexOf(this.element_base) != -1) {
                html = html.replace(this.element_base, idNovo);
            }
            var script = "";
            script = script + "<script>";
            script = script + "    var selector = '" + this.elements_sel + "';";
            script = script + "    var last = $(selector).size()-2;";
            script = script + "    var lastValue = $(selector).eq(last).val();";
            script = script + "    var novoElemento = '#" + idNovo + "';";
            script = script + "    $(novoElemento).val(lastValue);";
            script = script + "    $(novoElemento).removeClass('hasDatepicker');";
            script = script + "    $(novoElemento).removeAttr('helper');";
            script = script + "    $(novoElemento)." + this.options.helper_script + "();";
            script = script + "    $(novoElemento).next().css({'position':''}).css({'float':'left'});";
            script = script + "</script>";
            var htmlSeparacao = "";
            var operador = this.getCurrentOperador();
            if (this.element_qtd >= 1) {
                htmlSeparacao = "";
                var classes = 'ui-widget-header';
                if ($("'" + this.elements_sel + "'").first().hasClass('required')) {
                    //classes = classes + ' required';
                }
                htmlSeparacao = htmlSeparacao + "<div id='" + this.menu_div_sep + this.id + '-' + this.element_qtd + "' class='" + classes + "' style='float:left; position:relative; display:inline; padding-left:5px; padding-right:5px; padding-bottom:2px; padding-top:2px;border-left:0px;border-right:0px;'></div>";
            }
            $("#" + this.element_base).parent().append(htmlSeparacao + html + script);
            this.changeValueMenu();
            this.forceChange();
            /*if(operador == 'in'){
             $("'" + this.elements_sel + "'").last().focus().click();
             }*/
        },
        delElement: function () {
            if (this.element_qtd > 0) {
                this.removeElement(this.element_qtd);
                $("#" + this.menu_div_sep + this.id + '-' + this.element_qtd).remove();
                this.element_qtd--;
                this.forceChange();
            }
        },
        setStatusButtons: function (add, del) {
            if (this.options.show_buttons) {
                if (add != 'undefined' && add !== '' && add !== null) {
                    if (add) {
                        $("#" + this.btn_add + this.id).show();
                    } else {
                        $("#" + this.btn_add + this.id).hide();
                    }
                }
                if (del != 'undefined' && del !== '' && del !== null) {
                    if (del) {
                        $("#" + this.btn_del + this.id).show();
                    } else {
                        $("#" + this.btn_del + this.id).hide();
                    }
                }
            } else {
                $("#" + this.btn_add + this.id).hide();
                $("#" + this.btn_del + this.id).hide();
            }
        },
        updateButtons: function () {
            var operador = this.getCurrentOperador();
            if (operador == this.getOperatorByNumber()) {
                if ($(this.elements_sel).size() < 2) {
                    this.setStatusButtons('', false);
                } else {
                    this.setStatusButtons('', true);
                }
            }
        },
        changeValueHidden: function () {
            var operador = this.getCurrentOperador();
            if (operador == this.getOperatorByNumber(2) || operador == this.getOperatorByNumber() || operador == '=') {
                operador = '';
            }
            $("#" + this.id).val(operador + $("#" + this.id).val());
        },
        changeValueMenu: function () {
            var self = this;
            var operador = this.getCurrentOperador();
            $("[id^=" + this.menu_div_sep + this.id + "]").each(function () {
                var separador = '';
                jQuery.each(self.separadores, function (index) {
                    if ($(this)[0] == operador) {
                        separador = $(this)[1];
                    }
                });
                $(this).html(separador);
            });

            if (operador == this.getOperatorByNumber()) {
                this.setStatusButtons(true, true);
            } else {
                this.setStatusButtons(false, false);

                var max = 1;
                if (operador == this.getOperatorByNumber(2)) {
                    max = 2;
                }
                while ($(this.elements_sel).size() > max) {
                    $("#" + this.btn_del + this.id).click();
                }
                while ($(this.elements_sel).size() < max) {
                    $("#" + this.btn_add + this.id).click();
                }
            }
            this.forceChange();
        },
        getScriptChange: function () {
            var script = "";
            script = script + "<script>";
            /* Função para datas */
            script = script + "function dateDiff(d1, d2, tipo) {";
            script = script + "    var d1_s = d1.split('/');";
            script = script + "    var d2_s = d2.split('/');";
            script = script + "    var date1 = new Date(d1_s[2], d1_s[1], d1_s[0]);";
            script = script + "    var date2 = new Date(d2_s[2], d2_s[1], d2_s[0]);";
            script = script + "    date1.setHours(0);";
            script = script + "    date1.setMinutes(0, 0, 0);";
            script = script + "    date2.setHours(0);";
            script = script + "    date2.setMinutes(0, 0, 0);";
            script = script + "    if(tipo == 'diff'){";
            script = script + "        var datediff = Math.abs(date1.getTime() - date2.getTime());";
            script = script + "        return parseInt(datediff / (24 * 60 * 60 * 1000), 10);";
            script = script + "    } else if(tipo == 'maior'){";
            script = script + "        if(date1 > date2) return d1;";
            script = script + "        else if(date1 < date2) return d2;";
            script = script + "        return 0;";
            script = script + "    }";
            script = script + "    return null;";
            script = script + "}";

            /* Script change dos elementos */
            script = script + "$('body').delegate('" + this.elements_sel + "', 'change', function(){";
            script = script + "    var valorFinal = '';";
            script = script + "    var size = $('" + this.elements_sel + "').size();";
            script = script + "    var qtd = 0;";
            script = script + "    var valorMenor = '';";
            script = script + "    $('" + this.elements_sel + "').each(function(){";
            script = script + "        var operador = $('#" + this.menu_value + this.id + "').val();";
            script = script + "        var tipo = ' ';";
            script = script + "        if(operador == '" + this.getOperatorByNumber() + "'){";
            script = script + "            tipo = ';'";
            script = script + "        }";
            script = script + "        var valorNovo = $(this).val();";
            script = script + "        if(valorNovo){";
            if (this.options.max_periodo) {
                script = script + "        var valorMenor = '';";
                script = script + "        $('" + this.elements_sel + "').each(function(){";
                script = script + "            if($(this).val()){";
                script = script + "                if(valorMenor){";
                script = script + "                    var maior = dateDiff(valorMenor, $(this).val(), 'maior');";
                script = script + "                    if(maior == $(this).val()){";
                script = script + "                        return false; /*continue*/";
                script = script + "                    }";
                script = script + "                }";
                script = script + "                valorMenor = $(this).val();";
                script = script + "            }";
                script = script + "        });";
                script = script + "        if(valorMenor){";
                script = script + "            diff = dateDiff(valorMenor, $(this).val(), 'diff');";
                script = script + "            if(diff > parseInt(" + this.options.max_periodo + ")){";
                script = script + "                alert('A data ' + $(this).val() + ' foi removida pois está fora do período máximo de " + this.options.max_periodo + " dias!');";
                script = script + "                $(this).val('').change().focus();";
                script = script + "                return false; /*continue*/";
                script = script + "            }";
                script = script + "        }";
            }
            script = script + "             qtd ++;";
            script = script + "             if(valorFinal){";
            script = script + "                 valorFinal = valorFinal + tipo;";
            script = script + "             }";
            script = script + "             valorFinal = valorFinal + valorNovo;";
            script = script + "         }";
            script = script + "     });";
            script = script + "     $('#" + this.id + "').val(trim(valorFinal)).change();";
            script = script + " });";

            script = script + "</script>";
            return script;
        },
        getScriptElement: function () {
            var scripts = document.getElementsByTagName("script");
            var src = '';
            for (var i in scripts) {
                if (isNaN(i) == false) {
                    if (scripts[i].outerHTML.indexOf(this.widget_name + ".js") != -1) {
                        src = scripts[i].outerHTML;
                        break;
                    }
                }
            }
            var srcs = src.split('.');
            var pos = srcs[0].lastIndexOf('/');
            var file = srcs[0].substr(pos + 1);
            src = src.replace(file, this.options.helper_script);
            return src;
        },
        getHtmlElement: function () {
            var html = $("<div/>").append($("#" + this.id).clone()).html();
            html = html.replace('text', 'hidden');
            $("#" + this.id).replaceWith(html);

            var html = $("<div/>").append($("#" + this.id).clone()).html();
            html = html.replace("hidden", "text");

            while (html.indexOf('"' + this.id + '"') != -1) {
                html = html.replace('"' + this.id + '"', '"' + this.element_base + '"');
            }
            //validação para o IE8, que não adiciona aspas
            while (html.indexOf(this.id + ' ') != -1) {
                //alert(html);
                html = html.replace(this.id + ' ', this.element_base + ' ');
            }

            $("#" + this.id).after(html);
            return '<script> jQuery("#' + this.element_base + '").' + this.options.helper_script + '(); </script>';
        },
        getHtmlHidden: function () {
            var htmlHidden = '';
            var value = $("#" + this.elements_sel).first().val();
            htmlHidden = htmlHidden + '<input type="hidden" id="' + this.id + '" name="' + this.id + ' value = "' + value + '"/>';
            return htmlHidden;
        },
        getHtmlMenu: function () {
            var htmlMenu = '';
            htmlMenu = htmlMenu + '<a  id="' + this.menu_href + this.id + '" href="#' + this.menu_div + this.id + '" style="color:inherit;float:left;height:9px;padding-top:2px; padding-bottom: 7px;" class="fg-button fg-button-icon-left ui-widget ui-state-default ui-corner-all">'
            htmlMenu = htmlMenu + '    <span id="' + this.menu_icon + this.id + '" class="ui-icon ui-icon-triangle-1-s">';
            htmlMenu = htmlMenu + '    </span>';
            htmlMenu = htmlMenu + '    <label id="' + this.menu_label + this.id + '"></label>';
            htmlMenu = htmlMenu + '    <input id="' + this.menu_value + this.id + '" type="hidden"/>';
            htmlMenu = htmlMenu + '</a>';
            htmlMenu = htmlMenu + '<div id="' + this.menu_div + this.id + '" class="hidden">';
            htmlMenu = htmlMenu + '    <ul>';
            var onClick = '';
            onClick = onClick + '$(\'#' + this.menu_label + this.id + '\').text($(this).find(\'label\').text());'
            onClick = onClick + '$(\'#' + this.menu_value + this.id + '\').val($(this).attr(\'value\')).change();';
            jQuery.each(this.operadores, function (index) {
                htmlMenu = htmlMenu + '<li><a href="#" onclick="' + onClick + '" value="' + $(this)[0] + '"><label>' + $(this)[1] + '</label></a></li>';
            });
            htmlMenu = htmlMenu + '    </ul>';
            htmlMenu = htmlMenu + '</div>';
            htmlMenu = htmlMenu + '<script>$("#' + this.menu_div + this.id + '").find("ul li a").first().click();</script>';
            return htmlMenu;
        },
        getHtmlButtons: function () {
            var htmlButtons = '';
            htmlButtons = htmlButtons + '<div id="' + this.btn_group + this.id + '" style="margin-left:5px;float:left;">';
            htmlButtons = htmlButtons + '  <span id="' + this.btn_del + this.id + '" style="margem:0px; float:left; height: 18px; width: 20px;margin-left:0px;" class="ui-button ui-state-default ui-corner-right ui-button-icon-only" title="Remover">';
            htmlButtons = htmlButtons + '      <span class="ui-button-icon-primary ui-icon ui-icon-minus">';
            htmlButtons = htmlButtons + '      </span>';
            htmlButtons = htmlButtons + '  </span>';
            htmlButtons = htmlButtons + '  <span id="' + this.btn_add + this.id + '" style="margem:0px; float:left; height: 18px; width: 20px;margin-left:-2px;" class="ui-button ui-state-default ui-corner-right ui-button-icon-only" title="Adicionar">';
            htmlButtons = htmlButtons + '      <span class="ui-button-icon-primary ui-icon ui-icon-plus">';
            htmlButtons = htmlButtons + '      </span>';
            htmlButtons = htmlButtons + '  </span>';
            htmlButtons = htmlButtons + '</div>';
            return htmlButtons;
        },
        getCurrentOperador: function () {
            return $("#" + this.menu_value + this.id).val();
        },
        updateStatusMenu: function () {
            if (this.options.change_menu == false) {
                //$("#" + this.menu_href + this.id).before('<a style="display:none" class="fg-button"></a>');
                $("#" + this.menu_href + this.id).attr('href', '#');
                $("#" + this.menu_href + this.id).click(function () {
                    $(this).removeAttr('href');
                });
                $("#" + this.menu_div + this.id).remove();
            }
        },
        myIndexOf: function (object, value) {
            for (var i in object) {
                if (object[i] == value) {
                    return i;
                }
            }
            return -1;
        },
        updateOperadores: function () {
            var self = this;
            if (this.options.operadores_show.length) {
                $("#" + this.menu_div + this.id + " ul li a").each(function () {
                    if (self.myIndexOf(self.options.operadores_show, $(this).attr('value')) == -1) {
                        $(this).remove();
                    }
                });
            }
        },
        removeElement: function (n) {
            $("#" + this.formatIdBase(n)).parent().remove();
        },
        forceChange: function () {
            $("#" + this.element_base).change();
            this.updateButtons();
        },
        getOperatorByNumber: function (n) {
            if (n == 2) {
                return 'between';
            }
            return 'in';
        },
        formatElementsValue: function () {
            var value = $("#" + this.id).val();
            value = $.trim(value);
            var operador = '=';
            /*jQuery.each(this.operadores, function (index) {
             var tmp = value.substring(0, 1);
             if (index.indexOf(tmp) != -1) {
             operador = tmp;
             value = value.substring(1, value.length);
             }
             });*/

            var values = [];
            while (value.indexOf(';') != -1) {
                value = value.replace(';', ' ');
            }
            if (value.indexOf(' ') != -1) {
                values = value.split(' ');
            } else {
                values = [value];
            }

            //this.options.fix_elements = 0;
            if (this.options.fix_elements > 1) {
                var fix_operador = this.getOperatorByNumber(this.options.fix_elements);
                if (this.options.fix_elements == 2) {
                    values = [values[0], values[1]];
                } else {
                    for (var i = values.length; i < this.options.fix_elements; i++) {
                        if (!values[i]) {
                            values[i] = '';
                        }
                    }
                }
                $("#" + this.menu_div + this.id + " ul li a").each(function () {
                    if ($(this).attr('value') != fix_operador) {
                        $(this).parent().remove();
                    }
                });
                $("#" + this.menu_icon + this.id).removeClass("ui-icon-triangle-1-s").addClass("ui-icon-triangle-1-e");
                this.options.change_menu = false;
                this.options.show_buttons = false;
                //$("#" + this.menu_href + this.id + " span").remove();
            }
            var qtd = values.length;

            if (qtd > 1) {
                operador = this.getOperatorByNumber(qtd);
            }

            if ($("#" + this.id).hasClass("required")) {
                this.options.operadores_show = this.options.operadores_show.concat(['=', 'between', 'in']);
            }
            $("#" + this.menu_div + this.id + " ul li a").each(function () {
                if ($(this).attr('value') == operador) {
                    $(this).click();
                }
            });

            while ($(this.elements_sel).size() < qtd) {
                $("#" + this.btn_add + this.id).click();
            }
            for (var i = 0; i < $(this.elements_sel).size(); i++) {
                $(this.elements_sel).eq(i).val('').val(values[i]);
            }
            this.forceChange();
            this.setStatusButtons();
            this.updateStatusMenu();
            this.updateOperadores();
        },
    });
})(jQuery);