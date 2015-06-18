<!-- /app/View/Users/index.ctp -->
<!DOCTYPE html>
<html>
	<head>
		<h1>User Profile <?php echo $this->HTML->link('Logout', array('action' => 'logout'), array('class' => 'button')); ?></h1>
	</head>
	<body>		
		<br>
		<p>This is the Profile page.</p>
		<br>
		<table style="width:80%">
			<tr> 
				<td rowspan="6" style="width:10%">
					<?php if (!$user['User']['image']) {
						echo $this->Html->image('user-default.png');}?>
				</td>
				<td style="font-size:30px;"><?php print_r($user['User']['name']);?></td>
			</tr>
			<tr>
				<td>Gender:
						<?php 
							switch($user['User']['gender']){
							case 1:
								{	echo ' Male';
									break;}
							case 2:
								{	echo ' Female';
									break;}
							default:
								{	echo ' ';
									break;}
							} ?>
				</td>
			</tr>
			<tr>
				<td>Birthdate: <?php if (isset($user['User']['birthdate'])) {
										echo $user['User']['birthdate']; 
										} else { echo ''; }?> 
				</td>
			</tr>
			<tr>
				<td>Joined: <?php echo $this->Time->nice($user['User']['created']); ?> </td>
			</tr>
			<tr>
				<td>Last Login: <?php echo $this->Time->nice($user['User']['last_login_time']); ?> </td>
			</tr>
			<tr>
				<td>Hubby: <?php echo $user['User']['hubby']; ?> </td>
			</tr>
		</table>
		<?php echo $this->HTML->link('Update', array('action' => 'update'), array('class' => 'button')); ?>
	</body>
</html>
