/**
 * 
 * 
 * @author: rsantos
 * @version 1.0
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 *
 *  Options:
 *  
 */

(function($) {
    $.widget('ta.TMask', {
        options: {
            masks: [],
            charMask: '@'
        },
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function() {
            var self = this;
            var arrayMasks = ['@', '9', 'Z'];
            var activeMask = function(){
                var value = self.element.val();
                if (value){
                    var masks = '';
                    var mask = '';
                    if (typeof self.options.masks == 'string'){
                        masks = [self.options.masks];
                    }else{
                        masks = [];                        
                        for(var iMask=0; iMask<self.options.masks.length; iMask++){
                            mask = self.options.masks[iMask];
                            for(var m in arrayMasks){
                                mask = replace(mask,arrayMasks[m],'@');
                            }
                            masks[iMask] = mask;
                        }
                    }
                    value = formatString({
                        value: value,
                        masks: masks,
                        charMask: '@'
                    });
                    var valid = false;
                    for(var mask in self.options.masks){
                        //alert(self.options.masks[mask]);
                        if(self.options.masks[mask].length == value.length){
                            valid = true;
                            for(var i = 0; i < self.options.masks[mask].length; i ++){
                                if(arrayMasks.indexOf(self.options.masks[mask][i]) != -1){
                                    if(self.options.masks[mask][i] == '9' && isNaN(value[i])){
                                        valid = false;
                                        break;
                                    } else if(self.options.masks[mask][i] == 'Z' && !/^[a-zA-Z]+$/.test(value[i])){
                                        valid = false;
                                        break;
                                    }
                                } else if(self.options.masks[mask][i] != value[i]){
                                    valid = false;
                                    break;
                                }
                            }
                            if(valid){
                                break;
                            }
                        }
                    }
                    var elName = self.element.attr("id");
                    var labelError = jQuery('[for="' + elName + '"][class*="error"]');
                    if(!valid){
                        value = '';
                        //alert('Formatação ou valor inválido!');
                        labelError.html('<br />Formatação ou valor inválido!').show();
                        var idTimeout = null;
                        idTimeout = setTimeout(function(){
                            self.element.focus();
                            clearTimeout(idTimeout);
                        }, 1);
                    } else {
                        labelError.html('').hide();
                    }
                    self.element.val(value);
                }
            }
            self.element.blur(activeMask);
        }
    });
})(jQuery);
