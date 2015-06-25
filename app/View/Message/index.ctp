<!-- /app/View/Message/index.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>Message List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
	<div class="container">
		<?php
			$this->startIfEmpty('navbar');
			echo $this->element('navbar');
			$this->end();
			echo $this->fetch('navbar');
		?>		
		<div class="page-header">
			<h1>Message List</h1>
		</div>
		<div class="pull-right">
			<?php echo $this->Html->link('New Message', array('controller' => 'message', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		</div>
	</div>
	<br>
	<?php echo $this->Html->script('custom', array('inline' => false)); ?>
	<div id="paginated-content-container" class="container">
		<div class="loading-bar" style="text-align:center">
			<p><?php echo $this->Html->image('ajax-loader.gif')?></p>
		</div>
	</div>
</body>
</html>