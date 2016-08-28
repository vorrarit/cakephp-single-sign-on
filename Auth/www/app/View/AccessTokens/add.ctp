<div class="accessTokens form">
<?php echo $this->Form->create('AccessToken'); ?>
	<fieldset>
		<legend><?php echo __('Add Access Token'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('resource_owner_id');
		echo $this->Form->input('auth_code');
		echo $this->Form->input('access_token');
		echo $this->Form->input('token_expiry_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Access Tokens'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
