<?php
App::uses('FShop', 'Model');

/**
 * FShop Test Case
 *
 */
class FShopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.f_shop',
		'app.login',
		'app.shop_jp',
		'app.shop_auxjp',
		'app.address1_jp',
		'app.address1_auxjp',
		'app.address2_jp',
		'app.address2_auxjp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FShop = ClassRegistry::init('FShop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FShop);

		parent::tearDown();
	}

}
