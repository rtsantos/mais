;(function($){
/**
 * jqGrid Brazilian-Portuguese Translation
 * Junior Gobira juniousbr@gmail.com
 * http://jnsa.com.br
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
**/
$.jgrid = {
	defaults : {
		recordtext: "Visualizando {0} - {1} de {2}",
	    emptyrecords: "Nenhum registro encontrado!",
		loadtext: "Carregando...",
		pgtext : "Pagina {0} de {1}"
	},
	search : {
	    caption: "Pesquisa de registro",
	    Find: "Pesquisar",
	    Reset: "Restaurar",
	    odata : ['igual (=) ', 'diferente (<>)', 'menor(<)', 'menor igual (<=)','maior (>)','maior igual (>=)', 'comeÁa com','n„o comeÁa com','dentro Ex: 1,2,3','n„o est· dentro Ex: 1,2,3','termina com','n„o termina com','contÈm','n„o contÈm'],
	    groupOps: [	{ op: "AND", text: "Incrementa filtro" },	{ op: "OR",  text: "Um ou outro" }	],
		matchText: " match",
		rulesText: " rules"
	},
	edit : {
	    addCaption: "Incluir",
	    editCaption: "Alterar",
	    bSubmit: "Salvar",
	    bCancel: "Cancelar",
		bClose: "Fechar",
		saveData: "Data has been changed! Save changes?",
		bYes : "Yes",
		bNo : "No",
		bExit : "Cancel",
	    msg: {
	        required:"Campo √© obrigat√≥rio",
	        number:"Por favor, informe um n√∫mero v√°lido",
	        minValue:"valor deve ser igual ou maior que ",
	        maxValue:"valor deve ser menor ou igual a",
	        email: "este e-mail n√£o √© v√°lido",
	        integer: "Por favor, informe um valor inteiro",
			date: "Por favor, entre com uma data v√°lida",
			url: "is not a valid URL. Prefix required ('http://' or 'https://')"
		}
	},
	view : {
	    caption: "View Record",
	    bClose: "Close"
	},
	del : {
    caption: "Delete",
	    msg: "Deletar registros selecionado(s)?",
	    bSubmit: "Delete",
	    bCancel: "Cancelar"
	},
	nav : {
		edittext: " ",
	    edittitle: "Alterar registro selecionado",
		addtext:" ",
	    addtitle: "Incluir novo registro",
	    deltext: " ",
	    deltitle: "Deletar registro selecionado",
	    searchtext: " ",
	    searchtitle: "Procurar registros",
	    refreshtext: "",
	    refreshtitle: "Recarrgando Tabela",
	    alertcap: "Aviso",
	    alerttext: "Por favor, selecione um registro",
		viewtext: "",
		viewtitle: "View selected row"
	},
	col : {
	    caption: "Mostrar/Esconder Colunas",
	    bSubmit: "Enviar",
	    bCancel: "Cancelar"
	},
	errors : {
		errcap : "Erro",
		nourl : "Nenhuma URL defenida",
		norecords: "Sem registros para exibir",
	    model : "Tamanho da propriedade colNames <> colModel!"
	},
	formatter : {
		integer : {thousandsSeparator: " ", defaultValue: '0'},
		number : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, defaultValue: '0,00'},
		currency : {decimalSeparator:",", thousandsSeparator: ".", decimalPlaces: 2, prefix: "", suffix:"", defaultValue: '0,00'},
		date : {
			dayNames:   [
				"Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab",
				"Domingo", "Segunda", "Ter√ßa", "Quarta", "Quinta", "Sexta", "S√°bado"
			],
			monthNames: [
				"Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez",
				"Janeiro", "Fevereiro", "Mar√ßo", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
			],
			AmPm : ["am","pm","AM","PM"],
			S: function (j) {return j < 11 || j > 13 ? ['st', 'nd', 'rd', 'th'][Math.min((j - 1) % 10, 3)] : 'th'},
			srcformat: 'Y-m-d',
			newformat: 'd/m/Y',
			masks : {
	            ISO8601Long:"d-m-Y H:i:s",
	            ISO8601Short:"d-m-Y",
	            ShortDate: "n/j/Y",
	            LongDate: "l, F d, Y",
	            FullDateTime: "l, F d, Y g:i:s A",
	            MonthDay: "F d",
	            ShortTime: "g:i A",
	            LongTime: "g:i:s A",
	            SortableDateTime: "Y-m-d\\TH:i:s",
	            UniversalSortableDateTime: "Y-m-d H:i:sO",
	            YearMonth: "F, Y"
	        },
	        reformatAfterEdit : false
		},
		baseLinkUrl: '',
		showAction: '',
	    target: '',
	    checkbox : {disabled:true},
		idName : 'id'
	}
};
})(jQuery);