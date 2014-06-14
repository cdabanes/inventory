<?php
/* ReceivingReportDetail Test cases generated on: 2014-01-12 17:09:56 : 1389542996*/
App::import('Model', 'ReceivingReportDetail');

class ReceivingReportDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_report_detail', 'app.receiving_report', 'app.item', 'app.item_type', 'app.article', 'app.unit', 'app.issue_out_detail', 'app.material_request_detail', 'app.material_return_detail', 'app.purchase_order_detail');

	function startTest() {
		$this->ReceivingReportDetail =& ClassRegistry::init('ReceivingReportDetail');
	}

	function endTest() {
		unset($this->ReceivingReportDetail);
		ClassRegistry::flush();
	}

}
