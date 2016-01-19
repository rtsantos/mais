/**
 * Classe para formatação de campo input-text como hora, além de verificar o conteudo do campo
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 *  
 *  To-do:
 *      Corrigir o bug de Max-height no IE
 *
 *
 *  Options:
 * - timeMinutesInterval(int): Define o intervalo de minutos que autocomplete irá exibir; Default 30
 * - timeSecondsInterval(int): Define o intervalo de segundos que autocomplete irá exibir; Default 0
 * - timeHoursInterval(int): Define o intervalo de horas que autocomplete irá exibir; Default 0
 * - allowSeconds(bol): Permite ou não o uso de segundos no campo de tempo; Default false
 * - hoursOnly(bol): Bloqueia ou não o preenchimento automatico do campo quando apenas a hora é digitada; Default true
 * - classCSS(str): Define uma classe css para o autocomplete de horas; Default autocomplete-time
 * - inputCSS(str): Define uma classe css para a caixa de texto do autocomplete de horas; Default autocomplete-input-time
 * - showButtonSearch(bol): Exibe ou não o botão do relogio ao lado do campo de hora; Default true
 * - autofocusOnError(bol): Habilita o autofocus ao compo após a mensagem de erro; Default true
 * - dataAutocomplete(array/php file): Recebe um array javascript com os dados para o autocomplete ou o url de um arquivo
 * dinamico com saida JSON: Default false
 * - selectAll(bol): Habilita a opção de selecionar o conteudo do campo ao receber focus; Default true;
 * - noAutocomplete(bol): Desabilita o autocomplete
 */

