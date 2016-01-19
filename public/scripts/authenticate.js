function authenticate() {
    jQuery.AjaxT.submitJson({
        selector: '#frm_auth',
        success: function (result) {
            location.reload();
        }
    });
}

function controlKeyDownLogin(event, element) {
    if (event.keyCode == 13) {
        if ($(element).attr('id') == 'user' && $(element).val()) {
            $("#senha").focus();
        } else if ($(element).attr('id') == 'pass' && $(element).val()) {
            $("#btn_auth").click();
        }
        event.preventDefault();
    }
    jQuery('#layout-auth-error').html('').hide('fast');
}