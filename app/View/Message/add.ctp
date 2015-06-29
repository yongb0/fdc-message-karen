<!-- /app/View/Message/new.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>New Message</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
	
</head>
<body>
	<div class="container">
		<?php 
			switch($data['alert']) {
				case 1: ?>
					<div class="alert alert-warning">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Login Unsuccessful!</strong> Invalid username or password. Try again.
					</div>
		<?php	break; 
				
				default:
				break;
			}
			$this->startIfEmpty('navbar');
			echo $this->element('navbar');
			$this->end();
			echo $this->fetch('navbar');
		?>	
		<div class="page-header">
			<h1>New Message</h1>
		</div>
		<div class="row">
			<div class="col-sm-1">
				<label>To: </label> <br><br><br>
				<label>Message: </label>
			</div>
			<div class="col-sm-11">
				<?php echo $this->Form->create('Message');?> 
				<select class="js-example-basic-single" id="select2" style="width:500px" name="to_id" required>
				  <?php foreach ($data['users'] as $user) {
						if($user['User']['id'] != $this->Session->read('user_id')) {
						?><option value=<?php echo $user['User']['id'];?> > <?php echo $user['User']['name']; ?> </option> <?php
					} } ?>
				</select>
				<script type="text/javascript">
					$(document).ready(function () { //for select2 plugin
					  $('#select2').select2({
						placeholder: "Enter Name",
						allowClear: true,
						minimumInputLength: 1,
					  });
					});
				</script>
				<br><br>
				<?php	
					echo $this->Form->textarea('content', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Enter message') );
				?>  <br> <?php	
					echo $this->Form->input('created', array('type' => 'hidden', 'value' =>  date('Y:m:d H:i:s')));
					echo $this->Form->submit('Send Message', array('class' => 'btn btn-primary btn-md', 'id' => 'submit-btn'));
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</body>
</html>