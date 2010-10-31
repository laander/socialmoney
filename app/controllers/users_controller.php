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

		// Runs Facebook user check
        $this->fbCheckUser();			

        // Check for possible Facebook login return session for the connected Facebook user and the User model
        if (isset($this->params['url']['session'])) {
        	$fbCallbackSessionFull = json_decode($this->params['url']['session'], true);
			if (!empty($fbCallbackSessionFull)) {
				$this->FACEBOOK_COOKIE = $fbCallbackSessionFull;
				$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
			}
		}
	}
	
	// Should be used indirectly after logging out of Facebook first
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	// Perhaps shouldnt be available as Facebook handles all user info?
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