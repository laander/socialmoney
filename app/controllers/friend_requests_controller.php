<?php
class FriendRequestsController extends AppController {

	var $name = 'FriendRequests';
	var $uses = array('FriendRequest', 'Friend');	
	var $scaffold = 'admin';

    function index() {
    
	    if(!empty($this->data)) {
	    
	    	$this->data['FriendRequest']['user_id'] = $this->me();
	    	$this->data['FriendRequest']['status_id'] = 1;
	    
	        if($this->FriendRequest->save($this->data)) {
	        	$this->Session->setFlash("Friend request sent!");
	        	$this->redirect(array('controller' => 'friend_requests', 'action' => 'index'));
	        }		    
    	}
    	
    	$this->set('sentFriendRequests', $this->FriendRequest->findMineSent('all', $this->me()));	
    	$this->set('receivedFriendRequests', $this->FriendRequest->findMineReceived('all', $this->me()));	    
    	$this->set('friendUsers', $this->FriendRequest->User->find('list'));    
    
    }
    
    function respond($id = null, $status = 3) {
    
    	if ($id != null) {    	
    		$this->FriendRequest->id = $id;
    		$this->data = $this->FriendRequest->findById($id);
	    	$this->data['FriendRequest']['status_id'] = $status;
    		if ($this->FriendRequest->save($this->data)) {
	        	$this->Session->setFlash("Friend request was updated!");    		
    			$this->redirect(array('controller' => 'friend_requests', 'action' => 'index'));
    		}
    	}

    }


}
?>