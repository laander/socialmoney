<div id="fb-root"></div>

<fb:login-button></fb:login-button>

<br /><br />

<?php if ($fbMe) {
	echo "I am logged in! Details: <br />";
	debug($fbMe);
} ?>

<?php /*
echo $this->Session->flash('auth');
echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->inputs(array(
	'legend' => __('Login', true),
	'username',
	'password'
));
echo $this->Form->end('Login');
*/ ?>