/**
 * jQuery.TComboCustom
 *
 * Description:
 * Componente criado para implementação de um combo customizado
 * onde o usuário poderá inserir e excluir dados de uma tabela de uma
 * forma dinâmica, rápida e prática.
 *
 * @author: Juliano Sena
 * @version: 0.1
 *
 * 
 * Depends:
 *      jQuery.ui,
 *      jQuery.ui.TOpenDownBox,
 *      jQuery.grid
 *      tanet.js
 *
 */

(function($){
    $.widget('ta.TComboCustom',{
        options: {
            TOpenDownBox : {
                boxId : 'ta-TOpenDownBox-div'
            },
            grid : {
                id: 'ta-TOpenDownBox-div',
                height: 'auto',
                scrollOffset: 0,
                datatype: "json",
                rowNum:10000,
                pager: '#nav',
                navButtons: {edit:false,add:false,del:false, search:false},
                navAdd: false,
                navEdit: false,
                navDel: false,
                colNames:['Date'],
                colModel:[ {name:'invdate',index:'invdate', width:136} ],
                gridComplete : function(){

                    /*
                     * Retiro o título da coluna em questão...
                     * a borda direita dos itens listados no combobox
                     * paginação e o índice de paginação
                     */
                    $('div.ui-jqgrid-hdiv')
                    .hide();

                    $('table#grid tr td')
                    .css('border-right','none');

                    $('#nav_center, #nav_right')
                    .hide();
                }
            }
        },

        _create : function(){
            var self    = this;
            /**
            * Implemento o TOpenDownBox
            * para inserir o grid abaixo do campo de texto em questão
            */
            self.element.TOpenDownBox({
                boxId: self.options.TOpenDownBox.boxId,
                content : $('<table></table>')
                          .attr('id', self.options.grid.id),

                success : function(){

                    /**
                     * Adiciono eventos que trabalham com a instância do objeto
                     * as opções para criação do grid
                     * 
                     */
                    var customEvents = {
                        ondblClickRow: function( rowid ){
                            self.element.val(rowid);
                            self.element.TOpenDownBox('close');
                        }
                    }
                    $.extend(self.options.grid, customEvents);


                    /*
                     * Adiciono um elemento após a table que receberá o grid, para ser renderizado
                     * e receber os botões de adição, edição e exclusão dos itens
                     * 
                     * Crio o grid de acordo com os parâmetros passados
                     * dentro do objeto grid de this.options
                     */
                    $('<div id="nav"></div>').insertAfter($('table#' + self.options.grid.id));

                    jQuery('table#' + self.options.grid.id ).jqGrid(
                        self.options.grid
                    )
                    
                    jQuery('#' + self.options.grid.id ).jqGrid(
                        'navGrid',
                        '#nav',
                        self.options.grid.navButtons
                    )
                },
                open : function(){

                    /*
                     * Ativa a navegação pelo teclado no combobox
                     * selecionando como default o primeiro elemento
                     * cada vez que o botão para exibição dos itens for clicado
                     */
                    $.gridAtivaNavKey({
                        idGrid: self.options.grid.id,
                        functionEnter: function(rowid){
                            self.element.val(rowid);
                            self.element.TOpenDownBox('close');

                        }
                    });
                }
            })
            /**
             * Configurando as funções da key 'Enter'
             */
            configTabIndex();
            self.element
            .taEscEnter()
            .taEsc();

        }//Fim _create

    })  
})(jQuery);