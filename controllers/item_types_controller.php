<?php
class ItemTypesController extends AppController {

	var $name = 'ItemTypes';

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$curr_data = $this->ItemType->find('all');
			echo json_encode($curr_data);
			exit;
		}else{
			$itemTypes = $this->ItemType->find('list');
			$this->set(compact('itemTypes'));
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid item type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('itemType', $this->ItemType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ItemType->create();
			
			if ($this->ItemType->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/canteen/img/icons/tick.png" />&nbsp; Saving successful';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Saving successful...', true));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = '<img src="/canteen/img/icons/exclamation.png" />&nbsp; The item type could not be saved. Please, try again.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
				$this->Session->setFlash(__('The item type could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemType->save($this->data)) {
				$this->Session->setFlash(__('The item type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ItemType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemType->delete($id)) {
			$this->Session->setFlash(__('Item type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Item type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function api($params){
		$schema = $this->ItemType->schema();
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
							array_push($fields,'ItemType.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				case 'group':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($group,'ItemType.'.$f);
							if(count($fields)==0){
								foreach($schema as $sk=>$sv){
									array_push($fields,'ItemType.'.$sk);									
								}
							}
							if(!in_array('GROUP_CONCAT(ItemType.id) as ids',$fields)){
								array_push($fields,'GROUP_CONCAT(ItemType.id) as ids');
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
						$conditions['ItemType.'.$key.' LIKE']=$val;
						pr($conditions);exit;
						
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->ItemType->recursive = 1;

		return $this->ItemType->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}	
}
