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
		<?php
			$this->startIfEmpty('navbar');
			echo $this->element('navbar');
			$this->end();
			echo $this->fetch('navbar');
		?>	
		<div class="page-header">
			<h1>Message List</h1>
		</div>
		<div class="pull-right">
			<?php echo $this->Html->link('New Message', array('controller' => 'message', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		</div>
	</div>
	<br>
	<div class="container">
		<?php if (isset($data['messages'])) { 
				$message = $data['messages'];
				$user = $data['user'];
				$current_user = $this->Session->read('user_id');
			  foreach ($message as $msg) { 	?> 
					<div class="row" id="msgbox" >
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
								<tr> <?php echo $msg['Message']['content'];?>
									<td> <br> <div class="btn-group"> 
										<?php 											
											echo $this->Html->link('Reply', array('controller' => 'message', 'action' => 'details', 'id' => $msg['Message']['id']), array('class' => 'btn btn-default btn-sm'));
											echo $this->Html->link('Delete', array('controller' => 'message', 'action' => 'delete', 'id' => $msg['Message']['id']), array('class' => 'btn btn-primary btn-sm'));
										?>
										</div>
									</td>
									<td><br><strong class="pull-left"><small>&nbsp&nbsp&nbsp&nbspSent: <?php echo $msg['Message']['created']?></small></strong></td>
								</tr>	
								</table>
							</div>
						</div>
					</div>
		  <?php   } } else { ?>
			<div class="well well-lg" style="text-align:center"><h1>No Messages</h1></div>
		<?php } ?>
	</div>
</body>
</html>