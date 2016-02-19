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
            var self = this;
            var form = this.element[0];
            var btnSave = $(form).find("#btn_save").find('span');
            $('#' + self.element.attr('id') + ' #id').change(function () {
                btnSave.first().removeClass('ui-icon-disk');
                btnSave.first().removeClass('ui-icon-plus');
                if ($(this).val()) {
                    btnSave.last().html('Salvar');
                    btnSave.first().addClass('ui-icon-disk');
                } else {
                    btnSave.last().html('Adicionar');
                    btnSave.first().addClass('ui-icon-plus');
                }
            }).change();
        },
        populate: function (data) {
            var self = this;
            var form = this.element[0];
            var formId = '#' + self.element.attr('id');
            for (var field in data) {
                try {
                    if (data[field] == null)
                        data[field] = '';

                    var jField = jQuery(formId + ' #' + field.toLowerCase());
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
                    } else if (jField.attr('type') == 'select' || jField.attr('type') == 'select-one' || jField.size() && jField.get(0).tagName.toLowerCase() == 'select') {
                        var select = jQuery(jField).find('option');
                        for (var index = 0; index < select.length; index++) {
                            if (data[field] == select.eq(index).html()) {
                                data[field] = select.eq(index).val();
                                break;
                            }
                        }
                        jField.val(data[field]);
                    } else if (jField.attr('TAutoSelect') == '1') {
                        var role = jField.attr('role');
                        if (role != '') {
                            jField.TAutoSelect('select', data[field], data[role]);
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
                            if ($(formId + ' #' + field.toLowerCase()).Tdata('TFileUpload')) {
                                $(formId + ' #' + field.toLowerCase()).TFileUpload('loadFiles', field.toLowerCase());
                            } else if ($(formId + ' #' + field.toLowerCase()).Tdata('TSpreadSheet')) {
                                $(formId + ' #' + field.toLowerCase()).TSpreadSheet('loadData', data[field.toLowerCase()]);
                            } else if ($(formId + ' #' + field.toLowerCase()).Tdata('TQueryBuilder')) {
                                $(formId + ' #' + field.toLowerCase()).TQueryBuilder('loadData', data[field.toLowerCase()]);
                            } else if ($(formId + ' #' + field.toLowerCase()).Tdata('TDateTime')) {
                                $(formId + ' #' + field.toLowerCase()).TDateTime('loadData', data[field.toLowerCase()]);
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
                } catch (ex) {

                }
            }
            $('#' + self.element.attr('id') + ' #id').change();
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
        firstFocus: function () {
            var self = this;
            var id = '#' + self.element.attr('id') + ' input, #' + self.element.attr('id') + ' textarea, #' + self.element.attr('id') + ' select';
            focusFirstElement(id);
        },
        save: function (options) {
            if (!options) {
                options = {};
            }
            if (typeof options.async == 'undefined') {
                options.async = true;
            }
            var self = this;
            var id = jQuery('#' + self.element.attr('id') + ' #id');
            if (id.val() == '') {
                self.element.attr('action', self.options.url.insert + '/json/1');
            } else {
                self.element.attr('action', self.options.url.update + '/json/1');
            }

            if (options.async) {
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
                            self.clear();
                            self.firstFocus();
                        }
                        id.val(result.id);
                    };
                }
                jQuery.AjaxT.submitJson({selector: '#' + self.element.attr('id'), success: options.success});
            } else {
                return jQuery.AjaxT.submitJson({selector: '#' + self.element.attr('id'), async: false});                
            }
        },
        delete: function (options) {
            var self = this;
            var id = jQuery('#' + self.element.attr('id') + ' #id');

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
                    self.clear({});
                    return true;
                };
            }

            if (id.val() == '') {
                jQuery.DialogT.alert('Necessário estar posicionado no registro!');
                return false;
            } else {
                jQuery.DialogT.confirm('Tem certeza que deseja excluir o registro?'
                        , function (confirm) {
                            if (confirm) {
                                jQuery.AjaxT.json({
                                    url: options.url,
                                    data: 'id=' + id.val(),
                                    success: options.success
                                });
                            }
                        });
            }
        },
        clear: function () {
            var self = this;
            self.element.resetForm();
            $('#' + self.element.attr('id') + ' #id').trigger('change');
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
                    id: selected,
                    before: options.before,
                    after: options.after
                });
                grid.setSelection(selected);
            }

            return result;
        }
    })
})(jQuery);