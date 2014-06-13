<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name items">
								 <?php echo $this->Html->link( 'Items',
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
								<li><?php echo $this->Html->link(__('Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Issue Out Details', true), array('controller' => 'issue_out_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Material Request Details', true), array('controller' => 'material_request_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Material Return Details', true), array('controller' => 'material_return_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Purchase Order Details', true), array('controller' => 'purchase_order_details', 'action' => 'index')); ?> </li>
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
<div class="items view">
<h2><?php  __('Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['ItemType']['name'], array('controller' => 'item_types', 'action' => 'view', $item['ItemType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Article'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Article']['name'], array('controller' => 'articles', 'action' => 'view', $item['Article']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Unit']['name'], array('controller' => 'units', 'action' => 'view', $item['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Initial Quantity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['initial_quantity']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['quantity']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="span6">
<div class="related">
	<h3><?php __('Related Issue Out Details');?></h3>
	<?php if (!empty($item['IssueOutDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Issue Out Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Order'); ?></th>
		<th><?php __('Served'); ?></th>
		<th><?php __('Variance'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['IssueOutDetail'] as $issueOutDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $issueOutDetail['id'];?></td>
			<td><?php echo $issueOutDetail['issue_out_id'];?></td>
			<td><?php echo $issueOutDetail['item_id'];?></td>
			<td><?php echo $issueOutDetail['order'];?></td>
			<td><?php echo $issueOutDetail['served'];?></td>
			<td><?php echo $issueOutDetail['variance'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'issue_out_details', 'action' => 'view', $issueOutDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'issue_out_details', 'action' => 'edit', $issueOutDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'issue_out_details', 'action' => 'delete', $issueOutDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $issueOutDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Issue Out Detail', true), array('controller' => 'issue_out_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Material Request Details');?></h3>
	<?php if (!empty($item['MaterialRequestDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Material Request Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['MaterialRequestDetail'] as $materialRequestDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $materialRequestDetail['id'];?></td>
			<td><?php echo $materialRequestDetail['material_request_id'];?></td>
			<td><?php echo $materialRequestDetail['item_id'];?></td>
			<td><?php echo $materialRequestDetail['created'];?></td>
			<td><?php echo $materialRequestDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'material_request_details', 'action' => 'view', $materialRequestDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'material_request_details', 'action' => 'edit', $materialRequestDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'material_request_details', 'action' => 'delete', $materialRequestDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $materialRequestDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Material Request Detail', true), array('controller' => 'material_request_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Material Return Details');?></h3>
	<?php if (!empty($item['MaterialReturnDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Material Return Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['MaterialReturnDetail'] as $materialReturnDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $materialReturnDetail['id'];?></td>
			<td><?php echo $materialReturnDetail['material_return_id'];?></td>
			<td><?php echo $materialReturnDetail['item_id'];?></td>
			<td><?php echo $materialReturnDetail['quantity'];?></td>
			<td><?php echo $materialReturnDetail['created'];?></td>
			<td><?php echo $materialReturnDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'material_return_details', 'action' => 'view', $materialReturnDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'material_return_details', 'action' => 'edit', $materialReturnDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'material_return_details', 'action' => 'delete', $materialReturnDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $materialReturnDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Material Return Detail', true), array('controller' => 'material_return_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Purchase Order Details');?></h3>
	<?php if (!empty($item['PurchaseOrderDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Purchase Order Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['PurchaseOrderDetail'] as $purchaseOrderDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $purchaseOrderDetail['id'];?></td>
			<td><?php echo $purchaseOrderDetail['purchase_order_id'];?></td>
			<td><?php echo $purchaseOrderDetail['item_id'];?></td>
			<td><?php echo $purchaseOrderDetail['created'];?></td>
			<td><?php echo $purchaseOrderDetail['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'purchase_order_details', 'action' => 'view', $purchaseOrderDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'purchase_order_details', 'action' => 'edit', $purchaseOrderDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'purchase_order_details', 'action' => 'delete', $purchaseOrderDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $purchaseOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Purchase Order Detail', true), array('controller' => 'purchase_order_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Receiving Report Details');?></h3>
	<?php if (!empty($item['ReceivingReportDetail'])):?>
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
		foreach ($item['ReceivingReportDetail'] as $receivingReportDetail):
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