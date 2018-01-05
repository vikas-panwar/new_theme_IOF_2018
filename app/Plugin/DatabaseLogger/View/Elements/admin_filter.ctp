<?php echo $this->Html->script('/database_logger/js/clear_default'); ?>
<div id="admin_filter">
<?php
$model = isset($model) ? $model : false;

if($model){
	echo $this->Form->create($model, array('inputDefaults' => array('label' => false,'div' => false)));
	echo $this->Form->input('filter', array('label' => false, 'value' => "$model Search", 'class' => 'clear_default'));
	echo $this->Form->submit('/database_logger/img/search_button.gif', array('div' => false));
	echo $this->Form->end();
}
?>
</div>