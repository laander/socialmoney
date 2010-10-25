
Send a new transaction request to a friend:

<?php echo $this->Form->create('TransactionRequest');
	// echo $this->Form->input('user_id');
	echo $this->Form->input('friend_user_id', array('label' => 'Pick your friend'));
	echo $this->Form->input('amount');
	// echo $this->Form->input('status_id');
	echo $this->Form->end();
?>

<ul>

	<?php foreach($sentTransactionRequests as $item) {
		echo "<li>To " . $item['FriendUser']['alias'] . " on the amount of " . $item['TransactionRequest']['amount'] . " at " . $item['TransactionRequest']['created'] . "<br />";
		if ($item['TransactionRequest']['status_id'] == 2) {
			echo "The transaction has been accepted <br />";
		} elseif ($item['TransactionRequest']['status_id'] == 1) {
			echo "Your awaiting feedback from your friend <br />";
		} else {
			echo "The transaction was rejected by your friend <br />";
		}
		echo "<br /></li>";
	} ?>
	
</ul>