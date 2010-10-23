<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $scaffold;

    function beforeFilter() {
        parent::beforeFilter();        
        $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
    }

	function login() {
		// Auth Magic 
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}

}
?>