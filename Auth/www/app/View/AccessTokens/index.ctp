<div class="accessTokens index">
	<h2><?php echo __('Access Tokens'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('resource_owner_id'); ?></th>
			<th><?php echo $this->Paginator->sort('auth_code'); ?></th>
			<th><?php echo $this->Paginator->sort('access_token'); ?></th>
			<th><?php echo $this->Paginator->sort('token_expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($accessTokens as $accessToken): ?>
	<tr>
		<td><?php echo h($accessToken['AccessToken']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($accessToken['Application']['id'], array('controller' => 'applications', 'action' => 'view', $accessToken['Application']['id'])); ?>
		</td>
		<td><?php echo h($accessToken['AccessToken']['resource_owner_id']); ?>&nbsp;</td>
		<td><?php echo h($accessToken['AccessToken']['auth_code']); ?>&nbsp;</td>
		<td><?php echo h($accessToken['AccessToken']['access_token']); ?>&nbsp;</td>
		<td><?php echo h($accessToken['AccessToken']['token_expiry_date']); ?>&nbsp;</td>
		<td><?php echo h($accessToken['AccessToken']['created']); ?>&nbsp;</td>
		<td><?php echo h($accessToken['AccessToken']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $accessToken['AccessToken']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $accessToken['AccessToken']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $accessToken['AccessToken']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $accessToken['AccessToken']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Access Token'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
