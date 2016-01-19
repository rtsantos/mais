/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TPopover', {
        options: {
            ignoreInputs: true,
            timerHide: 500,
            elements: 'input, button',
            updateScroll: false,
            reposition: true,
            /*-*/
            configsHideShow: {
                events: ['over'],
                autoShow: true,
                autoReposition: false,
                hideShowElement: true,
                fade: false
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
            self.focused = false;

            TsetUpdateHide(self, self.options.configsHideShow);
            self.updateSize();
            self.element.click(function () {
                self.updateSize();
            });
            if (self.options.updateScroll) {
                $(self.options.updateScroll).scroll(function () {
                    self.updateSize();
                });
            }
        },
        updateSize: function () {
            var self = this;
            if (self.options.reposition) {                
                if (self.element.attr('role')) {
                    var role = $('#' + self.element.attr('role'));
                    var posRole = role.position();
                    var height_padrao = 25;
                    var height = self.element.height();
                    if (height > height_padrao) {
                        height -= height_padrao;
                        height = height / 2;
                    } else {
                        height = 0;
                    }
                    var width = role.width() + 3;
                    self.element.css('top', posRole.top - height + 'px').css('left', posRole.left + width + 'px');
                }
            }
        }
    });
})(jQuery);

