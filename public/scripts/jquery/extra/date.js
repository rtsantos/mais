(function($) {
	$.fn.extend({
		taDate: function(p_options){
			this.change(function (){
				this.dateIsValid(this);
			});
		
			return this.each(function() {
				new $.taDateObject(this,p_options);
			});
		}
	});
	
	$.taDateObject = function (obj,options){
		if (!options){
			var options = [];		
		}
		options.dateIsValid = function(p_value){
			dia = (p_value.substring(0,2));
			mes = (p_value.substring(3,5));
			ano = (p_value.substring(6,10));

			dt_invalid = false;
			// verifica o dia valido para cada mes
			if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) {
				dt_invalid = true;
			}

			// verifica se o mes e valido
			if (mes < 01 || mes > 12 ) {
				dt_invalid = true;
			}

			// verifica se e ano bissexto
			if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) {
				dt_invalid = true;
			}

			if (p_value == "") {
				dt_invalid = true;
			}

			if (ano.length < 4) {
				dt_invalid = true;
			}

			if (dt_invalid) {
		      return false;
			}
			return true;
		};

		options.altFormat = 'dd/mm/yyyy';
		options = $.extend(options, options ||{});
		
		
		$(obj).datepicker({ altFormat: options.altFormat, showOn: 'button'});
		
		var vButton =  $(obj).next();
 		vButton.attr('class','ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only');
 		vButton.html('<span class="ui-button-icon-primary ui-icon ui-icon-calculator"></span><span>&nbsp;</span>');		
		
		obj.dateIsValid = function (this_data){
			if (this_data.value == ''){
				return false;
			}
			var data = null;
			data = this_data.value;
			data = data.replace('/','');
			data = data.replace('/','');
			data = data.replace('-','');
			data = data.replace('-','');

			if (data.length == 6 || data.length == 8){
				if (data.length == 6){
					data = data.substr(0,4) + '20' + data.substr(4,2);
				}
				this_data.value = data.substr(0,2) + '/' + data.substr(2,2) + '/' + data.substr(4,4);
				if (!options.dateIsValid(this_data.value)){
					alert('Data inválida!');
					this_data.value = '';
					return false;
				}
			}else{
				alert('Data inválida!');
				this_data.value = '';
				return false;
			}			
		};
	};
})(jQuery);