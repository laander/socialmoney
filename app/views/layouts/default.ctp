<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php echo $title_for_layout; ?>, Social Money</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('cake.generic');
			echo $scripts_for_layout;
		?>
		<style type="text/css">
			#header a { color: #fff }
			#header { color: gray; }
		</style>
	</head>
	<body>
		<div id="container">
		
			<div id="header">
				<?php echo $this->Html->link('Social Money ALPHA v0.1', array('controller' => 'dashboard', 'action' => 'index')); ?>
				... logged in as: <strong><?php echo $me['username']; ?></strong>
				(<?php echo $html->link('logout', array('controller' => 'users', 'action' => 'logout')); ?>, <?php echo $html->link('profile', array('controller' => 'users', 'action' => 'profile')); ?>)
			</div>
		
			<div id="content">	
				<?php echo $this->Session->flash(); ?>
				<?php echo $content_for_layout; ?>
			</div>
		
			<div id="footer"></div>
			<?php echo $this->element('sql_dump'); ?>	
		
		</div>
	</body>
</html>
