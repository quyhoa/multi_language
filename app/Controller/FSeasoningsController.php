<?php
App::uses('AppController', 'Controller');
/**
 * FSeasonings Controller
 *
 * @property FSeasoning $FSeasoning
 * @property PaginatorComponent $Paginator
 */
class FSeasoningsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
 * add method
 * Description : add season
 * @author haipt
 * @create_date: 2015/05/14
 */
	public function add() {
		$title_for_layout = "調味料入力画面";
		$seasonItemName = array();
		$seasoning_id = array();
		$formData = '';
		$itemData = '';
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$formData =  $data['Item']['form_data'];
			parse_str($data['Item']['form_data'], $values);
			$id = empty($values['data']['FMenu']['id'])?'':$values['data']['FMenu']['id'];
			$listSea = array();		
			if(!empty($values['data']['FMenu']['seasoning_list_name']))
			{
				$itemData     = $values['data']['FMenu']['seasoning_id'];
				$seaID        = $itemData;
				$seafoodId    = explode(',', $seaID);
				$seasoning_id = $seafoodId;
				$lang 			= $this->Session->read('Config.language');

				foreach ($seafoodId as $key => $value) {
						$seafood['word'][] = $this->FSeasoning->find('all',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FSeasoning.id '=>$value)));
					}
				if($lang == 'ja'){
					$modelDict = 'DictJa';
						foreach($seafood['word'] as $k=>$val)
						{
							$word = empty($val[0]['DictJa']['word_0'])?'':$val[0]['DictJa']['word_0'];
							$listSea[] = $word;								
						}
				}else{
					foreach($seafood['word'] as $k=>$val)
					{
						$listSea[] = $this->getNameDict($val[0]['DictJa']['id'],null,$lang);
					}
				}
				$seasonItemName = $listSea;
				$this->Session->write('item_3',explode(',',$values['data']['FMenu']['seasoning_id']));
				if(!empty($id)){
					$this->Session->write('check_add',$id);
				} 
			}
		}
		$numItem = count($seasonItemName);
		$numItem = ($numItem>0)?$numItem:DEFAULT_ITEM;
		$this->set(compact('seasonItemName','formData','itemData','numItem','title_for_layout','id','seasoning_id'));
	}
}
