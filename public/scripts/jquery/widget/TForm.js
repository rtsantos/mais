/**
 * jQuery.ui.TFile
 * 
 * Description:
 *      Cria um componente para trabalhar com arquivos
 *
 * @author: Rafael Santos
 * @version: 0.1
 * 
 * Depends:
 *      jQuery.ui
 *
 * Options:
 *      Não há opções
 *
 */
(function ($) {
    $.widget('ta.TForm', {
        options: {
            url: {
                retrieve: '',
                insert: '',
                update: '',
                delete: ''
            }
        },
        _create: function () {

        },
        populate: function (data) {
            var form = this.element[0];
            for (var field in data) {
                try {
                    if (data[field] == null)
                        data[field] = '';

                    var jField = jQuery('#' + field.toLowerCase());
                    if (jQuery(form.elements[field.toLowerCase() + '[]']).attr('type') == 'checkbox') {
                        var checkbox = jQuery(form.elements[field.toLowerCase() + '[]']);
                        for (var index = 0; index < checkbox.length; index++) {
                            checkbox.removeAttr('checked');
                        }
                        for (var index = 0; index < checkbox.length; index++) {
                            for (var valueCheck in data[field]) {
                                if (checkbox.val() == data[field][valueCheck]) {
                                    checkbox.attr('checked', true);
                                }
                            }
                        }
                    } else if (jField.Tdata('TMask') || jField.Tdata('TDateTime')) {
                        jField.val(data[field]).trigger('change');
                    } else if (data[field] != null) {
                        objField = form.elements[field.toLowerCase()];
                        if (!objField) {
                            for (var index = 0; index < form.elements.length; index++) {
                                if (jQuery(form.elements[index]).attr('field') == field) {
                                    objField = form.elements[index];
                                    index = form.elements.length;
                                }
                            }
                        }
                        if (objField) {
                            objField.value = data[field];
                            /**
                             * Verifica se o campo possui instancia para o PLUPLOAD
                             */
                            if ($('#' + field.toLowerCase()).Tdata('TFileUpload')) {
                                $('#' + field.toLowerCase()).TFileUpload('loadFiles', field.toLowerCase());
                            }
                            /**
                             * Verifica se o campo possui instancia para o TSeeker
                             */
                            if ($(objField).Tdata('TSeeker')) {
                                $(objField).Tdata('TSeeker').buttonNoFocus();
                                objField.valueold = objField.value;
                            }
                        }
                    }

                    if (field == 'id') {
                        $('#' + field.toLowerCase()).trigger('change');
                    }
                } catch (ex) {

                }
            }
        },
        retrieve: function (options) {
            var self = this;
            if (typeof options == 'string') {
                options = {
                    id: options
                };
            }

            if (!options.url) {
                options.url = self.options.url.retrieve;
            }
            if (!options.data) {
                options.data = 'id=' + options.id;
            }
            if (!options.before) {
                options.before = function (result) {
                    return true;
                }
            }
            if (!options.after) {
                options.after = function (result) {
                    return true;
                }
            }
            jQuery.AjaxT.json({
                url: options.url,
                data: options.data,
                success: function (result) {
                    options.before(result);
                    self.populate(result);
                    options.after(result);
                }
            });
        },
        save: function (options) {
            if (!options) {
                options = {};
            }
            var self = this;
            var id = jQuery('#' + self.element.attr('id') + ' #id');

            if (!options.success) {
                options.success = function (result) {
                    if (options.grid) {
                        var grid = jQuery(options.grid);
                        if (!grid) {
                            grid = jQuery(options.grid, top.opener.document);
                        }
                        if (!grid) {
                            grid = jQuery(options.grid, top.document);
                        }
                        grid.trigger('reloadGrid');
                    }
                    id.val(result.id);
                };
            }

            if (id.val() == '') {
                self.element.attr('action', self.options.url.insert + '/json/1');
            } else {
                self.element.attr('action', self.options.url.update + '/json/1');
            }
            jQuery.AjaxT.submitJson({selector: '#' + self.element.attr('id'), success: options.success});
        },
        delete: function (options) {
            if (!options) {
                options = {};
            }
            if (!options.url) {
                options.url = self.options.url.delete;
            }
            if (!options.success) {
                options.success = function () {
                    var grid = jQuery(options.grid);
                    if (!grid) {
                        grid = jQuery(options.grid, top.opener.document);
                    }
                    if (!grid) {
                        grid = jQuery(options.grid, top.document);
                    }
                    grid.trigger('reloadGrid');
                    return true;
                };
            }
            var self = this;
            var id = jQuery('#' + self.element.attr('id') + ' #id');
            if (id.val() == '') {
                jQuery.DialogT.open('Necessário estar posicionado no registro!', 'Alert');
                return false;
            } else {
                jQuery.AjaxT.json({
                    url: options.url,
                    param: 'id=' + id.val(),
                    success: options.success
                });
            }
        },
        clear: function () {
            var self = this;
            self.element.reset();
            return true;
        },
        navByGrid: function (options) {
            if (!options.before) {
                options.before = function (result) {
                    return true;
                }
            }
            if (!options.after) {
                options.after = function (result) {
                    return true;
                }
            }

            var self = this;
            var grid = jQuery(options.grid);
            if (!grid) {
                grid = jQuery(options.grid, top.opener.document);
            }
            if (!grid) {
                grid = jQuery(options.grid, top.document);
            }
            var data = grid.getDataIDs();
            var id = grid.getGridParam('selrow');
            var pos = jQuery.inArray(id, data);
            var result = [pos, data];
            var selected = false;

            if (result[0] != -1) {
                if (options.move == 'next') {
                    selected = result[1][result[0] + 1];
                } else {
                    selected = result[1][result[0] - 1];
                }
            }

            if (selected) {
                self.retrieve({
                    id: seleted,
                    before: options.before,
                    after: options.after
                });
                grid.setSelection(selected);
            }

            return result;
        }
    })
})(jQuery);