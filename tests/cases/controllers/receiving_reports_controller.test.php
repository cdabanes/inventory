<?php
/* ReceivingReports Test cases generated on: 2014-01-12 17:10:27 : 1389543027*/
App::import('Controller', 'ReceivingReports');

class TestReceivingReportsController extends ReceivingReportsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReceivingReportsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_report', 'app.receiving_report_detail', 'app.item', 'app.item_type', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail');

	function startTest() {
		$this->ReceivingReports =& new TestReceivingReportsController();
		$this->ReceivingReports->constructClasses();
	}

	function endTest() {
		unset($this->ReceivingReports);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
