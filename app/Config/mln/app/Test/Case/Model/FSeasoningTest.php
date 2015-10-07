<?php
App::uses('FSeasoning', 'Model');

/**
 * FSeasoning Test Case
 *
 */
class FSeasoningTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.f_seasoning',
		'app.seasoning_jp',
		'app.seasoning_auxjp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FSeasoning = ClassRegistry::init('FSeasoning');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FSeasoning);

		parent::tearDown();
	}

}
