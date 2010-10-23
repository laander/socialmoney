<?php
class AppController extends Controller {
    var $components = array('Auth', 'Session');

    function beforeFilter() {
        
        // Configure AuthComponent
        $this->Auth->authorize = 'controller';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
        
        // Set current user array that can be accessed in any views
   		$this->set('me', $this->Auth->user());       
        
    }
    
	function isAuthorized() {
		return true;
	}    
}
?>