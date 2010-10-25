<?php
class Transaction extends AppModel {
	var $name = 'Transaction';	
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
		'transaction_request_id' => array(
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
		'TransactionRequest' => array(
			'className' => 'TransactionRequest',
			'foreignKey' => 'transaction_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TransactionMirror' => array(
			'className' => 'Transaction',
			'foreignKey' => 'mirror_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);
	
	// Updates the friend balance account and user total balance
	function afterSave($created) {
	
		// Update the corresponding friend account balance with the transaction amount
		if($created) {

			// Find the friend relation entry (through the User model)
			$friendData = $this->User->Friend->find('first', array('conditions' => array(
				'Friend.user_id' => $this->data['Transaction']['user_id'],
				'Friend.friend_user_id' => $this->data['Transaction']['friend_user_id']
			)));
			$this->User->Friend->id = $friendData['Friend']['id'];
						
			// Add the transaction amount to the current balance
			$friendData['Friend']['balance'] += $this->data['Transaction']['amount'];
			$friendData['Friend']['transactions']++;
			
			// Update the Friend entry with the new balance
			if($this->User->Friend->save($friendData)) {
				
				// Find the users total_balance and add the transaction amount
				$this->User->id = $this->data['Transaction']['user_id'];
				$userData = $this->User->read();
				
				$userData['User']['total_balance'] += $this->data['Transaction']['amount'];
				$userData['User']['total_transactions']++;
				
				$this->User->save($userData);
			}
		
		}
	
	}
	
	function findMine($user_id) {
		return $this->find('all', array('conditions' => array('Transaction.user_id' => $user_id)));
	}
}
?>