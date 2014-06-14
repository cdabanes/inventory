var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';

//Initialize Cache
init_cache_model('ReceivingReportDetail');
init_cache_table_id('#ReceivingReportDetailTable');
init_cache_form_id('#ReceivingReportDetailAddForm');

$(document).ready(function(){

	//Vendor Handler
	$('#ReceivingReportVendorId').append('<option value="'+BASE_URL+'vendors'+'">New Vendor</option>');
	$(document).on('change','#ReceivingReportVendorId',function(){
		var vendor = $(this).val();
		if(vendor==BASE_URL+'vendors'){
			alert('This will open vendor module in a new tab...\nKindly refresh your receiving report module after saving new vendor.');
			window.open(this.value,'_blank'
		 );
		}
	});
	
	//Populate Amount 
	$(document).on('click','.compute-amount',function(){
		var record = RECORD.getActive();
		var amount =0;
		$.each(record.ReceivingReportDetail,function(i,o){
			amount = amount + (o.ReceivingReportDetail.qty*o.ReceivingReportDetail.price); 
		});
		$('#ReceivingReportAmount').val(amount.toFixed(2));
	});

});