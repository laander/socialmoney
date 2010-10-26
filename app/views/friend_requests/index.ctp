<h3>Received friend requests</h3>
<ul>

	<?php foreach($receivedFriendRequests as $item) {
		echo "<li>From " . $item['User']['alias'] . " at " . $item['FriendRequest']['created'] . "<br />";
		if ($item['FriendRequest']['status_id'] == 2) {
			echo "The friendship was established <br />";
		} elseif ($item['FriendRequest']['status_id'] == 1) {
			echo "You must respond: ";
			echo $html->link('Accept', array('controller' => 'friend_requests', 'action' => 'respond', $item['FriendRequest']['id'], '2'));
			echo " or ";
			echo $html->link('Reject', array('controller' => 'friend_requests', 'action' => 'respond', $item['FriendRequest']['id'], '3'));
			echo "<br />";			
		} else {
			echo "The friend request was rejected by you <br />";
		}
		echo "<br /></li>";
	} ?>
	
</ul>

<h3>Send friend request requests</h3>

Send a new friend request request to a friend:
<em>BUG: Shouldn't be able to pick existing friends and oneself</em>

<?php echo $this->Form->create('FriendRequest');
	// echo $this->Form->input('user_id');
	echo $this->Form->input('friend_user_id', array('label' => 'Pick your new buddy'));
	// echo $this->Form->input('status_id');
	echo $this->Form->submit();
	echo $this->Form->end();
?>

<ul>

	<?php foreach($sentFriendRequests as $item) {
		echo "<li>To " . $item['FriendUser']['alias'] . " at " . $item['FriendRequest']['created'] . "<br />";
		if ($item['FriendRequest']['status_id'] == 2) {
			echo "The friend request has been accepted <br />";
		} elseif ($item['FriendRequest']['status_id'] == 1) {
			echo "Awaiting feedback from your friend <br />";
		} else {
			echo "The friend request was rejected by your friend <br />";
		}
		echo "<br /></li>";
	} ?>
	
</ul>