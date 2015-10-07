<?php
App::uses('AppModel', 'Model');
/**
 * DictAuxJa Model
 *
 * @property LangJa $LangJa
 */
class DictAuxJa extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'dict_aux_ja';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LangJa' => array(
			'className' => 'LangJa',
			'foreignKey' => 'lang_ja_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
