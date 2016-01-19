var id_tab = 'tab_categoria';

var indexTab = {
    categoria: 0,
    priv_categ: 1,
    conteudo: 2
};

$(document).ready(function () {
    jQuery('#' + id_tab).TTabs('disable', indexTab.priv_categ);
    jQuery('#' + id_tab).TTabs('disable', indexTab.conteudo);
});

function selectedRowCategoria() {
    jQuery('#' + id_tab).TTabs('enable', indexTab.priv_categ);
    jQuery('#' + id_tab).TTabs('enable', indexTab.conteudo);
}