<!-- /app/View/Elements/sender.ctp -->

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
				echo $this->Form->create('Message', array('url' => array('controller' => 'message', 'action' => 'details', 'id' => $msg['Message']['id'])));
				echo $this->Form->input('id', array('type' => 'hidden', 'value' => $msg['Message']['id']));
				echo $this->Form->submit('Reply', array('class' => 'btn btn-default btn-sm'));
				echo $this->Form->end();
			?>
			<em class="pull-right">Sent: <?php echo $msg['Message']['created']?></em>
		</div>
	</div>
</div>