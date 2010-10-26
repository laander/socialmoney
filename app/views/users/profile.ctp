<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend>Edit my profile</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('alias', array('label' => 'Alias'));
		echo $this->Form->input('username', array('label' => 'Username (for login)'));
		//echo $this->Form->input('role_id', array('label' => 'Rolle'));

        echo $this->Form->input('changePassword', array('label' => 'Change password', 'type' => 'checkbox', 'checked'=> 'false'));
        ?><div><?php
			echo $this->Form->input('password', array('label' => 'Enter new password', 'value' => ''));                
        ?></div><div></div>

	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>