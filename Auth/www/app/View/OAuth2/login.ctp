<div class="users form">
<?php echo $this->Form->create('OAuth2'); ?>
	<fieldset>
		<legend><?php echo __('OAuth2 Login'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
