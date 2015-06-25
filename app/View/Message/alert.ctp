<!-- /app/View/Message/alert.ctp -->

<?php
    switch($data['operation']) {
		case 1: ?>
			<div class="alert alert-success" style="display:none">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> <?php $data['message']; ?>
			</div> <?php
		break;
		
		case 2: ?>
			<div class="alert alert-success" style="display:none">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Warning!</strong> <?php $data['message']; ?>
			</div>
		break; <?php
		
		default:
		break;
	}
?>