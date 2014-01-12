<?php
/* ItemType Test cases generated on: 2014-01-12 16:20:47 : 1389540047*/
App::import('Model', 'ItemType');

class ItemTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.item_type', 'app.item', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail', 'app.receiving_report_detail');

	function startTest() {
		$this->ItemType =& ClassRegistry::init('ItemType');
	}

	function endTest() {
		unset($this->ItemType);
		ClassRegistry::flush();
	}

}
