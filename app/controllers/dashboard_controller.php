<?php
class DashboardController extends AppController {

	var $name = 'Dashboard';
    var $uses = array('User', 'Friend', 'FriendRequest', 'Transaction', 'TransactionRequest');	
    var $helpers = array('Form', 'Html', 'Javascript', 'Time');
    var $persistModel = true;

    function index() {
        	
    	// Create new Transaction Request form
	    if(!empty($this->data['TransactionRequest'])) {
	    
	    	$this->data['TransactionRequest']['user_id'] = $this->me();
	    	$this->data['TransactionRequest']['status_id'] = 1;
	    
	        if($this->TransactionRequest->save($this->data)) {
	        	$this->Session->setFlash("Transaction request sent!");
	        	//$this->redirect(array('controller' => 'transaction_requests', 'action' => 'index'));
	        }		    
    	}	
    	$this->set('friendUsers', $this->Friend->findMine('list', $this->me()));    
    
    	// Me
    	$myUser = $this->User->find('first', array(
    		'conditions' => array('User.id' => $this->me('id'))
       	));
    	$this->set('myUser', $myUser);
    	
    	// Friends
    	$myFriends = $this->Friend->find('all', array(
    		'conditions' => array('Friend.user_id' => $this->me('id')),
    		'order' => array('Friend.balance ASC'),    		
    	));
    	$this->set('myFriends', $myFriends);
    	
    	// Friend Requests
/*    	$mySentFriendRequests = $this->FriendRequest->find('all', array(
    		'conditions' => array('FriendRequest.user_id' => $this->me('id')),
    		'order' => array('FriendRequest.created DESC'),
    	));
    	$myReceivedFriendRequests = $this->FriendRequest->find('all', array(
    		'conditions' => array('FriendRequest.friend_user_id' => $this->me('id')),
    		'order' => array('FriendRequest.created DESC'),    	
    	));
    	$this->set('mySentFriendRequests', $mySentFriendRequests);
    	$this->set('myReceivedFriendRequests', $myReceivedFriendRequests); */	

    	// Transactions
    	$myTransactions = $this->Transaction->find('all', array(
    		'conditions' => array('Transaction.user_id' => $this->me('id')),
    		'order' => array('Transaction.created DESC'),
		));
    	$this->set('myTransactions', $myTransactions);

		// Sent Transaction Requests (splitted by status)
		$mySentTransactionRequests = $this->TransactionRequest->findMineSent('all', $this->me());
		$mySentTransactionRequestsPending = array();
		$mySentTransactionRequestsDone = array();
		if(isset($mySentTransactionRequests) && !empty($mySentTransactionRequests)) {		
			foreach($mySentTransactionRequests as $item) {
				if ($item['TransactionRequest']['status_id'] == 1) {
					$mySentTransactionRequestsPending[] = $item;
				} else {
					$mySentTransactionRequestsDone[] = $item;
				}
			}
		}
		$this->set('mySentTransactionRequestsPending', $mySentTransactionRequestsPending);
		$this->set('mySentTransactionRequestsDone', $mySentTransactionRequestsDone);		

		// Received Transaction Requests (splitted by status)
		$myReceivedTransactionRequests = $this->TransactionRequest->findMineReceived('all', $this->me());
		$myReceivedTransactionRequestsPending = array();
		$myReceivedTransactionRequestsDone = array();		
		if(isset($myReceivedTransactionRequests) && !empty($myReceivedTransactionRequests)) {
			foreach($myReceivedTransactionRequests as $item) {
				if ($item['TransactionRequest']['status_id'] == 1) {
					$myReceivedTransactionRequestsPending[] = $item;
				} else {
					$myReceivedTransactionRequestsDone[] = $item;
				}
			}
		}
		$this->set('myReceivedTransactionRequestsPending', $myReceivedTransactionRequestsPending);
		$this->set('myReceivedTransactionRequestsDone', $myReceivedTransactionRequestsDone);
		
		//$myTransactionRequests = $this->TransactionRequest->findMine('all', $this->me());
		
    }

}
?>