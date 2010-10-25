<?php
class FriendsController extends AppController {

	var $name = 'Friends';
	var $scaffold = 'admin';

	function view($id = null) {
	
		$this->set('friend', $this->Friend->findById($id));
		$this->set('transactions', $this->Friend->User->Transaction->findMine($this->me()));

	}
	
}
?>