<!-- /app/View/Message/show.ctp -->
<?php 
	if (@$data['messages'] != null) { 
		$message = $data['messages'];
		$user = $data['user'];
		
		$current_user = $this->Session->read('user_id');
		
		foreach ($message as $msg) { 	?> 
			<div class="row" id=<?php echo 'msg'.$msg['Message']['id']?> data-page="<?php echo $data['page_number']; ?>">
				<div class="col-sm-2">
					<div class="pull-right">
						<?php 
							if ($msg['Message']['to_id'] == $current_user) {
								foreach ($user as $sender) {
									if ($msg['Message']['from_id'] == $sender['User']['id']) { 
										echo $this->Html->image('/img/tmp/'.$sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
										?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
						<?php 	} } } else { 
								foreach ($user as $sender) {
									if ($msg['Message']['to_id'] == $sender['User']['id']) { 
										echo $this->Html->image('/img/tmp/'.$sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
										?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
						<?php 	} } } ?>
					</div>
				</div>
				<div class="col-sm-8"> <br>
					<div class="well well-sm" style="word-wrap:break-word">
						<div id="msg-box"><?php echo $msg['Message']['content'];?></div>
						<table>
							<tr>
								<td> <br> <div class="btn-group"> 
								<?php echo $this->Html->link('Reply', array('controller' => 'message', 'action' => 'details', 'id' => $msg['Message']['id']), array('class' => 'btn btn-default btn-sm'));
									  echo $this->Html->link('Delete', array('controller' => 'message', 'action' => 'delete_list', 'id' => $msg['Message']['id']), array('class' => 'btn btn-primary btn-sm', 'id' => 'delete'.$msg['Message']['id']));?>
								</div></td>
								<td><br><strong class="pull-left"><small>&nbsp&nbsp&nbsp&nbspSent: <?php echo $msg['Message']['created']?></small></strong></td>
							</tr>	
						</table>
					</div>
				</div>
			</div>
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
		<?php 	} if ($data['page_number'] < $data['total_pages']) { ?>
				<div style="text-align:center">
					<button class="btn btn-link" id="show-more" style="text-align:center" >Show More</button>
				</div>
		<?php	} } else {?>
			<script>
				$(document).ready(function(){
					$('#no-msg').show();
				});
			</script>
		<?php } ?>
			<br><div class="well well-lg" style="text-align:center; display:none" id="no-msg"><h1>No Messages</h1></div>