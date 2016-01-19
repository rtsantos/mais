/**
 * Classe para formatação de campo input-text para mês e ano
 * 
 * @author: rsantos
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.mask.js
 *
 *  
 *  To-do:
 *
 *  Options:
 * - 
 */
(function($) {
    $.widget( 'ta.TDateMonthYear',{  
        options: {

        },
        
        /**
         * Método cosntrutor
         *
	 * @access private
	 * @return void
	 */
        _create: function(){
            var self = this;
            var parent = self.element.parent();
            var name = self.element.attr('name');
            var id = self.element.attr('id');
            
            
            self.element.attr('name',name + '_user');
            
            var divContainer = $('<div></div>')
                                .attr('id',this.element.attr('id') + '-container')
                                .height(this.element.height())
                                .width(this.element.width())
                                .css('position','relative') 
                                .insertAfter(this.element);

            this.element.appendTo(divContainer);
            
            var button = $('<button type="button" nofocus="true"><span class="ui-button-icon-primary ui-icon ui-icon-calendar"></span></button>');
            button.addClass('ui-button ui-state-default ui-corner-right ui-button-icon-only')
                  .attr('id','buttonTime'+this.element.attr('id'))
                  .height(self.element.height())
                  .width(20)
                  .css('margin-right','0')
                  .css('position','absolute')
                  .css('top','0')
                  .css('height', (self.element.height() + 12) + 'px')
                  .click(function(event){
                      self.openCloseDialog();
                      event.preventDefault();
                      return false;
                  })                  
                  .insertAfter(this.element);
            //button.TButton();
            $('<input type="hidden" name="'+name+'" id="'+id+'-value" value="'+ self.element.val() +'">').insertAfter(this.element);
            $('<label class="error" for="'+ id +'" generated="true" style="display: none; width:300px;"></label>').insertAfter(button);            
            this._createDialog().insertAfter(this.element);
            
            if (self.element.val()){
                var value = self.element.val().split('/');
                self.element.val(value[1]+'/'+value[2]);
            }
            
            self.element.change(function(){
                self._onChange();
            }).keydown(function(e){
                return self._keyPress(e);
            }).focusout(function(){
                return self._isValid();
            }).click(function(event){
                var dialog = $('#' + self.element.attr('id') + '-dialog');
                dialog.css('display','block');
            });
            
            $(document).click(function(){
                var dialog = $('#' + self.element.attr('id') + '-dialog');
                dialog.css('display','none');
            });
            
            //self.element.mask('99/9999');
            
            parent.find('.date-month-year-label-month').focus(function(){
                                                                $(this).removeClass('ui-state-default').addClass('ui-state-focus');
                                                             })
                                                       .focusout(function(){
                                                                $(this).removeClass('ui-state-focus').addClass('ui-state-default');
                                                             })
                                                       .hover(function(){$(this).removeClass('ui-state-default').addClass('ui-state-focus');}
                                                             ,function(){$(this).removeClass('ui-state-focus').addClass('ui-state-default');});
            
            this.disabled(this.element.attr('disabled'));
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        
        _keyPress: function(event){
            var month = this.element.parent().find('.date-month-year-choose-month .ui-state-highlight').attr('month');
            var dialog = $('#' + this.element.attr('id') + '-dialog');
            if (!month){
                month = 0;
            }
            if (event.keyCode == 38){//UP
                if (month == '01'){                    
                    month = '12';
                    this.changeYear('prev');
                }else{
                    month = (month*1) - 1;
                    month = str_pad(month,2,'0',0);
                }
                this.changeMonth(month);
                if (dialog.css('display') == 'none'){
                    dialog.css('display','block');
                }
            }else if (event.keyCode == 40){//Down
                if (month == '12'){
                    month = '01';
                    this.changeYear('next');
                }else{
                    month = (month*1) + 1;
                    month = str_pad(month,2,'0',0);
                }
                this.changeMonth(month);
                if (dialog.css('display') == 'none'){
                    dialog.css('display','block');
                }
            }else if (event.keyCode == 33){//PageUp
                this.changeYear('prev');
            }else if (event.keyCode == 34){//PageDown
                this.changeYear('next');
            }else if (event.keyCode == 39 && dialog.css('display') == 'block'){//Next
                this.changeYear('next');
                return false;
            }else if (event.keyCode == 37 && dialog.css('display') == 'block'){//Prev
                this.changeYear('prev');
                return false;
            }else if ((event.keyCode == 13 || 27) && dialog.css('display') == 'block'){//Enter / Esc
                dialog.css('display','none');
            }
            return true;
        },
        
        _getMonths: function(){
            var months = [];
            months[1] = 'Janeiro';
            months[2] = 'Fevereiro';
            months[3] = 'Março';
            months[4] = 'Abril';
            months[5] = 'Maio';
            months[6] = 'Junho';
            months[7] = 'Julho';
            months[8] = 'Agosto';
            months[9] = 'Setembro';
            months[10] = 'Outubro';
            months[11] = 'Novembro';
            months[12] = 'Dezembro';
            return months;
        },
        
        openCloseDialog: function(){
            var dialog = $('#' + this.element.attr('id') + '-dialog');
            if (dialog.css('display') == 'none'){
                dialog.width(this.element.width()+20);
                this._selectMonth(this.element.val().substr(0,2));
                dialog.css('display','block');
                this.element.focus();
            }else{
                dialog.css('display','none');
            }
        },
        
        _onChange: function(){
            $('#' + this.element.attr('id') + '-value').val('01/' + this.element.val());
        },
        
        changeMonth: function(month){
            var year = $('#' + this.element.attr('id') + '-year');
            var value = month + '/' + year.val();
            this.element.val(value);
            this.element.trigger('change');
            this._selectMonth(month);
        },
        
        changeYear: function(year){
            var varYear = $('#' + this.element.attr('id') + '-year');
            var varYearCur = new Date();
            varYearCur = varYearCur.getFullYear();
            
            if (year=='next'){
                year = (varYear.val()*1)+1;
            }else if(year=='prev'){
                year = (varYear.val()*1)-1;
            }
            year = year * 1;
            if (year < varYearCur-200 || year > varYearCur+200){
                alert('Ano inválido!');
                year = varYearCur;
            }
            
            var month = this.element.parent().find('.date-month-year-choose-month .ui-state-highlight');
            var value = month.attr('month') + '/' + year;
            
            this.element.val(value);
            this.element.trigger('change');
            
            $('#' + this.element.attr('id')+'-year').val(year);
        },
        
        _selectMonth: function(month){
            this.element.parent().find('.date-month-year-label-month').removeClass('ui-state-highlight');
            $('#' + this.element.attr('id')+'-'+month).addClass('ui-state-highlight');
        },
        
        _createDialog: function(){
            var dateNow = new Date();
            var value = this.element.val().split('/');
            var valueYear = dateNow.getFullYear();
            if (value[2]){
                valueYear = value[2];
            }
            
            var div = '<div id="'+this.element.attr('id')+'-dialog" class="date-month-year ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="position: absolute; z-index: 1; display: none; padding: 3px;">';
            div = div + '   <div class="date-month-year-choose-year ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all">';
            div = div + '      <span style="cursor: pointer;float:left;width:15px;" class="date-month-year-button-prev ui-icon ui-icon-circle-triangle-w" onClick="jQuery(\'#'+this.element.attr('id')+'\').TDateMonthYear(\'changeYear\',\'prev\');">';
            div = div + '      </span>';
            div = div + '      <span style="float:left;width:70px;text-align:center;">';
            div = div + '         <input type="text" nofocus="true" id="'+this.element.attr('id')+'-year" value="'+ valueYear +'" style="width:50px;text-align:center;" class="date-month-year-label-year" onChange="jQuery(\'#'+this.element.attr('id')+'\').TDateMonthYear(\'changeYear\',this.value);" />';
            div = div + '      </span>';
            div = div + '      <span style="cursor: pointer;float:left;width:15px;" class="date-month-year-button-next ui-icon ui-icon-circle-triangle-e" onClick="jQuery(\'#'+this.element.attr('id')+'\').TDateMonthYear(\'changeYear\',\'next\');">';
            div = div + '      </span>';
            div = div + '   </div>';
            div = div + '   <div class="date-month-year-choose-month">';
            var months = this._getMonths();            
            var classSelected = '';
            for (var month in months){
                month = str_pad(month,2,'0',0);
                classSelected = '';
                if ((dateNow.getMonth()*1)+1 == month*1){
                    classSelected = 'ui-state-highlight';
                }
                div = div + '      <div id="'+this.element.attr('id')+'-'+month+'" style="cursor: pointer;width:96%;margin-top:3px;padding:2px;" class="date-month-year-label-month ui-state-default '+classSelected+'" month="'+month+'" onClick="jQuery(\'#'+this.element.attr('id')+'\').TDateMonthYear(\'changeMonth\',\''+month+'\');jQuery(\'#'+this.element.attr('id')+'\').TDateMonthYear(\'openCloseDialog\');">';
                div = div + months[(month*1)];
                div = div + '      </div>';                
            }
            div = div + '   </div>';
            div = div + '</div>';
            return $(div);
        },
        
        /**
         * Método para validar hora
         *
	 * @access private
	 * @return bool
	 */
        _isValid: function (){
            var self = this;
            if (self.element.val() == ''){
                return true;
            }
            
            var value = self.element.val().split('/');            
            var month = value[0] * 1;
            var year  = value[1] * 1;
            var varYearCur = new Date();
            varYearCur = varYearCur.getFullYear() * 1;            
            
            if (month > 12 || month < 1){
                alert('Mês informado está inválido!');
                self.element.val('');
                self.element.trigger('change');
                self.element.focus();
                return false;
            }
            
            if (year < varYearCur-200 || year > varYearCur+200){
                alert('Ano inválido!');
                self.element.val('');
                self.element.trigger('change');
                self.element.focus();
                return false;
            }
            
            return true;
        }
    });
    
})(jQuery);
