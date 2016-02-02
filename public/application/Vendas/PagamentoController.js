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
        parcFormaPagto: '#parcela_forma_pagto',
        groupParc: '#group-descricao_parcela',
        groupVlrParc: '#group-vlr_parc',
        vlrParc: '#vlr_parc',
        perJuroParc: '#per_juro_parcela',
        qtdParc: '#qtd_parcela'
    };

    if (options && options.selectors) {
        for (index in options.selectors) {
            self.selectors[index] = options.selectors[index];
        }
    }

    for (index in self.selectors) {
        if (index != 'form') {
            self.selectors[index] = jQuery(self.selectors.form + ' ' + self.selectors[index]);
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
        self.onParcela();
    };

    self.selectors.perDesc.Tchange(function () {
        self.calc();
    });

    self.selectors.perAcre.Tchange(function () {
        self.calc();
    });

    self.selectors.vlrAPagar.Tchange(function () {
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

    self.onFormaPagto = function (formaPagto) {
        var parcela = self.selectors.parcFormaPagto.val();
        if (formaPagto && formaPagto.parcela){
            parcela = formaPagto.parcela;
        }
        
        console.log(parcela);
        
        if (parcela == 'S') {
            self.selectors.groupParc.show();
            self.selectors.groupVlrParc.show();
        } else {
            self.selectors.groupParc.hide();
            self.selectors.groupVlrParc.hide();
        }
    };

    self.onParcela = function (parcela) {
        var vlrAPagar = number(self.selectors.vlrAPagar.val()).toFloat();
        var qtdParc = number(self.selectors.qtdParc.val()).toFloat();
        var perJuroParc = number(self.selectors.perJuroParc.val()).toFloat();
        var vlrParc = 0;
        var vlrJuro = 0;
        
        if (parcela && parcela.qtd){
            qtdParc = parcela.qtd;
        }

        if (!qtdParc) {
            qtdParc = 1;
        }

        vlrParc = vlrAPagar / qtdParc;
        if (perJuroParc > 0) {
            vlrJuro = number(((vlrParc * perJuroParc) / 100)).round(4);
            vlrParc = vlrParc + vlrJuro;
        }
        
        self.selectors.vlrParc.val(number(vlrParc).format(2));
    };    
    
    self.onFormaPagto();

    return self;
}

