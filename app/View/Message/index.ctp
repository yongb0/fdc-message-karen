<!-- /app/View/Message/index.ctp -->
<title>Message List</title>

	<?php echo $this->Html->script('custom', array('inline' => false)); ?>
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