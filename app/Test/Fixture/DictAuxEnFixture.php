<?php
/**
 * DictAuxEnFixture
 *
 */
class DictAuxEnFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'dict_aux_en';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'lang_en_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'word_0' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_4' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_5' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word_6' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 512, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'lang_en_id' => 1,
			'word_0' => 'Lorem ipsum dolor sit amet',
			'word_1' => 'Lorem ipsum dolor sit amet',
			'word_2' => 'Lorem ipsum dolor sit amet',
			'word_3' => 'Lorem ipsum dolor sit amet',
			'word_4' => 'Lorem ipsum dolor sit amet',
			'word_5' => 'Lorem ipsum dolor sit amet',
			'word_6' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-05-07 12:21:29',
			'updated' => '2015-05-07 12:21:29',
			'status' => 1
		),
	);

}
