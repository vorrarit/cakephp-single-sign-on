<div class="accessTokens view">
<h2><?php echo __('Access Token'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($accessToken['Application']['id'], array('controller' => 'applications', 'action' => 'view', $accessToken['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resource Owner Id'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['resource_owner_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Auth Code'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['auth_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Access Token'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['access_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token Expiry Date'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['token_expiry_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($accessToken['AccessToken']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Access Token'), array('action' => 'edit', $accessToken['AccessToken']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Access Token'), array('action' => 'delete', $accessToken['AccessToken']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $accessToken['AccessToken']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Access Tokens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Access Token'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
