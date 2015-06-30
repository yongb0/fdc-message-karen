<!-- /app/View/Users/thankyou.ctp -->
<title>Thank You!</title>
	<div class="container" style="text-align:center">
		<div class="jumbotron">
			<h1>Thank you for registering!</h1>
		</div>
		<h2><small>Successfully saved!</small><h1>
		<?php
			echo $this->HTML->link('Back to Homepage', array('action' => 'index'), array('class' => 'btn btn-success btn-lg'));
		?>
	</div>