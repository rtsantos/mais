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
(function($){
    $.widget('ta.TFile',{
        options : {},
        _create : function(){
            var name = jQuery('#' + this.element.attr('id') + '_name');
            this.options.urlDelete = name.attr('urldelete');
            this.options.urlUpload = name.attr('urlupload');
            this.options.urlDownload = name.attr('urldownload');
            this.options.options = name.attr('options');
        },
        loadFile: function(param){
            this.element.val(param.filename);
            jQuery('#' + this.element.attr('id') + '_type').val(param.type);
            jQuery('#' + this.element.attr('id') + '_name').val(param.name);
        },        
        uploadFile: function(){
            jQuery.WindowT.open({type: 'WINDOW'
                               ,id:'windowUpload_' + this.element.attr('id')
                               ,url: this.options.urlUpload
                               ,param: 'id=' + this.element.attr('id')
                               ,height:515
                               ,width:750});
        },
        downloadFile: function(){
            if (this.element.val() == ''){
                $.TDialog('information', {}, 'Alert', 'Arquivo não enviado!');
                return;
            }
            
            if (!document.getElementById('iframe-download')){
                $('#div-windows').append('<iframe id="iframe-download" name="iframe_download_file" src="about:blank"></iframe>');
            }
            var $action = '/Mais/index.php/file/download';
            $action = $action + '?filename=' + this.element.val();
            $action = $action + '&type=' + jQuery('#' + this.element.attr('id') + '_type').val();
            $action = $action + '&name=' + jQuery('#' + this.element.attr('id') + '_name').val();
            document.getElementById('iframe-download').src = $action;            
            
            /*jQuery.WindowT.open({type: 'IFRAME'
                               ,id:'windowDownload_' + this.element.attr('id')
                               ,url: this.options.urlDownload
                               ,param: 
                               ,height:0
                               ,width:0});*/
        },        
        deleteFile: function() {
            if (this.element.val() == ''){
                $.TDialog('information', {}, 'Alert', 'Arquivo não enviado!');
                return;
            }
            $.ajax({
                type: 'POST',
                url: this.options.urlDelete,
                data: 'filename=' + this.element.val() + '&id=' + this.element.attr('id'),
                success: function(result){
                    var vJson = decodeJson(result);
                    if (!vJson){
                        $.TDialog('error', {}, 'Erro', result);
                        $.TLoadClose();
                    }else{
                        if (vJson.error){
                            $.TDialog('error', {}, 'Erro', vJson.exception.message);
                            $.TLoadClose();
                        }else{
                            jQuery('#' + vJson.id).val('');
                            jQuery('#' + vJson.id + '_type').val('');
                            jQuery('#' + vJson.id + '_name').val('');
                        }
                    }                    
                }
            });
        }
    })
})(jQuery);