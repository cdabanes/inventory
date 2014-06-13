<?php
class ReceivingReportDetail extends AppModel {
	var $name = 'ReceivingReportDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ReceivingReport' => array(
			'className' => 'ReceivingReport',
			'foreignKey' => 'receiving_report_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
