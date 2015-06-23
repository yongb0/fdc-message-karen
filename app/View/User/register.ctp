<!-- /app/View/Users/register.ctp -->

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
	<div class="container">
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
</body>
</html>