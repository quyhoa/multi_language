<?php
App::uses('AppModel', 'Model');
/**
 * FMenu Model
 *
 * @property MenuJp $MenuJp
 * @property MenuAuxjp $MenuAuxjp
 * @property Foodstuff $Foodstuff
 * @property Seasoning $Seasoning
 * @property Shop $Shop
 * @property PriceunitJp $PriceunitJp
 * @property PriceunitAuxjp $PriceunitAuxjp
 * @property PaymentMethodJp $PaymentMethodJp
 * @property PaymentMethodAuxjp $PaymentMethodAuxjp
 * @property DescriptionJp $DescriptionJp
 * @property DescriptionAuxjp $DescriptionAuxjp
 * @property SpeacialDealJp $SpeacialDealJp
 * @property SpeacialDealAuxjp $SpeacialDealAuxjp
 * @property TastyEatingJp $TastyEatingJp
 * @property TastyEatingAuxjp $TastyEatingAuxjp
 */
class FMenu extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DictJa' => array(
			'className' => 'DictJa',
			'foreignKey' => 'menu_jp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'FFoodstuff' => array(
			'className' => 'FFoodstuff',
			'foreignKey' => 'foodstuff_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FSeasoning' => array(
			'className' => 'FSeasoning',
			'foreignKey' => 'seasoning_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FShop' => array(
			'className' => 'FShop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
}
