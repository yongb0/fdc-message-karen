<!-- /app/View/Message/index.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>Message List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
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
			<h1>Message List</h1>
		</div>
		<div class="pull-right">
			<?php echo $this->Html->link('New Message', array('controller' => 'message', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		</div>
	</div>
	<br>
	<div class="container">
		<?php foreach ($message as $msg) { ?>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<div class="well well-sm">
						<?php echo $msg['Message']['content'];?>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
</body>
</html>