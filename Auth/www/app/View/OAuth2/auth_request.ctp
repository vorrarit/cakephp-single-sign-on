<div class="users form">
<?php echo $this->Form->create('OAuth2'); ?>
	<fieldset>
		<legend><?php echo __('OAuth2 Auth Request'); ?></legend>
		<?php pr($this->Session->read('Auth')); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
