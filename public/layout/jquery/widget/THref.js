/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.THref', {
        options: {
        },
        /**
         * Método construtor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function () {
            var self = this;
            self.element.click(function (e) {
                document.location.href = self.element.attr('t-href');
                e.preventDefault();
                e.stopPropagation();
            });
        }
    });
})(jQuery);

