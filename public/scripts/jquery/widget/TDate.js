/**
 * jQuery.ui.TDate
 * 
 * Description:
 *      Componente que extende as funcionalidades do jQuery.ui.datepicker
 *
 * @author: jcarlos
 * @version: 0.1
 *
 * Depends:
 *      jQuery.ui,
 *      jQuery.ui.datepicker
 *      jQuery.ui.i18n.parâmetro_da_região
 *      extra/php.js
 */
(function($){
    $.widget('ta.TDate', {
        options: {
            /**
             * A Região padrão para exibição da data
             * Formato da data da região
             * O componente será exibido com um botão auxiliar
             */
            regional: 'pt-BR',
            dateFormat: 'dd/mm/yy',
            showOn: "button"
        },

        /**
         * Executado como um construtor do componente
         * Todas as configurações iniciais são executadas neste método
         */
        _create : function(){
            var self = this;

            /**
             * Quando um dia for selecionado
             * dispare para execução essa função
             * e chame a função para validação da data
             */
            var functions = {
                onSelect: function( date ){
                    var self = this;
                    self.validate(date, self.options.dateFormat );
                }
            }

            /**
             * Inicio o datepicker com as opções setadas como default e passadas pelo programador
             */
            $.extend(functions, self.options);
            this.divElement = self.element.wrap('<div></div>').parent()
            .css('width', self.element.width()+20)
            .css('height', self.element.height() + 4)
            .css('position','relative');
            if(self.options.cssFloat){
                this.divElement.css('float','left');
                this.divElement.css('margin-right','10px');
            }
            
            if(self.options.onChangeFunction){
                this.element.change(function(){
				    self.options.onChangeFunction(self.element);
                });
            }

            self.element.datepicker(self.options);

            /**
             * Setando as características do objeto
             */
            self.element.change(this.buttonNoFocus)
            .attr('maxlength', self.options.dateFormat.length + 2)
            .next().attr('class','ui-button ui-widget ui-state-default ui-corner-right ui-button-icon-only')/*ui-corner-all*/
            .html('<span class="ui-button-icon-primary ui-icon ui-icon-calculator"></span><span>&nbsp;</span>')
            .width(20);
            this.buttonNoFocus();
            /**
             * Posicionando o botão para dentro do input
             */
            self.element.next().css('position','absolute')
            .css('top','0')
            .css('height', (self.element.height() + 4) + 'px')
            .focus(function(){
                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
            })
            .focusout(function(){
                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                if (self.element.val().length >= 4 && self.options.onChangeFunction){
                    self.options.onChangeFunction(self.element);
                }
            })
            .blur(function(){
                if (self.element.val().length >= 4 && self.options.onChangeFunction){
                    self.options.onChangeFunction(self.element);
                }                
            })
            .hover(function(){
                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
            }
            ,function(){
                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
            });

            /**
             * Validando a data quando objeto perder o foco
             */
            self.element.focusout(function(){
                if (self.element.val() != ''){
                    var newValue = self.TDateFormat(self.element.val());
                    self.element.val(newValue);
                    
                    if(self.element.val()[self.element.val().length-1] == '/' && self.element.val() != '' ){
                        alert('Data inválida');
                        self.cleaner();
                        return false;
                    }
                    
                    self.validate(self.element.val(), self.options.dateFormat);
                    self.buttonNoFocus();
                }
            })

            self.element.click(function(){
                //console.log('Click');
                self.element.next().trigger('click');
            })

            self.element.focus(function(){
                //console.log('Focus');
                self.buttonNoFocus();
                self.element = $(this);
            });
            
            self.element.keyup(function(e){
                if (self.element.val().length >= 4 && self.options.onChangeFunction){
                    self.options.onChangeFunction(self.element);
                }
                return true;
            });

            //Não permite a inserção do caracter '/'
            //Formata o valor da data inserindo o caracter '/' via JavaScript
            self.element.keypress(function(e){
                //console.log('Keypress');
                var value = self.element.val();

                //Proibe a inserção do caracter '/'
                if( e.which == 47 || e.which == 13 ){
                    return false;
                }

                //Se o usuário não estiver utilizando o backspace
                //Execute as instruções de formatação da data
                if( e.which != 8 ){
                    var maxlength = parseInt(self.element.attr('maxlength'));

                    if( value.length == 2 && (maxlength == 7 || maxlength == 10) ){
                        self.element.val(self.element.val() + '/');

                    } else if( value.length == 5 && maxlength == 10 ){
                        self.element.val(self.element.val() + '/');

                    }
                }
                return true;
            })

            this.disabled(this.element.attr('disabled'));
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        validate : function(date, format){
            var periods = format.split('/');
            var arrayDate = date.split('/');
            var date = new Date();

            if( periods.length == 3 && arrayDate[2] != '' ){

                if(periods[0] == 'dd'){

                    if ( this._validateMonth(arrayDate[1]) ) {
                        if( this._validateDay( arrayDate[0], arrayDate[1], arrayDate[2] ) ) {
                            date.setDate(arrayDate[0]);
                            date.setMonth(arrayDate[1]);
                            date.setFullYear(this._validateYear(arrayDate[2]));
                        }
                    }

                } else {
                    if ( this._validateMonth(arrayDate[0]) ) {
                        if( this._validateDay( arrayDate[0], arrayDate[1], arrayDate[2] ) ) {
                            date.setDate( arrayDate[1] );
                            date.setMonth( arrayDate[0] );
                            date.setFullYear( this._validateYear(arrayDate[2]) );
                        }
                    }
                }
            } else if ( periods.length == 2 ) {
                if(this._validateMonth( arrayDate[0] )){
                    date.setMonth( arrayDate[0] );
                    date.setFullYear( this._validateYear(arrayDate[1]) );
                }
            }
        },
        
        TDateFormat: function(value){
            if (value == ''){
                return '';
            }else{
                //'010113'
                if (value.indexOf('/') == -1){
                    value = value.substr(0,2) + '/' + value.substr(2,2) + '/' + value.substr(4);
                }
                var arrayData = value.split('/');
                var valueFormat = '';
                if( arrayData[arrayData.length-1].length == 2 ){
                    var date = new Date();
                    var year = date.getFullYear() + '';
                    year = year.substring(0,2);

                    if(arrayData.length == 3){
                        valueFormat = arrayData[0] + '/' + arrayData[1] + '/' + year + arrayData[2];
                    } else {
                        valueFormat = arrayData[0] + '/' + year + arrayData[1];
                    }
                }else{
                    valueFormat = value;
                }
                return valueFormat;
            }
        },
        
        getDate : function(){
            var retorna = false;
            if(this.element.val() != ''){
                var arrayData = this.element.val().split('/');
                if( arrayData[arrayData.length-1].length == 2 ){
                    var date = new Date();
                    var year = date.getFullYear() + '';
                    year = year.substring(0,2);
                    if(arrayData.length == 3){
                        arrayData[2] = year + arrayData[2];
                    } else {
                        arrayData[1] = year + arrayData[1];
                    }
                }
                if(arrayData.length == 2){
                    arrayData[2] = arrayData[1];
                    arrayData[1] = arrayData[0];
                    arrayData[0] = '01';
                }
                var mes = parseInt(arrayData[1],10);
                var dia = parseInt(arrayData[0],10);
                var ano = parseInt(arrayData[2],10);
                retorna = new Date(ano,mes-1,dia);
            }
            return retorna;
        },

        _validateYear : function(){
            var self = this;

            if(self.element.length == 2 && this._property.dateFormat.length == 7) {
                var temp = new Date();
                temp = temp.getFullYear();
                return temp.substring(0,2) + self.element.val();
            } else if ( self.element.val().length == 3 ) {
                return true;
            } else {
                return self.element.val();
            }
        },

        _validateMonth : function( value ){
            if ( value > 12 ) {
                alert('Insira um mes valido!');
                this.cleaner();
                return false;
            } else {
                return true
            }
        },

        _validateDay : function( day, month, year ){
            //Segundo parâmetro '10' força o JavaScript a trabalhar com decimal
            day = parseInt(day, 10);
            month = parseInt(month, 10);
            year = parseInt(year, 10);

            //Se for o último mês do ano, transforme o mês para Janeiro do próximo ano
            //E adicione 1 ao valor do ano recebido como parâmetro desta função
            if(month == 12) {
                month = 1;
                year += 1;
            }

            var max = new Date((month+1)+'/01/'+year);
            max = new Date(max - 1);

            if( day > max.getDate() || day < 1 ){
                alert('Insira um dia valido para o mes!');
                this.cleaner();
                return false;
            } else {
                return true;
            }
        },//Fim _validateDay

        cleaner : function(){
            //console.log('Input limpo!');
            var self = this;
            self.element.val('');
            self.element.focus();
			self.options.onChangeFunction(self.element);
        },

        destroy: function() {
            var self = this;
            $.Widget.prototype.destroy.call( self );
        },
        
        buttonNoFocus: function (){
            var element = null;
            if (!this.element){
                element = jQuery(this);
            }else{
                element = this.element;
            }
            //element.next().attr('nofocus',true);
            if (element.val() != ''){
                element.next().attr('nofocus',true);
            }else if (element.hasClass('required')){
                element.next().attr('nofocus',false);
            }else{
                element.next().attr('nofocus',true);
            }
        }

    })//Fim $.widget('ta.TDate'...
})(jQuery);