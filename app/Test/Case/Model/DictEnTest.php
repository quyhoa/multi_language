<?php
App::uses('DictEn', 'Model');

/**
 * DictEn Test Case
 *
 */
class DictEnTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dict_en',
		'app.lang',
		'app.lang_ja',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DictEn = ClassRegistry::init('DictEn');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DictEn);

		parent::tearDown();
	}

}
