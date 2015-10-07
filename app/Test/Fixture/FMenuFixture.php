<?php
/**
 * FMenuFixture
 *
 */
class FMenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'menu_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'menu_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'foodstuff_id' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seasoning_id' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'price' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'priceunit_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'priceunit_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'payment_method_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'payment_method_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'description_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'description_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'speacial_deal_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'speacial_deal_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tasty_eating_jp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tasty_eating_auxjp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'calorie' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'cholesterol' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'ranking' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'menu_jp_id' => 1,
			'menu_auxjp_id' => 1,
			'foodstuff_id' => 'Lorem ipsum dolor sit amet',
			'seasoning_id' => 'Lorem ipsum dolor sit amet',
			'shop_id' => 1,
			'price' => 1,
			'priceunit_jp_id' => 1,
			'priceunit_auxjp_id' => 1,
			'payment_method_jp_id' => 1,
			'payment_method_auxjp_id' => 1,
			'description_jp_id' => 1,
			'description_auxjp_id' => 1,
			'speacial_deal_jp_id' => 1,
			'speacial_deal_auxjp_id' => 1,
			'tasty_eating_jp_id' => 1,
			'tasty_eating_auxjp_id' => 1,
			'calorie' => 1,
			'cholesterol' => 1,
			'ranking' => 1,
			'created' => '2015-05-07 12:42:52',
			'updated' => '2015-05-07 12:42:52',
			'status' => 1
		),
	);

}
