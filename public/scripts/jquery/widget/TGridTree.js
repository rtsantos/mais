/**
 * Classe para renderizar uma tabela em formato de árvore
 * 
 * @author: rsantos
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *      php.js
 *
 *  Options:
 *  
 */
(function($) {
    $.widget( 'ta.TGridTree',{  
        options: {
            columns:{
                group: null,
                parent: null,
                level: null,
                child: 0
            },
            url:null,
            isFocus: false,
            setFocus: true,
            idSelected: ''
        },
        /**
         * Método cosntrutor
         *
	 * @access private
	 * @return void
         * 
         * 
	 */
        _create: function(){    
            var self = this;
            self._enableTree();
                                                
            self.element.click(function(event){
                event.preventDefault();
                self.options.isFocus = true;
                return false;
            })
                                                
            $(document).click(function(){
                          self.options.isFocus = false;
                          self.element.find('td').removeClass('ui-state-highlight');
                        });
                       
            if ($.browser.opera){
                $(document).keypress(function(event){
                            if(self.options.isFocus){
                                self._keyPress(event);
                            }
                        });
            }else{
                $(document).keydown(function(event){
                            if(self.options.isFocus){
                                self._keyPress(event);
                            }
                        });
            }
                        
            if (self.options.setFocus) self.focus();
        },
        
        _enableTree: function(){
            var self = this;            
            var cells = self.element.find('.' + self.options.columns.group);
            var value = null;
            var padding = null;            
            var rowId = '';
            var child = 0;
            
            for(var index=0; index<cells.length; index++){
                rowId = cells.eq(index).parent().attr('id');
                
                padding = 0;
                cells.eq(index).parent().click(function(){                    
                    self.element.find('td').removeClass('ui-state-highlight');
                    $(this).find('td').addClass('ui-state-highlight');
                })
                
                padding = cells.eq(index).attr('level') * 15;                
                child = cells.eq(index).attr('child') * 1;
                value = '';
                if (child >= 1){
                    value = value + '<span style="float:left;cursor:pointer;" id="icon-'+rowId+'" class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e">';
                    value = value + '</span>';
                }else{
                    padding = padding + 18;
                }
                value = value + '<span style="float:left;">';
                value = value + '   ' + cells.eq(index).html();
                value = value + '</span>';
                
                cells.eq(index).html(value);
                
                $('#icon-'+rowId).click(function(){
                    var cell = $(this);
                    self.openCloseTree(cell.parent().parent().attr('id'));
                });
                
                cells.eq(index).css('padding-left',padding + 'px')
            }
        },
        
        _nextRow: function(rowSel){
            var nextRow = rowSel.next();
            if (nextRow.css('display') == 'none'){
                return this._nextRow(nextRow);
            }else{
                return nextRow;
            }
        },
        
        _prevRow: function(rowSel){
            var prevRow = rowSel.prev();
            if (!prevRow){
                return rowSel;
            }
            if (prevRow.css('display') == 'none'){
                return this._prevRow(prevRow);
            }else{
                return prevRow;
            }
        },
        
        _keyPress: function(event){
            var obj = null;
            var self = this;
            var icon = null;
            var rowSel = self.element.find('.ui-state-highlight');
            
            if (rowSel.length == 0) rowSel = self.element.find('td');
            rowSel = rowSel.eq(0).parent();
            
            if (event.keyCode == 38){//UP
                obj = this._prevRow(rowSel);
                if (obj.attr('id')){
                    self.element.find('td').removeClass('ui-state-highlight');
                    obj.find('td').addClass('ui-state-highlight');
                }
            }else if (event.keyCode == 40){//Down
                obj = this._nextRow(rowSel);
                if (obj.attr('id')){
                    self.element.find('td').removeClass('ui-state-highlight');
                    obj.find('td').addClass('ui-state-highlight');
                }
            }else if (event.keyCode == 39){//next
                icon = $('#icon-' + rowSel.attr('id'));
                if (icon.hasClass('ui-icon-triangle-1-e')){
                    self.openCloseTree(rowSel.attr('id'));
                }
            }else if (event.keyCode == 37){//prev
                icon = $('#icon-' + rowSel.attr('id'));
                if (icon.hasClass('ui-icon-triangle-1-s')){
                    self.openCloseTree(rowSel.attr('id'));
                }
            }
            return true;
        },
            
        openCloseTree: function(parentId){
            var self = this;
            var rows = self.element.find('.parent-' + parentId);
            var row = null;
            var icon = $('#icon-' + parentId);
            var parent = $('#' + parentId);
            for(var index=0; index<rows.length; index++){
                row = $(rows[index]);

                if (row.css('display') == 'none'){
                    row.show();
                    icon.removeClass('ui-icon-triangle-1-e');
                    icon.addClass('ui-icon-triangle-1-s');
                    parent.css('font-weight','bold');
                }else{
                    row.hide();
                    icon.removeClass('ui-icon-triangle-1-s');
                    icon.addClass('ui-icon-triangle-1-e');
                    parent.css('font-weight','normal');
                }
            }
        },
        
        focus: function(param){
            var self = this;
            self.options.isFocus = true;
            var rows = self.element.find('td');
            if (self.options.idSelected){
                
            }
            rows.removeClass('ui-state-highlight');
            rows.eq(0).parent().find('td').addClass('ui-state-highlight');
        }
    });   
})(jQuery);
