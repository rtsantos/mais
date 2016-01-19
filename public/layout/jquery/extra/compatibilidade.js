/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$.blockUI = function (opts) {
    $.BlockT.open();
};
$.unblockUI = function (opts) {
    $.BlockT.close();
};