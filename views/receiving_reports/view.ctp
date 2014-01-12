<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name receivingReports">
								 <?php echo $this->Html->link( 'Receiving Reports',
															array('action' => 'index')
														);  ?>							</div>
						</div>
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-info btn-block animate')
													);  ?>					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<!-- dropdown menu links -->
								<li><?php echo $this->Html->link(__('Receiving Report Details', true), array('controller' => 'receiving_report_details', 'action' => 'index')); ?> </li>
					  </ul>
					</div>
				</div>
			</div>
			<div class="span6 text-right">
				 <input class="span6 m-t-5 p" type="text" placeholder="Search">
			</div>
		</div>
	</div>
 </div>


 <div class="row-fluid">
<div class="span6">
<div class="receivingReports view">
<h2><?php  __('Receiving Report');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingReport['ReceivingReport']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingReport['ReceivingReport']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingReport['ReceivingReport']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="span6">
<div class="related">
	<h3><?php __('Related Receiving Report Details');?></h3>
	<?php if (!empty($receivingReport['ReceivingReportDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Receiving Report Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($receivingReport['ReceivingReportDetail'] as $receivingReportDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $receivingReportDetail['id'];?></td>
			<td><?php echo $receivingReportDetail['receiving_report_id'];?></td>
			<td><?php echo $receivingReportDetail['item_id'];?></td>
			<td><?php echo $receivingReportDetail['quantity'];?></td>
			<td><?php echo $receivingReportDetail['price'];?></td>
			<td><?php echo $receivingReportDetail['created'];?></td>
			<td><?php echo $receivingReportDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'receiving_report_details', 'action' => 'view', $receivingReportDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'receiving_report_details', 'action' => 'edit', $receivingReportDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'receiving_report_details', 'action' => 'delete', $receivingReportDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingReportDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Receiving Report Detail', true), array('controller' => 'receiving_report_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
</div>
</div>