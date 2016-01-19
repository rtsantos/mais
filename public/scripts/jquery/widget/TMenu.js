/**
 * jQuery.ui.TMenu
 * 
 * Description:
 *      Componente que cria menu estilo Ipod
 *
 * @author: Juliano Sena
 * @version: 0.1
 * 
 * Depends:
 *      jQuery.ui
 */

(function($){
    $.widget('ta.TMenu',{
        options : {
            content : $('<ul id="main-menu">\n\
                            <li class="teste">\n\
                                <a href="#">teste 1</a>\n\
                                <ul>\n\
                                    <li class="teste">\n\
                                        <a href="#">teste 1</a>\n\
                                    </li>\n\
                                    <li class="nivel 1">\n\
                                        <a href="#">teste 2</a>\n\
                                    </li>\n\
                                    <li class="nivel 1">\n\
                                        <a href="#">teste 3</a>\n\
                                        <ul>\n\
                                            <li class="nivel 2">\n\
                                                <a href="#">teste 1</a>\n\
                                                <ul>\n\
                                                    <li class="nivel 3">\n\
                                                        <a href="#">teste 1</a>\n\
                                                        <ul>\n\
                                                            <li class="nivel 4">\n\
                                                                <a href="#">teste 1</a>\n\
                                                            </li>\n\
                                                            <li class="nivel 4">\n\
                                                                <a href="#">teste 2</a>\n\
                                                            </li>\n\
                                                            <li class="nivel 4">\n\
                                                                <a href="#">teste 3</a>\n\
                                                            </li>\n\
                                                        </ul>\n\
                                                    </li>\n\
                                                    <li class="nivel 3">\n\
                                                        <a href="#">teste 2</a>\n\
                                                    </li>\n\
                                                    <li class="nivel 3">\n\
                                                        <a href="#">teste 3</a>\n\
                                                    </li>\n\
                                                </ul>\n\
                                            </li>\n\
                                            <li class="nivel 2">\n\
                                                <a href="#">teste 2</a>\n\
                                            </li>\n\
                                            <li class="nivel 2">\n\
                                                <a href="#">teste 3</a>\n\
                                            </li>\n\
                                        </ul>\n\
                                    </li>\n\
                                </ul>\n\
                            </li>\n\
                            <li>\n\
                                <a href="#">teste 1</a>\n\
                                <ul>\n\
                                    <li>\n\
                                        <a href="#">teste 1</a>\n\
                                    </li>\n\
                                    <li>\n\
                                        <a href="#">teste 2</a>\n\
                                    </li>\n\
                                    <li>\n\
                                        <a href="#">teste 3</a>\n\
                                    </li>\n\
                                </ul>\n\
                            </li>\n\
                            <li><a href="#">teste 3</a></li>\n\
                            <li><a href="#">teste 4</a></li>\n\
                            <li><a href="#">teste 5</a></li>\n\
                            <li><a href="#">teste 3</a></li>\n\
                            <li><a href="#">teste 4</a></li>\n\
                            <li><a href="#">teste 5</a></li>\n\
                            <li><a href="#">teste 3</a></li>\n\
                            <li><a href="#">teste 4</a></li>\n\
                            <li><a href="#">teste 5</a></li>\n\
                        </ul>'),
            width   : 200,
            height  : 180,
        },

        level   : 1,

        _create : function(){
            var self = this;

            self._buildMenu( self.options.content, self.level )

        },

        _buildMenu : function( ul, level ) {
            var self = this;

            if( !$('div#container_' + level).length ){
                $('body').append('<div id="container_' + level + '"></div>');
            }

            ul.find('ul')
                .each(function(){
                    if( $(this).find('li > a').next().is('ul') ){
                        self._buildMenu( $(this), level++ );
                    }

                    $('div#container_' + level)
                        .append($(this));
                })
        },

        _animate : function() {
            var self = this;

        },

        destroy: function() {
            $.Widget.prototype.destroy.call( this );
        }

    })
})(jQuery);