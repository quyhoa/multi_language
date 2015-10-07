<?php
App::uses('AppController', 'Controller');
/**
 * DictJas Controller
 *
 * @property DictJa $DictJa
 * @property PaginatorComponent $Paginator
 */
class DictJasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	 public function test(){
	 	$this->loadModel('FShop');
	 	debug($this->FShop->find('first'));
	 	exit;
		//save into dict_jas
	 }
/**
* function ajaxMulWord
* @return json data{status,}
* @author haipt
* @create day: 12/05/2015
**/

	public function ajaxMulWord()
	{
		$this->autoRender = false;
		$this->layout = false;
		if($this->request->is(array('POST','put')))
		{
			$data 				= $this->request->data;
			$word_japan 		= '';
			$translate_japan 	= '';
			$rel = array(); 
			$check_language = $this->Session->check('Config.language')? $this->Session->read('Config.language'):'ja';	
			if(!empty($data['word'])){
				// handle language ja
				if($check_language == 'ja'){
					$word_japan 	= $data['word'];
					$word 			= $word_japan;	
					$cateId 		= $data['cate_id'];			
					$check 			= $this->isExits($word,$cateId);
					// check language		

						if($check===false){//translate and save data

							$rel['status']='0';	//	word not exist				
							//translate
							$text = $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$word);										
					
							//save into dict_jas
							$this->loadModel('LangMaster');
							$fromLang =$this->LangMaster->find('first',array('conditions'=>array('dict_name'=>FROM_LANGUAGE,'status'=>0),'recursive'=>-1,));
							$fromLangId = (!empty($fromLang))?$fromLang['LangMaster']['id']:'';
							$aSave['DictJa'] = array('category_id'=>$cateId,'word_0'=>$word,'lang_id'=>$fromLangId);
							$this->DictJa->create();
							if($this->DictJa->save($aSave))
							{
								$id = $this->DictJa->getLastInsertId();
								$rel['id'] 		= $id;
								$rel['error'] 	= '';
								$rel['text']	=$text;
								// handle list
								$listLangueges = $this->LangMaster->find('all',array('fields'=>array('id','dict_name','status'),'conditions'=>array('status'=>0,'id >'=> 1),'recursive'=>-1,));
								foreach ($listLangueges as $key => $value) {
							 		$textLanguage = $this->translate(FROM_LANGUAGE,$value['LangMaster']['dict_name'],'持っているメニュー一覧');
							 		$first = strtoupper(substr($value['LangMaster']['dict_name'], 0,1));
							 		$end = substr($value['LangMaster']['dict_name'],1);
							 		$langModel = 'Dict'.$first.$end;
							 		$toLang = $value['LangMaster']['id'];	 		
							 		$toLangId = (!empty($toLang))?$toLang:'';
							 		$aSaveEn[$langModel] = array('category_id'=>$cateId,'word_0'=>$textLanguage,'lang_id'=>$toLangId,'lang_ja_id'=>$id);
							 		$this->loadModel($langModel);
							 		$this->{$langModel}->create();
							 		if($this->{$langModel}->save($aSaveEn))
									{
										$tranId = $this->{$langModel}->getLastInsertId();
										$rel['translate'] = '1';
										$rel['translate_id'] = $tranId;
									}
									else{
										$rel['translate'] = '0';
										$rel['translate_id'] = '';
									}
							 	}
							 	// end handle
							}
							else{
								$rel['id'] 		= '';
								$rel['error'] 	= '1';
								$rel['text']	=$text;
							}
						}
						else{
							$rel['status']	='1';// word exist
							$rel['id'] 		= $check;
							$rel['error'] 	= '';
							$rel['text']	= '';
						}
				}
				// handle language orther
				else{
					$lang_ja_id = $data['lang_ja_id'];
					$cateId 	= $data['cate_id'];
					$word 		= $data['word'];								
					// set
					$rel['id'] = $lang_ja_id;
					$rel['error'] = '';
					// get word dict_ja
					$word_dict_ja = $this->DictJa->find('first',array(
						'conditions'=>array(
							'DictJa.id'			=>$lang_ja_id,
							'DictJa.category_id'=>$cateId)));
					$rel['text']=$word_dict_ja['DictJa']['word_0'];
					$first = strtoupper(substr($check_language, 0,1));
			 		$end = substr($check_language,1);
			 		$model = 'Dict'.$first.$end;
					$this->loadModel($model);
					$update = $this->{$model}->updateAll(
								array($model.'.word_0'		=>"'".$word."'"),
								array($model.'.lang_ja_id'	=>$lang_ja_id,
									$model.'.category_id'	=>$cateId));

					// $rel['error']=$update;
				}
			}else{
				$rel['error']='2';
			}
		}
		else{
			$rel['error']='2';
		}
		echo json_encode($rel);exit;

	}
