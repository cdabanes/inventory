<?php
require('formsheet.php');
class assess extends Formsheet{
	protected static $_width = 4.25;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_available_line = 37;	
	protected static $_curr_page = 1;
	protected static $_allot_subjects = 15;
	
	function assess($data=null){
		$this->data =$data; 
		$this->showLines = !true;
		$this->FPDF(assess::$_orient, assess::$_unit,array(assess::$_width,assess::$_height));
		$this->createSheet();
	}
	function hdr($data,$b_subt,$s_subt,$o_subt,$total,$meta){
		$metrics = array(
			'base_x'=> 0.133,
			'base_y'=> .3,
			'width'=> 3.867,
			'height'=> 1,
			'cols'=> 20,
			'rows'=> 7,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=14;	
		$y = 1;
		$this->centerText(0,$y++,'CHILD JESUS OF PRAGUE SCHOOL',20,'b');
		$this->GRID['font_size']=9;	
		$this->centerText(0,$y++,'Brgy. Calumpang, Binangonan, Rizal, Philippines',20,'');
		$this->GRID['font_size']=13;
		$y ++;
		$this->centerText(0,$y++,'Bookstore Assessment',20,'b');
		$this->GRID['font_size']=9;
		$y ++;
		$this->leftText(0,$y,'SY : '.$meta['sy_str'] ,0,'');
		$this->rightText(16,$y,'Semester : ',0,'');
		$this->leftText(16,$y++,' '.$data['Invoice']['sem'] ,0,'');
		$this->leftText(0,$y,'Dept / Level : '.$meta['level_str'],0,'');
		$this->rightText(16,$y,'Curriculum Type : ',0,'');
		$this->leftText(16,$y++,' '.$data['Invoice']['type'],0,'');
		$y+=0.5;
		$this->leftText(0,$y++,'Sub Total',0,'b');		
		$this->leftText(0,$y++,'Books: '.$b_subt,0,'');		
		$this->leftText(0,$y++,'Supplies: '.$s_subt,0,'');		
		$this->leftText(0,$y,'Others: '.$o_subt,0,'');		
		$this->rightText(16,$y,'Total : ',0,'b');
		$this->leftText(16,$y++,' '.$total,0,'');
	

	}
	
	function details($data,$books,$supplies,$others){
		$metrics = array(
			'base_x'=> 0.2,
			'base_y'=> 2.35,
			'width'=> 3.867,
			'height'=> 0.855,
			'cols'=> 20,
			'rows'=> 4,	
		);	
		$this->section($metrics);
		//Books
		$y = 0;
		$count = 0;
		$max = 37;
		if(count($books) != 0){
			$this->GRID['font_size']=13;
			$this->centerText(0,$y-0.5,'Books Details',20,'b');
			$this->GRID['font_size']=9;
			$this->DrawLine($y,'h',array(0,20));
			$y+=0.8;
			$this->leftText(0.2,$y,'Description ',0,'b');
			$this->centerText(8,$y,'Qty',2,'b');	
			$this->centerText(10,$y,'Order',2,'b');	
			$this->centerText(12,$y,'Price',4,'b');	
			$this->centerText(16,$y,'Amount',4,'b');
			$y+=0.2;
			$this->DrawLine($y++,'h',array(0,20));
			foreach($books as $b){
				$y-=0.2;
				$amount = $b['Product']['selling_price'] * $b['order'];
				$this->leftText(0.2,$y,$b['Product']['name'] ,0,'');	
				$this->centerText(8,$y,'',2,'');	
				$this->centerText(10,$y,$b['order'],2,'');	
				$this->rightText(15.75,$y,number_format($b['Product']['selling_price'], 2, '.', ','),'');	
				$this->rightText(19.75,$y++,number_format($amount, 2, '.', ','),'');
				$y+=0.2;
				
				assess::$_available_line--;
				if(assess::$_available_line==0){	
					$this->createSheet();
					$this->hdr($data,$b_subt,$s_subt,$o_subt,$total,$meta);
					$this->section($metrics);
					$y = 0;
					$this->GRID['font_size']=13;
					$this->centerText(0,$y-0.5,'Books Details',18,'b');
					$this->GRID['font_size']=9;
					$this->leftText(12.5,$y-0.5,'(continuation)',20,'');
					$this->DrawLine($y,'h',array(0,20));
					$y+=0.8;
					$this->leftText(0.2,$y,'Description ',0,'b');
					$this->centerText(11,$y,'Order',3,'b');	
					$this->centerText(14,$y,'Served',3,'b');	
					$this->centerText(17,$y,'Variance',3,'b');
					$y+=0.2;		
					$this->DrawLine($y++,'h',array(0,20));
			
					assess::$_available_line=34;
					assess::$_curr_page++;
					$count = 0;
					
				}
				$count++;
			}
			if($count < $max){
				$this->rightText(19,40,' Page '.assess::$_curr_page,'','');
				assess::$_available_line-=3;
				$count+=3;
			}
			$y+=1.2;
		}
		
		if(count($supplies) != 0){
			//Supplies
			
			$start_ = $y;
			$this->GRID['font_size']=13;
			$this->centerText(0,$y-0.5,'Supplies Details',20,'b');
			$this->GRID['font_size']=9;
			$this->DrawLine($y,'h',array(0,20));
			$y+=0.8;
			$this->leftText(0.2,$y,'Description ',0,'b');
			$this->centerText(8,$y,'Qty',2,'b');	
			$this->centerText(10,$y,'Order',2,'b');	
			$this->centerText(12,$y,'Price',4,'b');	
			$this->centerText(16,$y,'Amount',4,'b');
			$y+=0.2;
			$this->DrawLine($y++,'h',array(0,20));	
		
			foreach($supplies as $s){
				$y-=0.2;
				$amount = $s['Product']['selling_price'] * $s['order'];
				$this->leftText(0.2,$y,$s['Product']['name'] ,0,'');	
				$this->centerText(8,$y,'',2,'');	
				$this->centerText(10,$y,$s['order'],2,'');	
				$this->rightText(15.75,$y,number_format($s['Product']['selling_price'], 2, '.', ','),'');	
				$this->rightText(19.75,$y++,number_format($amount, 2, '.', ','),'');
				$y+=0.2;
				assess::$_available_line--;
				if(assess::$_available_line==0){		
					$this->createSheet();
					$this->hdr($data,$b_subt,$s_subt,$o_subt,$total,$meta);
					$this->section($metrics);
					$y = 0;
					$this->GRID['font_size']=13;
					$this->centerText(0,$y-0.5,'Supplies Details',17,'b');
					$this->GRID['font_size']=9;
					$this->leftText(12.5,$y-0.5,'(continuation)',20,'');
					$this->DrawLine($y,'h',array(0,20));
					$y+=0.8;
					$this->leftText(0.2,$y,'Description ',0,'b');
					$this->centerText(11,$y,'Order',3,'b');	
					$this->centerText(14,$y,'Served',3,'b');	
					$this->centerText(17,$y,'Variance',3,'b');
					$y+=0.2;		
					$this->DrawLine($y++,'h',array(0,20));
			
					assess::$_available_line=34;
					assess::$_curr_page++;
					$this->rightText(19,40,' Page '.assess::$_curr_page,'','');
					$count = 0;
				}
				$count++;
			}
			
			if($count < $max){
				$this->rightText(19,40,' Page '.assess::$_curr_page,'','');
				assess::$_available_line-=3;
				$count+=3;
			}
			$y+=1.2;
		}
		if(count($others) != 0){
			//Others
			$start_ = $y;
			$this->GRID['font_size']=13;
			$this->centerText(0,$y-0.5,'Others',20,'b');
			$this->GRID['font_size']=9;
			$this->DrawLine($y,'h',array(0,20));
			$y+=0.8;
			$this->leftText(0.2,$y,'Description ',0,'b');
			$this->centerText(8,$y,'Qty',2,'b');	
			$this->centerText(10,$y,'Order',2,'b');	
			$this->centerText(12,$y,'Price',4,'b');	
			$this->centerText(16,$y,'Amount',4,'b');
			$y+=0.2;
			$this->DrawLine($y++,'h',array(0,20));
			
			//pr($data);exit;
			foreach($others as $o){
					$y-=0.2;
					$amount = $o['Product']['selling_price'] * $o['order'];
					$this->leftText(0.2,$y,$o['Product']['name'] ,0,'');	
					$this->centerText(8,$y,'',2,'');	
					$this->centerText(10,$y,$o['order'],2,'');	
					$this->rightText(15.75,$y,number_format($o['Product']['selling_price'], 2, '.', ','),'');	
					$this->rightText(19.75,$y++,number_format($amount, 2, '.', ','),'');
					$y+=0.2;
					
					assess::$_available_line--;
					if(assess::$_available_line==0){
						$this->createSheet();
						$this->hdr($data,$b_subt,$s_subt,$o_subt,$total,$meta);
						$this->section($metrics);
						$y = 0;
						$this->GRID['font_size']=13;
						$this->centerText(0,$y-0.5,'Others',18,'b');
						$this->GRID['font_size']=9;
						$this->leftText(12.5,$y-0.5,'(continuation)',20,'');
						$this->DrawLine($y,'h',array(0,20));
						$y+=0.8;
						$this->leftText(0.2,$y,'Description ',0,'b');
						$this->centerText(11,$y,'Order',3,'b');	
						$this->centerText(14,$y,'Served',3,'b');	
						$this->centerText(17,$y,'Variance',3,'b');
						$y+=0.2;		
						$this->DrawLine($y++,'h',array(0,20));
						assess::$_available_line=34;
						assess::$_curr_page++;
						$this->rightText(19,40,' Page '.assess::$_curr_page,'','');
						$count = 0;
					}
				$count++;
			}
			if($count < $max){
				$this->rightText(19,40,' Page '.assess::$_curr_page,'','');
				assess::$_available_line-=3;
				$count+=3;
			}
		}
	}
	
}	
?>
	