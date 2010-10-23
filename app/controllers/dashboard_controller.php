<?php
class DashboardController extends AppController {

	var $name = 'Dashboard';
    var $uses = array('Friend');	
	var $scaffold;

    function index() {
      
    	$myFriends = $this->Friend->find('all', array('conditions' => array('Friend.user_id' => $this->Auth->user('id'))));
		$this->set('myFriends', $myFriends);
       
    }

}
?>