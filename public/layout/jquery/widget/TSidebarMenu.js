/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TSidebarMenu', {
        options: {
            timerHide: 1000,
            /*-*/
            configsHideShow: {
                events: ['over'],
                autoShow: true,
                autoReposition: false,
                hideShowElement: false,
                fade: true
            }
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
            self.role = $('#' + this.element.attr('role'));
            
            self.role.click(function(e){
                self.element.slideToggle();
                self.role.toggleClass('hover');
                self.role.find('span.go').toggleClass('open');
                e.preventDefault();
            });
            
            //TsetUpdateHide(self, self.options.configsHideShow);
        }
    });
})(jQuery);

