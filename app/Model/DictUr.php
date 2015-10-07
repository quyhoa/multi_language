<?php
App::uses('AppModel', 'Model');
/**
 * DictEn Model
 *
 * @property Lang $Lang
 * @property LangJa $LangJa
 * @property Category $Category
 */
class DictUr extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'dict_ur';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		// 'LangMaster' => array(
		// 	'className' => 'LangMaster',
		// 	'foreignKey' => 'lang_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'CategoryMaster' => array(
		// 	'className' => 'CategoryMaster',
		// 	'foreignKey' => 'category_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// )
	);

/**
 * check exits method
 *
 * @throws NotFoundException
 * @param string $id
 * @return true if $key exits or false
 */
	// public function isExitsEns($key){
	// 	$kt = flase;
	// 	$valKey = $this->find('first',array(
	// 		'conditions'=>array(
	// 			'or'=>array(
	// 				'DictEn.word_0'=>$key,
	// 				'DictEn.word_1'=>$key,
	// 				'DictEn.word_2'=>$key,
	// 				'DictEn.word_3'=>$key,
	// 				'DictEn.word_4'=>$key,
	// 				'DictEn.word_5'=>$key,
	// 				'DictEn.word_6'=>$key
	// 			)
	// 		)
	// 	));
	// 	if(!empty($valKey)){
	// 		return true;
	// 	}
	// 	return $kt;
	// }


/**
 * seva keyword in dictEns method
 *
 * @throws NotFoundException
 * @param string $id
 * @return id 
 */

	// public function beforSaveDictEns($key){
	// 	$fmenu_id = $this->Session->read('fMenu.id');
	// 	$id = '';
	// 	$category_ids = $this->DictEn->find('all',array(
	// 		'recursive'=>-1,
	// 		'fields'=>array('category_id'),
	// 		'limit'=>1
	// 	));
	// 	$data['DictEn']['word_0'] = $key;
	// 	$data['DictEn']['lang_id'] = 2;
	// 	$data['DictEn']['category_id'] = $category_ids[0]['DictEn']['category_id'] + 1;

	// 	$this->DictEn->create();
	// 		if ($this->DictEn->save($data)) {
	// 			$nameDictEn = $this->DictEn->findByWord_0($key);
	// 			$id = $nameDictEn['DictEn']['id'];
	// 		}
	// 	return $id;
	// }

}
