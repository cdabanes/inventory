$(document).ready(function(){
	//Populate User Full Name
	$(document).bind('after_get',function(){
		$('#UserFullName').val(window.user.full_name);
	});
	
	$(document).on('click','.intent-print',function(){
	
		var type = $('#report_form').val();
		if(type == 'SR'){
			$('#SalesReport').submit();
		}
	});
});