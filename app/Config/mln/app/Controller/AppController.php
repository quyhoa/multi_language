<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Text');
	public $components = array('Session','Cookie',
		'Auth'=>array(
			'loginAction'=>'/login',
			'authError'=>'Bạn chưa đăng nhập',
			'flash'=>array(
				'element'=>'default',
				'key'=>'auth',
				'params'=>array('class'=>'alert alert-danger')
				),
			'loginRedirect'=>'/'
			)
		);
	
/**
 * check exits method
 *
 * @param string $id
 * @return id if $key exits or false
 * @author hoanq
 * @create_date:2015/05/12
 */

	public function beforeFilter()
	{
		if($this->Session->check('Config.language')) { // Check for existing language session
            $language = $this->Session->read('Config.language'); // Read existing language
            Configure::write('Config.language', $language);        
        }else{
        	$this->Session->write('Config.language','jpn');
        }
	}
	public function isExits($key,$cateId){
		$this->loadModel('DictJa');
		$aDic = $this->DictJa->find('first',array(
			'conditions'=>array(
				'or'=>array(
					'DictJa.word_0'=>$key,
					'DictJa.word_1'=>$key,
					'DictJa.word_2'=>$key,
					'DictJa.word_3'=>$key,
					'DictJa.word_4'=>$key,
					'DictJa.word_5'=>$key,
					'DictJa.word_6'=>$key
				),
				'DictJa.category_id'=>$cateId
			)
		));
		if(empty($aDic)){
			return false;
		}
		else{
			return $aDic['DictJa']['id'];
		}
		
	}
/**
* getNameDict
* Description : get word_0 from disct_ja table
* @author haipt
* create_date :2015/05/14
*/	
	public function getNameDict($id = null,$cateId = null, $lang = null){
		
		$modelDict = 'DictJa';
		if(!is_null($lang))
		{
			//get Language id
			switch($lang)
			{
				case "jpn":
						$this->loadModel('DictJa');
						$modelDict = 'DictJa';
						$conditions[] = array('DictJa.id'=>$id);
						$conditions[] = array('DictJa.status'=>0);
						break;
				case "eng":
						$this->loadModel('DictEn');
						$modelDict = 'DictEn';
						$conditions[] = array('DictEn.lang_ja_id'=>$id);
						$conditions[] = array('DictEn.status'=>0);
						break;
						
			}
			$this->loadModel('LangMaster');
			$languages = $this->LangMaster->find('first',array('fields'=>array('lang_name','id'),'conditions'=>array('dict_name'=>$lang)));
			if(!empty($languages))
			{
				$langId =  $languages['LangMaster']['id'];
				$conditions[]= array($modelDict.'.lang_id'=>$langId);
			}
		}
		else{
			$this->loadModel('DictJa');
			$conditions[] = array('DictJa.id'=>$id);
			$conditions[] = array('DictJa.status'=>0);
		}
		
		if(!is_null($cateId))
		{
			$conditions[]= array($modelDict.'.category_id'=>$cateId);
		}
		$dict = $this->{$modelDict}->find('first',array(
				'conditions'=>$conditions,
				'recursive'=>-1

				));
		
		$word0 = (!empty($dict))?$dict[$modelDict]['word_0']:'';
		return $word0;
	}


}
