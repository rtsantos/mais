/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {

    var jQueryData = $.fn.data;
    $.fn.Tdata = function (name) {
        return this.data('ta' + name);
    };
	
    $.fn.Tchange = function (callback) {
		var self = this;
		self.focus(function(){
			self.attr('valueold',self.val());
		});
		
		self.blur(function(){
			if (self.attr('valueold') != self.val()){
				callback(self);
				self.attr('valueold',self.val());
			}
		});
		
		return self;
    };

    $.fn.TaddClass = function (c) {
        var currentClass = $(this).attr("class");
        if (currentClass != undefined) {
            if (currentClass.indexOf(c) == -1) {
                $(this).attr("class", $(this).attr("class") + " " + c);
            }
        }
        return this;
    };

    $.fn.TremoveClass = function (c) {
        var currentClass = $(this).attr("class");
        if (currentClass != undefined) {
            while (currentClass.indexOf(c) != -1) {
                currentClass = currentClass.replace(c, "");
            }
            $(this).attr("class", currentClass);
        }
        return this;
    };

    $.fn.ThasClass = function (c) {
        var currentClass = $(this).attr("class");
        if (currentClass != undefined) {
            if (currentClass.indexOf(c) != -1) {
                return true;
            }
        }
        return false;
    };

    $.fn.widthTotal = function () {
        var width = this.width();
        width = width + formatWhenIsNan(parseInt(this.css('margin-left')));
        width = width + formatWhenIsNan(parseInt(this.css('margin-right')));
        width = width + formatWhenIsNan(parseInt(this.css('padding-left')));
        width = width + formatWhenIsNan(parseInt(this.css('padding-right')));
        return width;
    };

    $.fn.heightTotal = function () {
        var height = this.height();
        height = height + formatWhenIsNan(parseInt(this.css('margin-top')));
        height = height + formatWhenIsNan(parseInt(this.css('margin-bottom')));
        height = height + formatWhenIsNan(parseInt(this.css('padding-top')));
        height = height + formatWhenIsNan(parseInt(this.css('padding-bottom')));
        return height;
    };

    $.extend(jQuery.expr[':'], {
        focus: function (e) {
            try {
                return e == document.activeElement;
            }
            catch (err) {
                return false;
            }
        }
    });

    $.convertObjectToArray = function (obj) {
        var arr = [];
        for (var i in obj) {
            if (obj.hasOwnProperty(i)) {
                arr.push(obj[i]);
            }
        }
        return arr;
    }

})(jQuery);

function formatWhenIsNan(value) {
    if (isNaN(value)) {
        return 0;
    }
    return value;
}

function TupdateShow(element, configs) {
    jQuery(document).click();
    //$(document.activeElement).focusout().blur();

    var self = element;
    self.focused = true;

    if (configs.autoShow) {
        if (configs.hideShowElement) {
            TshowHide(self.element, 'show', configs);
        }
    }
    if (configs.autoReposition) {
        var pos = $("#" + self.element.attr('role'))[0].getBoundingClientRect();
        self.element.css('left', pos.x);
        self.element.css('top', pos.y);
    }
    self.role.TaddClass('hover');
    if (self.timer) {
        clearTimeout(self.timer);
    }
}

function TupdateHide(element, now, configs) {
    var self = element;
    self.focused = false;

    clearTimeout(self.timer);
    var interval = self.options.timerHide;
    if (now == true) {
        interval = 0;
    }
    self.timer = setTimeout(function () {
        var inputExists = false;
        if (self.options.ignoreInputs) {
            jQuery(self.element.find(self.options.elements)).each(function () {
                if ($(this).is(':focus')) {
                    inputExists = true;
                    return false;
                }
            });
        }
        if (!self.element.is(':focus') && !self.role.is(':focus') && !inputExists) {
            self.role.TremoveClass('hover');
            if (configs.hideShowElement) {
                TshowHide(self.element, 'hide', configs);
            }
        }
    }, interval);
}

function TsetUpdateHide(widget, configs) {
    var events = configs.events;
    var self = widget.element;
    for (var i in events) {
        var role = widget.role;
        var elements = $.fn.add.call(self, role);
        if (events[i] == 'over') {
            elements.mouseover(function () {
                TupdateShow(widget, configs);
            });
            elements.mouseout(function () {
                TupdateHide(widget, false, configs);
            });
        } else if (events[i] == 'focus') {
            elements.focus(function () {
                TupdateShow(widget, configs);
            });
            elements.blur(function () {
                TupdateHide(widget, false, configs);
            });
        }
    }

    $(document).click(function () {
        if (widget.focused == false) {
            TupdateHide(widget, true, configs);
        }
    });
}

function TshowHide(element, action, configs) {
    //console.log(element);
    var ifrIe = element.attr('iframe-ie');
    if (ifrIe) {
        ifrIe = $("#" + ifrIe);
    }
    if (action == 'hide') {
        if (configs.fade == true) {
            element.fadeOut();
        } else {
            element.hide();
        }
        if (ifrIe) {
            ifrIe.hide();
        }
    } else {
        if (configs.fade == true) {
            element.fadeIn();
        } else {
            element.show();
        }
        if (ifrIe) {
            ifrIe.show();

            //var ifrPos = element.position();
            var ifrPos = element.offset();
            var ifrIdDiv = $('#' + element.attr('div-iframe-ie'));
            ifrIdDiv.css('top', ifrPos.top);
            ifrIdDiv.css('left', ifrPos.left);
        }

        if (configs.focusShow) {
            if (!$(element).find('input, select, textarea').is(':focus')) {
                if ($(element).find(configs.focusShow).size()) {
                    $(element).find(configs.focusShow).first().focus();
                }
            }
        }
    }
}

$(document).ready(function () {
    $("#layout-banner").css("background-size", "cover");
});