<?php
/* Article Test cases generated on: 2014-01-12 16:49:30 : 1389541770*/
App::import('Model', 'Article');

class ArticleTestCase extends CakeTestCase {
	var $fixtures = array('app.article', 'app.item', 'app.item_type', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail', 'app.receiving_report_detail');

	function startTest() {
		$this->Article =& ClassRegistry::init('Article');
	}

	function endTest() {
		unset($this->Article);
		ClassRegistry::flush();
	}

}
