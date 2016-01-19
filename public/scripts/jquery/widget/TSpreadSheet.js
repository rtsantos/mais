(function ($) {
    $.widget('ta.TSpreadSheet', {
        hot: null,
        doSearchProduto: true,
        doSearchCodigo: true,
        doValidQtd: true,
        hiddenColumns: [],
        options: {
        },
        /**
         * Método construtor
         *
         * @access private
         * @return void
         */
        _create: function () {
            var self = this;
            var id = self.options.elements.id;
            var container = document.getElementById(id);

            self.options.data = self.objToArray(self.options.data);
            if (typeof self.options.colHeaders == 'object'){
                self.options.colHeaders = self.objToArray(self.options.colHeaders);
            }
            self.options.colWidths = self.objToArray(self.options.colWidths);
            self.options.properties = self.objToArray(self.options.properties);
            self.options.callbacks = self.objToArray(self.options.callbacks);
            self.options.hiddenColumns = self.objToArray(self.options.hiddenColumns);
            if (typeof self.options.columns != 'undefined') {
                self.options.columns = self.objToArray(self.options.columns);
            } else {
                self.options.columns = false;
            }
            if (typeof self.options.contextMenu == 'object') {
                self.options.contextMenu = self.objToArray(self.options.contextMenu);
            }
            if (self.options.fixedRowsTop) {
                self.options.fixedRowsTop = self.options.fixedRowsTop * 1;
            } else {
                self.options.fixedRowsTop = [];
            }
            if (self.options.fixedColumnsLeft) {
                self.options.fixedColumnsLeft = self.options.fixedColumnsLeft * 1;
            } else {
                self.options.fixedColumnsLeft = [];
            }

            /* Preenche as colunas do array columns como vazias para que sejam
             * exibidas todas as colunas que estão populadas no array data */
            for (var line in self.options.data) {
                for (var column in self.options.data[line]) {
                    if (typeof self.options.columns[column] == 'undefined') {
                        self.options.columns[column] = '';
                    }
                }
            }
            /* Caso o source de qualquer coluna seja um objeto, deve ser transformado em um array */
            for (var i in self.options.columns) {
                if (typeof self.options.columns[i].source == 'object') {
                    self.options.columns[i].source = self.objToArray(self.options.columns[i].source);
                }
            }

            function readOnlyRenderer(instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                if (cellProperties['readOnly'] || self.getPropertyValue(row, col, 'readOnly')) {
                    td.style.background = '#EEE';
                }
                if (self.options.properties['backgroundColor']) {
                    if (self.options.properties['backgroundColor'][row][col]) {
                        td.style.backgroundColor = self.options.properties['backgroundColor'][row][col];
                    }
                }
                if (cellProperties['invalid'] || self.getPropertyValue(row, column, 'invalid')) {
                    //alert(row + ' e ' + column);
                    td.style.backgroundColor = '#FF0000';
                }
            }
            Handsontable.renderers.registerRenderer('readOnlyRenderer', readOnlyRenderer);

            if (typeof self.options.contextMenuKey != 'undefined') {
                self.options.contextMenu = {
                    callback: self.options.contextMenuCallback,
                    items: self.options.contextMenuKey
                };
            }

            self.hot = new Handsontable(container, {
                data: self.options.data,
                className: 'htCenter',
                colHeaders: self.options.colHeaders,
                rowHeaders: self.options.rowHeaders,
                colWidths: self.options.colWidths,
                columns: self.options.columns,
                manualColumnResize: self.options.manualColumnResize,
                contextMenu: self.options.contextMenu,
                fixedRowsTop: self.options.fixedRowsTop,
                fixedColumnsLeft: self.options.fixedColumnsLeft,
                cells: function (row, col, prop) {
                    var cellProperties = {};
                    cellProperties.renderer = "readOnlyRenderer";
                    return cellProperties;
                },
                beforeDrawBorders: function () {
                    for (var i in self.hiddenColumns) {
                        self.setHiddenColumn(self.hiddenColumns[i]);
                    }
                }
            });

            for (var event in self.options.callbacks) {
                self.hot.addHook(event, self.options.callbacks[event]);
            }

            for (var prop in self.options.properties) {
                for (var line in self.options.properties[prop]) {
                    for (var column in self.options.properties[prop][line]) {
                        var cellProperties = self.hot.getCellMeta(line, column);
                        cellProperties[prop] = self.options.properties[prop][line][column];
                    }
                }
            }

            for (var column in self.options.hiddenColumns) {
                self.hiddenColumns.push(column);
                self.setHiddenColumn(column);
            }

            var hidden = jQuery('#' + this.element.attr('id') + '_json');
            hidden.change(function () {
                self.setValue(hidden.val());
            });

            var form = hidden.parents().find('form');
            form.submit(function () {
                var dataJson = self.hot.getData();
                var jsonString = JSON.stringify(dataJson);
                hidden.val(jsonString);
            });
        },
        objToArray: function (obj) {
            var array = [];
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    array[prop] = obj[prop];
                    if (typeof array[prop] == 'object') {
                        array[prop] = this.objToArray(array[prop]);
                    }
                }
            }
            return array;
        },
        getCellValue: function (line, column) {
            var self = this;
            return self.hot.getDataAtCell(line, column);
        },
        setCellValue: function (line, column, value) {
            var self = this;
            self.hot.setDataAtCell(line, column, value);
        },
        selectCell: function (line, column) {
            var self = this;
            self.hot.selectCell(line, column);
        },
        setHiddenColumn: function (column, value) {
            var self = this;
            if (typeof value == 'undefined') {
                value = true;
            }
            if (value == true) {
                $("#" + self.options.elements.id + " td:nth-child(" + column + "),th:nth-child(" + column + ")").hide();
                self.setHiddenColumnHead(true);
            } else {
                $("#" + self.options.elements.id + " td:nth-child(" + column + "),th:nth-child(" + column + ")").show();
            }
        },
        setHiddenColumnHead: function (value) {
            var self = this;
            if (typeof value == 'undefined') {
                value = true;
            }
            if (value == true) {
                $("#" + self.options.elements.id + " .htContainer .ht_clone_top .wtHolder .wtHider .wtSpreader th").hide();
            } else {
                $("#" + self.options.elements.id + " .htContainer .ht_clone_top .wtHolder .wtHider .wtSpreader th").show();
            }
        },
        setPropertyValue: function (line, column, property, value) {
            var self = this;
            if (typeof self.options.properties[property] == 'undefined') {
                self.options.properties[property] = [];
                if (typeof self.options.properties[property][line] == 'undefined') {
                    self.options.properties[property][line] = [];
                    if (typeof self.options.properties[property][line][column] == 'undefined') {
                        self.options.properties[property][line][column] = value;
                    }
                }
            }
        },
        getPropertyValue: function (line, column, property) {
            var self = this;
            if (typeof self.options.properties[property] != 'undefined') {
                if (typeof self.options.properties[property][line] != 'undefined') {
                    if (typeof self.options.properties[property][line][column] != 'undefined') {
                        return self.options.properties[property][line][column];
                    }
                }
            }
            return null;
        },
        loadData: function (data) {
            var self = this;
            data = self.objToArray(data);
            self.hot.loadData(data);
        }
    });
})(jQuery);
