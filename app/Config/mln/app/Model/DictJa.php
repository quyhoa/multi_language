<?php
App::uses('AppModel', 'Model');
/**
 * DictJa Model
 *
 * @property Lang $Lang
 * @property Category $Category
 */
class DictJa extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'dict_ja';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LangMaster' => array(
			'className' => 'LangMaster',
			'foreignKey' => 'lang_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CategoryMaster' => array(
			'className' => 'CategoryMaster',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
