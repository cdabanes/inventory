<?php
class ReceivingReport extends AppModel {
	var $name = 'ReceivingReport';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'ReceivingReportDetail' => array(
			'className' => 'ReceivingReportDetail',
			'foreignKey' => 'receiving_report_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
