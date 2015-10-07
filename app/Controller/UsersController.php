<?php 
/**
* 
*/
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
	public $uses = array('User');
	/**
	*Name method: login
	*login system
	*@author: Hoa
	*@create date:
	**/
	public $components = array('Cookie');
	public function login() {
		if($this->request->is('post')){
			$data = $this->request->data;
			
			$checkUser = $this->User->find('first',array(
				'conditions'=>array('email'=>$data['User']['email'],'password'=>md5($data['User']['password']))
			));
			if(empty($checkUser)){
				$this->Session->setFlash(ERROR_LOGIN,'error');
			}else{
				if($this->Auth->login($checkUser)){
					if($data['User']['Remember'] ==1){
						$cLogin['email'] = $data['User']['email'];
						$cLogin['password'] = $data['User']['password'];
						$this->Cookie->write('email',$cLogin,TIME_COOKIE);
					}
					$sLogin['email'] = $data['User']['email'];
					$sLogin['password'] = $data['User']['password'];
					$this->Session->write('sLogin',$sLogin);
					$this->redirect('/');
				}else{
					$this->Session->setFlash(ERROR_LOGIN,'error');	
				}
			}
		}else{
			$rLogin = $this->Session->check('sLogin');
			$rC_Login = $this->Cookie->check('email');
			if($rC_Login === true){
				$dataCookie = $this->Cookie->read('email');
				$this->request->data['User']['email'] = $dataCookie['email'];
				$this->request->data['User']['password'] = $dataCookie['password'];
			}
			if($rLogin){
				$dataLogin = $this->Session->read('sLogin');
				$checkLogin = $this->User->find('first',array(
					'conditions'=>array(
						'email'=>$dataLogin['email'],
						'password'=>md5($dataLogin['password'])
					)
				));
				if(!empty($checkLogin)){
					$this->redirect('/');
				}
			}
		}
	}
/**
* logout method
* @return login
* @author hoa
* @create_day: 18/05/2015
**/
	public function logout() {
		$this->Session->destroy();
		$this->redirect('/');
	}
}
 ?>