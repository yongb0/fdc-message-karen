<?php echo $scripts_for_layout; ?>
<script type="text/javascript"><?php echo $this->fetch('content'); ?></script>
$msg = array(
    'APP_PATH' => Router::url('/',true)
);
echo $this->Html->scriptBlock('var MsgObj = ' . $this->Javascript->object($msg) . ';');