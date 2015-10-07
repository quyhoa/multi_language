<?php
App::uses('FMenu', 'Model');

/**
 * FMenu Test Case
 *
 */
class FMenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.f_menu',
		'app.menu_jp',
		'app.menu_auxjp',
		'app.foodstuff',
		'app.seasoning',
		'app.shop',
		'app.priceunit_jp',
		'app.priceunit_auxjp',
		'app.payment_method_jp',
		'app.payment_method_auxjp',
		'app.description_jp',
		'app.description_auxjp',
		'app.speacial_deal_jp',
		'app.speacial_deal_auxjp',
		'app.tasty_eating_jp',
		'app.tasty_eating_auxjp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FMenu = ClassRegistry::init('FMenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FMenu);

		parent::tearDown();
	}

}
