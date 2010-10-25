<?php
class DashboardController extends AppController {

	var $name = 'Dashboard';
    var $uses = array('Friend', 'FriendRequest', 'Transaction', 'TransactionRequest');	

    function index() {
    	
    	// Friends
    	$myFriends = $this->Friend->find('all', array('conditions' => array('Friend.user_id' => $this->me('id'))));
    	$this->set('myFriends', $myFriends);
    	
    	// Friend Requests
    	$mySentFriendRequests = $this->FriendRequest->find('all', array('conditions' => array(
    		'FriendRequest.user_id' => $this->me('id'),
//    		'FriendRequest.status_id' => 1	
    	)));
    	$myReceivedFriendRequests = $this->FriendRequest->find('all', array('conditions' => array(
    		'FriendRequest.friend_user_id' => $this->me('id'),
//    		'FriendRequest.status_id' => 1
    	)));
    	$this->set('mySentFriendRequests', $mySentFriendRequests);
    	$this->set('myReceivedFriendRequests', $myReceivedFriendRequests);    	

    	// Transactions
    	$myTransactions = $this->Transaction->find('all', array('conditions' => array('Transaction.user_id' => $this->me('id'))));
    	$this->set('myTransactions', $myTransactions);

		// Transaction Requests
    	$mySentTransactionRequests = $this->TransactionRequest->find('all', array('conditions' => array(
    		'TransactionRequest.user_id' => $this->me('id'),
//    		'TransactionRequest.status_id' => 1
    	)));
    	$myReceivedTransactionRequests = $this->TransactionRequest->find('all', array('conditions' => array(
    		'TransactionRequest.friend_user_id' => $this->me('id'),
//    		'TransactionRequest.status_id' => 1    		
    	)));
    	$this->set('mySentTransactionRequests', $mySentTransactionRequests);    	
    	$this->set('myReceivedTransactionRequests', $myReceivedTransactionRequests);

    }

}
?>