/**
 * Widget QueryBuilder
 * 
 * @author: Patrick Reis
 * @version 0.1 
 * 
 *  Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *
 */
(function ($) {
    $.widget('ta.TQueryBuilder', {
        options: {
            jsonElement: null,
            columns: {},
            iNode: 0,
            urlQuote: '',
            mapper: '',
            valueQuote: []
        },
        /**
         * Método construtor
         *
         * @access private
         * 
         * @return void
         * 
         */
        _create: function () {

            this._createTree();

            var self = this;
            var hidden = this.element;

            self.options.valueQuote = [];

            var form = hidden.parents().find('form');
            form.submit(function () {
                self.options.valueQuote = [];

                var sql = self.toSql();

                var data = '';
                data = data + 'mapper=' + self.options.mapper;
                for (var index = 0; index < self.options.valueQuote.length; index++) {
                    data = data + '&values[]=' + self.options.valueQuote[index]['value'];
                    data = data + '&fields[]=' + self.options.valueQuote[index]['field'];
                }

                var json = jQuery.AjaxT.json({
                    url: self.options.urlQuote,
                    data: data,
                    async: false
                });

                for (var index in json.values) {
                    var value = json.values[index];
                    if (value != null && value.indexOf("|") >= 0) {
                        value = value.replace(/\|/g, '%');
                    }
                    sql = sql.replace('%' + index + '%', value);
                }

                hidden.val(sql);
            });
        },
        _createTree: function () {

            jQuery('#panel_' + this.element.attr('id')).remove();
            var xhtml = '<div class="tree" id="panel_' + this.element.attr('id') + '"> '
                    + '<ul><li> '
                    + '<div class="ui-corner-all ui-state-default">Grupo de Condição '
                    + this.addButtons(this.options.iNode, this.element.attr('id'), true)
                    + '</div>';
            xhtml += ' <ul class="tree_root" id ="ul_' + this.options.iNode + '">';

            xhtml += this._printTree(this.options.jsonElement)
                    + '</ul></li></ul></div>';

            jQuery(xhtml).insertAfter(this.element);
        },
        /**
         * 
         * @param {type} where
         * 
         * @param {type} iNode
         * 
         * @returns {String}
         */
        _createInputs: function (where, iNode) {

            var xhtml = '';
            var onChange = "jQuery('#" + this.element.attr('id')
                    + "').Tdata('TQueryBuilder').changeSelect(" + iNode + ")";

            var optionObj = this.addOptionField(where.field);

            xhtml += '<select class="item" id="field_' + iNode
                    + '" onChange="' + onChange + '">' + optionObj + "</select>";
            xhtml += this.configureActionField(where.field, iNode, where.value, where.operator, false);
            this.options.iNode++;

            return xhtml;
        },
        /**
         * Método responsável por criar a Tree.
         * 
         * @param {Object} itens Itens a ser adicionado na tree.
         * 
         * @returns {String} Conteudo HTML gerado.
         */
        _printTree: function (itens) {

            var xhtml = '';

            for (var iItem in itens) {

                if (itens[iItem]['field']) {

                    xhtml += '<li id="li_' + this.options.iNode + '">';

                    xhtml += '<textarea name="comment_' + this.options.iNode + '" rows="1" cols="52" style="display:none;">' + itens[iItem]['comment'] + '</textarea>';

                    var remComp = "jQuery('#" + this.element.attr('id')
                            + "').Tdata('TQueryBuilder').removeComponent('li_', "
                            + this.options.iNode + ",false)";
                    xhtml += this._createInputs(itens[iItem], this.options.iNode);

                    if (this.options.iNode > 1) {
                        xhtml += '<button type="button" onClick="' + remComp
                                + '" class="ui-button ui-corner-all ui-state-default">Remover</button>';
                    }
                    xhtml += '</li>';

                } else if (itens[iItem]['condition']) {

                    xhtml += this.addCondition(itens[iItem]['condition']);

                } else if (itens[iItem]['rules']) {

                    xhtml += '<li id="li_' + this.options.iNode + '">';
                    this.options.iNode++;
                    xhtml += '<div class="ui-corner-all ui-state-default">Grupo de Condição';
                    xhtml += this.addButtons(this.options.iNode, this.element.attr('id'), false);
                    xhtml += '</div>';
                    xhtml += '<ul id="ul_' + this.options.iNode + '">';

                    this.options.iNode++;
                    xhtml += this._printTree(itens[iItem]['rules']);
                    xhtml += '</ul>';
                    xhtml += '</li>';
                    this.options.iNode++;
                }
            }

            return xhtml;
        },
        /**
         * Adiciona uma nova Regra Condicional.
         * 
         * @param {Number} iNode         
         */
        addRule: function (iNode) {
            var item = {field: '', operator: '', value: ''};
            for (var index in this.options.columns) {
                item.field = index;
                break;
            }

            var ul = jQuery('#ul_' + iNode);
            var xhtml = '';

            var parent = jQuery('#panel_' + this.element.attr('id')).find('.tree_root');
            var tamanho = parent.children('li').length;
            var isFirstNode = true;

            if (tamanho !== 0) {
                xhtml += this.addCondition("AND");
                isFirstNode = false;
            }
            xhtml += '<li id="li_' + this.options.iNode + '">';
            xhtml += '<textarea name="comment_' + this.options.iNode + '" rows="1" cols="52" style="display:none;"></textarea>';
            var remComp = "jQuery('#" + this.element.attr('id')
                    + "').Tdata('TQueryBuilder').removeComponent('li_', "
                    + this.options.iNode + ",false)";
            xhtml += this._createInputs(item, this.options.iNode);

            if (!isFirstNode) {
                xhtml += '<button type="button" onClick="' + remComp + '" class="ui-button ui-state-default">Remover</button>';

            }
            xhtml += '</li>';
            ul.append(xhtml);
        },
        /**
         * Adiciona um Grupo Condicional.
         * 
         * @param {Number} iNode         
         */
        addGroup: function (iNode) {

            var xhtml = '';
            xhtml += this.addCondition("AND");
            var ul = jQuery('#ul_' + iNode);
            var item = {field: '', operator: '', value: ''};
            for (var index in this.options.columns) {
                item.field = index;
                break;
            }

            xhtml += '<li id="li_' + this.options.iNode + '">';
            this.options.iNode++;
            xhtml += '<div class="ui-corner-all ui-state-default">Grupo de Condição:';
            xhtml += this.addButtons(this.options.iNode, this.element.attr('id'), false);
            xhtml += '</div>';
            xhtml += '<ul id="ul_' + this.options.iNode + '">';
            xhtml += '<li id="li_' + this.options.iNode + '">';
            xhtml += '<textarea name="comment_' + this.options.iNode + '" rows="1" cols="52" style="display:none;"></textarea>';
            xhtml += this._createInputs(item, this.options.iNode);
            xhtml += '</li>';
            xhtml += '</ul>';
            xhtml += '</li>';

            ul.append(xhtml);
        },
        /**
         * Adiciona Botões com as Actions de AddRule,AddGroup e RemoveComponent.
         * 
         * @param {Number} iNode   
         * @param {String} element 
         * @param {Boolean} isRoot campo que informa se o elemento é root
         * 
         * @returns {String} Html com os botões adicionados.
         */
        addButtons: function (iNode, element, isRoot) {

            var xhtml = '';
            var classBt = 'class="ui-button ui-corner-all ui-state-default" ';

            if (!isRoot) {
                var remComp = "jQuery('#" + element
                        + "').Tdata('TQueryBuilder').removeComponent('li_', " + iNode + ",true)";
                xhtml += '<button type="button" ' + classBt + 'onClick="' + remComp
                        + '" class="ui-button ui-corner-all ui-state-default">Remover</button>';
            }

            var addGroup = "jQuery('#" + element
                    + "').Tdata('TQueryBuilder').addGroup(" + iNode + ")";
            xhtml += '<button type="button" id="btn_group_' + iNode
                    + '" ' + classBt + 'onClick="' + addGroup + '">Novo Grupo</button>';

            var addRule = "jQuery('#" + element
                    + "').Tdata('TQueryBuilder').addRule(" + iNode + ")";
            xhtml += '<button type="button" id="btn_rule_' + iNode
                    + '" ' + classBt + 'onClick="' + addRule + '">Nova Regra</button>';

            return xhtml;
        },
        /**
         * Método que cria uma lista de opções dos campos disponíveis.
         * 
         * @param {String} field Campo que deverá estar selecionado
         * 
         * @returns {String} Lista de opções contendo os campos.
         */
        addOptionField: function (field) {

            var xhtml = '';
            var selected = '';
            for (var listField in this.options.columns) {
                var column = this.options.columns[listField];

                if (field !== null) {
                    selected = (listField.toUpperCase().trim() === field.toUpperCase().trim() ? "selected" : '');
                }
                xhtml += '<option value="' + listField + '"'
                        + selected + '>' + column['label'] + "</option>";
            }

            return xhtml;
        },
        /**
         * Método que adiciona a estrutura condicional na Estrutura.
         * 
         * @param {Number} iNode
         * @param {String} condition 
         * 
         * @returns {String}
         */
        addCondition: function (condition) {

            var xhtml = '';
            var checked = '';
            this.options.iNode++;
            xhtml += '<li id="li_' + this.options.iNode + '" class="condition">';

            if (condition.toUpperCase() === 'AND') {
                checked = 'AND';
            }
            else if (condition.toUpperCase() === 'OR') {
                checked = 'OR';
            }
            else if (condition.toUpperCase() === 'AND NOT') {
                checked = 'AND NOT';
            }
            else if (condition.toUpperCase() === 'OR NOT') {
                checked = 'OR NOT';
            }

            var strProp = 'class="condition" name="condition_' + this.options.iNode + '"';

            xhtml += '<input class="item" type="radio" ' + strProp + ' value="AND" '
                    + (checked === 'AND' ? 'checked' : '') + ' /> E ';
            xhtml += '<input class="item" type="radio" ' + strProp + ' value="OR" '
                    + (checked === 'OR' ? 'checked' : '') + ' /> OU ';
            xhtml += '<input class="item" type="radio" ' + strProp + '  value="AND NOT" '
                    + (checked === 'AND NOT' ? 'checked' : '') + ' /> E Não ';
            xhtml += '<input class="item" type="radio" ' + strProp + ' value="OR NOT" '
                    + (checked === 'OR NOT' ? 'checked' : '') + ' /> OU Não';
            xhtml += '</>';

            this.options.iNode++;
            return xhtml;
        },
        /**
         * Evento Onchange  do campo Field.
         * 
         * @param {Number} iNode         
         */
        changeSelect: function (iNode) {

            var field = jQuery('#field_' + iNode);
            this.configureActionField(field.val(), iNode, null, null, true);
        },
        changeOperator: function (isObject, iNode, value, field) {

            var nOperator = jQuery('#operator_' + iNode).val();
            var xhtmlValues = this._configureActionValue(isObject, iNode, value, nOperator, field);
            jQuery('#spanV_' + iNode).html(xhtmlValues);
        },
        /**
         * Remove o Component informado.
         * 
         * @param {String} component  Nome Do Elemento.
         */
        removeComponent: function (component, iNode, isGroup) {

            if (isGroup) {
                iNode = (iNode - 1);
                component = component + iNode;
                iNode = (iNode - 1);
            } else {
                component = component + iNode;
                iNode = (iNode - 1);
            }

            var removeBefore = jQuery('#li_' + iNode);
            if (removeBefore.attr('class') === 'condition') {
                removeBefore.remove();
            }
            jQuery('#' + component).remove();
        },
        /**
         * Função que obtem uma lista de operadores validos baseado no tipo do campo informado.
         * 
         * @param {String} operator Operador informado.
         * 
         * @param {String} type Tipo do campo para obter o operador.
         * 
         * @returns {String} Os operadores(Logicos,Relacionais e outros). 
         */
        addOptionOperator: function (operator, type) {

            operator = (operator === '!=' ? '<>' : operator);
            var xhtml = '';
            var operadores = ['=', '<>', 'IS NULL', 'IS NOT NULL'];
            var relacionais = ['>=', '<=', '>', '<'];
            var logicosString = ['IN', 'NOT IN', 'LIKE', 'NOT LIKE'];
            var logicosContidos = ['IN', 'NOT IN'];
            var opTranslate = 
            ({
                "=": 'Igual a'
                , ">=": 'Maior Igual a'
                , "<=": 'Menor Igual a'
                , "<>": 'Diferente de'
                , ">": 'Maior que'
                , "<": 'Menor que '
                , "!=": 'Diferente de'
                , "IS NULL": 'Está Vazio'
                , "IS NOT NULL": 'Não Está Vazio'
                , "IN": 'Está contido em'
                , "NOT IN": 'Não está contido em'
                , "LIKE": 'Contém'
                , "NOT LIKE": 'Não Contém'
            });

            if (type === 'Number') {
                operadores = operadores.concat(relacionais);
            } else if (type === 'Char') {
                operadores = operadores.concat(logicosContidos);
            } else {
                operadores = operadores.concat(logicosString);
            }
            
            for (var i = 0; i < operadores.length; i++) {
                var op = operadores[i];
                var selected = (op === operator ? "selected" : '');
                xhtml += '<option value="' + op + '"' + selected + '>' + opTranslate[op] + "</option>";
            }

            return xhtml;
        },
        /**
         * Método de configuração das actions e valores de um campo.
         * 
         * @param {String} field Campo que deverar configurar a action.
         * 
         * @param {Number} iNode Id do nó do elemento.
         * 
         * @param {String} value Valor do field.
         * 
         * @param {String} operator Operador relacional entre field e value.
         * 
         * @param {Boolean} replace Se irá substituir os valores de um field já criado.
         * 
         * @returns {String} HTML gerado.
         */
        configureActionField: function (field, iNode, value, operator, replace) {

            var xhtml = '';
            field = field.trim().toLowerCase();

            if (value !== null && typeof value === "String") {
                value = value.trim();
            }

            var column = this.options.columns[field];
            operator = (operator !== null ? operator : column.operation);
            var isObject = (typeof column.listOptions === 'object');
            var type = (isObject ? 'Char' : column.type);
            var xhtmlOperator = replace ? '' : '<span id="spanO_' + iNode + '" class="item">';
            var xhtmlValues = replace ? '' : '<span id="spanV_' + iNode + '" class="item">';

            var onChangeOperator = "jQuery('#" + this.element.attr('id')
                    + "').Tdata('TQueryBuilder').changeOperator(" + isObject
                    + "," + iNode + ",'" + value + "','" + field + "')";

            xhtmlOperator += '<select id="operator_'
                    + iNode + '" onChange="' + onChangeOperator + '">'
                    + this.addOptionOperator(operator, type) + "</select>";
            xhtmlOperator += replace ? '' : ' </span>';

            xhtmlValues += this._configureActionValue(isObject, iNode, value, operator, field);
            xhtmlValues += replace ? '' : ' </span>';
            xhtml = xhtmlOperator.concat(xhtmlValues);

            if (replace) {
                jQuery('#spanO_' + iNode).html(xhtmlOperator);
                jQuery('#spanV_' + iNode).html(xhtmlValues);
            } else {
                return xhtml;
            }
        },
        _configureActionValue: function (isObject, iNode, value, operator, field) {
            var xhtmlValues = '';
            if (value == null || value == "null") {
                value = "";
            }
            field = field !== null ? field.toLowerCase() : "";
            var column = this.options.columns[field];
            var isNull = (operator === 'IS NULL' || operator === 'IS NOT NULL');

            if (isObject && !isNull) {
                var multiple = 'multiple';
                if (operator == '=' || operator == '<>') {
                    multiple = '';
                }

                xhtmlValues += '<select class="required"  id="listValues_'
                        + iNode + '"' + multiple + '>';

                for (var options in column.listOptions) {
                    var selected = '';

                    if (value !== null && multiple != '') {
                        var multValue = value.split(',');
                        if (multValue.length > 0) {
                            for (var index in multValue) {
                                if (options === multValue[index]) {
                                    selected = 'selected';
                                    break;
                                }
                            }
                        }

                    }
                    else {
                        selected = (options == (value + '') ? 'selected' : '');
                    }

                    xhtmlValues += '<option value="' + options + '"' + selected + ' >'
                            + column.listOptions[options] + '</option>';

                }
                xhtmlValues += '</select>';

            }
            else if (operator === 'IN' || operator === 'NOT IN') {
                xhtmlValues += '<textarea name="value_' + iNode + '" class="required" >'
                        + this._newLine(value) + '</textarea>';
            }
            else if (isNull) {
            }
            else {
                xhtmlValues += '<input type="text" name="value_' + iNode
                        + '" value="' + value + '" class="required item" />';
            }

            return xhtmlValues;
        },
        /**
         * Função que obtem as propriedades da Coluna.
         * 
         * @param {String} field Campo que deseja obter as propriedades.
         * 
         * @returns {Array|String} As propriedades obtidas.
         */
        getFieldProperties: function (field) {

            var obj = '';
            for (var listField in this.options.columns) {
                var column = this.options.columns[listField];
                var isField = false;

                if (field !== null) {
                    isField = (listField === field.trim() ? true : false);
                }
                if (isField) {
                    obj = [column['operation'], column['type'], column['listOptions']];
                }
            }

            return obj;
        },
        /**
         * Método que substitui quebra de linha  por ','(virgula). 
         * 
         * @param {String} value Valor que será alterado.
         * 
         * @param {String} field
         * 
         * @returns {String} Novo valor.
         */
        _quote: function (value, field) {
            if (typeof value === 'object') {
                var values = '';
                for (var index in value) {
                    values += ";" + value[index];
                }
                values = values.substr(1);
            } else {
                var values = value.replace(/[\s+]{3,}/g, '\n');
                values = value.replace(/\n/g, ',').split(',');
                value = '';
                for (var index in values) {
                    value += ";" + values[index];
                }
                values = value.substr(1);
            }

            var iValue = this.options.valueQuote.length;
            var data = {
                field: field,
                value: values
            };
            this.options.valueQuote[iValue] = data;
            value = '%' + iValue + '%';
            return value;
        },
        /**
         * Método que substitui ','(virgula) por quebra de linha quando o valor
         * não possuir o comando select.
         * 
         * @param {String} value Valor que será alterado.
         * 
         * @returns {String} Novo valor.
         */
        _newLine: function (value) {

            if (typeof value === 'string' && !value.match('select ')) {
                var values = '';
                values = value.replace(/\,/g, '\n');
                return values;
            } else {
                return value;

            }

        },
        /**
         * Function Responsável por gerar um objeto JSON.
         * 
         * @param {String} parent param de entrada que será convertido.
         * 
         * @returns {String} Objeto JSON Criado.
         */
        toJson: function (parent) {

            var json = '{"commands": {';
            var ul = null;
            if (!parent) {
                var parent = this.element.children('ul');
            }
            var itens = parent.children('li');
            for (var index = 0; index < itens.length; index++) {
                var command = itens.eq(index).children();
                if (index > 0) {
                    json = json + ',';
                }
                ul = itens.eq(index).children('ul');

                if (ul.length > 0) {
                    json = json + '"' + index + '": {rules: ' + this.toJson(ul) + '} ';
                } else {
                    var field = command.eq(0).val();
                    var operator = command.eq(1).children().val();
                    var value = command.eq(2).children().val();

                    json += '"' + index + '": { ';
                    json += ' "field": " ' + field + '"';
                    json += ',"operator": " ' + operator + '"';
                    json += ',"value": " ' + value + '"';
                    json += '} ';
                }
            }
            json = json + '}}';

            return json;
        },
        /**
         * Function Responsável por gerar um objeto JSON.
         * 
         * @param {String} parent param de entrada que será convertido.
         * 
         * @returns {String} Objeto JSON Criado.
         */
        toSql: function (parent) {
            var sql = '';
            var ul = null;
            var condition = '';

            if (!parent) {
                var parent = jQuery('#panel_' + this.element.attr('id')).find('.tree_root');
            }
            var itens = parent.children('li');

            for (var index = 0; index < itens.length; index++) {

                var command = itens.eq(index).children();
                var condition = itens.eq(index).children('input:checked');
                ul = itens.eq(index).children('ul');
                if (ul.length > 0) {
                    sql = sql + '(' + this.toSql(ul) + ')';
                } else if (condition.length > 0) {
                    sql += ' ' + condition.val() + ' ';
                } else {
                    var comment = "/*" + command.eq(0).html() + "*/";
                    var field = command.eq(1).val() + '';
                    var operator = command.eq(2).children().val() + '';
                    var value = command.eq(3).children().val() + '';
                    var type = typeof value;
                    var isUndefined = (type === 'undefined');


                    //Tratamento adicionado para o valor % junto ao operador like,
                    //A chamada Ajax perdia o valor quando era executada.
                    if (!isUndefined && value !== null
                            && value.indexOf("%") >= 0) {
                        value = value.replace(/\%/g, '|');
                    }

                    //Remove quebra de linhas ou virgulas no final da expressão. 
                    if (!isUndefined && type == 'string') {
                        value = value.replace(/[\,+]{2,}|[\n+]{2,}/g, ',')
                                .replace(/\,+$|\n+$/g, '');
                    }

                    if (operator === 'IS NULL' || operator === 'IS NOT NULL') {
                        sql += comment + ' ' + field + ' ' + operator + ' ';
                    } else if (operator.toUpperCase().trim() === 'IN' || operator.toUpperCase().trim() === 'NOT IN') {
                        sql += comment + ' ' + field + ' ' + operator + ' (' + this._quote(value, field) + ')';
                    } else {
                        sql += comment + ' ' + field + ' ' + operator + ' ' + this._quote(value, field);
                    }
                }
            }
            return sql;
        },
        /**
         * Método chamado pelo edit para realizar o populate.
         * 
         * @param {Sting} data         
         */
        loadData: function (data) {
            var self = this;

            self.options.jsonElement = decodeJson(data);
            self.options.iNode = 0;
            self._createTree();
        },
        /**
         * 
         * @param {type} columns
         * @returns {undefined}
         */
        setColumns: function (columns, mapper) {
            if (columns) {
                var self = this;

                self.options.mapper = mapper;
                self.options.columns = columns;
                self.options.jsonElement = {};
                self.options.iNode = 0;

                jQuery('#panel_' + this.element.attr('id')).remove();
                var xhtml = '<div class="tree" id="panel_' + this.element.attr('id') + '"> '
                        + '<ul><li> '
                        + '<div class="ui-corner-all ui-state-default">Grupo de Condição '
                        + this.addButtons(this.options.iNode, this.element.attr('id'), true)
                        + '</div>';
                xhtml += ' <ul class="tree_root" id ="ul_' + this.options.iNode + '">';

                xhtml += this._printTree(this.options.jsonElement)
                        + '</ul></li></ul></div>';

                jQuery(xhtml).insertAfter(this.element);
            }
        }
    });
})(jQuery);