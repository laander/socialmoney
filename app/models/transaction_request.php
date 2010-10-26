<?php
class TransactionRequest extends AppModel {
	var $name = 'TransactionRequest';
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
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'transaction_request_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function afterSave($created) {
		
		// When a transaction request has been accepted, transaction entries should be created.
		// Two mirrored entries are created in the transaction model, with reference to the original request.
		if(!$created && $this->data['TransactionRequest']['status_id'] == 2) {
			
			// Create the first transaction entry
			$this->Transaction->create();
			$transaction1Data = array(
				'Transaction' => array(
					'user_id' => $this->data['TransactionRequest']['user_id'],
					'friend_user_id' => $this->data['TransactionRequest']['friend_user_id'],
					'amount' => $this->data['TransactionRequest']['amount'],
					'transaction_request_id' => $this->data['TransactionRequest']['id'],
					'mirror_id' => 0,
				)
			);
			
			if($this->Transaction->save($transaction1Data)) {
		        
		        // Get the new entrys id and create the second transaction entry with roughly same data as the first
		        $transaction1Id = $this->Transaction->id;
				$this->Transaction->create();
				
				$transaction2Data = $transaction1Data;
				$transaction2Data['Transaction']['user_id'] = $this->data['TransactionRequest']['friend_user_id'];
				$transaction2Data['Transaction']['friend_user_id'] = $this->data['TransactionRequest']['user_id'];
				$transaction2Data['Transaction']['amount'] = $this->data['TransactionRequest']['amount'] * -1;				
				$transaction2Data['Transaction']['mirror_id'] = $transaction1Id;
				
				if($this->Transaction->save($transaction2Data)) {
					
					// Set the first entrys mirror_id to the second entrys
					$transaction2Id = $this->Transaction->id;					
					$this->Transaction->id = $transaction1Id;
					
					if ($this->Transaction->saveField('mirror_id', $transaction2Id)) {
						// All saved!						
					}		
				}
			}
		}
	}

	function findMineSent($findType = 'all', $userId) {
		return $this->find($findType, array('conditions' => array('TransactionRequest.user_id' => $userId)));
	}
	function findMineReceived($findType = 'all', $userId) {
		return $this->find($findType, array('conditions' => array('TransactionRequest.friend_user_id' => $userId)));
	}
	function findMine($findType = 'all', $userId) {
		return $this->find($findType, array('conditions' => array(
			array('OR' => array(
				'TransactionRequest.user_id' => $userId,
				'TransactionRequest.friend_user_id' => $userId
				)
			)
		)));
	}
}
?>