<?php
App::uses('DictAuxJa', 'Model');

/**
 * DictAuxJa Test Case
 *
 */
class DictAuxJaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dict_aux_ja',
		'app.lang_ja'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DictAuxJa = ClassRegistry::init('DictAuxJa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DictAuxJa);

		parent::tearDown();
	}

}
