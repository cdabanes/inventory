<?php
require('formsheet.php');
class check extends Formsheet{
	protected static $_width = 4.25;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_available_line = 41;	
	protected static $_allot_subjects = 15;
	
	function check($data=null){
		$this->data =$data; 
		$this->showLines = !true;
		$this->FPDF(check::$_orient, check::$_unit,array(check::$_width,check::$_height));
		$this->createSheet();
	}
	
	function hdr($data,$meta){
		$metrics = array(
			'base_x'=> 0.2,
			'base_y'=> 0.3,
			'width'=> 3.867,
			'height'=> 1.2,
			'cols'=> 20,
			'rows'=> 8,	
		);
		$this->section($metrics);
		$this->GRID['font_size']=14;	
		$y = 1;
		$this->centerText(0,$y++,'CHILD JESUS OF PRAGUE SCHOOL',20,'b');
		$this->GRID['font_size']=9;	
		$this->centerText(0,$y++,'Brgy. Calumpang, Binangonan, Rizal, Philippines',20,'');
		$this->GRID['font_size']=13;
		$y ++;
		$this->centerText(0,$y++,'Bookstore Checklist',20,'b');
		$this->GRID['font_size']=9;
		$y ++;
		$this->leftText(0,$y,'SY: '.$meta['sy_str'],0,'');
		$this->leftText(12,$y++,'Date/Time: '.$data['Checklist']['created'],0,'');
		$this->leftText(0,$y,'Dept./Gr-Yr : '.$meta['level_str'],0,'');
		$this->leftText(12,$y++,'Curriculum Type : '.$data['Checklist']['type'],0,'');
	}
	
	function details($data,$meta){
		$metrics = array(
			'base_x'=> 0.2,
			'base_y'=> 1.8,
			'width'=> 3.867,
			'height'=> 0.85,
			'cols'=> 20,
			'rows'=> 4,	
		);	
		$this->section($metrics);
		$y = 0;
		$this->DrawLine($y,'h',array(0,20));
		$this->centerText(0,$y-0.5,'Checklist Details ',20,'b');	
		$y +=0.8;
		$this->GRID['font_size']=9;
		$this->leftText(0.2,$y,'Description ',0,'b');	
		$this->centerText(14,$y,'Qty ',3,'b');	
		$this->centerText(17,$y,'Price ',3,'b');	
		$y+=0.2;
		$this->DrawLine($y++,'h',array(0,20));
		//for($i=0;$i<10;$i++){
		foreach($data['ChecklistDetail'] as $details){
			$y-=0.2;
			$this->leftText(0.2,$y,$details['Product']['name'] ,0,'');	
			$this->centerText(14,$y,$details['qty'],3,'');	
			$this->rightText(19.5,$y++,$details['Product']['selling_price'],'','');
			$y+=0.2;
			
			check::$_available_line--;
			if(check::$_available_line == 0){	
				$this->createSheet();
				$this->hdr($data,$meta);
				$this->section($metrics);
				$y = 0;
				$this->DrawLine($y,'h',array(0,20));
				$this->centerText(0,$y-0.5,'Checklist Details ',20,'b');	
				$y +=0.8;
				$this->GRID['font_size']=9;
				$this->leftText(0.2,$y,'Description ',0,'b');	
				$this->centerText(14,$y,'Qty ',3,'b');	
				$this->centerText(17,$y,'Price ',3,'b');	
				$y+=0.2;
				$this->DrawLine($y++,'h',array(0,20));
				check::$_available_line=41;
			}
		}//}
		$this->centerText(0,$y,'========== ** Nothing Follows ** ==========',20,'');
	}
}	
?>
	