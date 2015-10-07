<?php
App::uses('LangMaster', 'Model');

/**
 * LangMaster Test Case
 *
 */
class LangMasterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lang_master'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LangMaster = ClassRegistry::init('LangMaster');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LangMaster);

		parent::tearDown();
	}

}
