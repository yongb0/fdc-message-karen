<!-- /app/View/Users/register.ctp -->

<h1>Registration</h1>
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('name');
	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->input('re_password', array('label' => 'Confirm Password', 'type' => 'password'));
	echo $this->Form->end('Register'); 
	
	echo $this->HTML->link('Back to Login', array('action' => 'login'), array('class' => 'button'));
?>
