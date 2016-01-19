/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TBanner', {
        options: {
            timer: 5000,
            index: 0,
            interval: null,
            banners: [],
            urls: [],
            titles: [],
            dots: false,
            timer_effect: 1000
        },
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function () {
            var self = this;
            if (self.options.banners.length) {
                self.id_dots = $(self.element).attr('id') + '-dots';
                self.id_urls = $(self.element).attr('id') + '-url';

                var hrefs = '';
                hrefs = hrefs + '<ul>';
                for (var index = 0; index < self.options.banners.length; index++) {
                    hrefs = hrefs + '<li id="dot-' + index + '" index="' + index + '">' + (index + 1) + '</li>';
                }
                hrefs = hrefs + '</ul>';
                if (self.options.dots) {
                    self.element.after('<div id="' + self.id_dots + '" class="footer dots"></div>');
                    self.options.dots = $('#' + self.id_dots);
                    self.options.dots.html(hrefs);
                    self.options.dots.addClass("layout-dots");
                    self.options.dots.find('li').click(function () {
                        self.transiction($(this).attr('index'), false);
                    });
                }

                if (self.options.urls) {
                    self.element.wrap('<a id="' + self.id_urls + '"></a>');
                }

                $(self.element).css("cursor", "pointer");
                $.merge($(self.element), $("#" + self.id_dots)).mouseover(function () {
                    if (self.options.interval) {
                        clearInterval(self.options.interval);
                    }
                }).mouseout(function () {
                    self.update();
                });
                self.update();
                self.transiction(0);
            }
        },
        update: function () {
            var self = this;
            if (self.options.banners.length > 1) {
                self.options.interval = setInterval(function () {
                    self.transiction();
                }, this.options.timer);
            }
        },
        transiction: function (index, with_timer) {
            var self = this;
            if (index != undefined) {
                self.options.index = index;
            }
            if (self.options.index >= self.options.banners.length) {
                self.options.index = 0;
            }
            var timer = self.options.timer_effect;
            if (with_timer == false) {
                timer = 0;
            }
            self.changeImage(self.options.index, timer);
            if (self.options.urls.length) {
                $("#" + self.element.attr('id') + "-url").attr('href', self.options.urls[self.options.index]);
            }
            if (self.options.titles.length) {
                $("#" + self.element.attr('id')).attr('title', self.options.titles[self.options.index]);
            }
            if (self.options.dots) {
                self.options.dots.find('[id^=dot-]').removeClass('active');
                self.options.dots.find('#dot-' + self.options.index).addClass('active');
            }
            self.options.index++;
        },
        changeImage: function (index, timer) {
            var self = this;
            if (self.element.css('background-image') == 'none') {
                timer = 0;
            }
            timer = timer / 2;
            self.element.fadeOut(timer, function () {
                self.element.css('background-image', 'url(' + self.options.banners[index] + ')');
                self.element.fadeIn(timer);
            });
        }
    });
})(jQuery);

