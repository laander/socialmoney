<h3>Received transaction requests</h3>
<ul>

	<?php foreach($receivedTransactionRequests as $item) {
		echo "<li>From " . $item['User']['alias'] . " on the amount of " . $item['TransactionRequest']['amount'] * -1 . " at " . $item['TransactionRequest']['created'] . "<br />";
		if ($item['TransactionRequest']['status_id'] == 2) {
			echo "The transaction was mutually accepted <br />";
		} elseif ($item['TransactionRequest']['status_id'] == 1) {
			echo "You must respond: ";
			echo $html->link('Accept', array('controller' => 'transaction_requests', 'action' => 'respond', $item['TransactionRequest']['id'], '2'));
			echo " or ";
			echo $html->link('Reject', array('controller' => 'transaction_requests', 'action' => 'respond', $item['TransactionRequest']['id'], '3'));			
			echo "<br />";			
		} else {
			echo "The transaction was rejected by you <br />";
		}
		echo "<br /></li>";
	} ?>
	
</ul>

<h3>Send transaction requests</h3>

Send a new transaction request to a friend:

<?php echo $this->Form->create('TransactionRequest');
	// echo $this->Form->input('user_id');
	echo $this->Form->input('friend_user_id', array('label' => 'Pick your friend'));
	echo $this->Form->input('amount');
	echo $this->Form->submit();	
	// echo $this->Form->input('status_id');
	echo $this->Form->end();
?>

<ul>

	<?php foreach($sentTransactionRequests as $item) {
		echo "<li>To " . $item['FriendUser']['alias'] . " on the amount of " . $item['TransactionRequest']['amount'] . " at " . $item['TransactionRequest']['created'] . "<br />";
		if ($item['TransactionRequest']['status_id'] == 2) {
			echo "The transaction has been accepted <br />";
		} elseif ($item['TransactionRequest']['status_id'] == 1) {
			echo "Awaiting feedback from your friend <br />";
		} else {
			echo "The transaction was rejected by your friend <br />";
		}
		echo "<br /></li>";
	} ?>
	
</ul>