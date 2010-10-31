<?php
App::import('Lib', 'facebook-php/src/facebook');
class AppController extends Controller {

    var $components = array('Auth', 'Session', 'Cookie');

	// Facebook variables with app specific id's.
    var $FACEBOOK_APP_ID = '151681881541064'; 
    var $FACEBOOK_API_ID = '7d4ff4f17d8bcbad1086233564bae8c9'; 
    var $FACEBOOK_SECRET = '83b82bd73ec9a3974f83d716457dcf5a';  
    var $FACEBOOK_COOKIE = '';
    // Facebook object will be saved to this variable so it can be accessed universally
    var $FACEBOOK;

    function beforeFilter() {
        
        // Configure AuthComponent
        $this->Auth->authorize = 'controller';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
                
		// Initialise the FB php class
		$this->fbInit();

        // Set current user array that can be accessed in any views
        $me = $this->Auth->user();
   		$this->set('me', $me['User']);       
                
    }
    
    // Needed for the Auth component to work
	function isAuthorized() {
		return true;
	}    

    // Set current user function that can be accessed in any controller
	function me($value = 'id') {
		$me = $this->Auth->user();
		return $me['User'][$value];
	}    
	
	// Initialization of the server-side Facebook integration. Uses PHP Class provided by FB.
	function fbInit() {
		$facebook = new Facebook(array(
			'appId'  => $this->FACEBOOK_APP_ID,
			'secret' => $this->FACEBOOK_SECRET,
			'cookie' => true,
		));	
		$this->FACEBOOK_COOKIE = $facebook->getSession();		
		$this->FACEBOOK = $facebook;
		
		//debug($this->FACEBOOK_COOKIE);
		
		$fbMe = null;
		$fbLogoutUrl = null;
		$fbLoginUrl = null;
		if ($this->FACEBOOK_COOKIE) {
		  try {
		    $fbUid = $this->FACEBOOK->getUser();
		    $fbMe = $this->FACEBOOK->api('/me');
		    if ($fbMe) {
				$fbLogoutUrl = $this->FACEBOOK->getLogoutUrl(array('next' => Router::url(array('controller' => 'users', 'action' => 'logout', 'full_base' => true))));
			}
		  } catch (FacebookApiException $e) {
//		    debug($e);
		  }
		}
		$fbLoginUrl = $this->FACEBOOK->getLoginUrl();		
		
        // Save handy view variables
        $this->set('fbAppId', $this->FACEBOOK_APP_ID); 
        $this->set('fbApiKey', $this->FACEBOOK_API_ID); 
        $this->set('fbCookie', $this->FACEBOOK_COOKIE);
        $this->set('fbMe', $fbMe);
        $this->set('fbLogoutUrl', $fbLogoutUrl);
        $this->set('fbLoginUrl', $fbLoginUrl);
		
	}
	 
	// Can be called on the login screen, i.e. not the user is NOT authenticated to cake.
	function fbCheckUser(){ 
		
		// If the user is logged in to Facebook 
		if ($this->FACEBOOK_COOKIE) {
					
			// If the user is already logged in to Cake
			if ($this->Auth->User()) {

				if ($this->FACEBOOK_COOKIE['uid'] != $this->Auth->User('fb_uid')) {
					// Logged in user and facebook user is not the same, so logout
					$this->redirect($this->Auth->logout());
				}				
				
				$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
			
			// Not logged in to Cake	
			} else {
				
				// Load the User model
		        $this->loadModel('User');  
	            
	            // See if a user with the fb cookie user id is in the User database  
	            $userData = $this->User->find('first', array(  
	               'conditions' => array('User.fb_uid' => $this->FACEBOOK_COOKIE['uid']), 
	               'fields' => array('User.username', 'User.password', 'User.fb_uid'),  
	               'contain' => array() 
	            ));
	            
	            // If the user does not exist in database, create it
	            if (empty($userData)) {
	           	            
					$userData['User']['username'] = $this->FACEBOOK_COOKIE['uid']; 
					// Major security problem with current password thing, needs alternative solution!
					$userData['User']['password'] = $this->Auth->password($this->FACEBOOK_COOKIE['uid']); 
					// Alias needs to be fetched from Facebook, through api call?
					$userData['User']['alias'] = 'FB Name Here';
					$userData['User']['fb_uid'] = $this->FACEBOOK_COOKIE['uid'];  
					$userData['User']['fb_token'] = sha1($this->FACEBOOK_COOKIE['uid'].'evmgr');  
					$userData['User']['role_id'] = 2;
					$userData['User']['total_transactions'] = 0;
					$userData['User']['total_balance'] = 0;
					$userData['User']['active'] = 1;                                
					//$user_record['User']['group_id'] = 2; 
					//$user_record['User']['active'] = 1;  
					//$user_record['User']['name'] = $a_user->first_name;
					//$user_record['User']['lastname'] = $a_user->last_name;  
					//$user_record['User']['website'] = $a_user->website;
					//$user_record['User']['birthday'] = date('Y-m-d', strtotime($a_user->birthday));  
					//$user_record['User']['facebook_link'] = $a_user->link; 
					//$user_record['User']['email'] = $this->FACEBOOK_COOKIE['uid'].'@facebookuser.de';  
					//$user_record['User']['new_passwd'] = $user_record['User']['new_passwd_hash']; 
					//$user_record['User']['confirm_passwd'] =  $user_record['User']['new_passwd_hash'];  
					//$user_record['User']['passwd'] = $user_record['User']['new_passwd_hash']; 
	
	                // Create the User  
	                if ($this->User->save($userData)) {
	                    // All OK, user created, proceeding to login
	                } else {  
						$this->Session->setFlash('An error occured when trying to create the user');
						//$this->redirect('/', null, false);
	                }
	                
	            } else {

					$userData['User']['username'] = $this->FACEBOOK_COOKIE['uid'];
					$userData['User']['password'] = $this->Auth->password($this->FACEBOOK_COOKIE['uid']);
	            }
				
				if ($this->Auth->login($userData)) {
	            	// All OK, user logged in
	            	// debug('All OK, user logged in');
					$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
				} else {
					$this->Session->setFlash('Couldnt login the user');
	            	// debug('Couldnt login the user');
					// $this->redirect('/', null, false);
				}
			}		
		} else {
			// User is not logged in to Facebook, make sure user is not logged in to cake either
			if ($this->Auth->User()) {
				$this->redirect($this->Auth->logout());
			}
		}
    } 

}
?>