(function ($) {
    $.widget('ta.TTime', {
        options: {
            timeMinutesInterval: 30,
            timeSecondsInterval: 0,
            timeHoursInterval: 0,
            allowSeconds: false,
            hoursOnly: true,
            classCSS: 'autocomplete-time',
            inputCSS: 'autocomplete-input-time',
            showButtonSearch: true,
            autofocusOnError: true
        },
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         */
        _create: function () {
            var self = this;
            var arrayHoras;


            if (self.options.onChangeFunction) {
                this.element.change(function () {
                    self.options.onChangeFunction(self.element);
                    if (self.element.val() == '') {
                        self.element.val(' '); //remove o valor do campo
                    }
                });
            }

            if (self.options.allowSeconds) {
                this.element.attr('maxlength', 8);
            } else {
                this.element.attr('maxlength', 5);
            }
            if (self.options.selectAll) {
                this.element.click(function () {
                    self.element.select();
                });
            }
            this.element.addClass(self.options.inputCSS)
                    .keydown(function (e) {
                        return self._keyValidade(e);
                    })
                    .keyup(function (e) {
                        if (self.element.val().length >= 4 && self.options.onChangeFunction) {
                            self.options.onChangeFunction(self.element);
                        }
                        return true;
                    })
                    .focusout(function () {
                        if (self.element.hasClass('required') && self.element.val() == '') {
                            var d = new Date();
                            self.element.val(str_pad(d.getHours(), 2, '0', 0) + ':' + str_pad(d.getMinutes(), 2, '0', 0));
                        }
                        if (self.element.val().length >= 4 && self.options.onChangeFunction) {
                            self.options.onChangeFunction(self.element);
                        }
                    })
                    .blur(function (e) {
                        self._TTimeIsValid(e);
                        if (self.element.val().length >= 4 && self.options.onChangeFunction) {
                            self.options.onChangeFunction(self.element);
                        }
                    })
                    .appendTo(this.divTime);

            if (!self.options.dataAutocomplete) {
                arrayHoras = self._TTimeGetInterval(this);
            } else {
                arrayHoras = self.options.dataAutocomplete;
            }
            if (!self.options.noAutocomplete) {
                //try{
                self.element.oldAutocomplete(arrayHoras, {
                    minChars: 0,
                    width: (self.element.width() + 26),
                    scrollHeight: 200,
                    scroll: true
                });
                //}catch(err){
                // @todo tratar erro que está sendo apresentado no IE
                //}
            }
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
         * Método para abrir/fechar o autocomplete
         *
         * @access public
         * @return void
         */
        openClose: function () {
            var self = this;
            /*if(self.element.attr('status') == '1'){
             self.element.autocomplete("close")
             }else{
             self.element.autocomplete("search");
             }  */
            self.element.focus();
            self.element.openBox();
        },
        /**
         * Método para realizar contas com um determinado intervalo de tempo
         *
         * @access private
         * @return string
         */
        _TTimeGetInterval: function () {
            var self = this;
            var availableHours = new Array();
            var minutos = 0;
            var segundos = 0;
            var horas = 0;
            var contador = 0;
            if (isNaN(self.options.timeMinutesInterval) || self.options.timeMinutesInterval > 60) {
                self.options.timeMinutesInterval = 30;
            }
            if (isNaN(self.options.timeHoursInterval) || self.options.timeHoursInterval > 24) {
                self.options.timeHoursInterval = 0;
            }
            if (isNaN(self.options.timeSecondsInterval) || self.options.timeSecondsInterval > 60) {
                self.options.timeSecondsInterval = 0;
            }
            while (horas < 24) {
                minutos = parseInt(minutos, 10) + self.options.timeMinutesInterval;
                horas = parseInt(horas, 10) + self.options.timeHoursInterval;
                segundos = parseInt(segundos, 10) + self.options.timeSecondsInterval;
                if (segundos >= 60) {
                    segundos = -(60 - segundos);
                    minutos++;
                }
                if (minutos >= 60) {
                    minutos = -(60 - minutos);
                    horas++;
                }
                if (segundos <= 9) {
                    segundos = "0" + segundos;
                }
                if (minutos <= 9) {
                    minutos = "0" + minutos;
                }
                if (horas <= 9) {
                    horas = "0" + horas;
                }
                if (horas == 24) {
                    availableHours[contador++] = self.TTimeFormat('000000');
                } else {
                    availableHours[contador++] = self.TTimeFormat(horas + '' + minutos + '' + segundos);
                }
            }
            return availableHours;
        },
        /**
         * Método para formatar hora
         *
         * @access private
         * @return string
         */
        TTimeFormat: function (valueTime) {
            var self = this;
            var valueReturn = 0;
            if (valueTime == '') {
                return false;
            }
            try {
                valueTime = valueTime.trim().replace(':', '').replace(':', '');
            } catch (err) {
                valueTime = trim(valueTime);
                valueTime = str_replace(':', '', valueTime);
            }
            valueReturn = valueTime.substr(0, 2) + ':' + valueTime.substr(2, 2);
            if (self.options.allowSeconds) {
                valueReturn = valueReturn + ':' + valueTime.substr(4, 2);
            }
            return valueReturn;
        },
        /**
         * Método para validar hora
         *
         * @access private
         * @return bol
         */
        _TTimeIsValid: function () {
            var self = this;
            if (self.element.val() == '') {
                return false;
            }
            var valueTime = self.element.val();
            var erroHora = false;
            valueTime = valueTime.replace(/:/gi, '');
            if ((valueTime.length == 2 || valueTime.length == 4 || valueTime.length == 6) && !isNaN(parseInt(valueTime))) {
                if (valueTime.length == 2 && self.options.hoursOnly) {
                    valueTime += '00';
                }
                if (valueTime.length == 4 && self.options.allowSeconds) {
                    valueTime += '00';
                }
                if (parseInt(valueTime.substr(0, 2)) > 23 || parseInt(valueTime.substr(2, 2)) > 59 || parseInt(valueTime.substr(4, 2)) > 59) {
                    erroHora = true;
                }
                self.element.val(self.TTimeFormat(valueTime));
            } else if (valueTime == ' ') {
                self.element.val('');
            } else {
                erroHora = true;
            }
            if (erroHora) {
                alert('Horario invalido!');
                self.element.val('');
                self.options.onChangeFunction(self.element);
                if (self.options.autofocusOnError) {
                    setTimeout(function () {
                        self.element.focus();
                    }, 0);
                }
                return false;
            }
            return false;
        },
        /**
         * Método que valida a tecla digitada com o valor do campo para verificar se a hora é valida
         *
         * @access private
         * @return bol
         */
        _keyValidade: function (event) {
            var self = this;
            var valueTime = self.element.val().replace(/:/gi, '');
            var lengthElemento = valueTime.length;
            if (event.which == 8 || event.which == 9 || event.which == 46 || event.which == 36 || event.which == 35 || (event.which > 36 && event.which < 41)) {
                return true;
            }

            if (lengthElemento < 6) {
                if (lengthElemento == 0) {
                    return self._maxKey(2, event);
                } else if (lengthElemento == 1) {
                    if (valueTime == 0) {
                        return self._maxKey(9, event);
                    } else if (valueTime == 1) {
                        return self._maxKey(9, event);
                    } else if (valueTime == 2) {
                        return self._maxKey(3, event);
                    }
                } else if (lengthElemento == 2) {
                    return self._maxKey(5, event);
                } else if (lengthElemento == 4) {
                    return self._maxKey(5, event);
                } else if (valueTime.substr(-1) == 0) {
                    return self._maxKey(9, event);
                } else {
                    return self._maxKey(9, event);
                }
            }
            return false;
        },
        /**
         * Método para verificar se a tecla digitada esta dentro do range passado
         *
         * @access private
         * @return bol
         */
        _maxKey: function (valor, e) {
            var self = this;
            if (e.which > 47) {
                if (valor == 2) {
                    if (e.which < 51 || (e.which > 95 && e.which < 99)) {
                        return true;
                    }
                } else if (valor == 3) {
                    if (e.which < 52 || (e.which > 95 && e.which < 100)) {
                        return true;
                    }
                } else if (valor == 5) {
                    if (e.which < 54 || (e.which > 95 && e.which < 102)) {
                        return true;
                    } else if (e.which == 191 && self.element.val().substr(-1) != ':') {
                        return true;
                    }
                } else {
                    if ((e.which > 47 && e.which < 58) || (e.which > 95 && e.which < 106)) {
                        return true;
                    }
                }
            } else if (e.which == 13 || e.which == 27) {
                return true;
            }
            return false;
        }
    });

})(jQuery);
