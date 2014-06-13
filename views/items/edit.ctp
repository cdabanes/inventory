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
<div class="items form span6 offset3">

<?php echo $this->Form->create('Item',array(	'class'=>'form-horizontal',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>
	<fieldset>
		<legend><?php __('Edit Item'); ?></legend>
		<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('item_type_id',array('placeholder'=>'Item Type Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('article_id',array('placeholder'=>'Article Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('description',array('placeholder'=>'Description','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('unit_id',array('placeholder'=>'Unit Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('initial_quantity',array('placeholder'=>'Initial Quantity','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('quantity',array('placeholder'=>'Quantity','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-info'));?>
		<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>
</div>