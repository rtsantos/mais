/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery.fn.extend({
    mask: function (mask) {
        var maskAnalysis = mask;
        if (typeof mask == 'string') {
            mask = [mask];
        }
        if (typeof mask == 'object') {
            maskAnalysis = mask[0];
        }
        var count1 = maskAnalysis.split('@').length;
        var count2 = maskAnalysis.split('9').length;
        var count3 = maskAnalysis.split('Z').length;
        var charMask = '@';
        if (count2 > count1 && count2 > count3) {
            charMask = '9';
        }
        if (count3 > count1 && count3 > count2) {
            charMask = 'Z';
        }
        $(this).TMask({masks: mask, charMask: charMask});
        return $(this);
    }
});

