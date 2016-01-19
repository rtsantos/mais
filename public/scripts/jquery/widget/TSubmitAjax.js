/**
 * Classe para criação do submit via ajax validando os campos
 * 
 * @author: Kaue santoja
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
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

(function($) {
    $.widget('ta.TSubmitAjax',{
        options: {
            classCSS: 'submitAjax',
            urlSubmit: '#',
            validate: true,
            id: 'btSubmitAjax',
            classRequired: 'required'
        }, 
        
        
        /**
         * Método construtor
         *
	 * @access private
	 * @return void
	 */
        _create: function(){
            var self = this;
                      
            var formFields = $(".required");
            var requiredNull = "";
            
            for(i=0;i<formFields.length;i++){
                if(formFields[i].value == ""){
                    requiredNull = $("label[for=\'"+formFields[i].id+"\']").text();
                }
            }
            
            if(requiredNull != ""){
                alert("O campo "+requiredNull+" é obrigatório");
            } 
             
             
             
             
             
             
             
             
             
             
             
             
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
             
             
             
             
             
             
             
            self.options.open = function(){
                var objAutocomplete = self.element.autocomplete('widget')[0];
                $(objAutocomplete)
                .addClass(self.options.classCSS)
                .width(self.element.width()+16);
            
            }
        
            /*self.options.close = function(){
                self.element.attr('status',0); 
            }*/
            
            this.divBoxAC = $('<div></div>')
            .attr('id','divTAutocomplete'+this.element.attr('id'))
            .height(this.element.height())
            .width(this.element.width())
            .css('position','relative') 
            .addClass('divTAutocomplete')
            .insertAfter(this.element)
            .append(this.element);
            
            this.element
            .addClass(self.options.inputCSS)
            .css('padding-right',18)
            .width(this.element.width()-18);
           
            
            
            if(self.options.showButtonSearch){
                this.spanButton = $('<span></span>')
                .insertAfter(this.element)
                .addClass('ui-button ui-state-default ui-corner-right ui-button-icon-only')
                .click(function(){
                    self.openClose();
                })
                .height(self.element.height())
                .width(24)
                .css('margin-right','0')
                .css('position','absolute')
                .css('top','0')
                .css('right','-2px')
                this.innerSpanButton = $('<span></span>')
                .addClass('ui-button-icon-primary ui-icon ui-icon-carat-1-s')
                .appendTo(this.spanButton);
                
                $('<span>&nbsp;</span>')
                .insertAfter(this.innerSpanButton);
                
           
                
            }
                        
            if(self.options.selectAll){
                self.element.click(function(){
                    self.element.select();
                });
            }
            self.element.focus(function(){
                self.element.attr('focusEl',1);
            }).blur(function(){
                self.element.attr('focusEl',0);
            });
            self.options.minChars = self.options.minLength;
            self.element.oldAutocomplete(self.options.source,self.options);              
        },
        
        
        /**
         * Método para abrir/fechar o autocomplete
         *
	 * @access public
	 * @return void
	 */
        openClose: function(){
            var self = this;
            self.element.focus();
            self.element.openBox();
        }   
    });
})(jQuery);
