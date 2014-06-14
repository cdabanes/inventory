<?php
class ReceivingReportsController extends AppController {

	var $name = 'ReceivingReports';

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$curr_data = $this->ReceivingReport->find('all');
			echo json_encode($curr_data);
			exit;
		}else{
			$this->ReceivingReport->recursive = 0;
			$this->set('receivingReports', $this->paginate());
		}
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid receiving report', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('receivingReport', $this->ReceivingReport->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReceivingReport->create();
			if ($this->ReceivingReport->save($this->data)) {
				$this->Session->setFlash(__('The receiving report has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving report could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid receiving report', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReceivingReport->save($this->data)) {
				$this->Session->setFlash(__('The receiving report has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving report could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReceivingReport->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for receiving report', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ReceivingReport->delete($id)) {
			$this->Session->setFlash(__('Receiving report deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Receiving report was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	protected function api($params){
		$schema = $this->ReceivingReport->schema();
		$conditions = array();
		$fields = array();
		$group = array();
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($fields,'ReceivingReport.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				case 'group':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($group,'ReceivingReport.'.$f);
							if(count($fields)==0){
								foreach($schema as $sk=>$sv){
									array_push($fields,'ReceivingReport.'.$sk);									
								}
							}
							if(!in_array('GROUP_CONCAT(ReceivingReport.id) as ids',$fields)){
								array_push($fields,'GROUP_CONCAT(ReceivingReport.id) as ids');
							}
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
					
				break;
				case 'page':
					$page = $val;
				break;
				case 'limit':
					$limit = $val;
				break;
				default:
					if(isset($schema[$key])){
						//$val = explode(" ", $val);
						$conditions['ReceivingReport.'.$key.' LIKE']=$val;
						pr($conditions);exit;
						
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->ReceivingReport->recursive = 1;

		return $this->ReceivingReport->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}	
}

