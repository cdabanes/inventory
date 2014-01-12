<?php
require('formsheet.php');
class form extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	protected static $_available_line = 37;	
	protected static $_curr_page = 1;
	protected static $_allot_subjects = 15;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function form($data,$user,$vendors){
		$this->user = $user;
		$this->data = $data;
		form::$page_count = ceil((count($data)+count($vendors)+1)/21);//Total Page Count

		$this->showLines = !true;
		$this->FPDF(form::$_orient, form::$_unit,array(form::$_width,form::$_height));
		$this->createSheet();
	}
	
	function hdr(){
		$metrics = array(
			'base_x'=> 0.15,
			'base_y'=> 0.1,
			'width'=> 12.7,
			'height'=> 0.5,
			'cols'=> 64,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=11;
		$this->centerText(0,$y++,'CHILD JESUS OF PRAGUE SCHOOL',64,'b');
		$this->GRID['font_size']=8;	
		$this->centerText(0,$y++,'SY 2013 - 2014',64,'');
		$this->centerText(0,$y++,'SUMMARY OF SALES PER PUBLISHER / LEVEL',64,'b');
	}
	
	function b_tmplte(){
		$metrics = array(
			'base_x'=> 0.15,
			'base_y'=>0.7,
			'width'=> 12.7,
			'height'=> 0.5,
			'cols'=> 64,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=8;
		$this->SetDrawColor(105,105,105);
		//Body Header Box
		//$this->leftText(0.2,0,'I am the header box :)',12,'b'); 
		$this->drawBox(0,0,64,45);
		$this->drawLine(1,'h',array(19,42));
		$this->drawLine(3,'h');
		$this->drawLine(5,'v',array(0,45));
		$this->drawLine(14 ,'v',array(0,45));
		$this->drawLine(16 ,'v',array(0,45));
		$this->drawLine(19 ,'v',array(0,45));
		$this->drawLine(21 ,'v',array(1,44));
		$this->drawLine(24 ,'v',array(1,44));
		$this->drawLine(27 ,'v',array(1,44));
		$this->drawLine(31 ,'v',array(0,45));
		$this->drawLine(33 ,'v',array(1,44));
		$this->drawLine(36 ,'v',array(1,44));
		$this->drawLine(40 ,'v',array(1,44));
		$this->drawLine(44 ,'v',array(1,44));
		$this->drawLine(48 ,'v',array(0,45));
		$this->drawLine(51 ,'v',array(1,44));
		$this->drawLine(54 ,'v',array(1,44));
		$this->drawLine(57 ,'v',array(1,44));
		$this->drawLine(61 ,'v',array(0,45));
		//End of Body Header Box
		
		//Body Header Label
		$this->centerText(19,0.75,'PURCHASED',12,'b'); 
		$this->centerText(31,0.75,'SALES',17,'b');
		$this->centerText(48,0.75,'RETURNED',10,'b');
		$this->centerText(0,2.7,'Publisher',5,'b');
		$this->centerText(5,2.7,'Book Title',9,'b');
		$this->centerText(14,2,'Gr/Yr',2,'b');
		$this->centerText(14,2.7,'Level',2,'b');
		$this->centerText(16,2,'Beginning',3,'b');
		$this->centerText(16,2.7,'Inventory',3,'b');
		$this->centerText(19,2,'PO',2,'b');
		$this->centerText(19,2.7,'QTY',2,'b');
		$this->GRID['font_size']=6.5;
		$this->centerText(21,2,"SUPPLIER'S",3,'b');
		$this->centerText(21,2.7,'PRICE',3,'b');
		$this->GRID['font_size']=8;
		$this->centerText(24,2.7,'Amount',3,'b');
		$this->centerText(27,2.7,'Total',4,'b');	
		$this->GRID['font_size']=6.5;
		$this->centerText(31,2,'QTY',2,'b');
		$this->centerText(31,2.7,'SOLD',2,'b');
		$this->centerText(33,2,'SELLING',3,'b');
		$this->centerText(33,2.7,'PRICE',3,'b');
		$this->GRID['font_size']=8;
		$this->centerText(36,2.7,'Amount',4,'b');
		$this->centerText(40,2.7,'Total',4,'b');
		$this->GRID['font_size']=6.5;
		$this->centerText(44,2.7,'NET INCOME',4,'b');
		$this->centerText(48,2,'QTY',3,'b');
		$this->centerText(48,2.7,'RETURNED',3,'b');
		$this->centerText(51,2,'RETURNED',3,'b');	
		$this->centerText(51,2.7,'PRICE',3,'b');
		$this->centerText(54,2,'RETURNED',3,'b');
		$this->centerText(54,2.7,'AMOUNT',3,'b');
		$this->GRID['font_size']=8;
		$this->centerText(57,2.7,'Total',4,'b');
		$this->centerText(61,2,'Ending',3,'b');
		$this->centerText(61,2.7,'Inventory',3,'b');
		//End of Body Header Label
		
		//Body Multiple Line
		$this->DrawMultipleLines(5,44,2,'h');
		//End of Body Multiple Line 

	}
	
	function b_dta(){
		$data = $this->data;
		$data_count = count($data);
		$metrics = array(
			'base_x'=> 0.15,
			'base_y'=>0.7,
			'width'=> 12.7,
			'height'=> 0.5,
			'cols'=> 64,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$this->SetDrawColor(112,128,144);
		
		//VARIABLE INIT
		$y =4;
		$line_ctr =1;
		$prev_vndr = $data[0]['vendors']['company'];
		$new_publisher =1;
		
		//Per Publisher Totals 
		$purchased_total = 0;
		$returned_total = 0;
		$sales_total = 0;
		$net_income_total = 0;
		//End
		
		//Over All Total
		$over_all_total = array(
			'purchased'=>0,
			'sales'=>0,
			'returned'=>0,
			'net_income'=>0,
		);
		//End
	
		
		$this->GRID['font_size']=7.5;
		foreach($data as $k => $d){
			//Variable Init
			$po_amnt = $d['receiving_report_details']['qty']*$d['receiving_report_details']['price'];
			$sales_amnt = $d[0]['sold']*$d['products']['selling_price'];
			$net_income = ($d['products']['selling_price']-$d['receiving_report_details']['price'])*$d[0]['sold'];
			$ret_amnt = $d['return_details']['qty']*$d['return_details']['price'];
			$ndng_invt = $d['products']['initial_qty']+$d['receiving_report_details']['qty']-$d[0]['sold']-$d['return_details']['qty'];
				
			
			if($prev_vndr != $d['vendors']['company']){	
				$new_publisher =1;
				$y+=2; $line_ctr++;// Responsible for adding new line

				//Light steel blue line
				$this->SetFillColor(176,196,222);
				$this->drawBox(0,$y-3,64,2,'F');
				$this->drawLine(5,'v',array($y-3,2)); //redraw vertical lines
				$this->drawLine(14,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(16,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(19,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(21,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(24,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(27,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(31,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(33,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(36,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(40,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(44,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(48,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(51,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(54,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(57,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(61,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine(64,'v',array($y-3,2));//redraw vertical lines
				$this->drawLine($y-1,'h');
				$this->drawLine($y-3,'h');
				//$this->leftText(0.2,$y-2,"I am the light steel blue line :)",'','b');
				//End
			
				//Populate Totals
				$this->rightText(30.85,$y-2,number_format($purchased_total, 2, '.', ','),'','b');
				$this->rightText(60.85,$y-2,number_format($returned_total, 2, '.', ','),'','b');
				$this->rightText(43.85 ,$y-2,number_format($sales_total, 2, '.', ','),'','b');
				$this->rightText(47.85 ,$y-2,number_format($net_income_total, 2, '.', ','),'','b');
				//End
				
				//Reinit Variable
				$purchased_total = 0;
				$returned_total = 0;
				$sales_total = 0;
				$net_income_total = 0;
				$prev_vndr = $d['vendors']['company'];
			}
			
			//Create New Sheet
			if($line_ctr >= 22){
				form::$curr_page ++; //Increment Page Number
				$line_ctr = 1;//Reset Line Counter
				$y = 4;
				$this->createSheet();
				$this->hdr();
				$this->ftr();
				$this->b_tmplte();
			}
			
			//Print New Publisher Company Name
			if($new_publisher){
				$new_publisher = 0;
				$this->fitParagraph(0.2,$y-0.2,$d['vendors']['company'] ,1,'l',1);
			}
			
			//Incrementing Totals for each loop
			$purchased_total = $purchased_total+$po_amnt;
			$returned_total = $returned_total+$ret_amnt;
			$sales_total = $sales_total+$sales_amnt;
			$net_income_total = $net_income_total+$net_income;
			
			$over_all_total['purchased'] = $over_all_total['purchased'] + $po_amnt;
			$over_all_total['returned'] = $over_all_total['returned'] + $ret_amnt;
			$over_all_total['sales'] = $over_all_total['sales'] + $sales_amnt;
			$over_all_total['net_income'] = $over_all_total['net_income'] + $net_income;
			//End
		
			//Populate Other Details Data
			$this->fitParagraph(5.2,$y-0.2,$d['products']['name'],5.25,'l',1);
			$this->centerText(16,$y-0.2,$d['products']['initial_qty'],3,'');
			$this->centerText(19,$y-0.2,$d['receiving_report_details']['qty'],2,'');
			$this->rightText(23.85,$y-0.2,$d['receiving_report_details']['price'],'','');
			$this->rightText(26.85,$y-0.2,number_format($po_amnt, 2, '.', ','),'','');
			$this->centerText(31,$y-0.2,$d[0]['sold'],2,'');
			$this->rightText(35.85,$y-0.2,$d['products']['selling_price'],'','');
			$this->rightText(39.75,$y-0.2,number_format($sales_amnt, 2, '.', ','),'','');
			$this->rightText(47.85,$y-0.2,number_format($net_income, 2, '.', ','),'','');
			$this->centerText(48,$y-0.2,$d['return_details']['qty'],3,'');
			$this->rightText(53.85,$y-0.2,$d['return_details']['price'],'','');
			$this->rightText(56.85,$y-0.2,number_format($ret_amnt, 2, '.', ','),'','');
			$this->centerText(61,$y-0.2,$ndng_invt,3,'');
			//End
		
			$y+=2;	$line_ctr++;// Responsible for adding new line
			
			if(($k+1) == $data_count){ // Line for last publisher totals
				//Last light steel blue line
				$this->SetFillColor(176,196,222);
				$this->drawBox(0,$y-1,64,2,'F');
				$this->drawLine(5,'v',array($y-1,2));
				$this->drawLine(14,'v',array($y-1,2));
				$this->drawLine(16,'v',array($y-1,2));
				$this->drawLine(19,'v',array($y-1,2));
				$this->drawLine(21,'v',array($y-1,2));
				$this->drawLine(24,'v',array($y-1,2));
				$this->drawLine(27,'v',array($y-1,2));
				$this->drawLine(31,'v',array($y-1,2));
				$this->drawLine(33,'v',array($y-1,2));
				$this->drawLine(36,'v',array($y-1,2));
				$this->drawLine(40,'v',array($y-1,2));
				$this->drawLine(44,'v',array($y-1,2));
				$this->drawLine(48,'v',array($y-1,2));
				$this->drawLine(51,'v',array($y-1,2));
				$this->drawLine(54,'v',array($y-1,2));
				$this->drawLine(57,'v',array($y-1,2));
				$this->drawLine(61,'v',array($y-1,2));
				$this->drawLine(64,'v',array($y-1,2));
				$this->drawLine($y-1,'h');
				$this->drawLine($y+1,'h');
				//$this->leftText(0.2,$y,"I am the last light steel blue line :)",'','b');
				//End
			
				//Populate Total
				$this->rightText(30.85,$y,number_format($purchased_total, 2, '.', ','),'','b');
				$this->rightText(60.85,$y,number_format($returned_total, 2, '.', ','),'','b');
				$this->rightText(43.85,$y,number_format($sales_total, 2, '.', ','),'','b');
				$this->rightText(47.85,$y,number_format($net_income_total, 2, '.', ','),'','b');
				//End
			}
		}		
		$line_ctr++;
		$y+=2;
		
		//Create New Sheet
		if($line_ctr >= 22){
			form::$curr_page ++; //Increment Page Number
			$line_ctr = 1;//Reset Line Counter
			$y = 4;
			$this->createSheet();
			$this->hdr();
			$this->ftr();
			$this->b_tmplte();
		}
		
		//Over All Total
		$this->leftText(0.2,$y,'TOTAL','','b');
		$this->rightText(30.85,$y,number_format($over_all_total['purchased'], 2, '.', ','),'','b');
		$this->rightText(60.85,$y,number_format($over_all_total['returned'], 2, '.', ','),'','b');
		$this->rightText(43.85,$y,number_format($over_all_total['sales'], 2, '.', ','),'','b');
		$this->rightText(47.85,$y,number_format($over_all_total['net_income'], 2, '.', ','),'','b');
		
	}
	
	function ftr(){
		$metrics = array(
			'base_x'=> 0.15,
			'base_y'=> 8.2,
			'width'=> 12.7,
			'height'=> 0.5,
			'cols'=> 64,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$this->leftText(0.5,1,'Printed : '.$this->user.'     Date: '.date("F j, Y, g:i a"),'','');
		$this->rightText(63.5,1,'Page '. form::$curr_page .' of '.form::$page_count,'','');
	}
	
	function no_data(){
		$metrics = array(
				'base_x'=> 0.15,
				'base_y'=> 0,
				'width'=> 12.7,
				'height'=> 0.5,
				'cols'=> 64,
				'rows'=> 3,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=20;
		$this->centerText(0,23,'NO RECORDS FOUND',64,'b');
	}
		
}
?>
	