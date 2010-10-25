<h2>Social Money!</h2><br />

You are currently logged in as: <strong><?php echo $me['username']; ?></strong>, 
privileged with role: <strong><?php echo $me['role_id']; ?></strong><br />

<?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?><br /><br />

My total balance: <?php echo $me['total_balance']; ?><br />
My total transactions: <?php echo $me['total_transactions']; ?><br /><br />

<h3>Friends</h3>

<strong>My friends: </strong><br />
<?php foreach($myFriends as $item) {
	echo $html->link($item['FriendUser']['alias'], array('controller' => 'friends', 'action' => 'view', $item['Friend']['id']));

	echo " (balance: " . $item['Friend']['balance'] . ", transactions: " . $item['Friend']['transactions'] . ") " . "<br />";
} ?><br />

<strong>My sent friend requests (to): </strong><br />
<?php foreach($mySentFriendRequests as $item) {
	echo $item['FriendUser']['alias'] . " [" . $item['FriendRequest']['status_id'] . "] " . "<br />";
} ?><br /> 

<strong>My received friend requests (from): </strong><br />
<?php foreach($myReceivedFriendRequests as $item) {
	echo $item['User']['alias'] . " [" . $item['FriendRequest']['status_id'] . "] " . "<br />";
} ?><br /> 

<?php echo $html->link('Establish your friendships', array('controller' => 'friend_requests', 'action' => 'index')); ?><br /><br />

<h3>Transactions</h3>

<strong>My transactions (with): </strong><br />
<?php foreach($myTransactions as $item) {
	echo $item['FriendUser']['alias'] . " (" . $item['Transaction']['amount'] . ") " . "<br />";
} ?><br />

<strong>My sent transaction requests (to): </strong><br />
<?php foreach($mySentTransactionRequests as $item) {
	echo $item['FriendUser']['alias'] . " (" . $item['TransactionRequest']['amount'] . ") " . " [" . $item['TransactionRequest']['status_id'] . "] " . "<br />";
} ?><br /> 

<strong>My received transaction requests (from): </strong><br />
<?php foreach($myReceivedTransactionRequests as $item) {
	echo $item['User']['alias'] . " (" . $item['TransactionRequest']['amount'] * -1 . ") " . " [" . $item['TransactionRequest']['status_id'] . "] " . "<br />";
} ?><br /> 

<?php echo $html->link('Perform new transactions or respond', array('controller' => 'transaction_requests', 'action' => 'index')); ?><br /><br />

