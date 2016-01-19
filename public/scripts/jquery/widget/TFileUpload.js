/**
 * jQuery.ui.TFileUpload
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
 *      
 *
 */
(function($){
    $.widget('ta.TFileUpload',{
        options : {
            elements:{
                container: '',
                selectFiles: '',
                clearFiles: '',
                startUpload: '',
                id: ''
            },
            multiple : false,
            max_file_size : '100mb',
            uploader: null,
            filters: {},
            onComplete: false
        },
        
        _create : function(){
            
            var self = this;
            var id = this.options.elements.id;
            
            var filters = {};
            if (this.options.filters != null) {
                filters = [];
                for(var indexFilter in this.options.filters){
                    filters[indexFilter] = {
                        title: this.options.filters[indexFilter].title,
                        extensions: this.options.filters[indexFilter].extensions
                    };
                }
            }
            
            this.options.uploader = new plupload.Uploader({
                max_file_count: 1,
                multi_selection: this.options.multiple,
                max_file_size : this.options.max_file_size,
                filters: filters,
                container: this.options.elements.container,
                browse_button : this.options.elements.selectFiles,
                url: '/Mais/index.php/file/plUpload?platform=1',
                runtimes : 'html5,flash,browserplus,silverlight,gears,html4',
                flash_swf_url: '/Mais/public/scripts/plupload/plupload.flash.swf',
                silverlight_xap_url: '/Mais/public/scripts/plupload/plupload.silverlight.xap',
                init : {
                    FilesAdded: function(up, files) {
                        if (!$('#' + id).Tdata('TFileUpload').options.multiple) {
                            if ($('#' + id).val() == '') {
                                up.start();
                            }
                        } else {
                            up.start();
                        }
                    }
                }
            });
			
            var uploadComplete = function(up, file){
                if(self.options.onComplete !== false){
                    self.options.onComplete(self);
                }
                self.uploadComplete(up, file);
            }
            
            this.options.uploader.bind('Error', this.error);
            this.options.uploader.bind('FilesAdded', this.filesAdded);
            this.options.uploader.bind('FileUploaded', this.fileUploaded);
            this.options.uploader.bind('QueueChanged', this.queueChanged);
            this.options.uploader.bind('UploadComplete', uploadComplete);
            this.options.uploader.bind('UploadProgress', this.uploadProgress);
            
            this.options.uploader.init();
            
            $('#' + this.options.elements.clearFiles).click(function(){
                $('#' + id).Tdata('TFileUpload').filesClear(id);
            });
            
            $('#clear-files-' + id).attr('disabled', 'disabled');
            
            this.disabled(this.element.attr('disabled'));
        },
        disabled: function(value){
            if(value){
                $("#group-" + this.element.attr('id') + " *").attr('disabled',true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        
        filesAdded: function(up, files) {
            
            var id = $('#' + up.settings.container.replace('group-','')).attr('id');
            var countFiles = files.length;
            var maxSize = parseFloat(up.settings.max_file_size) / 1024 / 1024;
            
            /**
             * Se não for upload multiplo, impede o envio de novos arquivos
             */
            if (!up.settings.multi_selection) {
                if ($('#' + id).val() != '') {
                    files.each(function(file, i) {
                        up.removeFile(file);
                    });
                    return;
                }
            }
            
            var bg            = '';
            var container     = $('#files-selected-' + id);
            var total         = $('#total-' + id);
            var uploadProcess = $('#upload-process-' + id);
            var row = '';
                
            for (var i in files) {

                if (files[i].size > up.settings.max_file_size) {
                    $.TDialog('information', {}, 'Alert', 'O arquivo "' + files[i].name + '" ultrapassa o tamanho limite de ' + maxSize + 'mb e não será adicionado.');
                    up.removeFile(files[i].id);
                    countFiles -= 1;
                    continue;
                }

                if (container.attr('rows').length % 2 == 0) {
                    bg = '#EEEEEE';
                } else {
                    bg = '#FFFFFF';
                }
                
                row  = '<tr id="row-' + files[i].id + '" bgcolor="' + bg + '">';
                row += '    <td align="left">';
                row += '        <input type="hidden" name="files-'+ id +'[]" id="file-' + files[i].id + '" />';
                row += '        <input type="hidden" id="file-type-' + files[i].id + '" name="files-type-'+ id +'[]" />';
                row += '        <input type="hidden" id="file-name-' + files[i].id + '" name="files-name-'+ id +'[]" />';
                row += '        <a id="get-' + files[i].id + '" href="javascript:void(0)">' + files[i].name + '</a>';
                row += '    </td>';
                row += '    <td align="center"><a id="del-' + files[i].id + '" href="javascript:void(0)">&nbsp;</a></td>';
                row += '</tr>';
                
                container.append(row);
            }
            
            total.html(parseFloat(total.html()) + parseFloat(countFiles));
            uploadProcess.show();
            up.refresh();
        },

        uploadComplete: function(up, file) {
            var id = $('#' + up.settings.container.replace('group-','')).attr('id');
            /**
             * Se não for upload multiplo, impede o envio de novos arquivos
             */
            if (!up.settings.multi_selection) {
                $('#select-files-' + id).attr('disabled', 'disabled');
            }
            $('#clear-files-' + id).attr('disabled', '');
        },
        
        fileUploaded: function(up, file, response) {
            
            var id = $('#' + up.settings.container.replace('group-','')).attr('id');
            var uploader = $('#' + id).Tdata('TFileUpload');
            
            var result = decodeJson(response.response);
            
            var sent = $('#sent-' + id);
            if (file.percent == 100) {
                sent.html(parseFloat(sent.html()) + 1);
                $('#file-' + file.id).val(result.result.filename);
                $('#file-type-' + file.id).val(result.result.type);
                $('#file-name-' + file.id).val(result.result.name);
                $('#del-' + file.id).html('x');
                $('#get-' + file.id).click(function(){
                    uploader.downloadFile(id, file.id);
                });
                $('#del-' + file.id).click(function(){
                    uploader.deleteFile(id, file.id);
                });
            }
            
            /**
             * Quebra as informações com virgula
             * Este widget está pronto para a versão mult-upload
             */
            var objFile = $('#' + id);
            var files = objFile.val();
            var name = '';
            var type = '';
            
            if (files != '') {
                files += ',';
            }
            files = files + result.result.filename;
            objFile.val(files);
            
            $('input[name="files-name-'+ id + '[]"]').each(function() {
                if (name != '') {
                    name += ',';
                }
                name += $(this).val();
            });
            $('#' + id + '_name').val(name);
            
            $('input[name="files-type-'+ id + '[]"]').each(function() {
                if (type != '') {
                    type += ',';
                }
                type += $(this).val();
            });
            $('#' + id + '_type').val(type);
        },

        /**
         * Apaga todos os arquivos
         */
        filesClear: function(idContainer) {
            
            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var cryptName = $("#" + idContainer).val();
            
            $.AjaxT.json({
                url:  '/Mais/index.php/file/delete',
                data: 'filename=' + cryptName,
                success: function(result){
                    uploader.responseFilesClear(idContainer);
                }
            });
        },
        
        /**
         * Apaga o arquivo informado
         */
        deleteFile: function(idContainer, idFile) {
            
            var cryptName = $('#file-' + idFile).val();
            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            
            $.AjaxT.json({
                url:  '/Mais/index.php/file/delete',
                data: 'filename=' + cryptName,
                success: function(result){
                    uploader.responseDeleteFile(idContainer, idFile);
                }
            });
        },
        
        responseFilesClear: function(idContainer, idFile) {
            
            var id = idContainer;
            
            $('#' + id).val('');
            $('#upload-process-' + id).hide();
            $('#files-selected-' + id).html('');
            $('#sent-' + id).html(0);
            $('#total-' + id).html(0);
            
            $('#' + id).val('');
            $('#' + id + '_type').val('');
            $('#' + id + '_name').val('');
            
            $('#clear-files-' + id).attr('disabled', 'disabled');
            $('#select-files-' + id).attr('disabled', '');
            
        },
        
        responseDeleteFile: function(idContainer, idFile) {
            
            var id = idContainer;
            
            $('#row-' + idFile).remove();
            var sent  = $('#sent-' + id);
            var total = $('#total-' + id);
            sent.html(parseFloat(sent.html()) - 1);
            total.html(parseFloat(total.html()) - 1);

            var files = '';
            var types = '';
            var names = '';
            
            $('input[name="files-' + id + '[]"]').each(function() {
                if (files != '') {
                    files += ',';
                }
                files += $(this).val();
            });
            $('#' + id).val(files);
            
            $('input[name="files-name-'+ id + '[]"]').each(function() {
                if (names != '') {
                    names += ',';
                }
                names += $(this).val();
            });
            $('#' + id + '_name').val(names);
            
            $('input[name="files-type-'+ id + '[]"]').each(function() {
                if (types != '') {
                    types += ',';
                }
                types += $(this).val();
            });
            $('#' + id + '_type').val(types);
            
            if(files == '') {
                $('#clear-files-' + id).attr('disabled', 'disabled');
                $('#select-files-' + id).attr('disabled', '');
            }
            
        },
        
        downloadFile: function(idContainer, idFile) {
            
            if ($('#' + idContainer).val() == '') {
                $.TDialog('information', {}, 'Alert', 'Arquivo não enviado!');
                return;
            }
            
            if (!document.getElementById('iframe-download')) {
                $('#div-windows').append('<iframe id="iframe-download-' + idContainer + '" name="iframe-download-' + idContainer + '" src="about:blank"></iframe>');
            }
            
            var action = '/Mais/index.php/file/download';
            action = action + '?filename=' + $('#file-' + idFile).val();
            action = action + '&type=' + $('#file-type-' + idFile).val();
            action = action + '&name=' + $('#file-name-' + idFile).val();
            $('#iframe-download-' + idContainer).attr('src', action);
            
        },
        
        /**
         * Esta função será utilizada quando um formulário estiver sendo editado
         */
        loadFiles: function(idContainer) {
            
            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var container = $('#files-selected-' + idContainer);
            var bg = '';
            var fileId = plupload.guid(); // Gera um ID único para o arquivo
            var fileName = $('#' + idContainer + '_name');
            var fileType = $('#' + idContainer + '_type');
            
            $('#sent-' + idContainer).html(1);
            $('#total-' + idContainer).html(1);
            $('#upload-process-' + idContainer).show();
            $('#select-files-' + idContainer).attr('disabled', 'disabled');
            $('#clear-files-' + idContainer).attr('disabled', '');
            
            if (container.attr('rows').length % 2 == 0) {
                bg = '#EEEEEE';
            } else {
                bg = '#FFFFFF';
            }
            
            var row = '';
            row  = '<tr id="row-' + fileId + '" bgcolor="' + bg + '">';
            row += '    <td align="left">';
            row += '        <input type="hidden" name="files-'+ idContainer +'[]" id="file-' + fileId + '" value="' + $('#' + idContainer).val() + '" />';
            row += '        <input type="hidden" id="file-type-' + fileId + '" name="files-type-'+ idContainer +'[]" value="' + fileType.val() + '" />';
            row += '        <input type="hidden" id="file-name-' + fileId + '" name="files-name-'+ idContainer +'[]" value="' + fileName.val() + '" />';
            row += '        <a id="get-' + fileId + '" href="javascript:void(0)">' + fileName.val() + '</a>';
            row += '    </td>';
            row += '    <td align="center"><a id="del-' + fileId + '" href="javascript:void(0)">x</a></td>';
            row += '</tr>';
            
            container.append(row);
            
            $('#get-' + fileId ).click(function(){
                uploader.downloadFile(idContainer, fileId);
            });
            
            $('#del-' + fileId ).click(function(){
                uploader.deleteFile(idContainer, fileId);
            });
            
        },
        
        uploadProgress: function(up, file){},
        
        queueChanged: function(up,files){},
        
        error: function(status, error) {
            var objError = $('#' + this.settings.container.replace('group','error'));
            objError.append(error);
            objError.show();
        },
        
        start: function() {
            this.options.uploader.start();
        },
        
        plupload: function(){
            return this.options.uploader;
        }
    })
})(jQuery);