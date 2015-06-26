<!-- /app/View/Elements/show.ctp -->
<?php 
	$this->Paginator->options(array(
			'update' => '#content',
			'evalScripts' => true,
		));
	if ($data['messages'] != null) { 
		$message = $data['messages'];
		$user = $data['user'];
		$current_user = $this->Session->read('user_id');
			
		foreach ($message as $msg) { 	?> 
			<div class="row" id=<?php echo 'msg'.$msg['Message']['id']?>>
				<div class="col-sm-2">
					<div class="pull-right">
						<?php 
							if ($msg['Message']['to_id'] == $current_user) {
								foreach ($user as $sender) {
									if ($msg['Message']['from_id'] == $sender['User']['id']) { 
										echo $this->Html->image($sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
										?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
						<?php 	} } } else { 
								foreach ($user as $sender) {
									if ($msg['Message']['to_id'] == $sender['User']['id']) { 
										echo $this->Html->image($sender['User']['image'], array('class' => 'img-circle', 'width' => '100', 'height' => '100'));
										?> <br><center><strong> <?php echo $sender['User']['name']; ?> </center></strong> 
						<?php 	} } } ?>
					</div>
				</div>
				<div class="col-sm-8"> <br>
					<div class="well well-sm">
						<table>
							<tr><?php echo $msg['Message']['content'];?>
								<td> <br> <div class="btn-group"> 
								<?php echo $this->Html->link('Reply', array('controller' => 'message', 'action' => 'details', 'id' => $msg['Message']['id']), array('class' => 'btn btn-default btn-sm'));
									  echo $this->Html->link('Delete', array('controller' => 'message', 'action' => 'delete_list', 'id' => $msg['Message']['id']), array('class' => 'btn btn-primary btn-sm', 'id' => 'delete'.$msg['Message']['id']));?>
								</td>
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
		<?php 	} 
			if ($this->Paginator->hasNext()) {  ;
				$page = $this->Paginator->param('page')+1; 
				$url = $this->Paginator->url(array('page' => $page));
				$total_pages = $this->Paginator->param('count');?>
					
				<div style="text-align:center">
					<button class="btn btn-link" id="load-more">Show More</button>
				</div>
					
				<script type="text/javascript">
					$(document).ready(function(){
						var track_click = 0;
								
						if (track_click < <?php echo $total_pages?>) {
							$('#load-more').click(function() {
								$('#load-more').remove();
								$.get(<?php echo "'".$url."'"?>, function(data) {
									$('#paginated-content-container').append(data);
								});
								$('#load-more').show();
								track_click++;
							});
						} else {
							$('#load-more').hide();
								}
					});
				</script>
		<?php 	} } else {?>
			<div class="well well-lg" style="text-align:center" id="no-msg"><h1>No Messages</h1></div>
		<?php } echo $this->Js->writeBuffer(); ?>