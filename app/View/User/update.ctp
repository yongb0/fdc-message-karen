<!-- /app/View/Users/update.ctp -->
<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css" rel="stylesheet" >
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<?php echo $this->Html->link('Message Board', array('controller' => 'message', 'action' => 'index'), array('class' => 'navbar-brand'));?>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link('Profile', array('controller' => 'user', 'action' => 'index'));?>
					<li><?php echo $this->Html->link('Update Profile', array('controller' => 'user', 'action' => 'update'));?>
					<li><?php echo $this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'));?>
				</ul>
			</div>
		</nav>
		<div class="page-header">
			<h1>User Profile</h1>
		</div>
		<br>
		<div class="col-sm-3">
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
				<div>
					<span class="btn btn-default btn-file">
						<span class="fileinput-new">Select image</span>
						<span class="fileinput-exists">Change</span>
						<input type="file">
					</span>
					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
		</div>
		<div class='col-sm-9'>
			<?php echo $this->Form->create();?>
				<table style="width:80%">
					<tr>
						<td><?php echo $this->Form->input('name', array('label' => 'Name:', 'class' => 'form-control', 'value' => $user['User']['name']),array('legend' => false)); ?></td>
					</tr>
					<tr>
						<td>Birthdate:
						<div class="date-form">
							<div class="controls">
								<div class="input-group">
									<label for="date-picker-3" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span> </label>
									<input id="date-picker-3" type="text" class="date-picker form-control" />
								</div>
							</div>
						</div>
						</td>
					</tr>
					<tr>
						<td>Gender: 
							<?php 
								$options = array('1' => 'Male', '2' => 'Female');
								$attributes = array('legend' => false, 'value' => false);
								echo $this->Form->radio('gender', $options, $attributes);
							?>
						</td>
					</tr>
					<tr>
						<td>Hobby: <?php echo $this->Form->textarea('hobby', array('class' => 'form-control', 'value' => $user['User']['hobby'], 'rows' => '5', 'cols' => '10'));?></td>
					</tr>
				</table>
			<br>
			<?php 
				echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user['User']['id']));
				echo $this->Form->submit('Update', array('class' => 'btn btn-primary'));
				echo $this->Form->end();
			?>
		</div>	
	</div>
</body>
</html>