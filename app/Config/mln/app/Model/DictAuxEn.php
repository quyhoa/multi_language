<?php
App::uses('AppModel', 'Model');
/**
 * DictAuxEn Model
 *
 * @property LangEn $LangEn
 */
class DictAuxEn extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'dict_aux_en';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LangEn' => array(
			'className' => 'LangEn',
			'foreignKey' => 'lang_en_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
