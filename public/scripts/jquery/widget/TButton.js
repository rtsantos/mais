/**
 * jQuery.ui.TButton
 * 
 * Description:
 *      Trata o eventos de css do botão
 *
 * @author: rsantos
 * @version: 1.0
 * 
 * Depends:
 *      jQuery.ui
 *
 * Options:
 *      Não há opçõess
 *
 */
(function ($) {
    $.widget('ta.TButton', {
        options: {
            onClick: null
        },
        _create: function () {
            if (typeof this.options.onClick == 'function') {
                this.element.click(this.options.onClick);
            }
        }
    })
})(jQuery);