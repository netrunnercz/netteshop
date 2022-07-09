$(document).ready(function(){
	changeDeliveryDisabled();
	
	$("#frmformPayment-country").change(function () {
		changeDeliveryDisabled();
	});
	
});

function changeDeliveryDisabled() {
	if($("#frmformPayment-country").val() == "cz") {
		$("#frmformPayment-payment-0").removeAttr('disabled');
		$("#frmformPayment-payment-1").removeAttr('disabled');
		$("#frmformPayment-payment-2").attr('disabled', 'disabled');
	}
	else {
		$("#frmformPayment-payment-0").attr('disabled', 'disabled');
		$("#frmformPayment-payment-1").attr('disabled', 'disabled');
		$("#frmformPayment-payment-2").removeAttr('disabled');
	}
}