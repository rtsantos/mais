/**
 * jQuery.ui.TEmail
 * 
 * Description:
 *      Componente valida o email digitado
 *
 * @author: Juliano Sena
 * @version: 0.1
 * 
 * Depends:
 *      jQuery.ui
 *
 * Options:
 *      Não há opções
 *
 */

(function($){
    $.widget('ta.TEmail',{
        options : {},
        emailPattern : '^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$',

        _create : function(){
            var self = this;

            /**
             * Quando o input perder o foco valide
             * se é um email válido
             */
            self.element
            .focusout(function(){
                if( self.validate( self.element.val() ) || self.element.val() == '' ){
                    return true;
                } else {
                    alert('Email invalido!');
                    self.cleaner();
                    self.element.focus();
                    return false;
                }
            });

            

        },

        validate : function( value ){
            var self = this;
            var pattern = self.emailPattern;
            var regex = new RegExp(pattern,'');

            return regex.test( value );
        },

        cleaner : function(){
            var self = this;
            self.element.val('');
        }

    })
})(jQuery);