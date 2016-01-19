/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TDropdown', {
        options: {
            ignoreInputs: true,
            timerHide: 1000,
            elements: 'input, button',
            /*-*/
            configsHideShow: {
                events: ['over'],
                autoShow: true,
                autoReposition: false,
                hideShowElement: true,
                fade: false,
                focusShow: 'input'
            }
        },
        /**
         * MÃ©todo construtor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function () {
            var self = this;
            self.role = $('#' + this.element.attr('role'));

            TsetUpdateHide(self, self.options.configsHideShow);

            if (self.element.hasClass('tree')) {
                self.role.hover(function () {
                    self.updatePosition();
                });
            } else {
                self.updatePosition();
                jQuery(window).resize(function () {
                    self.updatePosition();
                });
            }
        },
        updatePosition: function () {
            var self = this;

            if (self.role.size()) {
                var align = this.element.attr('align');
                var posRole = null;
                if (self.element.hasClass('tree') || self.element.hasClass('position')) {
                    posRole = self.role.position();
                } else {
                    posRole = self.role.offset();
                }
                var offRole = self.role.offset();
                var infoWin = jQuery(window);

                var tree = false;
                if (self.element.hasClass('tree')) {
                    posRole.top = 0;

                    if ((offRole.left + this.element.width() + self.role.parent().width()) > infoWin.width()) {
                        posRole.left = (posRole.left - this.element.width()) - 2.5;
                    } else {
                        posRole.left = posRole.left + self.role.parent().width() - 10;
                    }

                    tree = true;
                }

                if (!tree) {
                    try {
                        var marginLeft = (self.role.css('margin-left').replace('px', '') * 1);
                    } catch (err) {
                        var marginLeft = 0;
                    }

                    if (marginLeft > 0) {
                        posRole.left = posRole.left + marginLeft;
                    }

                    /*
                     try {
                     var marginRight = (self.role.css('margin-right').replace('px', '') * 1);
                     } catch (err) {
                     var marginRight = 0;
                     }
                     
                     if (marginRight > 0) {
                     posRole.left = posRole.left + marginRight;
                     }
                     */

                    posRole.top = posRole.top + self.role.heightTotal();
                    if (self.role.attr('top')) {
                        posRole.top = posRole.top + (self.role.attr('top') * 1);
                    }

                    var paddingLeft = (self.role.css('padding-left').replace('px', '') * 1);
                    var paddingRight = (self.role.css('padding-right').replace('px', '') * 1);


                    if (!align) {
                        if (this.element.width() + posRole.left > infoWin.width()) {
                            align = 'right';
                        } else {
                            align = 'left';
                        }
                    }

                    if (align == 'right') {
                        if (paddingLeft > 0) {
                            posRole.left = posRole.left + paddingLeft;
                        }
                        if (paddingRight > 0) {
                            posRole.left = posRole.left + paddingRight;
                        }
                        posRole.left = posRole.left - this.element.width();
                        posRole.left = posRole.left + self.role.width();

                        this.element.addClass('ui-no-radius-tr');
                    } else if (align == 'center') {
                        if (paddingLeft > 0) {
                            posRole.left = posRole.left + paddingLeft;
                        }
                        if (paddingRight > 0) {
                            posRole.left = posRole.left + paddingRight;
                        }
                        posRole.left = posRole.left - (this.element.width() / 2);
                        posRole.left = posRole.left + (self.role.width() / 2);
                    } else {
                        this.element.addClass('ui-no-radius-tl');
                    }
                    self.role.addClass('ui-no-radius-bottom');
                }

                this.element.css('top', posRole.top + 'px').css('left', posRole.left + 'px');
                if (this.element.width() < self.role.width()){
                    this.element.width(self.role.widthTotal());
                }

                /*if (self.role.attr('id') == 'menu-administrativocompras') {
                 
                 console.log('this.element.width(): ' + this.element.width());
                 console.log('self.role.parent().width(): ' + self.role.parent().width());
                 console.log('infoWin.width(): ' + infoWin.width());
                 console.log('self.role.offset(): ' + self.role.offset().left);
                 console.log('self.element.offset(): ' + self.element.offset().left);
                 }*/


                if (isInternetExplorer()) {
                    /*
                     * https://connect.microsoft.com/IE/feedback/details/724340/pdf-is-showing-always-on-top-of-all-controls
                     * http://stackoverflow.com/questions/593176/div-layer-on-top-of-pdf
                     */
                    var ifrHeight = self.role.find('ul').first().height() + self.role.height() - 7;
                    var ifrWidth = self.role.find('ul').first().width();
                    var ifrId = 'iframe-ie-' + self.role.attr('id');
                    var ifrIdDiv = 'div-' + ifrId;
                    self.element.attr('iframe-ie', ifrId);
                    self.element.attr('div-iframe-ie', ifrIdDiv);

                    //var ifrColor = "#" + ((1 << 24) * Math.random() | 0).toString(16);
                    var ifrColor = '#FFFFFF';

                    var ifrHtml = '';
                    ifrHtml = ifrHtml + '<div id="' + ifrIdDiv + '" style="position:absolute;z-index:1000;background-color:' + ifrColor + ';">';
                    ifrHtml = ifrHtml + '   <iframe id="' + ifrId + '" height="' + ifrHeight + '" width="' + ifrWidth + '" runat="server" frameborder="0" scrolling="auto" >' + ifrId + '</iframe>';
                    ifrHtml = ifrHtml + '</div>';

                    if ($("#" + ifrId).size()) {
                        $("#" + ifrId).remove();
                    }
                    $("body").prepend(ifrHtml);
                    $("#" + ifrId).hide();
                }

            }
        }
    });
})(jQuery);