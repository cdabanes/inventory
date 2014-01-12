<?php
/* Items Test cases generated on: 2014-01-12 15:44:37 : 1389537877*/
App::import('Controller', 'Items');

class TestItemsController extends ItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ItemsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.item', 'app.item_type', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail', 'app.receiving_report_detail');

	function startTest() {
		$this->Items =& new TestItemsController();
		$this->Items->constructClasses();
	}

	function endTest() {
		unset($this->Items);
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
