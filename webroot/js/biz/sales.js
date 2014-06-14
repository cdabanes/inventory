var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';

$(document).ready(function(){
	$('input').attr('autocomplete','off');
 	$('#ProductsTable').dataTable({
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bSort": true,
		"bInfo": false,
		"bScrollCollapse": true,
		"iDisplayLength": 12,
		//"sPaginationType": "full_numbers"
	});
	$('#SalesTable').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bScrollCollapse": false,
		"iDisplayLength": 2,
	});

	/****************************************UPDATE TABLE**********************************************/
	$(document).bind('UpdateProductsTable', function(e){
		$.get( BASE_URL+'products/getAllproducts', function( data){
			$('#ProductsTable').dataTable().fnClearTable();
			var json = $.parseJSON(data);
			$.each(json,function(i,o){
				var a = $('#ProductsTable').dataTable().fnAddData( [
					o.Product.id,
					'&nbsp'+o.Product.name+'&nbsp',
					'&nbsp'+o.Product.selling_price+'&nbsp',
					'&nbsp'+o.Product.item_code+'&nbsp',
				]);
				var nTr = $('#ProductsTable').dataTable().fnSettings().aoData[ a[0] ].nTr;
				$('td', nTr)[0].setAttribute( 'class', 'id hide' );
				$('td', nTr)[1].setAttribute( 'class', 'name' );
				$('td', nTr)[2].setAttribute( 'class', 'price' );
				$('td', nTr)[3].setAttribute( 'class', 'item_code hide' );
			});			
		}); 
	}).trigger('UpdateProductsTable');
	
	$(document).on('click','#ProductsTable tbody tr',function(){
		var id = $(this).find('.id').text();
		var name = $(this).find('.name').text();
		var price = $(this).find('.price').text();
		
		var a = $('#SalesTable').dataTable().fnAddData( [
			id,
			name,
			'<input value="'+1+'" name="data[Sale][amount]" type="text" class="text-center" autocomplete="off">',
			price,
			price,
			'<a href="#" class="action-cancel" >X</a>',
		]);
		var nTr = $('#SalesTable').dataTable().fnSettings().aoData[ a[0] ].nTr;
		$('td', nTr)[0].setAttribute( 'class', 'id hide' );
		$('td', nTr)[1].setAttribute( 'class', 'name' );
		$('td', nTr)[2].setAttribute( 'class', 'qty' );
		$('td', nTr)[3].setAttribute( 'class', 'price money' );
		$('td', nTr)[4].setAttribute( 'class', 'amount money' );
		$('td', nTr)[5].setAttribute( 'class', 'text-center' );
		$('#SalesTable .qty input:last').focus().select();

	});
	
	
	
	//Barcode purpose
	$('#ProductsTable_filter input').keypress(function(e){
		if(e.which == 13){
			if($('#ProductsTable tbody tr').length == 1){
				$('#ProductsTable tbody ').find('td.item_code').click();
				$(this).val('');
			}
		}
	});
	
	//X button
	$(document).on('click','.action-cancel',function(){
		var row = $(this).parents('tr:first');
		var index = $('tr', $(this).closest("#SalesTable")).index(row)-1;
		$('#SalesTable').dataTable().fnDeleteRow( index );
;
	});
});