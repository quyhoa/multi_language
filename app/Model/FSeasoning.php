<?php
App::uses('AppModel', 'Model');
/**
 * FSeasoning Model
 *
 * @property SeasoningJp $SeasoningJp
 * @property SeasoningAuxjp $SeasoningAuxjp
 */
class FSeasoning extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'f_seasoning';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DictJa' => array(
			'className' => 'DictJa',
			'foreignKey' => 'seasoning_jp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),	
	);
}
