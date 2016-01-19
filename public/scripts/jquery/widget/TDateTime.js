/**
 * Classe para formatação de campo input-text como hora, além de verificar o conteudo do campo
 * 
 * @author: ksantoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	TDate.js
 *	TTime.js
 *
 *
 *  Options:
 * - paraTime: Recebe parametros para o TTime
 * - paraDate: Recebe parametros para o TDate
 */


(function ($) {
    $.widget('ta.TDateTime', {
        options: {
            paramTime: {},
            paramDate: {
                dateFormat: 'dd/mm/yy'
            }
        },
        _create: function () {
            var self = this;
            self.refreshValues();
            self.options.paramTime.cssFloat = true;
            self.options.paramDate.cssFloat = true;
            self.options.paramDate.onChangeFunction = function (obj) {
                try {
                    var value = obj.val().replace('/', '').replace('/', '').trim();
                } catch (err) {
                    var value = str_replace('/', '', trim(obj.val()));
                }
                var objDateTime = $('#' + self.element.attr('id'));
                var valueDate = obj.TDate('TDateFormat', value);
                var valueTime = $('#' + self.element.attr('id') + '_time').val();
                if (value.length >= 6) {
                    objDateTime.val(valueDate + ' ' + valueTime);
                }
                if (!valueDate || !valueTime) {
                    objDateTime.val('');
                }
            };
            self.options.paramTime.onChangeFunction = function (obj) {
                try {
                    var value = obj.val().replace(':', '').replace(':', '').trim();
                } catch (err) {
                    var value = str_replace(':', '', trim(obj.val()));
                }
                var objDateTime = $('#' + self.element.attr('id'));
                var valueTime = obj.TTime('TTimeFormat', value);
                var valueDate = $('#' + self.element.attr('id') + '_date').val();
                if (value.length >= 4) {
                    objDateTime.val(valueDate + ' ' + valueTime);
                }
                if (!valueDate || !valueTime) {
                    objDateTime.val('');
                }
            };
            $('#' + self.element.attr('id')).attr('TDateTime', 1);
            $('#' + self.element.attr('id') + '_date').TDate(self.options.paramDate);
            $('#' + self.element.attr('id') + '_time').TTime(self.options.paramTime);
            self.element.change(function () {
                self.refreshValues();
            });
            $(document).ready(function(){
                self.refreshValues();
            });

            this.disabled(this.element.attr('disabled'));
        },
        disabled: function (value) {
            if (value) {
                $("#group-" + this.element.attr('id') + " *").attr('disabled', true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        /**
         * Atualiza o valor
         * 
         * Atualiza os campos de data e hora com o valor atual do campo hidden
         *
         */
        refreshValues: function () {
            var arraypart = '';
            var self = this;
            if (self.element.val() != '') {
                arraypart = self.element.val().split(' ');
                $('#' + self.element.attr('id') + '_date').val(arraypart[0]);
                $('#' + self.element.attr('id') + '_time').val(arraypart[1]);
            }
        },
        /**
         * Muda o valor do campo
         * 
         * Esta função dever ser utilizada no lugar da "val()" do jquery para que o evento
         * change seja disparado
         * 
         */
        setValue: function (valor) {
            var self = this;
            self.element.val(valor);
            self.element.change();
        },
        /**
         * 
         * @param {type} valor
         * @returns {undefined}
         */
        loadData: function (valor) {
            var self = this;
            self.element.val(valor);
            self.element.change();
        }
    });
})(jQuery);