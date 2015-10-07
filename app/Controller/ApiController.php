<?php
App::uses('AppController', 'Controller');
/**
 * FMenus Controller
 *
 * @property FMenu $FMenu
 * @property PaginatorComponent $Paginator
 */
class ApiController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('FShop','FMenu','ShopsMenus','DictJa','DictEn','LangMaster');

/**
 * index method
 * @author quyhoa
 * 
 * @return void
 * @create day: 09/09/2015
 */
 /**
 * Method getError
 * @author quyhoa
 * 
 * @return void
 * @create day: 15/09/2015
 */
 public $domain = 'http://118.69.77.23:8096/';
 public function getError($name=null){
 	if(!empty($name)){
 		$name = 'categoryList';
 	}
 	return $this->set(array(
	                'successCode' 	=> 0,
	                $name 			=> new object,
	                '_serialize' 	=> array('successCode', $name)
	            ));
 }
  /**
 * Method getData
 * @author quyhoa
 * 
 * @return void
 * @create day: 15/09/2015
 */
 public function getData($data=null,$name=null){
 	if(empty($name)){
 		$name = 'categoryList';
 	}
 	return $this->set(array(
	                'successCode' 	=> 1,
	                $name 			=> $data,
	                '_serialize' 	=> array('successCode', $name)
	            ));
 }
 /**
 * Method getServiceList.json
 * @author quyhoa
 * 
 * @return void
 * @create day: 15/09/2015
 * link test: api/getServiceList.json
 */
 public function getServiceList(){
 	// set method
 	$setMethod = false;
 	$host = 'http://118.69.77.23:8096/';
 	if($this->request->is('post')){
 		$data = $this->request->data;
 		$latitude  		= empty($data['latitude'])?null:$data['latitude'];
	 	$longitude 		= empty($data['longitude'])?null:$data['longitude'];
	 	$langId 		= empty($data['lang_id'])?null:$data['lang_id'];
	 	$setMethod      = true;	
 	}
 	if($this->request->is('get')){
 		$latitude  		= isset($_GET['latitude'])?$_GET['latitude']:null;
	 	$longitude 		= isset($_GET['longitude'])?$_GET['longitude']:null;
	 	$langId 		= isset($_GET['lang_id'])?$_GET['lang_id']:null;
	 	$setMethod      = true;		 	
 	}
 	if($setMethod){
 		if(empty($longitude) || empty($latitude)){
	 		$this->set(array(
	                'successCode' 	=> 0,
	                'categoryList' 	=> new object,
	                '_serialize' 	=> array('successCode', 'categoryList')
	        ));
	 	}else{
	 		$lang 	= $langId;
	 		$first 	= strtoupper(substr($langId, 0,1));
	 		$end 	= substr($langId,1);
	 		$modelDict = 'Dict'.$first.$end;
			// set length for lat
	 		$minlatitude = $latitude - LENGTH_LAT;
	 		$maxlatitude = $latitude + LENGTH_LAT;
	 		// set length for long
	 		$minlongitude = $longitude - LENGTH_LONG;
	 		$maxlongitude = $longitude + LENGTH_LONG;
	 		$categoryLists = $this->FShop->find('all',
	 			array(
	 				'conditions'=>array(
	 								'FShop.lat >='	=>$minlatitude,
	 								'FShop.lat <='	=>$maxlatitude,
	 								'FShop.long >='	=>$minlongitude,
	 								'FShop.long <='	=>$maxlongitude,
	 								// 'FShop.status'	=>$serviceStatus,
	 							  ),
	 			)
	 		);
	 		if(!empty($categoryLists)){
	 			$tmp = array();
	 			$image = null;
	 			foreach ($categoryLists as $key => $value) {
	 				$tmp['placeId'] 		= empty($value['FShop']['id'])? '' : $value['FShop']['id'];
	 				$tmp['placeNameJpn'] 	= empty($value['DictJa']['word_0'])? '' : $value['DictJa']['word_0'];
	 				$idDictJa = empty($value['DictJa']['id'])?null:$value['DictJa']['id'];
	 				// get nameEn
	 				if(!empty($idDictJa)){
	 					$nameEns = $this->DictEn->find('first',array(
		 					'conditions'=>array('DictEn.lang_ja_id'=>$idDictJa),
		 					'fields' =>array('id','word_0')
		 				));
		 				$tmp['placeNameEn'] = $nameEns['DictEn']['word_0'];
		 				$tmp['placeNameOrther'] = $this->getNameDict($value['FShop']['shop_jp_id'],null,$lang);	 					
	 				} 
	 				$tmp['long']			= empty($value['FShop']['long'])? '' : $value['FShop']['long'];
	 				$tmp['lat']				= empty($value['FShop']['lat'])? '' : $value['FShop']['lat'];
	 				$tmp['placeThumbImage'] = $host.'img/'.$value['FShop']['image'];
	 				$image = $tmp['placeThumbImage'];	 				
	 				// set menuList
	 				if(!empty($value['FMenu'])){
	 					$tmp['menuList'] = array();
	 					foreach ($value['FMenu'] as $key => $vl) {
	 						$tmpMenu['menuItemId'] 			=  $vl['id'];
		 					$langJa = $this->DictJa->find('first',array('conditions'=>array('DictJa.id'=>$vl['menu_jp_id']),'contain'=>array('DictEn'=>array('fields'=>'word_0'))));
		 					$tmpMenu['menuItemNameJpn'] 	=  $langJa['DictJa']['word_0'];
		 					$tmpMenu['menuItemNameEn'] 		=  $langJa['DictEn'][0]['word_0'];
		 					$tmpMenu['menuItemNameOrther'] 	=  $this->getNameDict($langJa['DictJa']['id'],null,$lang);
		 					$tmpMenu['menuItemThumbImage'] 	=  $host.'img/'.$vl['image'];
		 					$tmpMenu['menuItemPrice'] 		=  $vl['price'];
		 					$tmp['menuList'][]	 	 		=  $tmpMenu;		 						
		 				}
	 				}	
	 				$categoryList[] = $tmp;
	 				
	 			}
	 			// get info category
	 			$infoCateShop['categoryId'] 		= 1;
	 			$infoCateShop['categoryNameJpn'] 	= '店';
	 			$infoCateShop['categoryNameEn'] 	= $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$infoCateShop['categoryNameJpn']);
	 			$infoCateShop['categoryNameOrther'] = $this->translate(FROM_LANGUAGE,$lang,$infoCateShop['categoryNameJpn']);
	 			$infoCateShop['categoryThumbImage'] = empty($image)?null:$image;

	 			$infoCateShop['Shop'] 	= $categoryList;
	 			$category[] 			= $infoCateShop;
	 			$this->set(array(
	                'successCode' 	=> 1,
	                'categoryList' 	=> $category,
	                '_serialize' 	=> array('successCode', 'categoryList')
	    ));
	 		}else{
	 			$this->getError();
	 		}	
	 	} 
	 }else{
	 	$this->set(array(
	                'successCode' 	=> 0,
	                'placeList' 	=> new object,
	                '_serialize' 	=> array('successCode', 'placeList')
	    ));
	 }
 }
