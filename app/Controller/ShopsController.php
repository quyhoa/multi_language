<?php
App::uses('AppController', 'Controller');
/**
 * FMenus Controller
 *
 * @property FMenu $FMenu
 * @property PaginatorComponent $Paginator
 */
class ShopsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('FShop','FMenu','ShopsMenus');

/**
 * index method
 * @author quyhoa
 * 
 * @return void
 * @create day: 09/09/2015
 */
// test

// endtest
	public function index() {
		$title_for_layout = "店舗情報登録";
		$this->paginate = array(	
			'fields'=>array('FShop.id'),
				'conditions'=>array('FShop.status'=>0),
				'contain'=>array(
					'DictJa'=> array('fields'=>array('DictJa.word_0')),
					// 'FMenu'
					),
				'limit'=>LIMIT,
				'order'=>array('DictJa.created'=>'desc'),
				'paramType'=>'querystring'
			
			);
		$menus = $this->paginate();
		$model = "FShop";
		$this->set(compact('menus','title_for_layout','model'));
		$this->Session->delete('Config.language');		
		$this->Session->delete('select_language');
		$this->Session->delete('check_add');
	}
/**
 * Method
 * Description : add and edit menu
 * @author hoalqq
 * created_date 09/09/2015
 */
	public function add($idMenu = null) {
		if($this->request->is('post')){
			$dataFmenu = $this->request->data;
			$edit = (isset($this->request->data['FShop']['id'] ) && !empty($this->request->data['FShop']['id'] ))?true:false; 
				$this->FShop->create();
				if($this->FShop->save($dataFmenu)){
					$id = $this->FShop->getLastInsertId();
					// save table shops_menus
					if(!empty($dataFmenu['FShop']['listMenu'])){
							foreach ($dataFmenu['FShop']['listMenu'] as $key => $value) {
								$this->ShopsMenus->create();
								$dataShopMenu['ShopsMenus']['shop_id'] = $id;
								$dataShopMenu['ShopsMenus']['menu_id'] = $value;
								$this->ShopsMenus->save($dataShopMenu);
							}
						}
					$msg = ($edit)?SUCCESS_EDIT_MENU:SUCCESS_ADD_MENU;					
					$this->Session->setFlash($msg,'success');
				}else{
					$msg = ($edit)?ERROR_EDIT_MENU:ERROR_ADD_MENU;
					$this->Session->setFlash($msg,'error');
				}
				$this->redirect(array('action'=>'index'));
		}
		$listmenus = $this->FMenu->find('all',array(	
			'fields'=>array('FMenu.id','FMenu.menu_jp_id'),
				'conditions'=>array('FMenu.status'=>0),
				'contain'=>array('DictJa'=> array('fields'=>array('DictJa.word_0'))),
				'limit'=>LIMIT,
				'order'=>array('DictJa.created'=>'desc'),
			
			));
			foreach ($listmenus as $key => $value) {
					$listmenu[$value['FMenu']['id']] = $value['DictJa']['word_0'];
			}	
		$this->set(compact('listmenu'));
		
	}

/**
* Method: 
* return 
* @author hoa
* @create_day: 09/09/2015
**/
	public function delete($id=null) {
		$this->FShop->id = $id;
		$update = $this->FShop->updateAll(
			array('FShop.status'=>1),
			array('FShop.id'=>$id)
		);
		if($update){
			$this->Session->setFlash(SUCCESS_DELETE_FMENU,'success');
		}else{
			$this->Session->setFlash(ERROR_DELETE_FMENU,'error');
		}
			$this->redirect(array('action'=>'index'));
	}
