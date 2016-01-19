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
    $.widget('ta.TDateMulti', {
        options: {
            regional: 'pt-BR',
            dateFormat: 'dd/mm/yy',
            position:0
        },
        /**
         * Executado como um construtor do componente
         * Todas as configurações iniciais são executadas neste método
         */
        _create : function(){
            var self = this;
            var id = this.element.attr('id');
            
            /**
             * Posicionando o botão para dentro do input
             */
            jQuery('#bt-calend-' + id).click(function(){                
                jQuery('#calend-' + id + '-1').slideToggle('fast');
                jQuery('#calend-' + id + '-2').slideToggle('fast');
                jQuery('#calend-toolbar-' + id).slideToggle('fast');
            });
            
            var optionsDatePicker = {
                dateFormat: self.options.dateFormat,
                onSelect: null
            };
            
            optionsDatePicker.onSelect = function(value){
                self.setValue(value, this);
                //jQuery('#calend-' + id + '-1').hide('fast');
                //jQuery('#calend-' + id + '-2').hide('fast');
            }
            
            jQuery('#calend-' + id + '-1').datepicker(optionsDatePicker);
            jQuery('#calend-' + id + '-2').datepicker(optionsDatePicker);
            //self.options.cursor = jQuery(self.element).TCursor();
            
            var position = function(){
                var position = self.getCursorPosition(this);
                self.options.position = position;
                
                var value1 = self.getValuePosition(0);
                value1 = self.TDateFormat(value1);
                
                var value2 = self.getValuePosition(1);
                value2 = self.TDateFormat(value2);
                
                jQuery('#calend-' + id + '-1').datepicker( "setDate", value1 );
                jQuery('#calend-' + id + '-2').datepicker( "setDate", value2 );
            }
            
            self.element.keyup(position)
            .keydown(function(e){
                self.position;
                self._dateAdd(e);
            })
            .keypress(position)
            .mouseup(position)
            .mousedown(position)
            .click(function(){
                jQuery('#bt-calend-' + id).trigger('click');
                self.options.position = self.getCursorPosition(this);
                
                var value1 = self.getValuePosition(0);
                value1 = self.TDateFormat(value1);
                
                var value2 = self.getValuePosition(1);
                value2 = self.TDateFormat(value2);
                
                jQuery('#calend-' + id + '-1').datepicker( "setDate", value1 );
                jQuery('#calend-' + id + '-2').datepicker( "setDate", value2 );
                //jQuery('#calend-' + id).show('fast');
            });
            /**
             * Validando a data quando objeto perder o foco
             */
            self.element.focusout(function(){
                if (self.element.val() != ''){
                    self.format();
                    
                    if(self.element.val()[self.element.val().length-1] == '/' && self.element.val() != '' ){
                        alert('Data inválida');
                        self.cleaner();
                        return false;
                    }
                    
                    self.buttonNoFocus();
                }
            });
            
            this.disabled(this.element.attr('disabled'));
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        
        setCursorPosition: function(start, end){
            var input = document.getElementById(this.element.attr('id'));
            input.focus();
            input.setSelectionRange(start, end);
        },
        
        _dateAdd: function(event){
            if(event.which != 38 && event.which != 40 && event.which != 33 && event.which != 34){
                return;
            }
            var id = this.element.attr('id');
            jQuery('#calend-' + id + '-1').hide('fast');
            jQuery('#calend-' + id + '-2').hide('fast');
            var value = this.element.val();
            var arrayDate = [];
            var sep = '';
            var pos = this.options.position;

            if (value.indexOf(' ') > 0){
                sep = ' ';
            }else if (value.indexOf(';') > 0){
                sep = ';';
            }
            if (sep){
                arrayDate = value.split(sep);
            }else{
                arrayDate[0] = value;
            }

            var lenStart = 0;
            var lenFinish = 0;
            for(var index in arrayDate){
                lenFinish = lenFinish + arrayDate[index].length
                          + (index * sep.length); /*Regra adicionada para somar o separador*/
                if (this.options.position >= lenStart && this.options.position <= lenFinish){
                    break;
                }
            }
            
            if(arrayDate[index].indexOf('/') > 0){
                if(index > 0){
                    pos = this.options.position - (index * arrayDate[index].length) - (index * sep.length);
                }
                arrayDate = arrayDate[index].split('/');
                
                lenStart = 0;
                lenFinish = 0;
                for(var dmy in arrayDate){
                    lenFinish = lenFinish + arrayDate[dmy].length
                              + (dmy > 0?1:0) /*Regra adicionada para somar o tamanho da barra '/'*/;
                    if (pos >= lenStart && pos <= lenFinish){
                        break;
                    }
                }
                
                this._dateInc(arrayDate, index, dmy, event);
            }
        },
        
        _dateFormat: function(day, month, year, dmy){
            var arrayDate = [];
            
            var date = new Date();
            if(day === ''){
                day = date.getDay();
            }
            if(month === ''){
                month = date.getMonth() + 1;
            }
            if(!year){
                year = date.getFullYear();
            }
            day = parseInt(day),
            month = parseInt(month),
            year = parseInt(year);
                
            var max = new Date((month+1)+'/01/'+year);
            max = new Date(max - 1);

            /* Regras para dia */
            if(day > max.getDate()){
                if(dmy == 0){ /*Alterando dia*/
                    day = 1;
                    month += 1;
                } else if(dmy == 1){ /*Alterando mês*/
                    max = new Date((month+1)+'/01/'+year);
                    max = new Date(max - 1);
                    day = max.getDate();
                }
            }
            if(day <= 0){
                month -= 1;
                max = new Date((month+1)+'/01/'+year);
                max = new Date(max - 1);
                day = max.getDate();
            }
            
            /* Regras para mês */
            if(month > 12){
                month = 1;
                year += 1;
            }
            if(month <= 0){
                month = 12;
                year -= 1;
            }
            
            /* Formatação do array */
            arrayDate[0] = day,
            arrayDate[1] = month,
            arrayDate[2] = year;

            for(var i in arrayDate){
                if(parseInt(arrayDate[i]) <= 9 && arrayDate[i].toString().length == 1){
                    arrayDate[i] = '0' + arrayDate[i];
                }
            }
            return this.TDateFormat(arrayDate[0] + '/' + arrayDate[1] + '/' + arrayDate[2]);
        },
        
        _dateInc: function(arrayDate, index, dmy, event){
            var inc = 0;
            var pos = this.options.position;
            var date = '';
            if(event.which == 38){
                inc = 1;
            } else if(event.which == 40){
                inc = -1;
            } else if(event.which == 33){
                if(dmy == 0){
                    var max = new Date((parseInt(arrayDate[1])+1)+'/01/'+arrayDate[2]);
                    max = new Date(max - 1);
                    arrayDate[dmy] = max.getDate();
                } else if(dmy == 1){
                    arrayDate[dmy] = '12';
                } else if(dmy == 2){
                    inc = 1;
                }
            } else if(event.which == 34){
                if(dmy == 0 || dmy == 1){
                    arrayDate[dmy] = '01';
                } else if(dmy == 2){
                    inc = -1;
                }
            }
            arrayDate[dmy] = parseInt(arrayDate[dmy]) + inc;
            
            date = this._dateFormat(arrayDate[0], arrayDate[1], arrayDate[2], dmy);
            this.setValue(date, index);
            this.setCursorPosition(pos, pos);
        },
        
        getCursorPosition: function(o){
            if (o.createTextRange) {
                var r = document.selection.createRange().duplicate()
                r.moveEnd('character', o.value.length)
                if (r.text == '') return o.value.length
                return o.value.lastIndexOf(r.text)
            } else 
                return o.selectionStart
        },
        
        format: function(){
            var value = this.element.val();
            var id = this.element.attr('id');
            var sep = '';
            var arrayDate = [];
            if (value){                
                if (value.indexOf(' ') > 0){
                    sep = ' ';
                }else if (value.indexOf(';') > 0){
                    sep = ';';
                }
                if (sep){
                    arrayDate = value.split(sep);
                }else{
                    arrayDate[0] = value;
                }
                
                for(var index in arrayDate){
                    arrayDate[index] = this.TDateFormat(arrayDate[index]);
                    if (!this.validate(arrayDate[index], this.options.dateFormat)){
                        delete arrayDate[index];
                    }
                }
                value = '';
                if (sep == '') sep = ' ';
                for(index in arrayDate){
                    value = value + sep + arrayDate[index];
                }
                value = value.substr(1);
                this.element.val(value);
                //jQuery('#calend-' + id).hide('fast');
            }
        },
        
        getValuePosition: function(vIndex){
            if (vIndex == null) {
                vIndex = 0;
            }
            
            var value = this.element.val();
            var sep = '';
            var arrayDate = [];
            if (value){                
                if (value.indexOf(' ') > 0){
                    sep = ' ';
                }else if (value.indexOf(';') > 0){
                    sep = ';';
                }
                if (sep){
                    arrayDate = value.split(sep);
                }else{
                    arrayDate[0] = value;
                }
                
                
                var lenStart = 0;
                var lenFinish = 0;
                for(var index in arrayDate){
                    lenFinish = lenFinish + arrayDate[index].length;
                    if (this.options.position >= lenStart && this.options.position <= lenFinish){
                        break;
                    }
                    lenStart = lenStart + arrayDate[index].length;
                }
                return arrayDate[vIndex];
            }else{
                return '';
            }
        },
        
        setValue: function(newDate, object){
            var vIndexObject = '';
            if(typeof(object) == 'object'){
                var objectId = object.id;
                vIndexObject = objectId.substr(objectId.length - 1, 1) - 1;
            } else {
                vIndexObject = object;
            }
            var value = this.element.val();
            var sep = '';
            var arrayDate = [];
            if (value){                
                if (value.indexOf(' ') > 0){
                    sep = ' ';
                }else if (value.indexOf(';') > 0){
                    sep = ';';
                }
                if (sep){
                    arrayDate = value.split(sep);
                }else{
                    arrayDate[0] = value;
                }

                arrayDate[vIndexObject] = newDate;
                
                for(index in arrayDate){
                    arrayDate[index] = this.TDateFormat(arrayDate[index]);
                    if (!this.validate(arrayDate[index], this.options.dateFormat)){
                        delete arrayDate[index];
                    }
                }
                
                value = '';
                if (sep == '') sep = ' ';
                for(index in arrayDate){
                    value = value + sep + arrayDate[index];
                }
                value = value.substr(1);
                this.element.val(value);
            }else{
                this.element.val(newDate);
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
            
            return true;
        },
        
        TDateFormat: function(value){
            if (value == ''){
                return '';
            }else{
                //'010113'
                value = value.replace('/','').replace('/','');
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