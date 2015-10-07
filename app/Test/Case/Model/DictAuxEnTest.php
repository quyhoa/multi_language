<?php
App::uses('DictAuxEn', 'Model');

/**
 * DictAuxEn Test Case
 *
 */
class DictAuxEnTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dict_aux_en',
		'app.lang_en'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DictAuxEn = ClassRegistry::init('DictAuxEn');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DictAuxEn);

		parent::tearDown();
	}

}
