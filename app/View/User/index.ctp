<!-- /app/View/Users/index.ctp -->

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
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
		<table class="table table-condensed" style="width:80%">
			<tr> 
				<td rowspan="6" style="width:10%">
					<?php if (!$user['User']['image']) {
						echo $this->Html->image('user-default.png', array('class' => 'img-circle', 'width' => '200', 'height' => '200'));
						} else {
						echo $this->Html->image($user['User']['image'], array('class' => 'img-circle', 'width' => '200', 'height' => '200'));
						} ?>
				</td>
				<td style="font-size:30px;"><?php print_r($user['User']['name']);?></td>
			</tr>
			<tr>
				<td>Gender:
						<?php 
							switch ($user['User']['gender']) {
								case 1:
									echo ' Male';
									break;
								case 2:
									echo ' Female';
									break;
								default:
									echo '<small>Update to select gender.</small>';
									break;
							} ?>
				</td>
			</tr>
			<tr>
				<td>Birthdate: <?php if (isset($user['User']['birthdate'])) {
										echo $user['User']['birthdate']; 
									} else { echo '<small>Update to select birthdate.</small>'; }?> 
				</td>
			</tr>
			<tr>
				<td>Joined: <?php echo $this->Time->nice($user['User']['created']); ?> </td>
			</tr>
			<tr>
				<td>Last Login: <?php echo $this->Time->nice($user['User']['last_login_time']); ?> </td>
			</tr>
			<tr>
				<td>Hobby: <?php if (isset($user['User']['hobby'])) {
									echo $user['User']['hobby']; 
								} else	{ echo '<small>Update to enter hobby.</small>'; }?>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
