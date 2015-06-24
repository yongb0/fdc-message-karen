<!-- /app/View/Elements/navbar.ctp -->

<nav class="navbar navbar-default">
	<div class="navbar-header">
		<?php echo $this->Html->link('Message Board', array('controller' => 'message', 'action' => 'index'), array('class' => 'navbar-brand'));?>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li><?php echo $this->Html->link('New Message', array('controller' => 'message', 'action' => 'add'));?>
			<li><?php echo $this->Html->link('Profile', array('controller' => 'user', 'action' => 'index'));?>
			<li><?php echo $this->Html->link('Update Profile', array('controller' => 'user', 'action' => 'update'));?>
			<li><?php echo $this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'));?>
		</ul>
	</div>
</nav>