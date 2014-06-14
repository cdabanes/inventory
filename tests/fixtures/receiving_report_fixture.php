<?php
/* ReceivingReport Fixture generated on: 2014-01-12 17:09:46 : 1389542986 */
class ReceivingReportFixture extends CakeTestFixture {
	var $name = 'ReceivingReport';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 9, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'created' => '2014-01-12 17:09:46',
			'modified' => '2014-01-12 17:09:46'
		),
	);
}
