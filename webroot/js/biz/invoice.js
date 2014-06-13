var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){

	$('#ChecklistTableBooks').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bScrollCollapse": false,
	});
	$('#ChecklistTableSupplies').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bScrollCollapse": false,
	});
	$('#ChecklistTableOthers').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bScrollCollapse": false,
	});

	$(document).on('click','.check_all',function(e){
		var isCheck =  $(this).is(':checked');
		var table = $(this).parents('table:first');
		var check_items = table.find('tbody .bk_check_item');
		if(isCheck){
			table.find('tbody .bk_check_item').prop('checked', true).change();
			table.find('.product_id').removeAttr('disabled');	
		}else{
			table.find('tbody .bk_check_item').prop('checked', false).change();
			table.find('.product_id').attr('disabled','disabled');
		}	
	});
		
	$(document).on('change','.bk_check_item',function(){
		var isCheck =  $(this).is(':checked');
		var row = $(this).parents('tr:first');
		var qty = parseInt($(row).find('.qty').text());
		var order =  $(row).find('.order');
		var product_id =  $(row).find('.product_id');
		var count =  $(this).parents('table:first').find('.bk_check_item:checked').length;
		$(order).val(isCheck?qty:'').focus().select();
		if(isCheck){
			$(order).removeAttr('disabled').change();
			$(product_id).removeAttr('disabled');
		}else{
			$(order).attr('disabled','disabled').change();
			$(product_id).attr('disabled','disabled');
		}			
		if(isCheck){
			$(row).addClass('selected');
		}else{
			$(this).parents('table:first').find('thead .check_all').removeAttr('checked');
			$(row).removeClass('selected');
		}
	});
	
	//amount	
	$(document).on('change','.order',function(e){
		e.preventDefault();
		var row = $(this).parents('tr:first');
		var order = $(this).val();
		var amt =  $(row).find('.amount');
		var price =  parseFloat($(row).find('.price').text());
		$(amt).text((order*price).toFixed(2));
		$(amt).find('input').val(order*price);
		$(amt).change();
	});
	
	//sub total
	$(document).on('change','.amount',function(){
		var tbody = $(this).parents('tbody:first');
		var table = $(this).parents('table:first');
		var total = 0;
		$.each(tbody.find('.amount'),function(i,e){
			
			var amt = parseFloat($(e).text());
			if(!isNaN(amt)){
				total+=amt;
			}
		});
		var _class =  $(tbody).attr('class');
		$(table).parent().next().find('.subtotal').text(total.toFixed(2)).change();
	});
	
	//total
	$(document).on('change','.subtotal',function(){
		var total = 0;
		$.each($('.subtotal'),function(a,b){
			var subt = parseFloat($(b).text());
			total+=subt;
		});
		$('.bookstore_total').text(total.toFixed(2));
	});
	
	//default
	$('#intent-create').bind('click', function(){
		$('.subtotal').text('0.00').change();
		$('.bk_check_item').attr('checked',false);
		$('#ChecklistTableBooks').dataTable().fnClearTable();
		$('#ChecklistTableSupplies').dataTable().fnClearTable();
		$('#ChecklistTableOthers').dataTable().fnClearTable();
	});
	
	//Request content
	$(document).bind('request_content',function(){
		$('#ChecklistTableBooks').dataTable().fnClearTable();
		$('#ChecklistTableSupplies').dataTable().fnClearTable();
		$('#ChecklistTableOthers').dataTable().fnClearTable();
	});
	
	//Populate (ChecklistDetails)
	$(document).on('change','#InvoiceSy, #InvoiceSem,#InvoiceLevel,#CurrType',function(e,a){
		$(document).trigger('request_content');
		$(document).trigger('from_checklist_details');
	});
	
	$(document).on('click','.view-invoice_details',function(e,a){
		$(document).trigger('request_content');
		$(document).trigger('from_checklist_details');
	});
	
	//Bind Populate Invoice Detail(from:ChecklistDetails)
	$(document).bind('from_checklist_details',function(){
		var sy = $.trim($('#InvoiceSy').val());
		var sem = $.trim($('#InvoiceSem').val());
		var level = $.trim($('#InvoiceLevel').val());
		var type = $.trim($('#CurrType').val());
		var flag = sy.length&&sem.length&&level.length&&type.length;
	
		if (flag){
			var array = [
				{'product_type_id':'BK','tb_id':'#ChecklistTableBooks'},
				{'product_type_id':'SP','tb_id':'#ChecklistTableSupplies'},
				{'product_type_id':'OT','tb_id':'#ChecklistTableOthers'},
			];
			var index = 0;
			$.each(array,function(ctr,obj){
				$.ajax({
					url:BASE_URL+'checklists/forInvoice',
					dataType:'json',
					data:{'data':{'Checklist':{'sy':sy,'level':level,'product_type_id':obj.product_type_id,'type':type}}},
					type:'post',
					success:function(json){	
						$.each(json,function(i,o){
							var a = $(obj.tb_id).dataTable().fnAddData([
								'<input value="'+o.Product.id+'" name="data[InvoiceDetail]['+index+'][product_id]" class="product_id" type="text" disabled="disabled">',
								'<input class="bk_check_item" type="checkbox">',
								'&nbsp'+o.Product.name+'&nbsp',
								o.ChecklistDetail.qty,
								'<input name="data[InvoiceDetail]['+index+'][order]" type="text" class="order text-center" disabled="disabled">',
								'&nbsp'+o.ChecklistDetail.price+'&nbsp',
								'<span class="amount"></span>',
							]);
							var nTr = $(obj.tb_id).dataTable().fnSettings().aoData[ a[0] ].nTr;
							$('td', nTr)[0].setAttribute( 'class', 'hide' );
							$('td', nTr)[1].setAttribute( 'class', 'text-center' );
							$('td', nTr)[3].setAttribute( 'class', 'text-center qty' );
							$('td', nTr)[5].setAttribute( 'class', 'text-right price' );
							$('td', nTr)[6].setAttribute( 'class', 'text-right' );
							index++;
						});
					}
					
				}); 

			});
		}
	});
	
	//Delete Invoice Detail(Reassess)
	$('.intent-save').click(function(){
		var invoice_id= $('#InvoiceId').val();
		$.each( $('.product_id') ,function(i,e){
			$.ajax({
				url:BASE_URL+'invoice_details/reassess',
				dataType:'json',
				data:{'data':{'InvoiceDetail':{'product_id':$(e).val(),'invoice_id':invoice_id}}},
				type:'post',
				success:function(json){
					console.log(json);
				
				}
			});
		});
	});
	
	//meta on reassess
	$(document).on('click','.view-invoice_details',function(){
		$('.level').focus().blur();
	});

	$(document).on('click','.print',function(){
		$('#invoice_id').val($('#InvoiceId').val());
		setTimeout(function(){
			$('#PrintAssessment').submit();
		},0);
	});
	
	
	
});
