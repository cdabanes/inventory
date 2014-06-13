var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
	$('input').attr('autocomplete','off');

	$('#BooksTable').dataTable({
		"bLengthChange": false,
		"bFilter": false,
		"bSort": true,
		"bInfo": false,
		"bPaginate": false,
		"bScrollCollapse": true,
	});
	$('#SuppliesTable').dataTable({
		"bLengthChange": false,
		"bFilter": false,
		"bSort": true,
		"bInfo": false,
		"bPaginate": false,
		"bScrollCollapse": true,
	});
	$('#OthersTable').dataTable({
		"bLengthChange": false,
		"bFilter": false,
		"bSort": true,
		"bInfo": false,
		"bPaginate": false,
		"bScrollCollapse": true,
	});
	
	
	//Check All
	$(document).on('click','.checkall',function(){
		var isCheck =  $(this).is(':checked');
		var table = $(this).parents('table:first');
		var check_items = table.find('tbody .bk_check_item');
		
	 	if(isCheck){
			table.find('tbody .bk_check_item').prop('checked', true).change();
			table.find('.served:first').select();
			table.find('tbody tr').addClass('selected','selected');	
		}else{
			table.find('tbody .bk_check_item').prop('checked', false).change();
			table.find('tr').removeClass('selected');
		}
	});	
	
	// Check Item		
	$(document).on('change','.bk_check_item',function(){
		var isCheck =  $(this).is(':checked');
		var row = $(this).parents('tr:first');
		var order = $(row).find('.order');
		var served =  $(row).find('.served');
		var variance =  $(row).find('.variance');
	
		if(isCheck){
			$(served).val($(order).val()).change().select();
		}else{
			$(served).val(0);
			$(variance).val($(order).val());
		}			
		if(isCheck){
			$(row).addClass('selected');
		}else{
			$(this).parents('table:first').find('thead .check_all').removeAttr('checked');
			$(row).removeClass('selected');
		}
	});
	
	//Variance
	$(document).on('change','.served',function(e){
		e.preventDefault();
		var row = $(this).parents('tr:first');
		var served = $(this).val();
		var order = row.find('.order').val();

		if(served != ''){
			if(served > order){
				$(this).val(order);
				row.find('.variance').val(0);
			}else{
				$(row).find('.variance').val(order-served);
			}
		}
	});
	
	//Populate Details
	$('#IssueOutInvoiceNo').change(function(){
		var invNo = $(this).val();
		var flag = invNo.length;
		if(flag){
			$.ajax({
				url:BASE_URL+'invoices/forIssueOut',
				dataType:'json',
				data:{'data':{'Invoice':{'invoice_no':invNo}}},
				type:'post',
				success:function(json){
					$(document).trigger('request_content');
					console.log(json);
					if(json.length){
						if(json[0].Invoice.status == "Issued"){
							$.ajax({
								url:BASE_URL+'issue_outs/backOrders',
								dataType:'json',
								data:{'data':{'IssueOut':{'invoice_no':invNo}}},
								type:'post',
								success:function(json){	
									console.log(json);
									$('#IssueOutId').val(json.IssueOut.id);
									$('#IssueOutFullName').val(json.IssueOut.full_name);
									$('#IssueOutYearType').val(json.IssueOut.year_type);
									$.each(json.IssueOutDetail,function(i,o){
										switch(o.Product.product_type_id){
											case "BK": 
												var table = "#BooksTable";
												break;
											case "SP": 
												var table = "#SuppliesTable";
												break;
											case "OT": 
												var table = "#OthersTable";
												break;
										}

										var a = $(table).dataTable().fnAddData([
											'<input value="'+o.product_id+'" name="data[IssueOutDetail]['+i+'][product_id]" class="product_id" type="text">',
											'<input class="bk_check_item" type="checkbox">',
											'&nbsp'+o.Product.name+'&nbsp',
											'<input value="'+o.variance+'" type="text" class="text-center order" readonly="readonly" onfocus="blur()">',
											'<input name="data[IssueOutDetail]['+i+'][served]" value="0" type="text" class="text-center served">',
											'<input name="data[IssueOutDetail]['+i+'][variance]" value="'+o.variance+'" type="text" class="text-center variance" readonly="readonly" onfocus="blur()">',
											'<input value="'+o.id+'" name="data[IssueOutDetail]['+i+'][id]" class="id" type="text">',
											'<input value="'+o.served+'" name="data[IssueOutDetail]['+i+'][no_of_already_served]" type="text">',
											'<input value="'+o.Product.item_code+'" type="text" class="item_code">',
										]);
										var nTr = $(table).dataTable().fnSettings().aoData[ a[0] ].nTr;
										$('td', nTr)[0].setAttribute( 'class', 'hide' );
										$('td', nTr)[1].setAttribute( 'class', 'text-center' );
										$('td', nTr)[3].setAttribute( 'class', 'text-center' );
										$('td', nTr)[5].setAttribute( 'class', 'text-center' ); 
										$('td', nTr)[6].setAttribute( 'class', 'hide' ); 
										$('td', nTr)[7].setAttribute( 'class', 'hide' ); 
										$('td', nTr)[8].setAttribute( 'class', 'hide' ); 
									});
								}
							});
							
						
						}else{
							$('#IssueOutFullName').val(json[0].Invoice.full_name);
							$('#IssueOutYearType').val(json[0].Invoice.level+' / '+json[0].Invoice.type);
							$.each(json,function(i,o){
								switch(o.Product.product_type_id){
									case "BK": 
										var table = "#BooksTable";
										break;
									case "SP": 
										var table = "#SuppliesTable";
										break;
									case "OT": 
										var table = "#OthersTable";
										break;
								}

								var a = $(table).dataTable().fnAddData([
									'<input value="'+o.Product.id+'" name="data[IssueOutDetail]['+i+'][product_id]" class="product_id" type="text">',
									'<input class="bk_check_item" type="checkbox">',
									'&nbsp'+o.Product.name+'&nbsp',
									'<input name="data[IssueOutDetail]['+i+'][order]" value="'+o.InvoiceDetail.order+'" type="text" class="text-center order" readonly="readonly" onfocus="blur()">',
									'<input name="data[IssueOutDetail]['+i+'][served]"  value="0" type="text" class="text-center served">',
									'<input name="data[IssueOutDetail]['+i+'][variance]" value="'+o.InvoiceDetail.order+'" type="text" class="text-center variance" readonly="readonly" onfocus="blur()">',
									'<input name="data[IssueOutDetail]['+i+'][id]" class="id" type="text">',
									'<input value="0" name="data[IssueOutDetail]['+i+'][no_of_already_served]" type="text">',
									'<input value="'+o.Product.item_code+'" type="text" class="item_code">',
								]);
								var nTr = $(table).dataTable().fnSettings().aoData[ a[0] ].nTr;
								$('td', nTr)[0].setAttribute( 'class', 'hide' );
								$('td', nTr)[1].setAttribute( 'class', 'text-center' );
								$('td', nTr)[3].setAttribute( 'class', 'text-center' );
								$('td', nTr)[5].setAttribute( 'class', 'text-center' );
								$('td', nTr)[6].setAttribute( 'class', 'hide' );
								$('td', nTr)[7].setAttribute( 'class', 'hide' );
								$('td', nTr)[8].setAttribute( 'class', 'hide' ); 
							});
						}
					}else{
						$('#intent-modal').modal('hide');
						$('#warning .modal-body').html('No assessment found!!');
						$('#warning').modal('show');
						$(document).on('click',function(){
							$('#warning').modal('hide');		
							$('#intent-modal').modal('show');
							setTimeout(function() {
								$('#IssueOutInvoiceNo').focus().select();
							}, 500);
						});
					}
				}		
			});
		
		}
	});
	
	//Populate Details
	$('#IssueOutFullName').change(function(){
		var name = $(this).val();
		var flag = name.length;
		if(flag){
			$.ajax({
				url:BASE_URL+'invoices/forIssueOutName',
				dataType:'json',
				data:{'data':{'Invoice':{'name':name}}},
				type:'post',
				success:function(json){
					console.log(json);
					$(document).trigger('request_content');
					if(json.length){
						if(json[0].Invoice.status == "Issued"){
							$.ajax({
								url:BASE_URL+'issue_outs/backOrdersName',
								dataType:'json',
								data:{'data':{'IssueOut':{'name':name}}},
								type:'post',
								success:function(json){	
									console.log(json);
									$('#IssueOutId').val(json.IssueOut.id);
									$('#IssueOutInvoiceNo').val(json.IssueOut.invoice_no);
									$('#IssueOutYearType').val(json.IssueOut.year_type);
									$.each(json.IssueOutDetail,function(i,o){
										switch(o.Product.product_type_id){
											case "BK": 
												var table = "#BooksTable";
												break;
											case "SP": 
												var table = "#SuppliesTable";
												break;
											case "OT": 
												var table = "#OthersTable";
												break;
										}

										var a = $(table).dataTable().fnAddData([
											'<input value="'+o.product_id+'" name="data[IssueOutDetail]['+i+'][product_id]" class="product_id" type="text">',
											'<input class="bk_check_item" type="checkbox">',
											'&nbsp'+o.Product.name+'&nbsp',
											'<input value="'+o.variance+'" type="text" class="text-center order" readonly="readonly" onfocus="blur()">',
											'<input name="data[IssueOutDetail]['+i+'][served]" value="0" type="text" class="text-center served">',
											'<input name="data[IssueOutDetail]['+i+'][variance]" value="'+o.variance+'" type="text" class="text-center variance" readonly="readonly" onfocus="blur()">',
											'<input value="'+o.id+'" name="data[IssueOutDetail]['+i+'][id]" class="id" type="text">',
											'<input value="'+o.served+'" name="data[IssueOutDetail]['+i+'][no_of_already_served]" type="text">',
											'<input value="'+o.Product.item_code+'" type="text" class="item_code">',
										]);
										var nTr = $(table).dataTable().fnSettings().aoData[ a[0] ].nTr;
										$('td', nTr)[0].setAttribute( 'class', 'hide' );
										$('td', nTr)[1].setAttribute( 'class', 'text-center' );
										$('td', nTr)[3].setAttribute( 'class', 'text-center' );
										$('td', nTr)[5].setAttribute( 'class', 'text-center' ); 
										$('td', nTr)[6].setAttribute( 'class', 'hide' ); 
										$('td', nTr)[7].setAttribute( 'class', 'hide' ); 
										$('td', nTr)[8].setAttribute( 'class', 'hide' ); 
									});
								}
							});
							
						
						}else{
							$('#IssueOutInvoiceNo').val(json[0].Invoice.invoice_no);
							$('#IssueOutYearType').val(json[0].Invoice.level+' / '+json[0].Invoice.type);
							$.each(json,function(i,o){
								switch(o.Product.product_type_id){
									case "BK": 
										var table = "#BooksTable";
										break;
									case "SP": 
										var table = "#SuppliesTable";
										break;
									case "OT": 
										var table = "#OthersTable";
										break;
								}

								var a = $(table).dataTable().fnAddData([
									'<input value="'+o.Product.id+'" name="data[IssueOutDetail]['+i+'][product_id]" class="product_id" type="text">',
									'<input class="bk_check_item" type="checkbox">',
									'&nbsp'+o.Product.name+'&nbsp',
									'<input name="data[IssueOutDetail]['+i+'][order]" value="'+o.InvoiceDetail.order+'" type="text" class="text-center order" readonly="readonly" onfocus="blur()">',
									'<input name="data[IssueOutDetail]['+i+'][served]"  value="0" type="text" class="text-center served">',
									'<input name="data[IssueOutDetail]['+i+'][variance]" value="'+o.InvoiceDetail.order+'" type="text" class="text-center variance" readonly="readonly" onfocus="blur()">',
									'<input name="data[IssueOutDetail]['+i+'][id]" class="id" type="text">',
									'<input value="0" name="data[IssueOutDetail]['+i+'][no_of_already_served]" type="text">',
									'<input value="'+o.Product.item_code+'" type="text" class="item_code">',
								]);
								var nTr = $(table).dataTable().fnSettings().aoData[ a[0] ].nTr;
								$('td', nTr)[0].setAttribute( 'class', 'hide' );
								$('td', nTr)[1].setAttribute( 'class', 'text-center' );
								$('td', nTr)[3].setAttribute( 'class', 'text-center' );
								$('td', nTr)[5].setAttribute( 'class', 'text-center' );
								$('td', nTr)[6].setAttribute( 'class', 'hide' );
								$('td', nTr)[7].setAttribute( 'class', 'hide' );
								$('td', nTr)[8].setAttribute( 'class', 'hide' ); 
							});
						}
					}else{
						$('#intent-modal').modal('hide');
						$('#warning .modal-body').html('No assessment found!!');
						$('#warning').modal('show');
						$(document).on('click',function(){
							$('#warning').modal('hide');		
							$('#intent-modal').modal('show');
							setTimeout(function() {
								$('#IssueOutInvoiceNo').focus().select();
							}, 500);
						});
					}
				}		
			});
		
		}
	});

	//Request content
	$(document).bind('request_content',function(){
		$('#BooksTable').dataTable().fnClearTable();
		$('#SuppliesTable').dataTable().fnClearTable();
		$('#OthersTable').dataTable().fnClearTable();
	});
	
	//barcode
	$(document).on('keydown','#BarCode',function(e){	
		if(e.which == 13){
			e.preventDefault();
			var itemCode = $(this).val();
			$.each($('.item_code'),function(i,o){
				var barcoded = $(o).val();
				//console.log(barcoded);
				if(barcoded == itemCode){
					//$(o).parents('tr:first').find('.bk_check_item').click().change();
					$(o).parents('tr:first').find('.bk_check_item').prop('checked', true).change();	
				}
			});
		} 
	});


	
});