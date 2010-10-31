<h2>Dashboard!</h2>

My total balance: <?php echo $myUser['User']['total_balance']; ?><br />
My total transactions: <?php echo $myUser['User']['total_transactions']; ?><br /><br />

<h3>New Transaction</h3>

<?php echo $this->Form->create('TransactionRequest');
	// echo $this->Form->input('user_id');
	echo $this->Form->input('friend_user_id', array('label' => 'Who?'));
	echo $this->Form->input('amount', array('label' => 'How much?'));
	echo $this->Form->submit('Go');	
	// echo $this->Form->input('status_id');
	echo $this->Form->end();
?>

<h3>Pending transactions</h3>
<table style="width: 600px">

<?php // Output received transaction requests thats pending (needs action)
if(isset($myReceivedTransactionRequestsPending) && !empty($myReceivedTransactionRequestsPending)) {
	foreach($myReceivedTransactionRequestsPending as $item) {
		echo "<tr><td>";
			if ($item['TransactionRequest']['amount'] > 0) {
				echo "I owe " . $item['User']['alias'] . " <span style='color: red'>" . $item['TransactionRequest']['amount'] * 1 . "</span>";
			} else {
				echo $item['User']['alias'] . " owes me " . "<span style='color: green'>" . $item['TransactionRequest']['amount'] * -1 . "</span>";
			}
			echo "</td><td>" . $time->timeAgoInWords($item['TransactionRequest']['created']) . "</td><td>";
			echo $html->link('Accept', array('controller' => 'transaction_requests', 'action' => 'respond', $item['TransactionRequest']['id'], '2'));
			echo " or ";
			echo $html->link('Reject', array('controller' => 'transaction_requests', 'action' => 'respond', $item['TransactionRequest']['id'], '3'));
		echo "</td></tr>";
	}
} else {
	echo "";
} ?>

<?php // Output sent transaction requests thats pending (awaiting reply)
foreach($mySentTransactionRequestsPending as $item) {
	echo "<tr><td>";
		if ($item['TransactionRequest']['amount'] > 0) {
			echo "I owe " . $item['User']['alias'] . " <span style='color: red'>" . $item['TransactionRequest']['amount'] * 1 . "</span>";
		} else {
			echo $item['User']['alias'] . " owes me " . "<span style='color: green'>" . $item['TransactionRequest']['amount'] * -1 . "</span>";
		}
		echo "</td><td>" . $time->timeAgoInWords($item['TransactionRequest']['created']) . "</td><td>";
		echo "Awaiting a response";
	echo "</td></tr>";
} ?>

</table>

<?php echo $html->link('Perform new transactions or respond', array('controller' => 'transaction_requests', 'action' => 'index')); ?><br /><br />

<h3>Friends</h3>
<table style="width: 600px">
	<tr>
		<th>Friend</th>
		<th>Balance</th>
		<th>Transactions</th>
		<th>Latest activity</th>
	</tr>
<?php foreach($myFriends as $item) {
	echo "<tr>";
		echo "<td>" . $html->link($item['FriendUser']['alias'], array('controller' => 'friends', 'action' => 'view', $item['Friend']['id'])) . "</td>";
		echo "<td>";		
		if ($item['Friend']['balance'] < 0) {
			echo "<span style='color: red'>" . $item['Friend']['balance'] * 1 . "</span>";
		} else {
			echo "<span style='color: green'>" . $item['Friend']['balance'] * 1 . "</span>";
		}
		echo "</td>";
		echo "<td>" . $item['Friend']['transactions'] . "</td>";
		echo "<td>" . $item['Friend']['modified'] . "</td>";		
	echo "</tr>";
} ?>
</table>

<?php echo $html->link('Establish your friendships', array('controller' => 'friend_requests', 'action' => 'index')); ?><br /><br />

<h3>Transaction log</h3>
<table style="width: 600px">

<?php foreach($myTransactions as $item) {
	echo "<tr><td>";
		if ($item['Transaction']['amount'] > 0) {
			echo "I owe " . $item['FriendUser']['alias'] . " <span style='color: red'>" . $item['Transaction']['amount'] * 1 . "</span>";
		} else {
			echo $item['FriendUser']['alias'] . " owes me " . "<span style='color: green'>" . $item['Transaction']['amount'] * -1 . "</span>";
		}
		echo "</td><td>" . $time->timeAgoInWords($item['Transaction']['created']) . "</td><td>";
	echo "</td></tr>";
} ?>

</table>