/**
* function ajaxMulItem
* @return json data{status,}
* @author haipt
* @create day: 12/05/2015
**/

	public function ajaxMulItem()
	{
		$this->autoRender = false;
		$this->layout = false;
		$check_language = $this->Session->check('Config.language')? $this->Session->read('Config.language'):'ja';
		if($this->request->is(array('POST')))
		{
			$data 		= $this->request->data;
			$rel 		= array();	
			$cateId 	= $data['cate_id'];
			$numItem 	= $data['item'];
			
			if($check_language == 'ja'){

					$word = trim($data['word']);
					if(!empty($word)){
						// check language
						$check = $this->isExits($word,$cateId);
						if($check===false){//translate and save data
							$rel['status']='0';	//	word not exist
							//translate
							$text = $this->translate(FROM_LANGUAGE,TO_LANGUAGE_EN,$word);
							//save into dict_jas
							$this->loadModel('LangMaster');
							$fromLang =$this->LangMaster->find('first',array('conditions'=>array('dict_name'=>FROM_LANGUAGE,'status'=>0),'recursive'=>-1,));
							$fromLangId = (!empty($fromLang))?$fromLang['LangMaster']['id']:'';
							$aSave['DictJa'] = array('category_id'=>$cateId,'word_0'=>$word,'lang_id'=>$fromLangId);
							$this->DictJa->create();
							if($this->DictJa->save($aSave))
							{
								$id = $this->DictJa->getLastInsertId();
								$rel['id'] 		= $id;
								$rel['error'] 	= '';
								$rel['text']	= $text;
								// handle list
								$listLangueges = $this->LangMaster->find('all',array('fields'=>array('id','dict_name','status'),'conditions'=>array('status'=>0,'id >'=> 1),'recursive'=>-1,));
								foreach ($listLangueges as $key => $value) {
							 		$textLanguage = $this->translate(FROM_LANGUAGE,$value['LangMaster']['dict_name'],'持っているメニュー一覧');
							 		$first = strtoupper(substr($value['LangMaster']['dict_name'], 0,1));
							 		$end = substr($value['LangMaster']['dict_name'],1);
							 		$langModel = 'Dict'.$first.$end;
							 		$toLang = $value['LangMaster']['id'];	 		
							 		$toLangId = (!empty($toLang))?$toLang:'';
							 		$aSaveEn[$langModel] = array('category_id'=>$cateId,'word_0'=>$textLanguage,'lang_id'=>$toLangId,'lang_ja_id'=>$id);
							 		$this->loadModel($langModel);
							 		$this->{$langModel}->create();
							 		if($this->{$langModel}->save($aSaveEn))
									{
										$tranId = $this->{$langModel}->getLastInsertId();
										$rel['translate'] = '1';
										$rel['translate_id'] = $tranId;
									}
									else{
										$rel['translate'] = '0';
										$rel['translate_id'] = '';
									}
							 	}
							 	// end handle
							}
							else{
								$rel['id'] 		= '';
								$rel['error'] 	= '1';
								$rel['text']	= $text;
							}
						}
						else{
							$rel['status']='1';// word exist
							
							$id = $check;
							$rel['error'] = '';
							$rel['text']= '';
						}					
						$itemId = array();
						if($this->Session->check('item_'.$cateId))
						{
							$itemId = $this->Session->read('item_'.$cateId);														
						}
						//save data foodstuff
						if($cateId ==2)
						{
							$this->loadModel('FFoodstuff');
							$checkFood = $this->FFoodstuff->find('first'
								,array(
									'conditions'=>array(
										'FFoodstuff.foodstuff_jp_id'=>$id),
									// 'recursive'=>-1
									));
							if(!empty($checkFood))
							{
								$item = $checkFood['FFoodstuff']['id'];
								$rel['status']='1';
								$rel['error'] = '';
							}
							else{
								$this->FFoodstuff->create();
								if($this->FFoodstuff->save(array('FFoodstuff'=>array('foodstuff_jp_id'=>$id)))){
									$item = $this->FFoodstuff->getLastInsertId();
									$rel['error'] = 'savedFood';
								}
								else{
									$rel['error'] = '1';
								}
							}
						}
						else if($cateId==3)
						{
							$this->loadModel('FSeasoning');
							$checkSeason = $this->FSeasoning->find('first',array(
																				'conditions'=>array('FSeasoning.seasoning_jp_id'=>$id),
																				'recursive'=>-1
																				));
							if(!empty($checkFood))
							{
								$item = $checkSeason['seasoning_jp_id']['id'];
								$rel['status']='1';
								$rel['error'] = '';
							}
							else{
								$this->FSeasoning->create();
								if($this->FSeasoning->save(array('FSeasoning'=>array('seasoning_jp_id'=>$id)))){
									$item = $this->FSeasoning->getLastInsertId();
									$rel['error'] = 'savedSea';
								}
								else{
									$rel['error'] = '1';
								}
							}
						}
						$itemId[$numItem]=$item;
						$rel['id'] = implode(",", $itemId);
						$this->Session->write('item_'.$cateId,$itemId);
					}else{
						if($this->Session->check('item_'.$cateId))
						{
							$itemId = $this->Session->read('item_'.$cateId);
							unset($itemId[$numItem]);
							if(!empty($itemId))
							{
								$rel['id'] = implode(",", $itemId);
								
							}
							else{
								$rel['id'] = '';
							}
							$rel['error'] = '';
							$this->Session->write('item_'.$cateId,$itemId);
							
						}
					}
			}else{
				// switch ($check_language) {
				// 	case 'eng':
				// 		$dic_model = 'DictEn';
				// 		break;
					
				// 	default:
				// 		$dic_model = 'DictVie';
				// 		break;
				// }
				$first 		= strtoupper(substr($check_language, 0,1));
		 		$end 		= substr($check_language,1);
		 		$dic_model 	= 'Dict'.$first.$end;
				$this->loadModel($dic_model);							
					$id_data = $data['list_item'];
					$itemId = array();
						if($this->Session->check('item_'.$cateId))
						{
							$itemId = $this->Session->read('item_'.$cateId);												
						}					
					//save data foodstuff
						if($cateId ==2)
						{								
							if(!empty($id_data)){						
								$this->loadModel('FFoodstuff');
								$infoFood 	=  $this->FFoodstuff->find('first',array('conditions'=>array('FFoodstuff.id'=>$id_data)));
								$id 			= $infoFood['DictJa']['id'];
								$rel['error'] 	= '';
								$rel['text']	= $data['word'];
								// thuc hien update Dict_en
								$en 	= $this->{$dic_model}->find('first',array('conditions'=>array($dic_model.'.category_id'=>$cateId,$dic_model.'.lang_ja_id'=>$id)));
								$update = $this->{$dic_model}->updateAll(
									array($dic_model.'.word_0'=>"'".$data['word']."'"),
									array($dic_model.'.id'=>$en[$dic_model]['id'])
								);						
								
								if($update){$item = $infoFood['FFoodstuff']['id'];}	
							}else{
								$id_menu = $this->Session->read('check_add');
								$rel['error']=$id_menu;
								// do save in table dict_en
								$this->{$dic_model}->create();
								$dataEn[$dic_model] = array('category_id'=>$cateId,'word_0'=>$data['word0']);
								$this->{$dic_model}->save($dataEn[$dic_model]);
							}					
						}
						else if($cateId==3)
						{
							if(!empty($id_data)){
							$this->loadModel('FSeasoning');
							$infoSea 	    =  $this->FSeasoning->find('first',array('conditions'=>array('FSeasoning.id'=>$id_data)));
							$id 			= $infoSea['DictJa']['id'];
							$rel['error'] 	= '';
							$rel['text']	= $data['word'];

							// thuc hien update Dict_en
							$en 	= $this->{$dic_model}->find('first',array('conditions'=>array($dic_model.'.category_id'=>$cateId,$dic_model.'.lang_ja_id'=>$id)));
							$update = $this->{$dic_model}->updateAll(
								array($dic_model.'.word_0'=>"'".$data['word']."'"),
								array($dic_model.'.id'=>$en[$dic_model]['id'])
							);		
							if($update){$item = $infoSea['FSeasoning']['id'];}
							}else{
								$id_menu = $this->Session->read('check_add');
								$rel['error']=$id_menu;
								$this->{$dic_model}->create();
								$dataEn[$dic_model] = array('category_id'=>$cateId,'word_0'=>$data['word0']);
								$this->{$dic_model}->save($dataEn[$dic_model]);
							}	
						}						
					$itemId[$numItem]=$item;
					$rel['id'] = implode(",", $itemId);
					$this->Session->write('item_'.$cateId,$itemId);
				
			}
				
				
		}
		else{
			$rel['error']='2';
		}
		echo json_encode($rel);exit;

	}
