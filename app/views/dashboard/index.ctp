<?php

echo "Dash!<br />";

echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
echo "<br />";

print_r($me);

?>