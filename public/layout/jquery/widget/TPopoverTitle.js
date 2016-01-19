/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TPopoverTitle', {
        options: {
            content: '',
            url: '',
            load: false,
            popover: null,
            direction: 'bottom',
            arrowStyle: 'left: 20px',
            loading: false,
            reposition: true
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
            var content = this.options.content;
            if (!content && this.element.attr('popover-title') != '') {
                var selector = this.element.attr('popover-title');
                if (selector && selector.substr(0,1) == '#'){                    
                    content = jQuery(this.element.attr('popover-title')).html();
                }else{                    
                    content = this.element.attr('popover-title');
                }
            }
            if (!content && this.options.url) {
                content = 'Aguarde, carregando...';
            }


            if (!content) {
                alert('Não informado uma das propridades: "content", "url", "popover-title".');
                return;
            }

            if (self.options.direction == 'right') {
                self.options.arrowStyle = 'top:50%';
            }

            var divArrow = '';
            if(self.options.arrowStyle){
                divArrow = '<div class="arrow" style="' + self.options.arrowStyle + '"></div>';
            }
            self.options.popover = jQuery('<div role="' + this.element.attr('id') + '" class="popover fade ' + self.options.direction + ' in">' + divArrow + '<div class="popover-content">' + content + '</div></div>');
            jQuery('body').append(self.options.popover);
            self.options.popover.TPopover({reposition: false});
            self.reposition();

            if (this.options.url) {
                this.element.hover(function () {
                    if (self.options.reposition) {
                        self.reposition();
                    }
                    if (!self.options.load) {
                        self.refresh();
                    }
                });
            }
        },
        reposition: function () {
            var self = this;
            var offset = self.element.offset();
            var infoWin = jQuery(window);

            if (self.options.direction == 'bottom') {
                offset.top = offset.top + self.element.heightTotal();
                offset.left = offset.left - 5;
                
                if (offset.left+self.options.popover.widthTotal() > infoWin.width()){
                    offset.left = (offset.left - self.options.popover.widthTotal()) + 40;
                    self.options.popover.find('.arrow').removeAttr('style').css('left',(self.options.popover.widthTotal()-25) + 'px');
                }
                
            } else if (self.options.direction == 'right') {
                offset.top = offset.top + (self.element.heightTotal() / 2) - (self.options.popover.heightTotal() / 2);
                offset.left = offset.left + self.element.widthTotal() + 5;
                
                if ((offset.left+self.options.popover.widthTotal()) > infoWin.width()){
                    self.options.direction = 'bottom';
                    self.options.popover.removeClass('right').addClass('bottom');
                    self.options.popover.find('.arrow').removeAttr('style').css('left','20px');
                    self.reposition();
                    return false;
                }
            }
            self.options.popover.css('top', offset.top + 'px').css('left', offset.left + 'px');
        },
        refresh: function () {
            var self = this;
            if (!self.options.loading) {
                self.options.loading = true;
                jQuery.ajax({
                    url: self.options.url,
                    success: function (response) {
                        self.options.popover.find('.popover-content').html(response);
                        self.options.load = true;
                        self.options.loading = false;
                        self.reposition();
                    }
                });
            }
        }
    });
})(jQuery);

