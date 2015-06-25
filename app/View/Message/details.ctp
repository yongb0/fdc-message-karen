<!-- /app/View/Message/details.ctp -->

<!DOCTYPE html>
<html>
<head>
	<title>Message Details</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<?php
			$this->startIfEmpty('navbar');
			echo $this->element('navbar');
			$this->end();
			echo $this->fetch('navbar');
		?>	
		<div class="page-header">
			<h1>Message Details</h1>
		</div>
		<div>
			<div class="col-sm-4"></div>
			<div class="col-sm-8">
				<?php
					echo $this->Form->create('Message', array('url' => array('controller' => 'message', 'action' => 'reply', 'id' => $this->Session->read('message_id'))));
					echo $this->Form->textarea('content', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Enter reply...'));
					echo $this->Form->input('created', array('type' => 'hidden', 'value' =>  date('Y:m:d H:i:s')));
					echo $this->Form->submit('Reply', array('class' => 'btn btn-success btn-sm pull-right'));
					echo $this->Form->end();
				?>
			</div>
		</div>
		<div class="row">
			<?php $message = $data['messages'];
				  $user = $data['user'];
				  $current_user = $this->Session->read('user_id');
			  foreach ($message as $msg) { 
				if ($msg['Message']['to_id'] == $current_user) { ?> <!-- Not current user -->
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
							<div class="well well-sm">
								<table>
								<tr> <?php echo $msg['Message']['content'];?> </tr>
								<tr> <td><br><strong><small>Sent: <?php echo $msg['Message']['created']?></small></strong></td></tr>	
								</table>
							</div>
						</div>
					</div>
			<?php  } else { ?> <!-- Current user -->
				<div class="row" style="text-align:right">
					<div class="col-sm-2"></div> 
					<div class="col-sm-8"> <br>
						<div class="well well-sm">
							<table>
								<tr> <?php echo $msg['Message']['content'];?> </tr>
								<tr>
									<td><br><strong><small>Sent: <?php echo $msg['Message']['created']?></small></strong></td>
								</tr>	
							</table>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="pull-left">
							<?php 
								foreach ($user as $sender) {
								if ($msg['Message']['from_id'] == $sender['User']['id']) { 
									echo $this->Html->image($sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));?> 
									<br><center><strong>You</center></strong> 
							<?php } }?>
						</div>
					</div>
				</div>
			<?php	} } ?>
		</div>
	</div>
</body>
</html>