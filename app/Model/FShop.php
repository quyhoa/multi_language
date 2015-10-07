<?php
App::uses('AppModel', 'Model');
/**
 * FShop Model
 *
 * @property Login $Login
 * @property ShopJp $ShopJp
 * @property ShopAuxjp $ShopAuxjp
 * @property Address1Jp $Address1Jp
 * @property Address1Auxjp $Address1Auxjp
 * @property Address2Jp $Address2Jp
 * @property Address2Auxjp $Address2Auxjp
 */
class FShop extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed
		
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DictJa' => array(
			'className' => 'DictJa',
			'foreignKey' => 'shop_jp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		// 'Login' => array(
		// 	'className' => 'Login',
		// 	'foreignKey' => 'login_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'ShopJp' => array(
		// 	'className' => 'ShopJp',
		// 	'foreignKey' => 'shop_jp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'ShopAuxjp' => array(
		// 	'className' => 'ShopAuxjp',
		// 	'foreignKey' => 'shop_auxjp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'Address1Jp' => array(
		// 	'className' => 'Address1Jp',
		// 	'foreignKey' => 'address1_jp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'Address1Auxjp' => array(
		// 	'className' => 'Address1Auxjp',
		// 	'foreignKey' => 'address1_auxjp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'Address2Jp' => array(
		// 	'className' => 'Address2Jp',
		// 	'foreignKey' => 'address2_jp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'Address2Auxjp' => array(
		// 	'className' => 'Address2Auxjp',
		// 	'foreignKey' => 'address2_auxjp_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// )
	);
	public $hasAndBelongsToMany = array(
        'FMenu' => array(
            'className' => 'FMenu',
            'joinTable' => 'shops_menus',
            'foreignKey' => 'shop_id',
            'associationForeignKey' => 'menu_id',
            // 'dependent' => false,
        ),

    );
}
