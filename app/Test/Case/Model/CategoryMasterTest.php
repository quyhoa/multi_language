<?php
App::uses('CategoryMaster', 'Model');

/**
 * CategoryMaster Test Case
 *
 */
class CategoryMasterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category_master'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoryMaster = ClassRegistry::init('CategoryMaster');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoryMaster);

		parent::tearDown();
	}

}
