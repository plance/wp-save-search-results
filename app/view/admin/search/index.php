<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<style>
	.table-save-search-result tbody tr:nth-child(2n) {
		background: #F7F7F7;
	}
</style>

<div class="wrap">
	<h1>
		<?php echo __('Searches', 'lance') ?>
		<a href="<?php echo add_query_arg(array('action' => 'clear')) ?>" class="page-title-action" onclick="return confirm('<?php echo __('Delete?', 'lance') ?>')"><?php echo __('Clear table', 'lance') ?></a>
	</h1>
	
	<?php if(!empty($data_ar)): ?>
		<table class="widefat fixed table-save-search-result">
			<thead>
				<tr>
					<th style="width: 5%"><strong>#</strong></th>
					<th><strong><?php echo __('Query', 'lance') ?></strong></th>
					<th style="width: 130px; text-align: center"><strong><?php echo __('Date', 'lance') ?></strong></th>
					<th style="width: 130px; text-align: center"><strong><?php echo __('Action', 'lance') ?></strong></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($data_ar as $i => $row_ar): ?>
				<tr>
					<td><strong><?php echo ($i + 1) ?></strong></td>
					<td><?php echo $row_ar['text'] ?></td>
					<td style="text-align: center"><?php echo $row_ar['date'] ?></td>
					<td style="text-align: center">
						<a href="<?php echo add_query_arg(array('action' => 'delete', 'key' => $i)) ?>" onclick="return confirm('<?php echo __('Delete?', 'lance') ?>')"><?php echo __('delete', 'lance') ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p><?php echo __('Data not found', 'lance') ?></p>
	<?php endif; ?>
</div>