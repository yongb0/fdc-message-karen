<!-- /app/View/Message/index.ctp -->

<!DOCTYPE html>
<html>
<head>
<title>Message List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
	<?php echo $this->Html->script('custom', array('inline' => false)); ?>
	
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
	<div id="paginated-content-container" class="container"></div>
	<script>
		$(document).ready(function(){
			var track_click = 1;
			var url = '/message/show/';
			$(document).on('click', '#show-more',function() {
				$.ajax({
				url: url,
				type: 'POST',
				data: {"page_number": track_click},
				success: function(data){
					$('#show-more').remove();
					$('#paginated-content-container').append(data);
					track_click++;
					}, 
				error: function(data,status,xhr){
					alert(xhr);
					}
				});
			});
		});
	</script>
	<div id="ajax-loader" style="text-align:center; display:none"><img src="/img/ajax-loader.gif"></div>
</body>
</html>