/**
* loadMenu method\
* return json save info a menu
* @author hoa
* @create_day: 09/09/2015
**/
	public function process_delete() {
		if($this->request->is(array('post'))){
			$ids = null;
			$check = true;
			$data = $this->request->data;
			foreach ($data['News']['id'] as $key => $value) {
				if($value==1){
					$update = $this->FShop->updateAll(
						array('FShop.status'=>1),
						array('FShop.id'=>$key)
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
* Method : listMenu
* return json save info a menu
* @author hoa
* @create_day: 09/09/2015
**/
	public function listmenu($id=null){
		if(!empty($id)){
			$menus = array();
			$menus['FMenu'] = array();
			$title_for_layout = "店舗情報登録";
			$menu = $this->FShop->find('first',array(	
				'fields'=>array('FShop.id'),
				'conditions'=>array('FShop.status'=>0,'FShop.id'=>$id),
				'contain'=>array(
					'DictJa'=> array('fields'=>array('DictJa.word_0')),
					'FMenu' => array('fields'=>array('id'),
									 'conditions'=>array('FMenu.status'=>0)	
									 )),
				'limit'=>LIMIT,
				'order'=>array('DictJa.created'=>'desc'),
			));
			// $menus = $this->paginate();
			$menus['DictJa'] = empty($menu['DictJa'])?'':$menu['DictJa'];
			$menus['FShop'] = empty($menu['FShop'])?'':$menu['FShop'];
			if(!empty($menu['FMenu'])){
				foreach ($menu['FMenu'] as $key => $value) {
					$infMenus = $this->FMenu->find('first',array(	
						'fields'=>array('FMenu.id','FMenu.menu_jp_id','foodstuff_id','seasoning_id','price','payment_method_jp_id','description_jp_id','speacial_deal_jp_id','tasty_eating_jp_id'),
						'conditions'=>array('FMenu.status'=>0,'FMenu.id'=>$value['id']),
						'contain'=>array('DictJa'=> array('fields'=>array('DictJa.word_0'))),
						'limit'=>LIMIT,
						'order'=>array('DictJa.created'=>'desc'),
					
					));
					$infMenus['FMenu']['name'] = $infMenus['DictJa']['word_0'];
					$menus['FMenu'][] = empty($infMenus['FMenu'])?'':$infMenus['FMenu'];
				}
			}
			// handel fmenu with shop_id
			$this->set(compact('menus','title_for_layout'));
			$this->Session->delete('Config.language');		
			$this->Session->delete('select_language');
			$this->Session->delete('check_add');
		}
	}
/**
* Method : listMenu
* return json save info a menu
* @author hoa
* @create_day: 10/09/2015
**/
	public function edit($id=null) {
		$lang = $this->Session->read('Config.language');
		if(!empty($id)){
			// hanlde click submit
			if($this->request->is(array('post','put'))){
				$dataFmenu = $this->request->data;
				$this->FShop->create();
				if($this->FShop->save($dataFmenu)){
					$this->ShopsMenus->deleteAll(array('ShopsMenus.shop_id' => $id));								
					// save table shops_menus
					if(!empty($dataFmenu['FShop']['listMenu'])){
							foreach ($dataFmenu['FShop']['listMenu'] as $key => $value) {
								$this->ShopsMenus->create();
								$dataShopMenu['ShopsMenus']['shop_id'] = $id;
								$dataShopMenu['ShopsMenus']['menu_id'] = $value;
								$this->ShopsMenus->save($dataShopMenu);
							}
						}
					$msg = ($edit)?SUCCESS_EDIT_MENU:SUCCESS_ADD_MENU;					
					$this->Session->setFlash($msg,'success');
				}else{
					$msg = ($edit)?ERROR_EDIT_MENU:ERROR_ADD_MENU;
					$this->Session->setFlash($msg,'error');
				}
				$this->redirect(array('action'=>'index'));
			}
			// end 
			$menu = $this->FShop->find('first',array(	
				'conditions'=>array('FShop.status'=>0,'FShop.id'=>$id),
				'contain'=>array('DictJa'=> array('fields'=>array('DictJa.word_0')),'FMenu' => array('id')),
				'limit'=>LIMIT,
				'order'=>array('DictJa.created'=>'desc'),
			));
			$listMenuEdit = array();
			if(!empty($menu['FMenu'])){
				foreach ($menu['FMenu'] as $key => $menus) {
					$listMenuEdit[] = $menus['id'];
				}
			}
			// handle address			
			$menu['FShop']['address1'] = empty($menu['FShop']['address1_jp_id'])? null : $this->getNameDict($menu['FShop']['address1_jp_id'],null,$lang);			
			$menu['FShop']['address2'] = empty($menu['FShop']['address2_jp_id'])? null : $this->getNameDict($menu['FShop']['address2_jp_id'],null,$lang);			
			
			$this->request->data['FShop'] = $menu['FShop'];
			$listmenus = $this->FMenu->find('all',array(	
			'fields'=>array('FMenu.id','FMenu.menu_jp_id'),
				'conditions'=>array('FMenu.status'=>0),
				'contain'=>array('DictJa'=> array('fields'=>array('DictJa.word_0'))),
				'limit'=>LIMIT,
				'order'=>array('DictJa.created'=>'desc'),
			
			));
			foreach ($listmenus as $key => $value) {
					$listmenu[$value['FMenu']['id']] = $value['DictJa']['word_0'];
			}	
		}

		$this->set(compact('listmenu','menu','listMenuEdit'));
	}
	public function deletemenu($id = null) {
		try {
			if(!empty($id)){
				$ids = explode('_', $id);
				$shop_id = $ids[0];
				$menu_id = $ids[1];
				$check = $this->ShopsMenus->deleteAll(array('ShopsMenus.shop_id' => $shop_id,'ShopsMenus.menu_id' => $menu_id,));
				if($check){
					$this->Session->setFlash(SUCCESS_DELETE_FMENU,'success');
				}else{
					$this->Session->setFlash(ERROR_DELETE_FMENU,'error');
				}
			}
		} catch (Exception $e) {
			
		}
		$this->redirect($this->referer());
	}
	/**
* loadMenu method\
* return json save info a menu
* @author hoa
* @create_day: 09/09/2015
**/
	public function process_delete_menu() {
		if($this->request->is(array('post'))){
			$ids = null;
			$check = true;
			$shop_id = '';
			$data = $this->request->data;
			foreach ($data['News']['id'] as $key => $value) {
				if($value==1){
					$ids = explode('_', $key);
					$shop_id = $ids[0];
					$menu_id = $ids[1];
					$update = $this->ShopsMenus->deleteAll(array('ShopsMenus.shop_id' => $shop_id,'ShopsMenus.menu_id' => $menu_id,));
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
			$this->redirect(array('action'=>'listmenu',$shop_id));
		}
	}
}
