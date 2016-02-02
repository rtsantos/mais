/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function Vendas_PagamentoController(options) {
    var self = this;
    var index = null;

    self.selectors = {
        form: '#frm_cv_pagto_pedido',
        vlrTotal: '#vlr_total',
        perDesc: '#per_desc',
        perAcre: '#per_acre',
        vlrAPagar: '#vlr_a_pagar',
        vlrPago: '#vlr_pago',
        nroParc: '#nro_parc',
        vlrParc: '#vlr_parc'
    };

    if (options && options.selectors) {
        for (index in options.selectors) {
            self.selectors[index] = options.selectors[index];
        }
    }

    for (index in self.selectors) {
        if (index != 'form') {
            self.selectors[index] = jQuery(self.selectors + ' ' + self.selectors[index]);
        }
    }

    self.calc = function () {
        var vlrTotal = number(self.selectors.vlrTotal.val()).toFloat();
        var perDesc = number(self.selectors.perDesc.val()).toFloat();
        var vlrDesc = 0;
        var perAcre = number(self.selectors.perAcre.val()).toFloat();
        var vlrAcre = 0;

        if (perDesc > 0) {
            vlrDesc = number(((vlrTotal * perDesc) / 100)).round(4);
            vlrTotal = vlrTotal - vlrDesc;
        }

        if (perAcre > 0) {
            vlrAcre = number(((vlrTotal * perAcre) / 100)).round(4);
            vlrTotal = vlrTotal + vlrAcre;
        }

        self.selectors.vlrAPagar.val(number(vlrTotal).format(2));
    };
    
    self.selectors.perDesc.Tchange(function(){
        self.calc();
    });
    
    self.selectors.perAcre.Tchange(function(){
        self.calc();
    });
    
    self.selectors.vlrAPagar.Tchange(function(){
        var vlrTotal = number(self.selectors.vlrTotal.val()).toFloat();
        var vlrAPagar = number(self.selectors.vlrAPagar.val()).toFloat();
        
        if (vlrTotal == vlrAPagar) {

        } else if (vlrAPagar > vlrTotal) {
            // acréscimo
            self.selectors.perDesc.val(number(0).format(4));
            
            value = ((100 * vlrAPagar) / vlrTotal) - 100;
            value = number(value).format(4);
            self.selectors.perAcre.val(value);
        } else {
            // desconto
            self.selectors.perAcre.val(number(0).format(4));
            
            value = 100 - ((100 * vlrAPagar) / vlrTotal);
            value = number(value).format(4);
            self.selectors.perDesc.val(value);
        }
        
        self.calc();
    });

    return self;
}

