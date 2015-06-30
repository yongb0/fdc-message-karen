<!-- /app/View/Message/details.ctp -->
<title>Message Details</title>
		<?php
			$this->startIfEmpty('navbar');
			echo $this->element('navbar');
			$this->end();
			echo $this->fetch('navbar');
		?>	
		<div class="page-header">
			<h1>Message Details</h1>
		</div>
		<div class="reply-box">
			<div class="col-sm-4"></div>
			<div class="col-sm-8">
				<?php
					echo $this->Form->create('Message', array('url' => array('controller' => 'message', 'action' => 'reply')));
					echo $this->Form->textarea('content', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Enter reply...'));
					echo $this->Form->input('created', array('type' => 'hidden', 'value' =>  date('Y:m:d H:i:s')));
					echo $this->Form->input('to_id', array('type' => 'hidden', 'value' =>  $this->Session->read('message_to_id')));
					echo $this->Form->input('from_id', array('type' => 'hidden', 'value' => $this->Session->read('message_from_id')));
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
					<div class="row" id=<?php echo 'msg'.$msg['Message']['id']?>>
						<div class="col-sm-2">
							<div class="pull-right">
							<?php 
								foreach ($user as $sender) {
								if ($msg['Message']['from_id'] == $sender['User']['id']) { 
									echo $this->Html->image('/img/tmp/'.$sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
									?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
							<?php } }?>
							</div>
						</div>
						<div class="col-sm-8"> <br>
							<div class="well well-sm pull-left">
								<table>
									<tr> <?php echo $msg['Message']['content'];?></tr>
									<tr>
										<td><br><?php echo $this->Html->link(null, array('controller' => 'message', 'action' => 'delete', 'id' => $msg['Message']['id']), array('class' => 'btn glyphicon glyphicon-remove', 'id' => 'delete'.$msg['Message']['id'])); ?></td>
										<td><br><strong><small>Sent: <?php echo $msg['Message']['created']?></small></strong></td>
									</tr>	
								</table>
							</div>
						</div>
					</div>
			<?php  } else { ?> <!-- Current user -->
				<div class="row" id=<?php echo 'msg'.$msg['Message']['id']?>>
					<div class="col-sm-2"></div> 
					<div class="col-sm-8"> <br>
						<div class="well well-sm" style="word-wrap:break-word; text-align:right">
								<?php echo $msg['Message']['content'];?>
							<table>
								<tr>
									<td><br><strong><small>Sent: <?php echo $msg['Message']['created']?></small></strong></td>
									<td><br><?php echo $this->Html->link(null, array('controller' => 'message', 'action' => 'delete', 'id' => $msg['Message']['id']), array('class' => 'btn glyphicon glyphicon-remove', 'id' => 'delete'.$msg['Message']['id'], 'style' => 'float:right')); ?></td>
								</tr>	
							</table>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="pull-left">
							<?php 
								foreach ($user as $sender) {
								if ($msg['Message']['from_id'] == $sender['User']['id']) { 
									echo $this->Html->image('/img/tmp/'.$sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));?> 
									<br><center><strong>You</center></strong> 
							<?php } }?>
						</div>
					</div>
				</div>
			<?php	} ?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(<?php echo "'#delete".$msg['Message']['id']."'"?>).click(function() {
						var confirm_delete = confirm('Are you sure you want to delete message?');
						var url = $(this).attr('href');
						if (confirm_delete){
							$.ajax({
								url: url,
								data: <?php echo $msg['Message']['id']; ?>,
								type: 'POST',
								success: function(){
									$(<?php echo "'#msg".$msg['Message']['id']."'"?>).fadeOut();
								}
							});
						}
						return false;
					});
				});
			</script>
			<?php } ?>	
		</div>