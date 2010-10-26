<?php
class TransactionRequestsController extends AppController {

	var $name = 'TransactionRequests';
	var $uses = array('TransactionRequest', 'Friend');
    var $scaffold = 'admin';
    
    function send() {
    

    }
    
    function index() {
    
	    if(!empty($this->data)) {
	    
	    	$this->data['TransactionRequest']['user_id'] = $this->me();
	    	$this->data['TransactionRequest']['status_id'] = 1;
	        if($this->TransactionRequest->save($this->data)) {
	        	$this->Session->setFlash("Transaction request sent!");
	        	$this->redirect(array('controller' => 'transaction_requests', 'action' => 'index'));
	        }		    
    	}
    	
    	$this->set('sentTransactionRequests', $this->TransactionRequest->findMineSent('all', $this->me()));	
    	$this->set('receivedTransactionRequests', $this->TransactionRequest->findMineReceived('all', $this->me()));	    
    	$this->set('friendUsers', $this->Friend->findMine('list', $this->me()));    
    
    }
    
    function respond($id = null, $status = 3) {
    
    	if ($id != null) {
    		$this->TransactionRequest->id = $id;
    		$this->data = $this->TransactionRequest->findById($id);
    		$this->data['TransactionRequest']['status_id'] = $status;
    		if ($this->TransactionRequest->save($this->data)) {
	        	$this->Session->setFlash("Transaction request was updated!");    		
    			$this->redirect(array('controller' => 'transaction_requests', 'action' => 'index'));
    		}
    	}

    }

}
?>