<!-- /app/View/Users/login.ctp -->

<h1>Login</h1>
<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create();
	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->end('Login');
	
	echo $this->HTML->link('Register', array('action' => 'register'), array('class' => 'button'));
?>