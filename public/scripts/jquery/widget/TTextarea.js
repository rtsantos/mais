/**
 * Classe para limitar e exibir a capacidade maxima de um TextArea.
 * 
 * @author: Patrick Reis
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 * Opções:
 
 */
(function ($) {
    $.widget('ta.TTextarea', {
        options: {
            maxLength: null,
            showCount: true
        },
        /**
         * Método construtor
         *
         * @access private
         * @return void
         * 
         */
        _create: function () {
            var self = this;

            if (this.element.attr('id') == '') {
                this.element.attr('id', this.element.attr('name'));
            }

            this.element.keyup(function (e) {
                self.blockInsert();
                self.countChar();
            }).keydown(function (e) {
                self.blockInsert();
                self.countChar();
            });
        },
        /**
         * Função que conta a quantidade de caracteres disponíveis no textArea
         * exibindo o limite caso o mesmo tenha sido informado.
         */
        countChar: function () {
            var id_count = 'count_' + this.element.attr('id');
            var div = $('[id=' + id_count + ']');

            if (!div.size() && this.options.showCount) {
                this.element.after("<p id = '" + id_count + "'></p>");
            }

            if (this.options.showCount) {
                if (this.options.maxLength != null) {
                    div.html(this.element.val().length + ' de ' + this.options.maxLength);
                } else {
                    div.html(this.element.val().length);
                }
            }
        },
        /**
         * Função que bloqueia a inserção de novos caracteres quando ultrapassa o
         * limite informado.
         */
        blockInsert: function () {
            if (this.element.val().length > this.options.maxLength) {
                var conteudo = this.element.val().substring(0, this.options.maxLength);
                this.element.val(conteudo);
            }
        }

    });
})(jQuery);
