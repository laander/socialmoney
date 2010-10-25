<h3>Transactions with your friend</h3>

<p><?php echo $friend['FriendUser']['alias']; ?></p>
<p>Current balance: <?php echo $friend['Friend']['balance']; ?></p>
<p>Number of transactions: <?php echo $friend['Friend']['transactions']; ?></p>
<br />

<ul>
	<?php foreach($transactions as $item) {
		echo "<li>The amount of " . $item['Transaction']['amount'] . " at " . $item['Transaction']['created'] . "<br />";
		echo "Based on the request from " . $item['TransactionRequest']['created'];
		echo "<br /><br /></li>";
	} ?>
	
</ul>