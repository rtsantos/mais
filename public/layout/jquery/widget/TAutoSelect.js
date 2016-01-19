/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    $.widget('ta.TAutoSelect', {
        options: {
            sourceData: [],
            sourceUrl: '',
            sourceSelector: '',
            fieldValue: '',
            classFocus: 'focus',
            classRequired: 'required',
            multiple: false,
            placeholder: true,
            updateValue: false,
            typingMultiple: true,
            changeId: false,
            okClick: '',
            /*-*/
            configsHideShow: {
                events: ['focus'],
                autoShow: false,
                autoReposition: true,
                hideShowElement: true,
                fade: false
            }
        },
        keyDown: 38,
        keyUp: 40,
        keyEnter: 13,
        keyBackspace: 8,
        keyDelete: 46,
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         */
        _create: function () {
            var self = this;
            var loadedValue = self.element.val() + '';
            loadedValue = loadedValue.split(';');
            self.element.val('');
            //self.element.attr('top','10');

            if (typeof self.options.sourceData == 'object') {
                self.options.sourceData = jQuery.convertObjectToArray(self.options.sourceData);
            }

            self.isRequired = this.element.hasClass(self.options.classRequired);

            if (self.options.sourceData.length > 0) {
                var id = self.element.attr('id');
                var name = self.element.attr('name');
                if (!name) {
                    name = id;
                }

                if (!self.options.fieldValue) {
                    var hidden = '';
                    self.element.attr('name', 'display_' + name);
                    self.element.addClass('ui-input-auto');
                    if (self.options.changeId) {
                        self.element.attr('id', 'display_' + id);
                        hidden = '<input type="hidden" id="' + id + '" name="' + name + '" />';
                        self.element.after(hidden);
                        self.options.fieldValue = jQuery('#' + id);
                        id = 'display_' + id;
                    } else {
                        hidden = '<input type="hidden" id="value_' + id + '" name="' + name + '" />';
                        self.element.after(hidden);
                        self.options.fieldValue = jQuery('#value_' + id);
                    }
                } else {
                    self.options.fieldValue = jQuery('#' + self.options.fieldValue);
                }
                self.sourceItens = 'itens-' + id;
                self.options.sourceSelector = '#' + self.sourceItens + ' li:not(.divider, .footer)';

                var width = self.element.widthTotal();

                self.element.bind("DOMSubtreeModified", function () {
                    self.recalcSize();
                });

                var marginTop = '';
                if (jQuery.browser.mozilla) {
                    marginTop = 'margin-top:' + self.element.heightTotal() + 'px;';
                }

                if (self.options.multiple) {
                    var xhtml = '<ul id="' + self.sourceItens + '" role="' + id + '" class="dropdown-menu" style="width:' + width + 'px;min-width:210px;' + marginTop + '">';
                    xhtml = xhtml + '<li class="dropdown-menu-group footer">';
                    xhtml = xhtml + '   <ul class="ui-overflow-200">';
                } else {
                    var xhtml = '<ul id="' + self.sourceItens + '" role="' + id + '" class="dropdown-menu ui-overflow-200" style="width:' + width + 'px;min-width:210px;;' + marginTop + '">';
                }

                var value = '';
                for (var index in self.options.sourceData) {
                    value = self.options.sourceData[index];
                    var desc = '';
                    if (typeof value == 'object') {
                        var data = {};
                        //console.log(value);
                        if (typeof value.level != 'undefined') {
                            data.value = value.value;
                            data.desc = value.desc;
                            data.level = value.level;
                        } else {
                            for (var key in value) {
                                data.value = key;
                                data.desc = value[key];
                                data.level = 0;
                            }
                        }
                        value = replace(data.value, "'", "\'");
                        desc = replace(data.desc, "'", "\'");
                        level = data.level;
                    } else {
                        value = value.replace("'", "\'");
                        desc = value.replace("'", "\'");
                        level = 0;
                    }


                    level = (level * 10) + 5;
                    var scriptSelect = 'jQuery(\'#' + id + '\').TAutoSelect(\'select\', \'' + value + '\', \'' + desc + '\');';
                    /**
                     * Popula valores para selecionar valores carregados
                     */
                    for (var iValue in loadedValue) {
                        if (loadedValue[iValue] == value) {
                            loadedValue[iValue] = {value: value, desc: desc};
                            break;
                        }
                    }
                    xhtml = xhtml + '<li value="' + value + '" class="link" style="padding-left:' + level + 'px;cursor:pointer;" onClick="' + scriptSelect + '">';
                    if (self.options.multiple) {
                        xhtml = xhtml + '<span class="ui-icon multiple"></span>';
                    }
                    xhtml = xhtml + '<span>' + desc + '</span>';
                    xhtml = xhtml + '&nbsp;';
                    xhtml = xhtml + '</li>';
                }
                xhtml = xhtml + '   </ul>';
                if (self.options.multiple) {
                    xhtml = xhtml + '<button class="ui-button ui-state-default ui-no-radius-right" onClick="jQuery(\'#' + id + '\').TAutoSelect(\'updateAll\', true);">';
                    xhtml = xhtml + '<span class="ui-icon ui-icon-check"></span>';
                    xhtml = xhtml + '</button>';
                    xhtml = xhtml + '<button class="ui-button ui-state-default ui-no-radius-left ui-no-border-left" onClick="jQuery(\'#' + id + '\').TAutoSelect(\'updateAll\', false);">';
                    xhtml = xhtml + '<span class="ui-icon ui-icon-radio-off"></span>';
                    xhtml = xhtml + '</button>';
                    xhtml = xhtml + '<button class="ui-button ok btn primary" onClick="jQuery(\'#' + id + '\').TAutoSelect(\'okClick\');">';
                    xhtml = xhtml + '<span class="ui-text">OK</span>';
                    xhtml = xhtml + '</button>';
                    xhtml = xhtml + '&nbsp;';
                    xhtml = xhtml + '</li>';
                    xhtml = xhtml + '</ul>';
                    self.options.configsHideShow.events = ['over'];
                }
                $("body").append(xhtml);

                jQuery('#' + self.sourceItens).TDropdown({configsHideShow: self.options.configsHideShow});
                $('#' + self.sourceItens).scroll(function () {
                    $('#' + id).focus();
                });
            }
            if (self.options.fieldValue) {
                self.options.fieldValue.bind("DOMSubtreeModified", function () {
                    self.updateFieldValue();
                });
            }

            this.element.keydown(function (event) {
                self.keyValid(event);
                self.keyControl(event);
            });
            this.element.keyup(function (event) {
                self.updateElements();
            });
            this.element.change(function () {
                self.updateElements();
            });
            this.element.click(function () {
                $(this).select();
                self.updateElements();
            });
            this.element.blur(function () {
                self.validValue();
            });

            if (self.options.loadValue) {
                self.options.fieldValue.val(self.options.loadValue);
                self.updateFieldValue();
            }

            if (loadedValue.length > 0) {
                for (var iValue in loadedValue) {
                    if (loadedValue[iValue].value) {
                        self.select(loadedValue[iValue].value, loadedValue[iValue].desc);
                    }
                }
            }

            $(document).ready(function () {
                self.recalcSize();
            });
        },
        updateFieldValue: function(){
            var self = this;
            var element = self.options.fieldValue;
            var value = $(element).val();
            if (value) {
                if (self.isRequired) {
                    self.element.removeClass(self.options.classRequired);
                }
                var elements = self.getElements();
                elements.each(function () {
                    if (self.getText($(this)) == value) {
                        $(this).click();
                    }
                });
            } else {
                if (self.isRequired) {
                    self.element.addClass(self.options.classRequired);
                }
            }
        },
        recalcSize: function () {
            var self = this;
            if (!self.options.recalcSize) {
                self.options.recalcSize = true;
                $("#" + self.sourceItens).css('width', self.element.widthTotal());
                //$("#" + self.sourceItens).css('margin-top', self.element.heightTotal());
                self.options.recalcSize = false;
            }
        },
        /**
         * Função que realiza o controle de ação do KeyPress.
         * @param {type} keyCode Variavel de controle que poderá alterar a
         * @returns {undefined}
         */
        keyControl: function (event) {
            var self = this;
            var keyCode = event.keyCode;
            if (keyCode === self.keyUp || keyCode === self.keyDown) {
                self.updateFocus((keyCode == self.keyUp ? 1 : -1));
            } else if (keyCode == self.keyEnter) {
                self.selectFocus();
                /*event.preventDefault();
                 event.stopPropagation();*/
            } else if (keyCode == self.keyBackspace || keyCode == self.keyDelete) {
                if (!self.options.multiple && self.element.val() != self.options.fieldValue.val()) {
                    self.select('', '');
                }
            } /*else if (keyCode == 27) {
             self.lostFocus();
             } */
        },
        keyValid: function (event) {
            var self = this;
            var keyCode = event.keyCode;
            var keys = [self.keyUp, self.keyDown, self.keyEnter, self.keyBackspace, self.keyDelete];
            if (self.options.multiple && !self.options.typingMultiple) {
                if (keys.indexOf(keyCode) == -1) {
                    event.preventDefault();
                }
            }
        },
        /**
         * Função onde busca em um array de elementos a posição do focus.
         * 
         * @param {type} control variavel de controle do focus.
         * @returns {Number} a posição do focus. 
         */
        findFocus: function (control) {
            var self = this;
            var elements = self.getElements(true);
            var posFocus = 0;
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].hasClass(self.options.classFocus)) {
                    posFocus = i + (control);
                    if (posFocus === elements.length) {
                        posFocus = 0;
                    } else if (posFocus < 0) {
                        posFocus = elements.length - 1;
                    }
                    break;
                }
            }
            return posFocus;
        },
        /**
         * Função que obtem a lista visiveis apartir da lista de elements informado.
         * 
         * @param {type} elements Lista de Elementos.
         * @returns {Array} Lista de Elementos visiveis.
         */
        isVisible: function (elements) {
            var visibleElements = [];
            for (var i = 0; i < elements.length; i++) {
                if (elements.eq(i).is(':visible')) {
                    visibleElements.push(elements.eq(i));
                }
            }
            return visibleElements;
        },
        isNotInMultiple: function (elements) {
            var self = this;
            var visibleElements = [];
            for (var i = 0; i < elements.length; i++) {
                if (!self.existsInMultiple(elements.eq(i).text())) {
                    visibleElements.push(elements.eq(i));
                }
            }
            return visibleElements;
        },
        existsInMultiple: function (value) {
            var self = this;
            var exists = false;
            var elements = self.getElements();
            elements.each(function () {
                if ((self.getText($(this)) == value || $(this).attr('value') == value) && $(this).hasClass('checked')) {
                    exists = true;
                }
            });
            return exists;
        },
        loadData: function (value) {
            return this.select(value);
        },
        select: function (value, desc) {
            var self = this;
            var valueText = '';
            if (!self.options.multiple) {
                valueText = value;
                self.lostFocus();
            } else {
                var elements = self.getElements();
                elements.each(function () {
                    if (trim($(this).text()) == value || $(this).attr('value') == value) {
                        if ($(this).hasClass('checked')) {
                            $(this).removeClass('checked');
                        } else {
                            $(this).addClass('checked');
                        }
                    }
                });

                desc = '';
                elements = self.getElements();
                elements.each(function () {
                    if ($(this).hasClass('checked')) {
                        desc = desc + ';' + trim($(this).text());
                    }
                });
                desc = substr(desc, 1);
                if (!desc) {
                    desc = '';
                }

                var val = self.options.fieldValue.val();
                var values = [];
                if (val) {
                    var values = val.split(";");
                }
                var exists = false;
                for (var i in values) {
                    if (values[i] == value) {
                        values.splice(i, 1);
                        exists = true;
                    }
                }
                if (!exists) {
                    values.push(value);
                }
                var valueText = values.join(';');
                self.options.fieldValue.val(valueText);
                //desc = valueText;
            }

            if (self.options.updateValue) {
                self.element.val(valueText);
            }

            if (self.options.placeholder) {
                self.element.attr('placeholder', desc);
            }

            self.options.fieldValue.val(valueText);
        },
        updateAll: function (checked) {
            var self = this;
            var elements = self.getElements();
            if (checked) {
                elements.each(function () {
                    if (!$(this).hasClass('checked')) {
                        $(this).click();
                    }
                });
            } else {
                elements.each(function () {
                    if ($(this).hasClass('checked')) {
                        $(this).click();
                    }
                });
            }
        },
        okClick: function () {
            var self = this;
            self.lostFocus();
            if (self.options.okClick) {
                self.options.okClick();
            }
        },
        lostFocus: function () {
            var self = this;
            self.element.blur();
            $("#" + self.sourceItens).hide();
        },
        clearValue: function () {
            var self = this;
            self.element.val('');
        },
        validValue: function () {
            var self = this;
            if (!self.options.multiple) {
                var value = self.element.val();
                if (!self.exists(value)) {
                    self.clearValue();
                }
            } else {
                if (!self.options.updateValue) {
                    self.clearValue();
                }
            }
            self.removeFocus();
        },
        updateElements: function () {
            var self = this;
            var elements = self.getElements();
            var value = self.element.val();
            var exists = 0;
            elements.each(function (i) {
                var curValue = self.getText(elements.eq(i));
                self.setValue(elements.eq(i), curValue);
                if (self.matcherTest(curValue, value)) {
                    elements.eq(i).show();
                    self.updateValueBold(elements.eq(i), curValue, value);
                    exists++;
                } else {
                    elements.eq(i).hide().removeClass(self.options.classFocus);
                }
            });
            if (exists) {
                $('#' + self.sourceItens).show();
            } else {
                $('#' + self.sourceItens).hide();
            }
            if (self.options.multiple) {
                $('#' + self.sourceItens).show();
            }
            if (!self.options.multiple) {
                if (!self.hasFocus()) {
                    self.setFocus(null);
                }
            }
        },
        matcherTest: function (originalValue, findValue) {
            if (findValue) {
                var words = findValue.split(" ");
                var valuePattern = '';
                for (var i = 0; i < words.length; i++) {
                    if (i > 0) {
                        valuePattern = valuePattern + '([^\s]*)\\s';
                    }
                    valuePattern = valuePattern + '(' + words[i] + ')';
                }
                var matcher = new RegExp(valuePattern, 'i');
                return matcher.test(originalValue);
            }
            return true;
        },
        exists: function (value) {
            var self = this;
            var elements = self.getElements();
            for (var i = 0; i < elements.length; i++) {
                if (trim(elements.eq(i).text()) == value || elements.eq(i).attr('value') == value) {
                    return true;
                }
            }
            return false;
        },
        getElements: function (onlyIsVisible, onlyNotInMultiple) {
            var self = this;
            var elements = $(self.options.sourceSelector);
            if (onlyIsVisible) {
                return self.isVisible(elements);
            }
            if (onlyNotInMultiple) {
                return self.isNotInMultiple(elements);
            }
            return elements;
        },
        setValue: function (element, value) {
            var self = this;
            if (self.options.multiple) {
                element.find('span').last().html(value);
            } else {
                element.html(value);
            }
        },
        getText: function (element) {
            return trim(element.text());
        },
        getValue: function () {
            var self = this;
            return self.options.fieldValue.val();
        },
        updateFocus: function (control) {
            var self = this;
            var posFocus = self.findFocus(control);
            self.setFocus(posFocus);
        },
        removeFocus: function () {
            var self = this;
            var elements = self.getElements();
            for (var i = 0; i < elements.length; i++) {
                elements.eq(i).removeClass(self.options.classFocus);
            }
        },
        getPosFocus: function () {
            var self = this;
            var elements = self.getElements();
            var value = '';
            for (var index = 0; index < elements.length; index++) {
                value = self.options.fieldValue.val();
                if (trim(elements.eq(index).text()) == value || elements.eq(index).attr('value') == value) {
                    return index;
                }
            }
            return 0;
        },
        setFocus: function (posFocus) {
            var self = this;
            var visibleElements = self.getElements(true);
            self.removeFocus();
            if (visibleElements.length) {
                if (posFocus === null) {
                    posFocus = self.getPosFocus();
                }
                visibleElements[posFocus].addClass(self.options.classFocus);
            }
        },
        hasFocus: function () {
            var self = this;
            var elements = self.getElements();
            for (var i = 0; i < elements.length; i++) {
                if (elements.eq(i).hasClass(self.options.classFocus)) {
                    return true;
                }
            }
            return false;
        },
        selectFocus: function () {
            var self = this;
            $(self.options.sourceSelector + "." + self.options.classFocus).click();
        },
        updateValueBold: function (element, curValue, value) {
            var self = this;
            value = trim(value);
            var length = value.length;
            if (length) {
                var begin = curValue.toLowerCase().indexOf(value.toLowerCase());
                if (begin != -1) {
                    var curValueAux = '';
                    for (var j = 0; j < curValue.length; j++) {
                        var tmp = curValue[j];
                        if (curValue.toLowerCase().substr(j, length) == value.toLowerCase()) {
                            tmp = '<b>' + curValue.substr(j, length) + '</b>';
                            j += length - 1;
                        }
                        curValueAux = curValueAux + tmp;
                    }
                    self.setValue(element, curValueAux);
                }
            }
        }
    });
})(jQuery);

