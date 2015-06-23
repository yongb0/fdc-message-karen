<!-- /app/View/Users/update.ctp -->
<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
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
			<h1>User Profile</h1>
		</div>
		<br>
		<?php echo $this->Form->create('User');?>
		<div class="col-sm-3">
			<img id="uploadPreview" style="width: 200px; height: 200px;" class="img-circle" src=<?php echo '/img/'.$user['User']['image']?>>
				<?php echo $this->Form->input('image', array('id' => 'image', 'type' => 'file', 'onchange' => 'PreviewImage();', 'label' => false));?>
				<script type="text/javascript">
				  function PreviewImage() {
					var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("image").files[0]);

					oFReader.onload = function(oFREvent) {
					  document.getElementById("uploadPreview").src = oFREvent.target.result;
					};
				  };
				</script>
		</div>
		<div class='col-sm-9'>
				<table style="width:80%">
					<tr>
						<td>Name: <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'value' => $user['User']['name']),array('legend' => false)); ?></td>
					</tr>
					<tr>
						<td>Birthdate:
							<?php echo $this->Form->input('birthdate', array('id' => 'birthdate', 'type' => 'text', 'class' => 'form-control', 'placeholder' => $user['User']['birthdate'], 'label' => false));?>
							<script>
							  $(function() {
								$( "#birthdate" ).datepicker();
							  });
							</script>
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