<?php
/* Item Fixture generated on: 2014-01-12 15:43:49 : 1389537829 */
class ItemFixture extends CakeTestFixture {
	var $name = 'Item';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'item_type_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'article_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unit_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'initial_quantity' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '11,2'),
		'quantity' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '11,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'item_type_id' => 1,
			'article_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'unit_id' => 1,
			'initial_quantity' => 1,
			'quantity' => 1,
			'created' => '2014-01-12 15:43:49',
			'modified' => '2014-01-12'
		),
	);
}
