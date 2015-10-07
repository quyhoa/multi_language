<?php
App::uses('AppModel', 'Model');
/**
 * FFoodstuff Model
 *
 * @property FoodstuffJp $FoodstuffJp
 * @property FoodstuffAuxjp $FoodstuffAuxjp
 */
class FFoodstuff extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'f_foodstuff';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DictJa' => array(
			'className' => 'DictJa',
			'foreignKey' => 'foodstuff_jp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),	
	);
}
