<!-- /app/View/Users/thankyou.ctp -->

<!DOCTYPE html>
<html>
<head>
	<title>Thank you for Registering!</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container" style="text-align:center">
		<div class="jumbotron">
			<h1>Thank you for registering!</h1>
		</div>
		<h2><small>Successfully saved!</small><h1>
		<?php
			echo $this->HTML->link('Back to Homepage', array('action' => 'index'), array('class' => 'btn btn-success btn-lg'));
		?>
</body>	
</html>