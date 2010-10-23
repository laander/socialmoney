<?php
echo $this->Session->flash('auth');
echo "Dash!";

echo "<br />" . $html->link('Logout', array('controller' => 'users', 'action' => 'logout'));

print_r($me);

?>