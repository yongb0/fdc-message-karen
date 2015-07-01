<!-- /app/View/Users/update.ctp -->
<title>Update Profile</title>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<?php 
			$user = $data['user'];
			switch($data['alert']) {
				case 1: ?>
					<div class="alert alert-warning">
						<strong>Update Unsuccessful!</strong> Invalid input or empty field. Try again.
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
			<h1>User Profile</h1>
		</div>
		<br>
		<?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data'));?>
		<div class="col-sm-3">
			<img id="uploadPreview" style="width: 200px; height: 200px;" class="img-circle" src=<?php echo '/img/tmp/'.$user['User']['image']?>>
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
							<?php echo $this->Form->input('birthdate', array('id' => 'birthdate', 'type' => 'text', 'class' => 'form-control', 'value' => $user['User']['birthdate'], 'label' => false, 'readonly' => 'readonly'));?>
							<script>
							  $(function() {
							  	var currentTime = new Date();
								$( "#birthdate" ).datepicker( {
									changeMonth: true,
									changeYear: true,
									minDate: new Date(currentTime.getYear() - 100, 12, +1), //up until 100 years, one month and one day ago
									maxDate: new Date(currentTime.getFullYear() - 18, 12 , -1) //until 18 years, one month and one day ago; age restriction of 18 years old
								});
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