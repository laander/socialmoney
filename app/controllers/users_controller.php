<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $scaffold = 'admin';

    function beforeFilter() {
        parent::beforeFilter();        
        $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
       // $this->Auth->allow(array('*'));
    }

	function login() {
		// Auth Magic 
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function profile() {
		$this->set('title_for_layout', 'Rediger Profil');	
		if (!empty($this->data)) {
			$this->data['User']['role_id'] = $this->Auth->user('role_id');
			if (!$this->data['User']['changePassword']) {
				unset($this->data['User']['password']);
			}
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('Your profile was updated!');
				$this->redirect('/', null, false);
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $this->Auth->user('id'));
		}
	}	
	
}
?>