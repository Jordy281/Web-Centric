var showExistingUser= function(){
    $("#registrationForm").hide();
    $("#loginForm").show();
};
var showNewUser = function(){
    $("#loginForm").hide();
    $("#registrationForm").show();
};
var showEdit = function(){
    $("#userInfo").hide();
    $("#editInfo").show();
};
var shipDifBill = function(){
    $("#Billing").hide();
    $("#Shipping").show();
}

var shipToBill = function(){
    $("#Billing").show();
    $("#Shipping").hide();
}