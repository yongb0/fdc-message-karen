<!-- /app/View/Users/register.ctp -->
<title>Registration</title>
	<?php if (isset($data)) { ?>
		<div class="alert alert-warning">
			<strong>Login Unsuccessful!</strong> <?php echo $data; ?>
		</div>
	<?php	} ?>
		<div class="jumbotron">
			<h1>Registration</h1>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<?php
					echo $this->Form->create('User', array('class' => 'form-horizontal')); 
					echo $this->Form->input('name', array('class' => 'form-control'));
				?><br><?php	
					echo $this->Form->input('email', array('class' => 'form-control'));
				?><br><?php		
					echo $this->Form->input('password', array('class' => 'form-control'));
				?><br><?php		
					echo $this->Form->input('re_password', array('label' => 'Confirm Password', 'type' => 'password', 'class' => 'form-control'));
				?> <br> <?php	
					echo $this->Form->button('Register', array('class' => 'btn btn-primary btn-md'));
					echo $this->Form->end(); 	
				?>
			</div>	
			<div class="col-sm-4"> <br>
				<?php echo $this->HTML->link('Back to Login', array('action' => 'login'), array('class' => 'btn btn-success btn-lg btn-block')); ?>
			</div>
		</div>	
	</div>