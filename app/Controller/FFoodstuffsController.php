<?php
App::uses('AppController', 'Controller');
/**
 * FFoodstuffs Controller
 *
 * @property FFoodstuff $FFoodstuff
 * @property PaginatorComponent $Paginator
 */
class FFoodstuffsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
 * add method
 * Description add foodstuff for menus
 * @author haipt
 * @created_date 2015/05/16
 */
	public function add() {
		$title_for_layout 	= "食材入力画面";
		// $this->autoRender 	= false;
		$foodItemName 		= array();
		$foodstuff_id 		= array();
		$formData 			= '';
		$itemData 			= '';
		$id 				='';
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$formData =  $data['Item']['form_data'];
			parse_str($data['Item']['form_data'], $values);
			$id = $values['data']['FMenu']['id'];
			$listFood = array();
			// $lang = $this->Session->read('Config.language');			
			if(!empty($values['data']['FMenu']['foodstuff_list_name']))
			{
				// $foodItemName = explode(',',$values['data']['FMenu']['foodstuff_list_name']);
				$itemData = $values['data']['FMenu']['foodstuff_id'];
				$fooID = $values['data']['FMenu']['foodstuff_id'];
				$foodstuffID = explode(',',$fooID);
				$foodstuff_id = $foodstuffID;
				$lang = $this->Session->read('Config.language');
					foreach ($foodstuffID as $key => $value) {
						$foodstuff['word'][] = $this->FFoodstuff->find('all',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FFoodstuff.id '=>$value)));
					}
					if($lang == 'ja'){
					$modelDict = 'DictJa';
							foreach($foodstuff['word'] as $k=>$val)
							{
								$word = empty($val[0]['DictJa']['word_0'])?'':$val[0]['DictJa']['word_0'];
								$listFood[] = $word;								
							}
					}else{
						foreach($foodstuff['word'] as $k=>$val)
							{
								$listFood[] = $this->getNameDict($val[0]['DictJa']['id'],null,$lang);
							}
					}
					$foodItemName = $listFood;
					
				$this->Session->write('item_2',explode(',',$values['data']['FMenu']['foodstuff_id']));								
				if(!empty($id)){
					$this->Session->write('check_add',$id);
				}				
			}
		}
		$numItem = count($foodItemName);
		$numItem = ($numItem>0)?$numItem:DEFAULT_ITEM;
		$this->set(compact('foodItemName','formData','itemData','numItem','title_for_layout','id','foodstuff_id'));
	}
}
