/**
 * jQuery.TEndereco
 *
 * Description:
 * 
 *
 * @author: rsantos
 * @version: 0.1
 * 
 * Depends:
 *      jQuery.ui,
 *      jQuery.ui.TEndereco
 *      depreced http://maps.googleapis.com/maps/api/place/queryautocomplete/json?key=AddYourOwnKeyHere&sensor=false&language=fr&input=pizza+near%20par
 */
(function($) {
    $.fn.extend({
        retrieve: function(param) {
            var self = jQuery(this);
            self.TEndereco('retrieve', param);
        }
    });

    $.widget('ta.TEndereco', {
        options: {
            onFilter: null,
            onChange: null,
            url: {
                grid: '/Mais/index.php/ca/endereco/grid',
                retrieveGPB: '/Mais/index.php/gpb/logradouro/retrive',
                autoComplete: '/Mais/index.php/gpb/logradouro/auto-complete'
            },
            elements: {
                cep: null,
                estado: null,
                cidade: null,
                tipo: null,
                logradouro: null,
                bairro: null
            }
        },
        _create: function() {
            var oTEndereco = this;

            if (!this.options.name) {
                this.options.name = this.element.attr('id');
            }

            if (typeof this.options.elements.cep == 'string') {
                this.options.elements.cep = $('#' + this.options.elements.cep);
            }

            if (typeof this.options.elements.estado == 'string') {
                this.options.elements.estado = $('#' + this.options.elements.estado);
            }

            if (typeof this.options.elements.cidade == 'string') {
                this.options.elements.cidade = $('#' + this.options.elements.cidade);
            }

            if (typeof this.options.elements.tipo == 'string') {
                this.options.elements.tipo = $('#' + this.options.elements.tipo);
            }

            if (typeof this.options.elements.logradouro == 'string') {
                this.options.elements.logradouro = $('#' + this.options.elements.logradouro);
                this.options.elements.logradouro.TAutocomplete({
                    source: this.options.url.autoComplete,
                    limit: 100,
                    onFormatItem: function(row, i, max) {
                        return row[2] + ', ' + row[3] + ', ' + row[4] + '/' + row[5];
                    },
                    onFormatResult: function(row, i, max) {
                        return row[2];
                    },
                    onResult: function(event, row, formatted) {
                        var data = {
                            cep: row[0],
                            tipo_logr: row[1],
                            logradouro: row[2],
                            bairro: row[3],
                            cidade: {                                
                                nome: row[4],
                                uf_estado: row[5],
                                id: row[6]
                            }
                        };
                        oTEndereco.populate(data);
                    }
                });
            }

            if (typeof this.options.elements.bairro == 'string') {
                this.options.elements.bairro = $('#' + this.options.elements.bairro);
            }

            this.options.elements.cep.blur(function() {
                var cep = $(this);
                if (cep.val() != cep.attr('valueLoaded')) {
                    oTEndereco.retrieveGPB({field: 'cep', value: cep.val()});
                }else{
                    cep.attr('valueLoaded','');
                }
            });
        },
        retrieveGPB: function(param) {
            if (!param.focus) {
                param.focus = true;
            }
            if (!param.field) {
                param.field = 'cep';
            }
            if (!param.value) {
                param.value = '';
            }
            param.value = str_replace(['_', '.', '-', '/'], ['', '', '', ''], param.value);
            if (param.value != '') {
                var json = $.ajax({
                    type: 'POST',
                    url: this.options.url.retrieveGPB,
                    data: param.field + '=' + param.value,
                    async: false
                }).responseText;
                json = decodeJson(json);
                if (json.id) {
                    var data = {
                        cep: json.cep,
                        tipo_logr: json.tipo,
                        logradouro: json.nome,
                        bairro: json.nome_abrev_bairro_ini,
                        cidade: json.cidade
                    };
                    this.populate(data);
                    if (param.focus) {
                        this.options.elements.tipo.focus();
                    }
                }
            }
        },
        
        populate: function(data) {
            this.options.elements.cep.val(data.cep);
            this.options.elements.tipo.val(data.tipo_logr);            
            this.options.elements.logradouro.val(data.logradouro);
            this.options.elements.logradouro.attr('valueLoaded', data.logradouro);
            this.options.elements.bairro.val(data.bairro);
            this.options.elements.bairro.attr('valueLoaded', data.bairro);
            this.options.elements.bairro.trigger('change');
            this.options.elements.cidade.TSeeker('loadData', data.cidade);
        }
    });
})(jQuery);