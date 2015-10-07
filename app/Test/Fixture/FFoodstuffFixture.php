<?php
/**
 * FFoodstuffFixture
 *
 */
class FFoodstuffFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'f_foodstuff';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'foodstuff_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'foodstuff_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'status' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'foodstuff_jp_id' => 1,
			'foodstuff_auxjp_id' => 1,
			'created' => '2015-05-07 12:42:20',
			'updated' => '2015-05-07 12:42:20',
			'status' => 1
		),
	);

}
