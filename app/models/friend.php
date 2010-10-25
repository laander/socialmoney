<?php
class Friend extends AppModel {
	var $name = 'Friend';
	var $displayField = 'friend_user_id';	
	var $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'friend_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'transactions' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'preference' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'friend_request_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mirror_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FriendUser' => array(
			'className' => 'User',
			'foreignKey' => 'friend_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'FriendRequest' => array(
			'className' => 'FriendRequest',
			'foreignKey' => 'friend_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FriendMirror' => array(
			'className' => 'Friend',
			'foreignKey' => 'mirror_id',
			'dependent' => true,			
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);
	
	function findMine($findType = 'all', $userId) {
		if ($findType = 'list') {
	    	$result = $this->find('all', array(
	    		'fields' => array('Friend.friend_user_id', 'FriendUser.alias'),
	    		'conditions' => array('Friend.user_id' => $userId)
	    	));
	    	foreach ($result as $item) {
	    		$resultFiltered[$item['Friend']['friend_user_id']] = $item['FriendUser']['alias'];
	    	}
	    	return $resultFiltered;
    	} else if ($findType = 'all') {
			return $this->find('all', array('conditions' => array('Friend.user_id' => $userId)));
    	} else {
    		return false;
    	}
    	
	}	
	
}
?>