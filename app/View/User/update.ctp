<!-- /app/View/Users/update.ctp -->

<!DOCTYPE html>
<html>
	<head>
		<h1>User Profile <?php echo $this->Html->link('Logout', array('action' => 'logout'), array('class' => 'button')); ?></h1>
	</head>
	<body>
		<table>
			<form>
				<tr>
					<td>Name: </td>
					<td> <input type="text" value="<?php echo $user['User']['name']; ?>"></td>
				</tr>
				<tr>
					<td>Birthdate: </td>
					<td></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td> 
						<input type="radio" value="1">Male <br>
						<input type="radio" value="2">Female
					</td>
				</tr>
			</form>
		</table>
		<?php echo $this->Html->link('Back to Profile', array('action' => 'index'), array('class' => 'button')); ?>
	</body>
</html>