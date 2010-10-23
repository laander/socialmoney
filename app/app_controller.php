<?php
class AppController extends Controller {
    var $components = array('Auth', 'Session');

    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'controller';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
        
   		$me = $this->Auth->user();
   		$this->set('me', $me);       
        
    }
    
	function isAuthorized() {
		return true;
	}    
}
?>