<?php
/* Articles Test cases generated on: 2014-01-12 16:49:48 : 1389541788*/
App::import('Controller', 'Articles');

class TestArticlesController extends ArticlesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ArticlesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.article', 'app.item', 'app.item_type', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail', 'app.receiving_report_detail');

	function startTest() {
		$this->Articles =& new TestArticlesController();
		$this->Articles->constructClasses();
	}

	function endTest() {
		unset($this->Articles);
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
