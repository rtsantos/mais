/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TCalcWidth', {
        options: {
            defaultPercent: 100
        },
        paramCalcWidth: 'calc-width',
        paramCalcWidthParent: 'calc-width-parent',
        paramCalcHeight: 'calc-height',
        paramCalcHeightParent: 'calc-height-parent',
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
            self.init();
        },
        init: function () {
            var self = this;
            if (self.element.attr(self.paramCalcWidth) || self.element.attr(self.paramCalcWidthParent)) {
                self.fixedSize = self.formatValue(self.element.attr(self.paramCalcWidth));
                self.px = self.formatPx(self.fixedSize);
                self.size = self.calcValue(self.element.attr(self.paramCalcWidthParent), 'width');
                self.updateSize(self.fixedSize, self.px, self.size, 'width');
            }
            if (self.element.attr(self.paramCalcHeight) || self.element.attr(self.paramCalcHeightParent)) {
                self.fixedSize = self.formatValue(self.element.attr(self.paramCalcHeight));
                self.px = self.formatPx(self.fixedSize);
                self.size = self.calcValue(self.element.attr(self.paramCalcHeightParent), 'height');
                self.updateSize(self.fixedSize, self.px, self.size, 'height');
            }
        },
        formatValue: function (value) {
            if (value == undefined) {
                value = '0';
            }
            return parseInt(value);
        },
        formatPx: function (value) {
            var px = '';
            value = value.toString();
            if (value.indexOf('px') != -1) {
                value.replace('px', '');
                px = 'px';
            }
            return px;
        },
        calcValue: function (parent, type) {
            var self = this;
            var size = '';
            if (type == undefined) {
                type = 'width';
            }
            if (parent != undefined) {
                if (parent == '') {
                    parent = this.element.parent();
                } else {
                    parent = $('#' + parent);
                }
                if (parent.size()) {
                    parent.bind("DOMSubtreeModified", function () {
                        self.updateParentSize(parent);
                        if ($(this).height() != self.parentLastHeight || $(this).width() != self.parentLastWidth) {
                            self.init();
                        }
                    });
                    if (type == 'width') {
                        size = parent.width();
                    } else if (type == 'height') {
                        size = parent.height();
                    }
                    self.updateParentSize(parent);
                }
            } else {
                if (type == 'width') {
                    size = $(window).width();
                } else if (type == 'height') {
                    size = $(window).height();
                }
            }
            return size;
        },
        updateParentSize: function (parent) {
            var self = this;
            self.parentLastHeight = $(parent).height();
            self.parentLastWidth = $(parent).width();
        },
        updateSize: function (fixedSize, px, size, type) {
            var self = this;
            if (type == undefined) {
                type = 'width';
            }
            var newSize = (size * self.options.defaultPercent / 100) + fixedSize + px;
            if (type == 'width') {
                self.element.width(newSize);
            } else if (type == 'height') {
                self.element.height(newSize);
            }
        }
    });
})(jQuery);

