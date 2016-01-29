/**
 * Esse procedimento tem como finalidade bloquear a tela do usuário
 * para espera de um processamento
 * 
 * Usar o procedimento
 * $.BlockT.open()
 * $.BlockT.close()
 * 
 * Não usar <<<< IMPORTANTE >>>>>
 * $.TLoadOpen() será depreciado
 * $.TLoadClose() será depreciado
 * 
 * @example $.BlockT.open();
 *          $.BlockT.open({id:'block-teste',title:'Processando rotina ....'},message:'Aguarde o processamento...'});
 *          $.BlockT.close();
 *          $.BlockT.close('block-teste');
 */

(function ($) {
    $.TLoadOpen = function (options) {
        jQuery('body').addClass('ui-block');
    }

    $.TLoadClose = function (id) {
        jQuery('body').removeClass('ui-block');
    }

    $.BlockT = {
        open: function (options) {
            jQuery('body').addClass('ui-block');
        },
        close: function (id) {
            jQuery('body').removeClass('ui-block');
        }
    }
})(jQuery);