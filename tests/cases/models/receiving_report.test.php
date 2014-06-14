<?php
/* ReceivingReport Test cases generated on: 2014-01-12 17:09:46 : 1389542986*/
App::import('Model', 'ReceivingReport');

class ReceivingReportTestCase extends CakeTestCase {
	var $fixtures = array('app.receiving_report', 'app.receiving_report_detail');

	function startTest() {
		$this->ReceivingReport =& ClassRegistry::init('ReceivingReport');
	}

	function endTest() {
		unset($this->ReceivingReport);
		ClassRegistry::flush();
	}

}
