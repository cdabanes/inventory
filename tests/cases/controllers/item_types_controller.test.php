<?php
/* ItemTypes Test cases generated on: 2014-01-12 16:21:42 : 1389540102*/
App::import('Controller', 'ItemTypes');

class TestItemTypesController extends ItemTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ItemTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.item_type', 'app.item', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail', 'app.receiving_report_detail');

	function startTest() {
		$this->ItemTypes =& new TestItemTypesController();
		$this->ItemTypes->constructClasses();
	}

	function endTest() {
		unset($this->ItemTypes);
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
