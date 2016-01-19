/**
 * Classe para criação de autocomplete com botão de busca para resultados recentes
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.autocomplete.js
 *
 *
 * Opções:
 * - classCSS(str): Define uma classe css para o autocomplete de horas; Default autocomplete-ta
 * - inputCSS(str): Define uma classe css para a caixa de texto do autocomplete de horas; Default autocomplete-input-ta
 * - showButtonSearch(bol): Exibe ou não o botão de busca; Default true
 * - source(array/php file): Recebe um array javascript com os dados para o autocomplete ou o url de um arquivo
 * dinamico com saida JSON: Default false
 * - minLength(int): Define o numero minimo de caracteres que devem ser digitados antes de ativar o autocomplete; Default 0
 * - selectAll(bol): Habilita a opção de selecionar o conteudo do campo ao receber focus; Default false;
 * - removeClassClick(bol): Desabilita a propriedade de click do autocomplete
 */

(function ($) {
    $.widget('ta.TAutocomplete', {
        options: {
            classCSS: 'autocomplete-ta',
            inputCSS: 'autocomplete-input-ta',
            dataSource: null,
            showButtonSearch: false,
            minLength: 0,
            onFormatResult: null,
            onFormatMatch: null,
            onFormatItem: null,
            extraParams: null,
            matchContains: true,
            listWidth: null,
            limit: null
        },
        /**
         * Método construtor
         *
         * @access private
         * @return void
         */
        _create: function () {
            var self = this;
            self.options.open = function () {
                var objAutocomplete = self.element.autocomplete('widget')[0];
                $(objAutocomplete)
                        .addClass(self.options.classCSS)
                        .width(self.options.listWidth);

            }
            this.element.addClass(self.options.inputCSS);

            var btSearch = jQuery('#search-' + self.element.attr('id'));
            if (btSearch.length > 0) {
                btSearch.click(function () {
                    self.openClose();
                });
            }

            if (self.options.selectAll) {
                self.element.click(function () {
                    self.element.select();
                });
            }
            self.element.focus(function () {
                self.element.attr('focusEl', 1);
            }).blur(function () {
                self.element.attr('focusEl', 0);
            });
            //self.options.minChars = self.options.minLength;

            var dataSource = [];
            var options = {};
            if (self.options.source) {
                dataSource = self.options.source;
            } else {
                dataSource = self.options.dataSource;
            }
            if (self.options.onFormatResult != null) {
                options.formatResult = self.options.onFormatResult;
            }
            if (self.options.onFormatMatch != null) {
                options.formatMatch = self.options.onFormatMatch;
            }
            if (self.options.onFormatItem != null) {
                options.formatItem = self.options.onFormatItem;
            }
            if (self.options.onFormatResult != null) {
                options.formatResult = self.options.onFormatResult;
            }
            if (self.options.extraParams != null) {
                options.extraParams = self.options.extraParams;
            }
            options.minChars = self.options.minLength;
            if (self.options.listWidth != null) {
                options.width = self.options.listWidth;
            }
            if (self.options.limit != null) {
                options.max = self.options.limit;
                options.scroll = true;
            }
            options.matchContains = self.options.matchContains;

            if (typeof dataSource == 'object') {
                var aux = [];
                for (var index in dataSource) {
                    aux[index] = dataSource[index];
                }
                dataSource = aux;
                aux = null;
            }


            try {
                self.element.oldAutocomplete(dataSource, options);

                if (self.options.onResult != null) {
                    self.element.result(self.options.onResult);
                }

                if (this.options.multiple && this.element.val()) {
                    this.setValue(this.element.val());
                }

                this.disabled(this.element.attr('disabled'));
            } catch (err) {

            }
        },
        disabled: function (value) {
            if (value) {
                $("#group-" + this.element.attr('id') + " *").attr('disabled', true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        setValue: function (value) {
            if (this.options.multiple) {
                var id = this.element.attr('id');
                jQuery('#' + id).parent().find('.ac-multi').remove();
                if (value) {
                    values = value.split(';');
                    for (var i in values) {
                        this.addElement(id, values[i]);
                    }
                }
                this.element.val('');
            } else {
                if (value == null) {
                    value = '';
                }
                this.element.val(value);
            }
        },
        setOption: function (name, value) {
            this.options[name] = value;
            self.element.oldAutocomplete().setOptions(self.options);
        },
        /**
         * Método para abrir/fechar o autocomplete
         *
         * @access public
         * @return void
         */
        openClose: function () {
            var self = this;
            self.element.oldAutocomplete().clearCache();
            self.element.focus();
            self.element.openBox();
        },
        clearCache: function () {
            var self = this;
            self.element.oldAutocomplete().clearCache();
        },
        /**
         * 
         */
        addElement: function (id, value) {
            var itemAdded = false;
            var values = jQuery('#' + id).parent().find('.ac-multi');
            for (var index = 0; index < values.length; index++) {
                if (values.eq(index).attr('value') == value) {
                    itemAdded = true;
                    break;
                }
            }

            if (value.substr(0, 8) == 'Alert ::' || itemAdded) {
                jQuery('#' + id).Tdata('TAutocomplete').clearCache();
                jQuery('#' + id).val('');
                jQuery('#' + id).focus();
                return false;
            }

            var multipleValue = jQuery('#' + id + '-multiple').val();
            var container = jQuery('#sel-elements-' + id);
            var funcDelElement = "jQuery('#" + id + "').Tdata('TAutocomplete').delElement(this, '" + id + "', '" + value + "');"
            var row = '';

            row += '<div id="sel-item-' + id + '" value="' + value + '" class="ui-button ui-state-default ac-multi" style="margin-top:3px; margin-right:3px; float:left;">';
            row += '   <span>' + value + '&nbsp;</span>';
            row += '   <span class="ui-icon ui-icon-circle-close" onclick="' + funcDelElement + '"></span>';
            row += '</div>';

            container.append(row);

            if (!multipleValue) {
                multipleValue = value;
            } else {
                multipleValue = multipleValue + ';' + value;
            }

            jQuery('#' + id + '-multiple').val(multipleValue);
            jQuery('#' + id).val('');

            setTimeout(function () {
                jQuery('#' + id).focus();
            }, 300);
        },
        /**
         * 
         */
        delElement: function (varThis, id, value) {
            jQuery(varThis).parent().remove();

            var values = jQuery('#' + id).parent().find('.ac-multi');
            var newValue = '';
            for (var index = 0; index < values.length; index++) {
                newValue = newValue + ';' + values.eq(index).attr('value');
            }

            jQuery('#' + id + '-multiple').val(newValue.substr(1));
        }
    });
})(jQuery);
