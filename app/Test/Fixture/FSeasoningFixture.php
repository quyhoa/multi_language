<?php
/**
 * FSeasoningFixture
 *
 */
class FSeasoningFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'f_seasoning';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'seasoning_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'seasoning_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'seasoning_jp_id' => 1,
			'seasoning_auxjp_id' => 1,
			'created' => '2015-05-07 12:43:09',
			'updated' => '2015-05-07 12:43:09',
			'status' => 1
		),
	);

}
