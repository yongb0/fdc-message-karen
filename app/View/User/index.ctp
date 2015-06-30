<!-- /app/View/Users/index.ctp -->
<title>Profile</title>
	<?php
		$this->startIfEmpty('navbar');
		echo $this->element('navbar');
		$this->end();
		echo $this->fetch('navbar');
	?>	
		<div class="page-header">
			<h1>User Profile</h1>
		</div>
		<br>
		<table class="table table-condensed" style="width:80%">
			<tr> 
				<td rowspan="6" style="width:10%">
					<?php if (!$user['User']['image']) {
						echo $this->Html->image('/img/tmp/'.'user-default.png', array('class' => 'img-circle', 'width' => '200', 'height' => '200'));
						} else {
						echo $this->Html->image('/img/tmp/'.$user['User']['image'], array('class' => 'img-circle', 'width' => '200', 'height' => '200'));
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
				<td>Hobby: 
					<div class="well well-md">
					<?php if (isset($user['User']['hobby'])) {
									echo $user['User']['hobby']; 
								} else	{ echo '<small>Update to enter hobby.</small>'; }?>
					</div>
				</td>
			</tr>
		</table>
