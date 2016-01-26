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
(function($) {
    $.widget('ta.TForm', {
        options: {
            url: {
                retrieve: '',
                insert: '',
                update: '',
                delete: ''
            }
        },
        
        _create: function() {

        },
        
        populate: function(data) {
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
        
        retrieve: function(options) {
            var self = this;
            if (typeof options == 'string') {
                options = {
                    id: options
                };
            }

            if (!options.url) {
                options.url = this.options.url.retrieve;
            }
            if (!options.data) {
                options.data = 'id=' + options.id;
            }
            jQuery.AjaxT.json({
                url: options.url,
                data: options.data,
                success: function(result) {
                    self.populate(result);
                }
            });
        },
        
        saveAjax: function(){
            var self = this;
            var id = self.find('#id').val();
            if (id == ''){
                self.attr('action',options.url.insert);
            }else{
                self.attr('action',options.url.update);
            }
            jQuery.AjaxT.submitJson({selector: self});
        },
        
        deleteAjax: function(){
            var self = this;
            var id = self.find('#id').val();
            if (id == ''){

            }else{
                jQuery.AjaxT.json({
                    url: options.url.delete,
                    param: 'id=' + id
                });
            }
        },
    })
})(jQuery);