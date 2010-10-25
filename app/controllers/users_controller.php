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
	
}
?>