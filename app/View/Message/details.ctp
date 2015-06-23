<!-- /app/View/Message/details.ctp -->

<!DOCTYPE html>
<html>
<head>
	<title>Message Details</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
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
			<h1>Message Details</h1>
		</div>
		<div class="text-right">
			<div class="col-sm-4"></div>
			<div class="col-sm-8">
				<?php
					echo $this->Form->create('Message', array('url' => array('controller' => 'message', 'action' => 'reply')));
					echo $this->Form->textarea('content', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Enter reply...'));
					echo $this->Form->submit('Reply', array('class' => 'btn btn-success btn-md'));
					echo $this->Form->end();
				?>
			</div>
		</div>
		<div class="row">
			<?php $message = $data['messages'];
				  $user = $data['user'];
				?>
				<div class="row">
					<div class="col-sm-2">
						<div class="pull-right">
						<?php 
							foreach ($user as $sender) {
							if ($message['Message']['from_id'] == $sender['User']['id']) { 
								echo $this->Html->image($sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
								?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
						<?php } }?>
						</div>
					</div>
					<div class="col-sm-8"> <br>
						<div class="well well-md">
							<?php echo $message['Message']['content']; ?><br>
							<em class="pull-right">Sent: <?php echo $message['Message']['created']?></em>
						</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>