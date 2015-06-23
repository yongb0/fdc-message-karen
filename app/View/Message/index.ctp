<!-- /app/View/Message/index.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>Message List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="/js/select2.min.js"></script>
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
		<?php $message = $data['messages'];
			  $user = $data['user'];
			foreach ($message as $msg) { ?>
			<div class="row">
				<div class="col-sm-2">
					<div class="pull-right">
					<?php 
						foreach ($user as $sender) {
						if ($msg['Message']['from_id'] == $sender['User']['id']) { 
							echo $this->Html->image($sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
							?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
					<?php } }?>
					</div>
				</div>
				<div class="col-sm-8"> <br>
					<div class="well well-md">
						<?php echo $msg['Message']['content'];?><br><br>
						<?php 
							echo $this->Form->create('Message', array('url' => array('controller' => 'message', 'action' => 'details', 'id' => $msg['Message']['from_id'])));
							echo $this->Form->submit('Reply', array('class' => 'btn btn-default btn-sm'));
							echo $this->Form->end();
						?>
						<em class="pull-right">Sent: <?php echo $msg['Message']['created']?></em>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
</body>
</html>