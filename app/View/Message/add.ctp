<!-- /app/View/Message/new.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>New Message</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<link href="http://ivaynberg.github.com/select2/select2-3.3.2/select2.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://ivaynberg.github.com/select2/select2-3.3.2/select2.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<?php echo $this->Html->link('Message Board', array('controller' => 'message', 'action' => 'index'), array('class' => 'navbar-brand'));?>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link('New Message', array('controller' => 'message', 'action' => 'add'));?>
					<li><?php echo $this->Html->link('Profile', array('controller' => 'user', 'action' => 'index'));?>
					<li><?php echo $this->Html->link('Update Profile', array('controller' => 'user', 'action' => 'update'));?>
					<li><?php echo $this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'));?>
				</ul>
			</div>
		</nav>
		<div class="page-header">
			<h1>New Message</h1>
		</div>
		<div class="row">
			<div class="col-sm-1">
				<label>To: </label> <br><br><br>
				<label>Message: </label>
			</div>
			<div class="col-sm-11">
				<input id="user-select2" type="text" class="form-control" placeholder="Enter name">
				<?php
					echo $this->Form->create('Message');
				?> 	<br><?php	
					echo $this->Form->textarea('content', array('label' => 'Message', 'class' => 'form-control', 'placeholder' => 'Enter message') );
				?>  <br> <?php	
					echo $this->Form->input('created', array('type' => 'hidden', 'value' =>  date('Y:m:d H:i:s')));
					echo $this->Form->input('from_id', array('type' => 'hidden', 'value' =>  $user));
					echo $this->Form->submit('Send Message', array('class' => 'btn btn-primary btn-md'));
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</body>
</html>