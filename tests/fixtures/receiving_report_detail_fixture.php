<?php
/* ReceivingReportDetail Fixture generated on: 2014-01-12 17:09:55 : 1389542995 */
class ReceivingReportDetailFixture extends CakeTestFixture {
	var $name = 'ReceivingReportDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 9, 'key' => 'primary'),
		'receiving_report_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 9),
		'item_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 9),
		'quantity' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '8,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'receiving_report_id' => 1,
			'item_id' => 1,
			'quantity' => 1,
			'price' => 1,
			'created' => '2014-01-12 17:09:55',
			'modified' => '2014-01-12 17:09:55'
		),
	);
}
