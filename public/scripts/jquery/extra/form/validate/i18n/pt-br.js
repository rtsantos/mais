/**
 * Translated default messages for the jQuery validation plugin.
 * Language: PT_BR
 * Translator: Francisco Ernesto Teixeira <fco_ernesto@yahoo.com.br>
 */
jQuery.extend(jQuery.validator.messages, {
	required: '<div class="popover fade bottom in"><div style="left: 20px" class="arrow"></div><div class="popover-content">Este campo &eacute; obrigat&oacute;rio.</div></div>',
	remote: "<br/>Por favor, corrija este campo.",
	email: "<br/>Por favor, forne&ccedil;a um endere&ccedil;o eletr&ocirc;nico v&aacute;lido.",
	url: "<br/>Por favor, forne&ccedil;a uma URL v&aacute;lida.",
	date: "<br/>Por favor, forne&ccedil;a uma data v&aacute;lida.",
	dateISO: "<br/>Por favor, forne&ccedil;a uma data v&aacute;lida (ISO).",
	dateDE: "<br/>Bitte geben Sie ein gültiges Datum ein.",
	number: "<br/>Por favor, forne&ccedil;a um n&uacute;mero v&aacute;lida.",
	numberDE: "<br/>Bitte geben Sie eine Nummer ein.",
	digits: "<br/>Por favor, forne&ccedil;a somente d&iacute;gitos.",
	creditcard: "<br/>Por favor, forne&ccedil;a um cart&atilde;o de cr&eacute;dito v&aacute;lido.",
	equalTo: "<br/>Por favor, forne&ccedil;a o mesmo valor novamente.",
	accept: "<br/>Por favor, forne&ccedil;a um valor com uma extens&atilde;o v&aacute;lida.",
	maxlength: jQuery.validator.format("<br/>Por favor, forne&ccedil;a n&atilde;o mais que {0} caracteres."),
	minlength: jQuery.validator.format("<br/>Por favor, forne&ccedil;a ao menos {0} caracteres."),
	rangelength: jQuery.validator.format("<br/>Por favor, forne&ccedil;a um valor entre {0} e {1} caracteres de comprimento."),
	range: jQuery.validator.format("<br/>Por favor, forne&ccedil;a um valor entre {0} e {1}."),
	max: jQuery.validator.format("<br/>Por favor, forne&ccedil;a um valor menor ou igual a {0}."),
	min: jQuery.validator.format("<br/>Por favor, forne&ccedil;a um valor maior ou igual a {0}.")
});

jQuery.validator.addMethod("datePTBR", function(value) { 
  return this.optional(element) || /^\d\d?\/\d\d?\/\d\d\d?\d?$/.test(value); 
}, "<br/>Por favor, forne&ccedil;a uma data v&aacute;lida.");