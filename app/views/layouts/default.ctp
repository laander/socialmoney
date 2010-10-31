<!DOCTYPE >
<html xmlns:fb="http://www.facebook.com/2008/fbml">
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
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	</head>
	<body>

<!--	<script src="http://localhost:8888/socialmoney/libs/facebook-js/all.js.php"></script> -->
		<script type="text/javascript">
		  // Uses the "new" thirdparty Facebook JS library. Not used ATM.
/*
	      // initialize the library with the API key
	      FB.init({ 
	      	apiKey  : '<?php // echo $fbApiKey; ?>',
			appId   : '<?php // echo $fbAppId; ?>',
			apiKey  : '<?php // echo $fbApiKey; ?>',
			status  : true, // check login status
			cookie  : true, // enable cookies to allow the server to access the session
			xfbml   : true // parse XFBML
	      });
	
	      // fetch the status on load
	      FB.getLoginStatus(handleSessionResponse);
	
	      $('#login').bind('click', function() {
	        FB.login(handleSessionResponse);
	        alert(handleSessionResponse);
	      });
	
	      $('#logout').bind('click', function() {
	        FB.logout(handleSessionResponse);
	        alert(handleSessionResponse);
	      });
	
	      $('#disconnect').bind('click', function() {
	        FB.api({ method: 'Auth.revokeAuthorization' }, function(response) {
	          clearDisplay();
	        });
	      });
	
	      // no user, clear display
	      function clearDisplay() {
	        $('#user-info').hide('fast');
	      }
	
	      // handle a session response from any of the auth related calls
	      function handleSessionResponse(response) {
	        // if we dont have a session, just hide the user info
	        if (!response.session) {
	          clearDisplay();
	          return;
	        }
	
	        // if we have a session, query for the user's profile picture and name
	        FB.api(
	          {
	            method: 'fql.query',
	            query: 'SELECT name, pic FROM profile WHERE id=' + FB.getSession().uid
	          },
	          function(response) {
	            var user = response[0];
	            $('#user-info').html('<img src="' + user.pic + '">' + user.name).show('fast');
	          }
	        );
	      }
*/
		</script>
		<script src="http://connect.facebook.net/en_US/all.js"></script>				
		<script type="text/javascript">
			// The offical Facebook JS library. Not totally sure how the session-cookie thing plays together with serverside PHP.
			
			window.fbAsyncInit = function() {
				FB.init({
					appId   : '<?php echo $fbAppId; ?>',
					apiKey  : '<?php echo $fbApiKey; ?>',
					status  : true, // check login status
					cookie  : true, // enable cookies to allow the server to access the session
					xfbml   : true  // parse XFBML
			});
			
		    // Whenever the user logs in, we refresh the page
		    FB.Event.subscribe('auth.login', function(response) {
		    	if (response.session) {
					// console.debug(response.session);
					window.location.reload();
		    	} else {
  					alert('login fail');	
					// window.location.reload();	    	
		    	}
		    
//				FB.getLoginStatus(function(response) {
//					if (response.session) {
//						console.debug(response.session);
						// logged in and connected user, someone you know
//					} else {
//						alert('loginstatus fail');
						// no user session available, someone you dont know
//					}
//				});
		    
		    });		    
		  };
		  
		</script>

		<div id="container">
		
			<div id="header">
				<?php echo $this->Html->link('Social Money ALPHA v0.1', array('controller' => 'dashboard', 'action' => 'index')); 
				if (!empty($me)) {
					echo " ... logged in as: <strong>" . $me['alias'] . "</strong>";
					if ($fbMe != null) {
						echo '<a id="logout" href="' . $fbLogoutUrl . '"">' . 'Out!' . '</a>';					
					}
				}
				echo ' ... <a id="login" href="' . $fbLoginUrl . '"">' . 'Login' . '</a>'; ?>
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
