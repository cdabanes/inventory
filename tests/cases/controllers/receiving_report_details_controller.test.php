<?php
/* ReceivingReportDetails Test cases generated on: 2014-01-12 17:10:40 : 1389543040*/
App::import('Controller', 'ReceivingReportDetails');

class TestReceivingReportDetailsController extends ReceivingReportDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReceivingReportDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_report_detail', 'app.receiving_report', 'app.item', 'app.item_type', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail');

	function startTest() {
		$this->ReceivingReportDetails =& new TestReceivingReportDetailsController();
		$this->ReceivingReportDetails->constructClasses();
	}

	function endTest() {
		unset($this->ReceivingReportDetails);
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
