var UNITS_NAME = [];
var UNITS_ALIAS = [];
var PRODUCTS = [];
var PRODUCTS_DESC = [];
var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
	$('input').attr('autocomplete','off');//Disabled default HTML auto complete
	/*************************************UNIT**************************************************/
	$('#ProductUnit').append('<option class="create" value="CreateNewUnit">Create New</option>');	
	$(document).on('change','#ProductUnit',function(){
		if($(this).val() == "CreateNewUnit"){
			$("#add-unit").modal('show');
			$("#intent-modal").modal('hide');		
		}
	});
	//REPOPULATE UNIT OPTIONS
 	$(document).on('click','.unit-save',function(e){
		e.preventDefault();	
		$('#UnitAddForm').ajaxSubmit();
		$("#intent-modal").modal('show');
		$("#add-unit").modal('hide');
		$.ajax({
			url:BASE_URL+'products/getUnits.json',
			method:'post',
			dataType:'json',
			success:function(json){
				$('#ProductUnit option').remove();
				$('#ProductUnit').append('<option value="">Select</option>');
				$.each(json.data,function(ctr,obj){
					$('#ProductUnit').append('<option value="'+obj.Unit.id+'">'+obj.Unit.name+'</option>');
				});
				$('#ProductUnit').append('<option class="create" value="CreateNewUnit">Create New</option>'); 
				$('#ProductUnit').val($('#ProductUnit option:not(.create):last').val());
			}
		});
	});
	$(document).on('click','.unit-cancel',function(e){
		$("#intent-modal").modal('show');
		$("#add-unit").modal('hide');
		$('#ProductUnit').val('');
	});
	//UNIT TYPEAHEAD
	$.ajax({
		url:BASE_URL+'products/getUnits.json',
		method:'post',
		dataType:'json',
		success:function(json){
			$.each(json.data,function(ctr,obj){ 
				UNITS_NAME.push(obj.Unit.name);
				UNITS_ALIAS.push(obj.Unit.alias);
			});
			$("#UnitName").typeahead({source: UNITS_NAME});
			$("#UnitAlias").typeahead({source: UNITS_ALIAS});
		}
	});
	/***********************************END******************************************************/
	
	/*******************************PRODUCT DESC AND ITEMCODE***********************************/
	//PRODUCT INIT AND TYPEAHEAD
	$(document).bind('getProductItems',function(){
		$.ajax({
			url:BASE_URL+'products.json',
			method:'post',
			dataType:'json',
			success:function(json){
				PRODUCTS = [];
				PRODUCTS_DESC = [];
				PRODUCTS = json;
				$.each(json.data,function(ctr,obj){
					PRODUCTS_DESC.push(obj.Product.name);
				});
				$(".desc").typeahead({source: PRODUCTS_DESC,items:4});	
			}
		});
	}).trigger('getProductItems');	
	//VALIDATE PRODUCT DESC EVENT HANDLER
	$(document).on('blur','.desc',function(){
		$(document).trigger('getProductItems');
		var name = $('#ProductName').val();
		$('#ProductID').val('');
		$.each(PRODUCTS.data,function(ctr,obj){
			if(name == obj.Product.name && $('.nowarning').val() != 1){
				$('#intent-modal').modal('hide');
				$('#warning').modal('show').find('.modal-body').html('Item name already in used!');
			}
		}); 
	});
	//VALIDATE ITEM CODE
	$(document).on('blur','#ProductItemCode',function(){
		var itemcode = $(this).val();
		$('#ProductID').val('');
		$.each(PRODUCTS.data,function(ctr,obj){
			if(itemcode == obj.Product.item_code && $('.nowarning').val() != 1){
				$('#intent-modal').modal('hide');
				$('#warning').modal('show').find('.modal-body').html('Item code already in use!');
				$('input,select').val('');
			}
		}); 
	});
	//ITEM CODE AUTO GENERATE EVENT HANDLER
	$(document).on('keydown','#ProductItemCode',function(e){	
		(e.altKey && e.which == 65)?$(this).val('(Auto Generate)'):'';
		if(e.which == 13){
			e.preventDefault();
			$('#ProductName').focus().select();
		}
	});	
	$(document).on('click','.warning-back',function(e){
		$('#warning').modal('hide');
		$('#intent-modal').modal('show');
		$('#intent-modal').find('select,input').val('');
	});	
	/***********************************END******************************************************/
	
	//VALIDATE MAX/MIN
	$('.save-product').hover(function(){
		var max = parseInt($('#ProductMax').val());
		var min = parseInt($('#ProductMin').val());
		if(max != '' && min != '' && max < min){
			$("#warning").modal('toggle');//warning modal
			$("#warning .modal-body").html('<span>Stock Level max should be greater than min! </span>');
			$(this).attr('disabled','disabled');
		}
	});
	//MAKE AVG COST TWO DECIMAL PLACES
	$('.money').blur(function(){
		($(this).val() != '')?$(this).val(parseFloat($(this).val()).toFixed(2)):'';
	});
	//COMPUTE SRP
	$(document).on('change','#ProductAvgPrice,#ProductMarkupUnit,#ProductMarkupValue',function(){	
		var avg_price = $('#ProductAvgPrice').val();
		var markup_unit = $('#ProductMarkupUnit').val();
		var mu_value = $('#ProductMarkupValue').val();
		var flag = avg_price.length && markup_unit.length && mu_value.length;
		var srp = 0;
		if(flag){
			if(markup_unit == 'Php'){
				srp = parseFloat(mu_value)+parseFloat(avg_price);
				$('#ProductSellingPrice').val((srp).toFixed(2)).select();
			}else if(markup_unit == '%'){
				srp = parseFloat(avg_price)+(parseFloat(avg_price)*parseFloat(mu_value)/100);
				$('#ProductSellingPrice').val((srp).toFixed(2)).select();
			}
		}
	});
});