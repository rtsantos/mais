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
(function ($) {
    $.widget('ta.TFileUpload', {
        options: {
            elements: {
                container: '',
                selectFiles: '',
                clearFiles: '',
                startUpload: '',
                id: ''
            },
            multiple: false,
            max_file_size: '100mb',
            uploader: null,
            filters: {},
            onComplete: false
        },
        _create: function () {

            var self = this;
            var id = this.options.elements.id;

            var filters = {};
            if (this.options.filters != null) {
                filters = [];
                for (var indexFilter in this.options.filters) {
                    filters[indexFilter] = {
                        title: this.options.filters[indexFilter].title,
                        extensions: this.options.filters[indexFilter].extensions
                    };
                }
            }

            this.options.uploader = new plupload.Uploader({
                max_file_count: 1,
                multi_selection: this.options.multiple,
                max_file_size: this.options.max_file_size,
                filters: filters,
                container: this.options.elements.container,
                browse_button: this.options.elements.selectFiles,
                url: '/Mais/index.php/file/plUpload?platform=1',
                runtimes: 'html5,flash,browserplus,silverlight,gears,html4',
                flash_swf_url: '/Mais/public/scripts/plupload/plupload.flash.swf',
                silverlight_xap_url: '/Mais/public/scripts/plupload/plupload.silverlight.xap',
                init: {
                    FilesAdded: function (up, files) {
                        if (!$('#' + id).Tdata('TFileUpload').options.multiple) {
                            if (self.element.val() != '') {
                                self.filesClear(id);
                            }
                            up.start();
                        } else {
                            up.start();
                        }
                    }
                }
            });

            var uploadComplete = function (up, file) {
                if (self.options.onComplete !== false) {
                    self.options.onComplete(self);
                }
                self.uploadComplete(up, file);
            };

            this.options.uploader.bind('Error', self.error);
            this.options.uploader.bind('FilesAdded', self.filesAdded);
            this.options.uploader.bind('FileUploaded', self.fileUploaded);
            this.options.uploader.bind('QueueChanged', self.queueChanged);
            this.options.uploader.bind('UploadComplete', uploadComplete);
            this.options.uploader.bind('UploadProgress', self.uploadProgress);
            this.options.uploader.init();

            $('#' + this.options.elements.clearFiles).click(function () {
                $('#' + id).Tdata('TFileUpload').filesClear(id);
            });

            $('#clear-files-' + id).attr('disabled', 'disabled');

            this.disabled(this.element.attr('disabled'));
            this.element.focus(function () {
                self.element.editing = false;
                if ($(this).val()) {
                    self.element.editing = true;
                }
            });
            this.element.focusout(function () {
                if (!$(this).val()) {
                    if (self.element.editing) {
                        self.filesClear(id);
                    }
                }
                self.element.editing = false;
            });

            if (this.options.data) {
                this.loadData(this.options.data);
            }
        },
        disabled: function (value) {

            if (value) {
                $("#group-" + this.element.attr('id') + " *").attr('disabled', true);
            } else {
                $("#group-" + this.element.attr('id') + " *").removeAttr('disabled');
            }
        },
        filesAdded: function (up, files) {

            var id = $('#' + up.settings.container.replace('group-', '')).attr('id');
            var countFiles = files.length;
            var maxSize = parseFloat(up.settings.max_file_size) / 1024 / 1024;
            var objError = $('#' + this.settings.container.replace('group', 'error'));
            objError.hide();

            /**
             * Se não for upload multiplo, impede o envio de novos arquivos
             */
            if (!up.settings.multi_selection) {
                if ($('#' + id).val() != '') {
                    files.each(function (file, i) {
                        up.removeFile(file);
                    });
                    return;
                }
            }

            var container = $('#files-selected-' + id);
            var total = 0;
            var row = '';
            var fileId = '';

            var qtdFile = container.find('li').length;
            /**
             * Avalia se o facescroll está habilitado, caso esteja deve pular
             * as div´s dele.
             */
            if (container.find('.alt-scroll-content').length > 0) {
                container = container.find('.alt-scroll-content');
            }

            qtdFile = (qtdFile === null ? countFiles : qtdFile + countFiles);
            for (var i in files) {
                var name = files[i].name;
                var uploader = $('#' + id).Tdata('TFileUpload');
                var extension = uploader.getExtension(name);
                name = uploader.changeFileName(name);

                //$('#' + id).addClas('ui-input-loa')
                //console.log(files[i]);
                var errorUpload = false;
                if (files[i].size > up.settings.max_file_size) {
                    errorUpload = 'O arquivo "' + files[i].name + '" ultrapassa o tamanho limite de ' + maxSize + 'mb e não será adicionado.';
                }
                if (!uploader.isValidExtension(id, extension)) {
                    errorUpload = 'O arquivo "' + files[i].name + '" não possui uma extensão válida (' + uploader.getValidExtensions(id).join() + ') e não será adicionado.';
                }
                if (errorUpload) {
                    $.TDialog('alert', {}, 'Aviso', errorUpload);
                    up.removeFile(files[i].id);
                    countFiles -= 1;
                    continue;
                }
                total += 1;
                $('#' + id).attr("placeholder", "Enviando " + total + " de " + qtdFile + ' arquivos.');
                row = '<li id="row-' + files[i].id + '" style="width: 250px;" class="link">';
                row += '   <input type="hidden" name="files-' + id + '[]" id="file-' + files[i].id + '" />';
                row += '   <input type="hidden" id="file-type-' + files[i].id + '" name="files-type-' + id + '[]"/>';
                row += '   <input type="hidden" id="file-name-' + files[i].id + '" name="files-name-' + id + '[]"/>';
                //row += '   <input type="hidden" id="file-id-' + files[i].id + '" name="files-id-' + id + '[]" />';
                row += '   <span class="ui-text" id="get-' + files[i].id + '">' + name + '</span>';
                row += '   <span class="tools ui-icon ui-icon-close" id="del-' + files[i].id + '"></span>';
                row += '   <span class="tools ui-icon ui-icon-arrowthickstop-1-s" id="getD-' + files[i].id + '"></span>';
                row += '   &nbsp;';
                row += '</li>';

                container.append(row);

                fileId = files[i].id;
                $('#getD-' + fileId).click(function (e) {
                    uploader.downloadFile(id, fileId);
                    e.preventDefault();
                });

                $('#del-' + fileId).click(function (e) {
                    uploader.deleteFile(id, fileId);
                    e.preventDefault();
                });
            }
            $('#' + id).attr("placeholder", "Enviado " + qtdFile + " arquivo" + (qtdFile > 1 ? "s" : "") + ".");
            up.refresh();
        },
        getValidExtensions: function(idContainer){
            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var extensions = [];
            for (var i in uploader.options.filters) {
                extensions = extensions.concat(uploader.options.filters[i].extensions.split(','));
            }
            return extensions;
        },
        getExtension: function (fileName) {
            var i = fileName.lastIndexOf('.');
            if (i === -1)
                return false;
            return fileName.slice(i).replace('.', '');
        },
        isValidExtension: function (idContainer, extension){
            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var exists = false;
            var extensions = uploader.getValidExtensions(idContainer);
            if(!extensions.length){
                exists = true;
            } else {
                for (var i in extensions) {
                    if (extensions[i] == extension) {
                        exists = true;
                    }
                }
            }
            return exists;
        },
        uploadComplete: function (up, file) {

            var id = $('#' + up.settings.container.replace('group-', '')).attr('id');
            var uploader = $('#' + id).Tdata('TFileUpload');
            var container = $('#files-selected-' + id);
            var qtdFile = container.find('li').length;
            /**
             * Se não for upload multiplo, impede o envio de novos arquivos
             */
            if (!up.settings.multi_selection) {
                $('#select-files-' + id).attr('disabled', 'disabled');
            }
            $('#clear-files-' + id).removeAttr('disabled');
            uploader.infPlaceholder(id, qtdFile);
        },
        fileUploaded: function (up, file, response) {

            var element = $('#' + up.settings.container.replace('group-', '')).attr('id');
            var typeElement = $('#' + element + '_type');
            var nameElement = $('#' + element + '_name');
            var fileElement = $('#' + element + '_file');
            var result = decodeJson(response.response);

            //File
            if (fileElement.val() !== '') {
                fileElement.val(fileElement.val() + ',' + result.result.filename);
            } else {
                fileElement.val(result.result.filename);
            }
            //Name
            if (nameElement.val() !== '') {
                nameElement.val(nameElement.val() + ',' + result.result.name);
            } else {
                nameElement.val(result.result.name);
            }
            //Type
            if (typeElement.val() !== '') {
                typeElement.val(typeElement.val() + ',' + result.result.type);
            } else {
                typeElement.val(result.result.type);
            }

            var id = file.id;
            var uploader = $('#' + element).Tdata('TFileUpload');

            if (file.percent == 100) {
                $('#file-' + file.id).val(result.result.filename);
                $('#file-type-' + file.id).val(result.result.type);
                $('#file-name-' + file.id).val(result.result.name);
                $('#file-id-' + file.id).val(file.id);
                $('#getD-' + file.id).click(function () {
                    uploader.downloadFile(element, file.id);
                });
                $('#del-' + file.id).click(function () {
                    uploader.deleteFile(element, file.id);
                });
            }
            $('#' + id + '_name').val(nameElement.val());
            $('#' + id + '_file').val(fileElement.val());
            $('#' + id + '_type').val(typeElement.val());
        },
        /**
         * 
         * @param {type} idContainer
         * @param {type} idFile
         * @returns {undefined}
         */
        loadId: function () {
            return this.options.load_id;
        },
        /**
         * Apaga todos os arquivos
         */
        filesClear: function (idContainer) {

            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var cryptName = $("#" + idContainer + '_file').val();

            if (substr(cryptName, 0, 1) === ',') {
                cryptName = substr(cryptName, 1);
            }

            $.AjaxT.json({
                url: '/Mais/index.php/file/delete',
                data: 'filename=' + cryptName,
                success: function (result) {
                    uploader.responseFilesClear(idContainer);
                }
            });
        },
        /**
         * Apaga o arquivo informado
         */
        deleteFile: function (idContainer, idFile) {

            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var cryptName = $('#' + idContainer + '_file').val();
            if (substr(cryptName, 0, 1) === ',') {
                cryptName = substr(cryptName, 1);
            }
            $.AjaxT.json({
                url: '/Mais/index.php/file/delete',
                data: 'filename=' + cryptName,
                success: function (result) {
                    uploader.responseDeleteFile(idContainer, idFile);
                }
            });
        },
        responseFilesClear: function (idContainer, idFile) {

            var id = idContainer;
            $('#files-selected-' + id).html('');
            $('#' + id).val('');
            $('#' + id + '_type').val('');
            $('#' + id + '_name').val('');
            $('#' + id + '_file').val('');

            $('#clear-files-' + id).attr('disabled', 'disabled');
            $('#select-files-' + id).removeAttr('disabled');
            $('#' + id).removeAttr('placeholder');

        },
        responseDeleteFile: function (idContainer, idFile) {

            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            uploader.updateDeleteFileContainer(idContainer);
            $('#row-' + idFile).remove();
            var files = $('#' + idContainer + '_file').val();
            if (files == '') {
                $('#clear-files-' + idContainer).attr('disabled', 'disabled');
                $('#select-files-' + idContainer).attr('disabled', '');
                $('#select-files-' + idContainer).removeAttr('disabled');
            }

            var qtdFile = $('#files-selected-' + idContainer).find('li').length;
            if (qtdFile > 0) {
                uploader.infPlaceholder(idContainer, qtdFile);
            } else {
                $('#' + idContainer).val('');
                $('#' + idContainer).removeAttr("placeholder");
            }
        },
        downloadFile: function (idContainer, idFile) {

            if (!document.getElementById('iframe-download-' + idContainer)) {
                $('#group-' + idContainer).append('<iframe id="iframe-download-'
                        + idContainer + '" name="iframe-download-'
                        + idContainer + '" src="about:blank" style="display:none;"></iframe>');

            }
            var cryptName = $('#' + idContainer + '_file').val();
            if (substr(cryptName, 0, 1) === ',') {
                cryptName = substr(cryptName, 1);
            }
            var action = '/Mais/index.php/file/download';
            action = action + '?filename=' + cryptName;
            $('#iframe-download-' + idContainer).attr('src', action);
        },
        loadData: function (data) {
            var self = this;
            var id = self.element.attr('id');
            var name = self.changeFileName(data.name);
            row = '<li id="row-' + data.id + '" style="width: 250px;" class="link">';
            row += '   <input type="hidden" name="files-' + id + '[]" id="file-' + data.id + '" />';
            row += '   <input type="hidden" id="file-type-' + data.id + '" name="files-type-' + id + '[]"/>';
            row += '   <input type="hidden" id="file-name-' + data.id + '" name="files-name-' + id + '[]"/>';
            row += '   <span class="ui-text" id="get-' + data.id + '">' + name + '</span>';
            row += '   <span class="tools ui-icon ui-icon-close" id="del-' + data.id + '"></span>';
            row += '   <span class="tools ui-icon ui-icon-arrowthickstop-1-s" id="getD-' + data.id + '"></span>';
            row += '   &nbsp;';
            row += '</li>';

            jQuery('#files-selected-' + id).append(row);

            fileId = data.id;
            $('#getD-' + fileId).click(function (e) {
                self.downloadFile(id, fileId);
                e.preventDefault();
            });

            $('#del-' + fileId).click(function (e) {
                self.deleteFile(id, fileId);
                e.preventDefault();
            });

            $('#file-' + data.id).val(data.filename);
            $('#file-type-' + data.id).val(data.type);
            $('#file-name-' + data.id).val(data.name);
            $('#file-id-' + data.id).val(data.id);

            $('#' + id + '_name').val(data.name);
            $('#' + id + '_file').val(data.filename);
            $('#' + id + '_type').val(data.type);
            if (self.loadId()) {
                $('#' + id + '_id').val(data.id);
            }
            $('#' + id).val(data.name);
        },
        /**
         * Esta função será utilizada quando um formulário estiver sendo editado
         */
        loadFiles: function (idContainer) {

            var uploader = $('#' + idContainer).Tdata('TFileUpload');
            var container = $('#files-selected-' + idContainer);
            var fileId = plupload.guid(); // Gera um ID único para o arquivo
            var fileName = $('#' + idContainer + '_name');
            var fileType = $('#' + idContainer + '_type');

            /**
             * Avalia se o facescroll está habilitado, caso esteja deve pular
             * as div´s dele.
             */
            if (container.find('.alt-scroll-content').length > 0) {
                container = container.find('.alt-scroll-content');
            }
            $('#clear-files-' + idContainer).removeAttr('disabled');
            $('#select-files-' + idContainer).attr('disabled', 'disabled');

            var row = '';
            var name = fileName.val();
            name = uploader.changeFileName(name);
            row = '<li id="row-' + fileId + '" style="width: 250px;" class="link">';
            row += '   <span id="get-' + fileId + '">' + name + '</span>';
            row += '   <span id="getD-' + fileId + '" class="tools ui-icon ui-icon-arrowthickstop-1-s"></span>';
            row += '   <span id="del-' + fileId + '" class="tools ui-icon ui-icon-close"></span>&nbsp;';
            row += '   <input type="hidden" id="file-' + fileId + '"      name="files-' + idContainer + '[]" value="' + $('#' + idContainer).val() + '" />';
            row += '   <input type="hidden" id="file-type-' + fileId + '" name="files-type-' + idContainer + '[]" value="' + fileType.val() + '" />';
            row += '   <input type="hidden" id="file-name-' + fileId + '" name="files-name-' + idContainer + '[]" value="' + name + '" />';
            row += '</li>';

            container.append(row);

            $('#getD-' + fileId).click(function (e) {
                uploader.downloadFile(idContainer, fileId);
                e.preventDefault();
            });

            $('#del-' + fileId).click(function (e) {
                uploader.deleteFile(idContainer, fileId);
                e.preventDefault();
            });

        },
        uploadProgress: function (up, file) {
        },
        /**
         * 
         * @param {int} idContainer Id do container.
         * @param {int} qtdFile quantidade de arquivo contida no container.         
         */
        infPlaceholder: function (idContainer, qtdFile) {
            if (qtdFile == 1) {
                $('#' + idContainer).attr("placeholder", jQuery('#' + idContainer + '_name').val()).val(jQuery('#' + idContainer + '_name').val());
            } else {
                $('#' + idContainer).attr("placeholder", "Enviado " + qtdFile + " arquivo" + (qtdFile > 1 ? "s" : "") + ".");
            }

        },
        /**
         * 
         * @param {string} name Nome do arquivo para ser tratado.
         * @returns {string} Nome tratado para ficar no padrão do componente.
         */
        changeFileName: function (name) {
            name = name.length > 31 ? (substr(name, 0, 28)) + '...' : name;
            return name.toLowerCase();
        },
        /**
         * 
         * @param {int} idContainer         
         */
        updateDeleteFileContainer: function (idContainer) {

            var container = $('#files-selected-' + idContainer);
            var fileCrypt = '';
            var fileName = '';
            var fileType = '';
            /**
             * Avalia se o facescroll está habilitado, caso esteja deve pular
             * as div´s dele.
             */
            if (container.find('.alt-scroll-content').length > 0) {
                container = container.find('.alt-scroll-content li');
            }
            //Files            
            var files = container.find('input[name="files-' + idContainer + '[]"]');
            for (var index = 0; index < files.length; index++) {
                fileCrypt += ',' + files.eq(index).val();
            }
            $('#' + idContainer + '_file').val(fileCrypt.substr(1));

            //Name
            var names = container.find('input[name="files-name-' + idContainer + '[]"]');
            for (var index = 0; index < names.length; index++) {
                fileName += ',' + names.eq(index).val();
            }
            $('#' + idContainer + '_name').val(fileName.substr(1));
            //Type
            var types = container.find('input[name="files-type-' + idContainer + '[]"]');
            for (var index = 0; index < types.length; index++) {
                fileType += ',' + types.eq(index).val();
            }
            $('#' + idContainer + '_type').val(fileType.substr(1));
        },
        queueChanged: function (up, files) {
        },
        error: function (status, error) {
            var objError = $('#' + this.settings.container.replace('group', 'error'));
            objError.html(error.message);
            //objError.show();
        },
        start: function () {
            this.options.uploader.start();
        },
        plupload: function () {
            return this.options.uploader;
        }
    });
})(jQuery);