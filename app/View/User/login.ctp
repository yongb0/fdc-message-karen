<!-- /app/View/Users/login.ctp -->


	<?php 
	switch($data) {
	case 1: ?>
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Login Unsuccessful!</strong> Invalid username or password. Try again.
		</div>
	<?php	break; 
			
	default:
		break;
		}
	?>
	<div class="jumbotron">
		<h1>Log In</h1>
	</div>
	<div class="row">	
		<div class="col-sm-8">
			<?php 
				echo $this->Form->create();
				echo $this->Form->input('email', array('class' => 'form-control', 'label' => 'Email', 'placeholder' => 'Enter email'));
			?> <br> <?php
				echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'Password', 'placeholder' => 'Enter password'));
			?> <br>	<?php
				echo $this->Form->submit('Log In', array('class' => 'btn btn-primary btn-md'));
				echo $this->Form->end();
			?>	
		</div>
		<div class="col-sm-4">
			<br>
			<?php echo $this->Html->link('Register', array('action' => 'register'), array('type' => 'button', 'class' => 'btn btn-success btn-lg btn-block')); ?>
		</div>
	</div>