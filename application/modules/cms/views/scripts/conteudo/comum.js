var id_tab = 'tab_conteudo';
var id_form = 'form_conteudo';
var uri = '/Mais/index.php/cms/conteudo';

var indexTab = {
    conteudo: 0,
    priv_conteudo: 1,
    visualizacao: 2
};

$(document).ready(function () {
    var tab = jQuery('#' + id_tab);
    if (tab.length > 0) {
        jQuery('#' + id_tab).Tdata('TTabs').disable(indexTab.priv_conteudo);
        jQuery('#' + id_tab).Tdata('TTabs').disable(indexTab.visualizacao);
    }
});

function selectedRowConteudo() {
    var tab = jQuery('#' + id_tab);
    if (tab.length > 0) {
        jQuery('#' + id_tab).Tdata('TTabs').enable(indexTab.priv_conteudo);
        jQuery('#' + id_tab).Tdata('TTabs').enable(indexTab.visualizacao);
    }
}

$(document).ready(function () {
    $("#salvar-dynamic").parent().css("margin-top", "10px").css("float", "right");
    $("#group-corpo").removeClass('form-group');

    jQuery('#id').change(function () {
        if (!jQuery('#' + id_form).attr('action')) {
            if (jQuery('#id').val() != '') {
                jQuery('#' + id_form).attr('action', uri + '/update');
            } else {
                jQuery('#' + id_form).attr('action', uri + '/insert');
            }
        }
        if (jQuery('#id').val() != '') {
            selectedRowConteudo();
        }
    }).trigger('change');
});