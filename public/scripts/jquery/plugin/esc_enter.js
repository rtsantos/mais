/*
 * Copyright (c) 2007 Betha Sidik (bethasidik at gmail dot com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * This plugin developed based on jquery-numeric.js developed by Sam Collett (http://www.texotela.co.uk)
 */

/*
 * Change the behaviour of enter key pressed in web based to be tab key
 * So if this plugin used, a enter key will be a tab key
 * User must explicitly give a tabindex in element such as text or select
 * this version will assumed one form in a page
 * applied to element text and select
 *
 */

/*
 * I modified the plugin to work for my need
 * This will work even if the next tabindex is non-existent, or disabled so
 * it will find the very next element on the tabindex series until the maximum tabindex
 * which must be defined manually.
 *
 * ALL CREDITS GOES TO THE ORIGINAL AUTHOR
 */
jQuery.fn.taEscEnter = function(){
    this.keypress(function(e){
        // get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (jQuery(this).attr('disabledEscEnter')=='1') return;
		
        if (key == 13 || key == 27){
            var tmp = null;
            var maxTabIndex = 1000;

            // get tabindex from which element keypressed
            if (key == 13){
                var nTabIndex=this.tabIndex+1;
            }else{
                var nTabIndex=this.tabIndex-1;
            }
			
            // get element type (text or select)
            var myNode = this.nodeName;
            if (myNode) {
                myNode = myNode.toLowerCase();
            }
			
            // allow enter/return key (only when in an input box or select)
            if(nTabIndex > 0 && (key == 13 || key == 27) && nTabIndex <= maxTabIndex && ((myNode == "textarea") || (myNode == "input") || (myNode == "select") || (myNode == "a"))){
                for (var x=0; x<100; x++){
                    tmp = jQuery('body').find('input[tabIndex='+ nTabIndex +'],select[tabIndex='+ nTabIndex +'],textarea[tabIndex='+ nTabIndex +'],button[tabIndex='+ nTabIndex +']').get(0);
                    if (typeof tmp != "undefined" && !jQuery(tmp).attr("readonly") && !jQuery(tmp).attr("disabled") && !hasNoFocus(jQuery(tmp).attr("nofocus")) && jQuery(tmp).attr("id") != '5' && elementVisible(jQuery(tmp),1) == true){
                        try{
                            tmp.focus();
                            jQuery(tmp).select();
                            return false;
                        }catch(err){
                            
                        }
                    }
                    if (key == 13){
                        nTabIndex++;
                    } else {
                        nTabIndex--;
                        if (nTabIndex < 0) x = 101;
                    }                    
                }
                return false;
            }else if(key == 13){
                return false;
            }else if(key == 27){
                return false;
            }
        }
    });
    return this;
};
jQuery.fn.taEsc = function(){
    this.keypress(function(e){
        // get key pressed (charCode from Mozilla/Firefox and Opera / keyCode in IE)
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (key == 27){
            var tmp = null;
            var maxTabIndex = 1000;
				
            var nTabIndex=this.tabIndex-1;
            // get element type (text or select)            
            var myNode = this.nodeName;
            if (myNode) {
                myNode = myNode.toLowerCase();
            }

            // allow enter/return key (only when in an input box or select)
            if(nTabIndex > 0 && (key == 27) && nTabIndex <= maxTabIndex && ((myNode == "textarea") || (myNode == "input") || (myNode == "select") || (myNode == "button") || (myNode == "a"))){
                for (var x=0; x<100; x++){
                    var tmp = $(this).parents().find('form').find('input[tabIndex='+ nTabIndex +'],select[tabIndex='+ nTabIndex +'],textarea[tabIndex='+ nTabIndex +'],button[tabIndex='+ nTabIndex +']').get(0);
                    if (typeof tmp != "undefined" && !$(tmp).attr("readonly") && !$(tmp).attr("disabled") && !hasNoFocus($(tmp).attr("nofocus")) &&  $(tmp).attr("id") != '5'){						
                        $(tmp).focus();
                        $(tmp).select();
                        return false;
                    }else{
                        nTabIndex--;
                        if (nTabIndex < 0) x = 11;						
                    }
                }
                return false;
            }else if(key == 27){
                return false;
            }
        }
    });
    return this;
};

function elementVisible(element,iStart){
    try{
        if (element.parent().css('display') == 'none' || element.css('display') == 'none'){
            return false;
        }else if(iStart <= 6){
            return elementVisible(element.parent(),(iStart+1));
        }        
    }catch(err){
        return true;
    }
    return true;
}

function hasNoFocus(value){
    if (value == 'true' || value == '1' || value == true || value == 1){
        return true;
    }else{
        return false;
    }
}

function nextFocus(obj){
    obj = jQuery(obj);
    var tmp = null;
    var maxTabIndex = 1000;
    var nTabIndex = (obj.attr('tabIndex')*1) + 1;
    // get element type (text or select)
    var myNode = obj.attr('nodeName');
	if (myNode){
	    myNode = myNode.toLowerCase();
	}
    // allow enter/return key (only when in an input box or select)
    if(nTabIndex > 0 && nTabIndex <= maxTabIndex && ((myNode == "textarea") || (myNode == "input") || (myNode == "select") || (myNode == "a"))){
        for (var x=0; x<100; x++){
            tmp = $('body').find('input[tabIndex='+ nTabIndex +'],select[tabIndex='+ nTabIndex +'],textarea[tabIndex='+ nTabIndex +'],button[tabIndex='+ nTabIndex +']').get(0);
            if (typeof tmp != "undefined" && !$(tmp).attr("readonly") && !$(tmp).attr("disabled") && !hasNoFocus($(tmp).attr("nofocus")) && $(tmp).attr("id") != '5'){						
                $(tmp).focus();
                $(tmp).select();
                return this;
            } else {
                nTabIndex++;
            }
        }
    }
    return this;
}

function configTabIndex(options){
    if (!options){
        var options = {
            form: jQuery('body').find('form')
        };
    }
    var vForm = options.form;
    var vTabIndex = (gTabIndex + 1);
    var vSetFocus = true;
    var vIdFocus = '';

    $(vForm).each(function(){

        $('input, select, textarea, button').each(function(){
            //console.log($(this).attr('tabindex'));
            //console.log($(this).attr('nofocus'));
            //console.log($(this).attr('hidden'));
            if(	($(this).attr('tabindex') == '' || isNaN($(this).attr('tabindex')) )	&&
                /*!$(this).attr('nofocus')		&&*/
                ($(this).attr('type') != 'hidden' || !$(this).attr('type')) ){

                $(this).attr('tabindex',vTabIndex);
                vTabIndex++;

            }
        })
    })

    gTabIndex = vTabIndex;
};
var gTabIndex = 0;