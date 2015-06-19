<!-- /app/View/Message/new.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>New Message</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<?php echo $this->Html->link('Message Board', array('controller' => 'message', 'action' => 'index'), array('class' => 'navbar-brand'));?>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link('Profile', array('controller' => 'user', 'action' => 'index'));?>
					<li><?php echo $this->Html->link('Update Profile', array('controller' => 'user', 'action' => 'update'));?>
					<li><?php echo $this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'));?>
				</ul>
			</div>
		</nav>
		<div class="page-header">
			<h1>New Message</h1>
		</div>
	</div>
</body>
</html>