/**
 *Method: POST
 *Description: getMenuItemDetail
 * @param  user_id
 * @return info of song
 * @author hoalqq
 * @create date:10.07.2015
 * @update by:
 * @update date:
 * link test: api/getMenuItemDetail.json?id=142&lang_id=en
 */
 public function getMenuItemDetail(){
 	$result 	= array();
 	$check 		= false;
 	$setMethod 	= false;
 	$host = 'http://118.69.77.23:8096/';
 	if($this->request->is('post')){
 		$data 		= $this->request->data;
 		$id 		= $data['id'];
 		$langId 	= empty($data['lang_id'])?null:$data['lang_id'];
 		$setMethod 	= true;
 	}
 	if($this->request->is('get')){
 		$id 		= isset($_GET['id']) ? $_GET['id'] : null;
 		$langId 	= isset($_GET['lang_id'])?$_GET['lang_id']:null;
 		$setMethod 	= true;
 	}

 	if(!empty($id) && $setMethod){
 		$menus = $this->FMenu->find('first',array('conditions'=>array('FMenu.id'=>$id,'FMenu.status'=>0)));
		if(!empty($menus)){
			// get language orther
			// $checkLang = $this->LangMaster->find('first',array(
			// 		 			'conditions'=> array('LangMaster.id'=>$langId,'status'=>0),
			// 		 			'fields' 	=> array('dict_name'),
			// 		 		));
	 		$langOrther = $langId;
	 		$first = strtoupper(substr($langOrther, 0,1));
	 		$end = substr($langOrther,1);
	 		$modelDictOrther = 'Dict'.$first.$end;
	 		$this->loadModel($modelDictOrther);
			// end
			$lang = 'ja';
			$menus['FMenu']['word_0']= $menus['DictJa']['word_0'];
			$foodstuffId = $menus['FMenu']['foodstuff_id'];
			$this->loadModel('FFoodstuff');
			$listFood 		= array();
			$listFoodEn 	= array();
			$listFoodOrther = array();
			$foodstuffIds 	= explode(",",$foodstuffId);
			foreach ($foodstuffIds as $key => $value) {
				$foodstuff[] = $this->FFoodstuff->find('first',array(
				'fields'=>array('DictJa.word_0','DictJa.id'),
				'conditions'=>array('FFoodstuff.id '=>$value)));
			}
			$this->loadModel('FSeasoning');
			$listSeason 		= array();
			$listSeasonEn 		= array();
			$listSeasonOrther 	= array();
			$seasonId 			= $menus['FMenu']['seasoning_id'];
			$seasons 			= explode(",",$seasonId);
			foreach ($seasons as $key => $value) {
				$season[] = $this->FSeasoning->find('first',array(
				'fields'=>array('DictJa.word_0','DictJa.id'),
				'conditions'=>array('FSeasoning.id '=>$value)));
			}
			$modelDict = 'DictJa';
			foreach($foodstuff as $k=>$val)
			{
				$listFood[] = $val['DictJa']['word_0'];
				$f = $this->DictEn->find('first',array('conditions'=>array('DictEn.lang_ja_id'=>$val['DictJa']['id'])));
				$listFoodEn[] = $f['DictEn']['word_0'];
				$listFoodOrther[] = $this->getNameDict($val['DictJa']['id'],null,$langOrther);
			}
			foreach($season as $k=>$val)
			{
				$listSeason[] = $val[$modelDict]['word_0'];
				$f = $this->DictEn->find('first',array('conditions'=>array('DictEn.lang_ja_id'=>$val['DictJa']['id'])));
				$listSeasonEn[] = $f['DictEn']['word_0'];
				$listSeasonOrther[] = $this->getNameDict($val['DictJa']['id'],null,$langOrther);
			}
			// 
			$result['menuItemId']                 = $id;
			$result['menuItemNameJpn']            = $menus['FMenu']['word_0'];
			$langNameMenuEn = $this->DictEn->find('first',array(
				'conditions' => array('DictEn.lang_ja_id'=>$menus['FMenu']['menu_jp_id']),
				'fields' 	=> array('word_0'),
				'contain'	=> false
			));
			$result['menuItemNameEn']     = $langNameMenuEn['DictEn']['word_0'];
			$result['menuItemNameOrther'] = $this->getNameDict($menus['FMenu']['menu_jp_id'],null,$langOrther);;
			$result['menuItemThumbImage'] = $host.'img/'.$menus['FMenu']['image'];
			$result['menuItemCalorie']    = $menus['FMenu']['calorie'];
			// get method
			$method 											= explode(",",$menus['FMenu']['payment_method_jp_id']);
			$nameMethodJpns 	= array();
			$nameMethodEns  	= array();
			$nameMethodOrthers  	= array();
			foreach ($method as $key => $value) {				
				if($value == 1){
					$nameMethodJpn = '現金';
					$nameMethodEn  = $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$nameMethodJpn);
					$nameMethodOrther  = $this->translate(FROM_LANGUAGE,$langOrther,$nameMethodJpn);
				}
				if($value == 2){
					$nameMethodJpn = 'クレジットカード';
					$nameMethodEn  = $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$nameMethodJpn);
					$nameMethodOrther  = $this->translate(FROM_LANGUAGE,$langOrther,$nameMethodJpn);					
				}
				if($value == 3){
					$nameMethodJpn = 'トラベラーカード';
					$nameMethodEn  = $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$nameMethodJpn);
					$nameMethodOrther  = $this->translate(FROM_LANGUAGE,$langOrther,$nameMethodJpn);					
				}
				$nameMethodJpns[] 		= $nameMethodJpn;
				$nameMethodEns[]  		= $nameMethodEn;	
				$nameMethodOrthers[]  	= $nameMethodOrther;

			}
			$result['menuItemMethodJpn']     	= implode(',', $nameMethodJpns);
			$result['menuItemMethodEn']      	= implode(',', $nameMethodEns);
			$result['menuItemMethodOrther']     = implode(',', $nameMethodOrthers);
			$result['menuItemFoodSdtuffJpn'] 	= (!empty($listFood))?implode(',',$listFood):'';
			$result['menuItemFoodSdtuffEn']  	= (!empty($listFoodEn))?implode(',',$listFoodEn):'';
			$result['menuItemFoodSdtuffOrther'] = (!empty($listFoodOrther))?implode(',',$listFoodOrther):'';
			$result['menuItemFlavoringJpn']  	= (!empty($listSeason))?implode(',',$listSeason):'';
			$result['menuItemFlavoringEn']   	= (!empty($listSeasonEn))?implode(',',$listSeasonEn):'';
			$result['menuItemFlavoringOrther']  = (!empty($listSeasonOrther))?implode(',',$listSeasonOrther):'';
			$result['description_name'] 	 	= $this->getNameDict($menus['FMenu']['description_jp_id'],null,$lang);
			$desEn = $this->DictEn->find('first',array('conditions'=>array('DictEn.lang_ja_id'=>$menus['FMenu']['description_jp_id'])));
			$result['description_name_en'] 	 = $desEn['DictEn']['word_0'];
			
			$result['speacial_deal_name'] 	 = $this->getNameDict($menus['FMenu']['speacial_deal_jp_id'],null,$lang);
			$speacialEn = $this->DictEn->find('first',array('conditions'=>array('DictEn.lang_ja_id'=>$menus['FMenu']['speacial_deal_jp_id'])));
			$result['speacial_deal_name_en'] 	 = $speacialEn['DictEn']['word_0'];
			$result['speacial_deal_name_orther'] 	 = $this->getNameDict($menus['FMenu']['speacial_deal_jp_id'],null,$langOrther);

			$result['tasty_eating_name']     = $this->getNameDict($menus['FMenu']['tasty_eating_jp_id'],null,$lang);
			$tastyEn = $this->DictEn->find('first',array('conditions'=>array('DictEn.lang_ja_id'=>$menus['FMenu']['tasty_eating_jp_id'])));
			$result['tasty_eating_name_en'] 	 = $tastyEn['DictEn']['word_0'];
			$result['tasty_eating_name_orther'] 	 = $this->getNameDict($menus['FMenu']['tasty_eating_jp_id'],null,$langOrther);

			$result['priceunit_name']        = $this->getNameDict($menus['FMenu']['priceunit_jp_id'],null,$lang);
			$this->set(array(
	                'successCode' 	=> 1,
	                'menuItem' 		=> $result,
	                '_serialize' 	=> array('successCode', 'menuItem')
	        ));		
		}
 	}else{
 		$this->set(array(
	                'successCode' 	=> 0,
	                'menuItem' 		=> new object,
	                '_serialize' 	=> array('successCode', 'menuItem')
	    ));	
 	}
 }
}
