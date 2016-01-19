/**
 * 
 * 
 * @author: rsantos
 * @version 1.0
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 *
 *  Options:
 *  
 */

(function ($) {
    $.widget('ta.TPrinter', {
        version: '0.2',
        options: {
            filter: '',
            print: {
                success: function (result) {

                }
            }
        },
        /**
         * Método cosntrutor
         *
         * @access private
         * @return void
         * 
         * 
         */
        _create: function () {
            var self = this;
            if (!document.getElementById('scripts_' + this.element.attr('id'))) {
                var form = '<div id="scripts_' + this.element.attr('id') + '"></div>';
                jQuery('#div-windows').append(form);
            }
            self.refreshPrinters();
            var idTimeout = setTimeout(function () {
                var impressora = $('#local_' + self.element.attr('id'));
                var servidor = $('#server_' + self.element.attr('id'));
                //if (impressora.html() == '' && servidor.length == 0){
                if (impressora.html() == '' || !self.validVersion) {
                    $('#msg_' + self.element.attr('id')).show();
                }
                clearTimeout(idTimeout);
            }, 5000);
        },
        _loadServerLocal: function () {

        },
        successRefreshPrinters: function (printers) {
            var impressora = $('#local_' + this.element.attr('id'));
            var add = true;
            var self = this;

            impressora.html('');

            for (var index in printers) {
                add = true;
                if (self.options.filter != '' && printers[index].toUpperCase().indexOf(self.options.filter.toUpperCase()) < 0) {
                    add = false;
                }
                if (add) {
                    impressora.append('<option value="' + printers[index] + '">' + printers[index] + '</option>');
                }
            }

            $('#msg_' + self.element.attr('id')).hide();
        },
        _getBaseUrl: function () {
            var url = 'https://lcps.tanet.com.br:8443';
            if (window.location.protocol == 'http:') {
                url = 'http://lcps.tanet.com.br:8075';
            }
            return url;
        },
        refreshPrinters: function () {
            var self = this;
            self.validateVersion();

            var listPrinters = '<script src="' + self._getBaseUrl() + '/wsPrintServerLocal/listPrinter.php?id=' + this.element.attr('id') + '" type="text/javascript"></script>';
            jQuery('#scripts_' + this.element.attr('id')).html('').append(listPrinters);
            return false;
        },
        validateVersion: function (v) {
            var self = this;
            if (v == undefined) {
                var result = '<script src="' + self._getBaseUrl() + '/wsPrintServerLocal/version.php?id=' + this.element.attr('id') + '" type="text/javascript"></script>';
                jQuery('#scripts_' + this.element.attr('id')).html('').append(result);
                this.validVersion = false;
            } else {
                if (v != this.version) {
                    this.validVersion = false;
                } else {
                    this.validVersion = true;
                }
            }
        },
        successPrint: function (result) {
            $.BlockT.close();
            this.options.print.success(result);
        },
        print: function (options) {
            var printerName = this.element.val();
            if (printerName == '') {
                $.DialogT.open('Selecione a Impressora!', 'Alert');
                this.element.focus();
                return false;
            }

            if (typeof options == 'string') {
                options = {
                    url: options,
                    success: function (result) {
                        $.BlockT.close();
                        $.DialogT.open(result.message, 'Alert');
                    }
                }
            }
            this.options.print.success = options.success;

            if (printerName.substr(0, 4) == 'WSPS') {
                $.BlockT.open();
                jQuery.AjaxT.json({
                    url: options.url,
                    data: 'printer_name=' + printerName,
                    success: function (result) {
                        options.success(result);
                        $.BlockT.close();
                        $.DialogT.open(result.message, 'Alert');
                    }
                });
            } else {
                var self = this;
                $.BlockT.open();
                jQuery.AjaxT.json({
                    url: options.url,
                    data: 'printer_name=' + printerName,
                    success: function (result) {
                        try {
                            var listPrinters = '<script src="' + self._getBaseUrl() + '/wsPrintServerLocal/printRaw.php?id=' + self.element.attr('id') + '&printer_name=' + printerName + '&uri=' + result.result + '" type="text/javascript"></script>';
                            jQuery('#scripts_' + self.element.attr('id')).html('').append(listPrinters);
                        } catch (err) {
                            $.DialogT.open(err, 'Error');
                        }
                    }
                });
            }
        }
    });
})(jQuery);
