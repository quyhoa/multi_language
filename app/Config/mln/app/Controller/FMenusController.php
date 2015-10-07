<?php
App::uses('AppController', 'Controller');
/**
 * FMenus Controller
 *
 * @property FMenu $FMenu
 * @property PaginatorComponent $Paginator
 */
class FMenusController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 * @author quyhoa
 * 
 * @return void
 * @create day: 8/05/2013
 */
	public function index() {
		
		$title_for_layout = "メニュー一覧";
		$this->paginate = array(	
			'fields'=>array('FMenu.id','FMenu.menu_jp_id','foodstuff_id','seasoning_id','price','payment_method_jp_id','description_jp_id','speacial_deal_jp_id','tasty_eating_jp_id'),
				'conditions'=>array('FMenu.status'=>0),
				'contain'=>array('DictJa'=> array('fields'=>array('DictJa.word_0'))),
				'limit'=>LIMIT,
				'order'=>array('DictJa.word_0'=>'asc'),
				'paramType'=>'querystring'
			
			);
		$menus = $this->paginate();
		$model = "FMenu";
		$this->set(compact('menus','title_for_layout','model'));
		$this->Session->delete('Config.language');		
		$this->Session->delete('select_language');
		$this->Session->delete('check_add');
	}

/**
 * add method
 * Description : add and edit menu
 * @author haipt
 * created_date 2015/05/14
 */
	public function add($idMenu = null) {
		$title_for_layout = "メニュー登録";
		$this->loadModel('LangMaster');				
		$item_names = '';
		$numFoodItem = 0;
		$numSeasonItem = 0;
		$method = array();
		$exit_id = '';
		
		//edit menu
		if(!is_null($idMenu))
		{
			$check_add =  $this->Session->check('check_add')?true:false;
			if($check_add){
				if ($this->request->is('post')) {
					$data = $this->request->data;
					if(isset($data['FFoodstuff'])){
						parse_str($data['FFoodstuff']['form_data'], $values);
						$exit_id = empty($values['data']['FMenu']['id'])?'':$values['data']['FMenu']['id'];
						$method = explode(',',$values['data']['FMenu']['payment_method_jp_id']);
						if(!empty($values)){
							$this->request->data = $values['data'];
							if(!empty($values['data']['FMenu']['seasoning_id']))
							{
								$numSeasonItem = count(explode(',',$values['data']['FMenu']['seasoning_id']));						
							}					
						}
						$this->request->data['FMenu']['foodstuff_id'] =  $data['FFoodstuff']['item_data'];
						
						if(!empty($data['FFoodstuff']['item_name']))
						{

							$itemNames =array_filter(array_values($data['FFoodstuff']['item_name']));
							$numFoodItem = count($itemNames);
							$this->request->data['FMenu']['foodstuff_list_name'] = implode(",",$itemNames);
						}
								
						$this->Session->delete('item_2');

					}
					if(isset($data['FSeasoning'])){
						parse_str($data['FSeasoning']['form_data'], $values);
						$exit_id = empty($values['data']['FMenu']['id'])?'':$values['data']['FMenu']['id'];
						
						$method = explode(',',$values['data']['FMenu']['payment_method_jp_id']);
						if(!empty($values)){
							$this->request->data = $values['data'];
							if(!empty($values['data']['FMenu']['foodstuff_id']))
							{
								$numFoodItem = count(explode(',',$values['data']['FMenu']['foodstuff_id']));
								
							}
						}
						$this->request->data['FMenu']['seasoning_id'] =  $data['FSeasoning']['item_data'];
						
						if(!empty($data['FSeasoning']['item_name']))
						{
							$itemNames =array_filter(array_values($data['FSeasoning']['item_name']));
							$numSeasonItem = count($itemNames);
							$this->request->data['FMenu']['seasoning_list_name'] = implode(",",$itemNames);
						}
						$this->Session->delete('item_3');
					}
				}else{
					
				// edit
				$menus = $this->FMenu->find('first',array('conditions'=>array('FMenu.id'=>$idMenu,'FMenu.status'=>0)));
				$check_language = $this->Session->check('Config.language');
				$lang 	=  ($check_language)?$this->Session->read('Config.language'):'jpn';
				
				if(!empty($menus['FMenu']))
				{

					$menus['FMenu']['word_0']= $menus['DictJa']['word_0'];
					$this->request->data['FMenu'] = $menus['FMenu'];
					$foodstuffId = $menus['FMenu']['foodstuff_id'];
					$this->loadModel('FFoodstuff');
					$listFood = array();
					$foodstuff = $this->FFoodstuff->find('all',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FFoodstuff.id '=>explode(",",$foodstuffId))));
					$numFoodItem = count($foodstuff);
					$this->loadModel('FSeasoning');
					$listSeason = array();
					$seasonId = $menus['FMenu']['seasoning_id'];
					$season = $this->FSeasoning->find('all',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FSeasoning.id '=>explode(",",$seasonId))));
					$numSeasonItem = count($season);
					$lang = $this->Session->read('Config.language');
					//language japan
					if(strtolower($lang)==='jpn')
					{
						$modelDict = 'DictJa';
						foreach($foodstuff as $k=>$val)
						{
							$listFood[] = $val['DictJa']['word_0'];
						}
						foreach($season as $k=>$val)
						{
							$listSeason[] = $val[$modelDict]['word_0'];
						}

					}
					else{
						$modelDict = 'DictEn';
						$menus['FMenu']['word_0']= $this->getNameDict($menus['DictJa']['id'],null,$lang);
						$this->request->data['FMenu'] = $menus['FMenu'];
					
						foreach($foodstuff as $k=>$val)
						{
							$listFood[] = $this->getNameDict($val['DictJa']['id'],null,$lang);

						}
						foreach($season as $k=>$val)
						{
							$listSeason[] = $this->getNameDict($val['DictJa']['id'],null,$lang);
						}
					
					}
					$this->request->data['FMenu']['foodstuff_list_name']= (!empty($listFood))?implode(',',$listFood):'';

					
					$this->request->data['FMenu']['seasoning_list_name']= (!empty($listSeason))?implode(',',$listSeason):'';
					$this->request->data['FMenu']['description_name'] 	= $this->getNameDict($menus['FMenu']['description_jp_id'],null,$lang);
					$method 											= explode(",",$menus['FMenu']['payment_method_jp_id']);
					$this->set(compact('method'));
					$this->request->data['FMenu']['speacial_deal_name'] = $this->getNameDict($menus['FMenu']['speacial_deal_jp_id'],null,$lang);
					$this->request->data['FMenu']['tasty_eating_name']  = $this->getNameDict($menus['FMenu']['tasty_eating_jp_id'],null,$lang);
					$this->request->data['FMenu']['priceunit_name']     = $this->getNameDict($menus['FMenu']['priceunit_jp_id'],null,$lang);
					$this->request->data['FMenu']['id']                 = $idMenu;
					$this->request->data['FMenu']['calories']			= $this->getNameDict($menus['FMenu']['calorie'],null,$lang);
					// load language master
					$languages = $this->LangMaster->find('all',array('fields'=>array('lang_name','id')));
					foreach ($languages as $key => $value) {
						$language[$value['LangMaster']['id']] = $value['LangMaster']['lang_name'];
					}
					$exit_id = $idMenu;
				}
				}
				// endadd
			}
			else{
				// edit
				$menus = $this->FMenu->find('first',array('conditions'=>array('FMenu.id'=>$idMenu,'FMenu.status'=>0)));
				$check_language = $this->Session->check('Config.language');
				$lang 	=  ($check_language)?$this->Session->read('Config.language'):'jpn';
				
				if(!empty($menus['FMenu']))
				{

					$menus['FMenu']['word_0']= $menus['DictJa']['word_0'];
					$this->request->data['FMenu'] = $menus['FMenu'];
					$foodstuffId = $menus['FMenu']['foodstuff_id'];
					$this->loadModel('FFoodstuff');
					$listFood = array();
					$foodstuffIds = explode(",",$foodstuffId);
					foreach ($foodstuffIds as $key => $value) {
						$foodstuff[] = $this->FFoodstuff->find('first',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FFoodstuff.id '=>$value)));
					}
					$numFoodItem = count($foodstuff);
					$this->loadModel('FSeasoning');
					$listSeason = array();
					$seasonId = $menus['FMenu']['seasoning_id'];
					$seasons = explode(",",$seasonId);
					foreach ($seasons as $key => $value) {
						$season[] = $this->FSeasoning->find('first',array(
						'fields'=>array('DictJa.word_0','DictJa.id'),
						'conditions'=>array('FSeasoning.id '=>$value)));
					}
					
					$numSeasonItem = count($season);
					$lang = $this->Session->read('Config.language');
					//language japan
					if(strtolower($lang)==='jpn')
					{
						$modelDict = 'DictJa';
						foreach($foodstuff as $k=>$val)
						{
							$listFood[] = $val['DictJa']['word_0'];
						}
						foreach($season as $k=>$val)
						{
							$listSeason[] = $val[$modelDict]['word_0'];
						}

					}
					else{
						$modelDict = 'DictEn';
						$menus['FMenu']['word_0']= $this->getNameDict($menus['DictJa']['id'],null,$lang);
						$this->request->data['FMenu'] = $menus['FMenu'];
					
						foreach($foodstuff as $k=>$val)
						{
							$listFood[] = $this->getNameDict($val['DictJa']['id'],null,$lang);

						}
						foreach($season as $k=>$val)
						{
							$listSeason[] = $this->getNameDict($val['DictJa']['id'],null,$lang);
						}
					
					}
					$this->request->data['FMenu']['foodstuff_list_name']= (!empty($listFood))?implode(',',$listFood):'';

					
					$this->request->data['FMenu']['seasoning_list_name']= (!empty($listSeason))?implode(',',$listSeason):'';
					$this->request->data['FMenu']['description_name'] 	= $this->getNameDict($menus['FMenu']['description_jp_id'],null,$lang);
					$method 											= explode(",",$menus['FMenu']['payment_method_jp_id']);
					$this->set(compact('method'));
					$this->request->data['FMenu']['speacial_deal_name'] = $this->getNameDict($menus['FMenu']['speacial_deal_jp_id'],null,$lang);
					$this->request->data['FMenu']['tasty_eating_name']  = $this->getNameDict($menus['FMenu']['tasty_eating_jp_id'],null,$lang);
					$this->request->data['FMenu']['priceunit_name']     = $this->getNameDict($menus['FMenu']['priceunit_jp_id'],null,$lang);
					$this->request->data['FMenu']['id']                 = $idMenu;
					$this->request->data['FMenu']['calories']			= $this->getNameDict($menus['FMenu']['calorie'],null,$lang);
					// load language master
					$languages = $this->LangMaster->find('all',array('fields'=>array('lang_name','id')));
					foreach ($languages as $key => $value) {
						$language[$value['LangMaster']['id']] = $value['LangMaster']['lang_name'];
					}
					$exit_id = $idMenu;
				}
			}
			
			
		}else{

			// thuc hien add
			if ($this->request->is('post')) {
				$data = $this->request->data;
				if(isset($data['FFoodstuff'])){
					parse_str($data['FFoodstuff']['form_data'], $values);
					$exit_id = empty($values['data']['FMenu']['id'])?'':$values['data']['FMenu']['id'];
					
					$method = explode(',',$values['data']['FMenu']['payment_method_jp_id']);
					if(!empty($values)){
						$this->request->data = $values['data'];
						if(!empty($values['data']['FMenu']['seasoning_id']))
						{
							$numSeasonItem = count(explode(',',$values['data']['FMenu']['seasoning_id']));						
						}					
					}

					$this->request->data['FMenu']['foodstuff_id'] =  $data['FFoodstuff']['item_data'];

					if(!empty($data['FFoodstuff']['item_name']))
					{

						$itemNames =array_filter(array_values($data['FFoodstuff']['item_name']));
						$numFoodItem = count($itemNames);
						$this->request->data['FMenu']['foodstuff_list_name'] = implode(",",$itemNames);
					}
							
					$this->Session->delete('item_2');

				}
				if(isset($data['FSeasoning'])){
					parse_str($data['FSeasoning']['form_data'], $values);
					$exit_id = empty($values['data']['FMenu']['id'])?'':$values['data']['FMenu']['id'];					
					$method = explode(',',$values['data']['FMenu']['payment_method_jp_id']);
					if(!empty($values)){
						$this->request->data = $values['data'];
						if(!empty($values['data']['FMenu']['foodstuff_id']))
						{
							$numFoodItem = count(explode(',',$values['data']['FMenu']['foodstuff_id']));
						}
					}
					$this->request->data['FMenu']['seasoning_id'] =  $data['FSeasoning']['item_data'];
					
					if(!empty($data['FSeasoning']['item_name']))
					{
						$itemNames =array_filter(array_values($data['FSeasoning']['item_name']));
						$numSeasonItem = count($itemNames);
						$this->request->data['FMenu']['seasoning_list_name'] = implode(",",$itemNames);
					}
					$this->Session->delete('item_3');
				}
			}
			// endadd
			$listMenu = $this->FMenu->find('all',array(
				'fields'=>array('FMenu.id','DictJa.word_0'),
				'conditions'=>array('FMenu.status'=>0),
				
			));
			if(!empty($listMenu))
			{
				foreach($listMenu as $key => $val){
					$options[$val['FMenu']['id']] = $val['DictJa']['word_0'];
				}
				$this->set(compact('options'));
			}
		}

		$this->set(compact('numFoodItem','numSeasonItem','title_for_layout','method','language','exit_id'));
	}

/**
 * save method
 * @author quyhoa
 * 
 * @return true or false
 * @create day: 13/05/2013
 */
	public function saveFmenu(){
		if($this->request->is(array('POST','PUT')))
		{
			$dataFmenu = $this->request->data;						
				$l_method = array_shift($dataFmenu['FMenu']['payment_method']);
				foreach ($dataFmenu['FMenu']['payment_method'] as $key => $value) {
					if(!empty($value)){
						$l_method .= ','.$value;
					}
				}
				$dataFmenu['FMenu']['payment_method_jp_id'] = $l_method;
				$edit = (isset($this->request->data['FMenu']['id'] ) && !empty($this->request->data['FMenu']['id'] ))?true:false; 
				$this->FMenu->create();
				if($this->FMenu->save($dataFmenu)){

					$msg = ($edit)?SUCCESS_EDIT_MENU:SUCCESS_ADD_MENU;
					$this->Session->setFlash($msg,'success');
				}else{
					$msg = ($edit)?ERROR_EDIT_MENU:ERROR_ADD_MENU;
					$this->Session->setFlash($msg,'error');
				}
				
		}
		else{
			$this->Session->setFlash(ERROR_ACTION,'error');
		}		
		$this->redirect(array('action'=>'index'));
	}
/**
* checkMenusExist
* Description:check menu exist
* @author: haipt
* @create_date: 2015/05/18
**/	
	public function checkMenusExist()
	{
		$this->autoRender = false;
		$this->layout = false;
		if($this->request->is(array('POST','PUT')))
		{
			$data = $this->request->data;
			$word0 = $data['word0'];
			$menuId = $data['menu_id'];
			if(!empty($word0))
			{
				$check = $this->isExits($word0,1);
				if($check === false)
				{
					return 'true';
				}
				else{
					$checkMenus = $this->FMenu->find('first',array('conditions'=>array('FMenu.status'=>0,'FMenu.id !='=>$menuId,'FMenu.menu_jp_id'=>$check)));
					if(!empty($checkMenus))
					{
						return 'false';
					}
					else{
						return 'true';
					}
				}
			}
			else{
				return 'true';
			}
			
		}
		return 'true';
	}

/**
* loadMenu method\
* return json save info a menu
* @author hoa
* @create_day: 2015/05/21
**/
	function loadMenu(){
		if($this->request->is(array('POST'))){
			$data = $this->request->data;
			$word_id = $data['word'];
			$infoMenu = $this->FMenu->find('first',array(
				'conditions'=>array('FMenu.id'=>$word_id),
				'contain'=>array('DictJa'=>array(
					'fields'=>array('DictJa.word_0')
				))
			));
			$dataForm['FMenu']['word_0'] = $infoMenu['DictJa']['word_0'];
			/*load name food*/
			$this->loadModel('FFoodstuff');
				$listFood = array();

				$foodstuffId = $infoMenu['FMenu']['foodstuff_id'];
				$foodstuff = $this->FFoodstuff->find('all',array(
					'fields'=>array('DictJa.word_0'),
					'conditions'=>array('FFoodstuff.id '=>explode(",",$foodstuffId))));
				$numFoodItem = count($foodstuff);
				foreach($foodstuff as $k=>$val)
				{
					$listFood[] = $val['DictJa']['word_0'];
				}
				$dataForm['FMenu']['foodstuff_list_name']= (!empty($listFood))?implode(',',$listFood):'';
				/*load name sea*/
				$this->loadModel('FSeasoning');
				$listSeason = array();
				$seasonId = $infoMenu['FMenu']['seasoning_id'];
				$season = $this->FSeasoning->find('all',array(
					'fields'=>array('DictJa.word_0'),
					'conditions'=>array('FSeasoning.id '=>explode(",",$seasonId))));
				$numSeasonItem = count($season);
				foreach($season as $k=>$val)
				{
					$listSeason[] = $val['DictJa']['word_0'];
				}
				$dataForm['FMenu']['seasoning_list_name']= (!empty($listSeason))?implode(',',$listSeason):'';
				$dataForm['FMenu']['description_name'] = $this->getNameDict($infoMenu['FMenu']['description_jp_id']);
				$dataForm['FMenu']['payment_method'] = $this->getNameDict($infoMenu['FMenu']['payment_method_jp_id']);
				$dataForm['FMenu']['speacial_deal_name'] = $this->getNameDict($infoMenu['FMenu']['speacial_deal_jp_id']);
				$dataForm['FMenu']['tasty_eating_name'] = $this->getNameDict($infoMenu['FMenu']['tasty_eating_jp_id']);
				$dataForm['FMenu']['priceunit_name'] = $this->getNameDict($infoMenu['FMenu']['priceunit_jp_id']);
				// $dataForm['FMenu']['id'] = $idMenu;
				$dataForm['id'] = $infoMenu;

			echo json_encode($dataForm);exit;
		}
	}
/**
* loadMenu method\
* return json save info a menu
* @author hoa
* @create_day: 2015/06/05
**/
	public function process_delete() {
		if($this->request->is(array('post'))){
			$ids = null;
			$check = true;
			$data = $this->request->data;
			foreach ($data['News']['id'] as $key => $value) {
				if($value==1){
					$update = $this->FMenu->updateAll(
						array('FMenu.status'=>1),
						array('FMenu.id'=>$key)
					);
					if($update){
						$check = true;
					}else{
						$check = false;
					}
				}
			}
			if($check){
				$this->Session->setFlash(SUCCESS_DELETE_FMENU,'success');
			}else{
				$this->Session->setFlash(ERROR_DELETE_FMENU,'error');
			}
			$this->redirect(array('action'=>'index'));
		}
	}
/**
* loadMenu method\
* return json save info a menu
* @author hoa
* @create_day: 2015/06/05
**/
	public function delete($id=null) {
		$this->FMenu->id = $id;
		$update = $this->FMenu->updateAll(
			array('FMenu.status'=>1),
			array('FMenu.id'=>$id)
		);
		if($update){
			$this->Session->setFlash(SUCCESS_DELETE_FMENU,'success');
		}else{
			$this->Session->setFlash(ERROR_DELETE_FMENU,'error');
		}
			$this->redirect(array('action'=>'index'));
	}
/**
* changeLanguage method
* return json 
* @author hoa
* @create_day: 2015/12/06
**/
	public function changeLanguage() { // Change language method
		if($this->request->is(array('post','put'))){
			$dict_name 		= null;
			$data 			= $this->request->data;
			$id 			= $data['id'];
			$id_menu 		= $data['id_menu'];
			$this->Session->write('select_language',$id);			
			/*load model*/
			$this->loadModel('LangMaster');
			$language = $this->LangMaster->find('first',array('conditions'=>array('LangMaster.id'=>$id)));
			$dict_name = (!empty($language))?$language['LangMaster']['dict_name']:'jpn';
			$this->Session->write('Config.language',$dict_name);
			$result['status'] 	= 1;
			$result['data'] 	= $data;
			$result['id_menu'] 	= $id_menu ;
			echo json_encode($result);
			exit;
		}
        
    }
}
