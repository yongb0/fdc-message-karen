<!-- /app/View/Users/view.ctp -->

<h1>User Profile</h1>
<p>This is the Profile page.</p>
<?php
	echo $this->HTML->link('Logout', array('action' => 'logout'), array('class' => 'button'));
?>