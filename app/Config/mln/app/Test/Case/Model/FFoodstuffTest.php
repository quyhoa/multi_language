<?php
App::uses('FFoodstuff', 'Model');

/**
 * FFoodstuff Test Case
 *
 */
class FFoodstuffTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.f_foodstuff',
		'app.foodstuff_jp',
		'app.foodstuff_auxjp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FFoodstuff = ClassRegistry::init('FFoodstuff');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FFoodstuff);

		parent::tearDown();
	}

}
