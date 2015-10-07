<?php
App::uses('DictJa', 'Model');

/**
 * DictJa Test Case
 *
 */
class DictJaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dict_ja',
		'app.lang',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DictJa = ClassRegistry::init('DictJa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DictJa);

		parent::tearDown();
	}

}
