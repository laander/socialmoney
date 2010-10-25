<?php
class FriendRequest extends AppModel {
	var $name = 'FriendRequest';
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
		'status_id' => array(
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
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Friend' => array(
			'className' => 'Friend',
			'foreignKey' => 'friend_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function afterSave($created) {
		
		// When a friend request has been accepted, friend entries should be created for the connecting users.
		// Two mirrored entries are created in the friends model, with reference to the original request.
		if(!$created && $this->data['FriendRequest']['status_id'] == 2) {
			
			// Create the first friend entry
			$this->Friend->create();
			$friend1Data = array(
				'Friend' => array(
					'user_id' => $this->data['FriendRequest']['user_id'],
					'friend_user_id' => $this->data['FriendRequest']['friend_user_id'],
					'balance' => 0,
					'transactions' => 0,
					'preference' => 0,
					'active' => 1,
					'friend_request_id' => $this->data['FriendRequest']['id'],
					'mirror_id' => 0,
				)
			);
			
			if($this->Friend->save($friend1Data)) {
		        
		        // Get the new entrys id and create the second friend entry with roughly same data as the first
		        $friend1Id = $this->Friend->id;
				$this->Friend->create();
				
				$friend2Data = $friend1Data;
				$friend2Data['Friend']['user_id'] = $this->data['FriendRequest']['friend_user_id'];
				$friend2Data['Friend']['friend_user_id'] = $this->data['FriendRequest']['user_id'];
				$friend2Data['Friend']['mirror_id'] = $friend1Id;
				
				if($this->Friend->save($friend2Data)) {

					// Set the first entrys mirror_id to the second entrys
					$friend2Id = $this->Friend->id;					
					$this->Friend->id = $friend1Id;
					
					if ($this->Friend->saveField('mirror_id', $friend2Id)) {
						// All saved!
					}							
				}
			}
		}
	}
	
	function findMineSent($findType = 'all', $userId) {
		return $this->find($findType, array('conditions' => array('FriendRequest.user_id' => $userId)));
	}
	function findMineReceived($findType = 'all', $userId) {
		return $this->find($findType, array('conditions' => array('FriendRequest.friend_user_id' => $userId)));
	}	
	
}
?>