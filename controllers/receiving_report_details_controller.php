<?php
class ReceivingReportDetailsController extends AppController {

	var $name = 'ReceivingReportDetails';

	function index() {
		$this->ReceivingReportDetail->recursive = 0;
		$this->set('receivingReportDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid receiving report detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('receivingReportDetail', $this->ReceivingReportDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReceivingReportDetail->create();
			if ($this->ReceivingReportDetail->save($this->data)) {
				$this->Session->setFlash(__('The receiving report detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving report detail could not be saved. Please, try again.', true));
			}
		}
		$receivingReports = $this->ReceivingReportDetail->ReceivingReport->find('list');
		$items = $this->ReceivingReportDetail->Item->find('list');
		$this->set(compact('receivingReports', 'items'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid receiving report detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReceivingReportDetail->save($this->data)) {
				$this->Session->setFlash(__('The receiving report detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receiving report detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReceivingReportDetail->read(null, $id);
		}
		$receivingReports = $this->ReceivingReportDetail->ReceivingReport->find('list');
		$items = $this->ReceivingReportDetail->Item->find('list');
		$this->set(compact('receivingReports', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for receiving report detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ReceivingReportDetail->delete($id)) {
			$this->Session->setFlash(__('Receiving report detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Receiving report detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