/**
* removeItem
* Description: remove item
* @author haipt
* create_date 2015/05/14
*/
	public function removeItem()
	{
		$this->autoRender = false;
		$this->layout = false;
		$id = "";
		if($this->request->is(array('POST')))
		{
			$data = $this->request->data;
			$cateId = $data['cate_id'];
			$row =  $data['row'];
			$id= '';
			if($this->Session->check('item_'.$cateId))
			{
				$itemId = $this->Session->read('item_'.$cateId);
				if(!empty($itemId))
				{
					$i = $row*2 -2;
					if(isset($itemId[$i+1]))
					{
						unset($itemId[$i+1]);
					}
					if(isset($itemId[$i]))
					{
						unset($itemId[$i]);
					}
					$this->Session->write('item_'.$cateId,$itemId);
					$id = implode(',',$itemId);			
				}
			}
			
		}
		echo $id;
			exit;
	}
	public function suggestWord()
	{
		$this->autoRender = false;
		$this->layout = false;
		$rel = '';
		if($this->request->is(array('POST'))){
			$data = $this->request->data;
			$word0 = $data['word0'];
			$dict = $this->DictJa->find('list',array(
													'fields'=>array('id','word_0'),
													'conditions'=>array('DictJa.word_0 LIKE'=>$word0."%")));
			$rel = (!empty($dict))?json_encode($dict):'';
		}
		echo $rel;exit;
	}
}
