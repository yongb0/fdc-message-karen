<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
?>
<!DOCTYPE html>
<html>
<head>
	<head>
	<?php echo $this->Html->charset(); ?>

	<?php
		echo $this->fetch('meta');
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
	?>
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/flatly/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<?php	
		echo $this->Html->script('jquery.min.js');
		echo $this->fetch('script');
	?>
		
	
</head>
<body>
	<div id="container" class="container">
		<div id="content">
			
			<?php echo $this->Session->flash(); ?>
	
			<?php echo $this->fetch('content'); ?>
		</div>
		<footer>
			<hr>
			<p>&nbsp&nbsp&nbspTraining Task: Message Board </p>
		</footer>
	</div>
</body>
</html>
