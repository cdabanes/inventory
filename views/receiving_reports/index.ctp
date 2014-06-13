<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name receivingReports">
									 <?php echo $this->Html->link( 'Receiving Reports',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3 upAccount">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
													$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
													'/pages/apps',array('escape' => false,'class'=>'btn btn-medium tree-back btn-block animate' ,'id'=>'intent-back')
													); ?> 					
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'intent-create')
													);  ?>					</div>
				</div>
			</div>
			<div class="span3 pull-right">
				 <div id="simple-root"></div> 
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">
				<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="ReceivingReportTable" model="ReceivingReport">
			<thead>
				<tr>
																																											<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
						<td class="actions">
					<div class="btn-group">
						<div class="btn-group btn-center">
							<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
							<ul class="dropdown-menu pull-right">
									
											 <li><a href="#intent-modal" data-toggle="modal"  class="action-view view-receiving_report_details"><i class="icon-eye-open"></i> Receiving Report Details</a></li>
																	 
							  <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
							</ul>
						</div>
					</div>
						</td>
	</tr>
		</tbody>
		</table>
		
			</div>
</div>
<?php echo $this->Form->create('ReceivingReport',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> 'receivingReports', 'canvas'=>'#ReceivingReportCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
  <div class="modal-header">
     <h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Receiving Report</span></h3>
  </div>
  <div class="modal-body">
  

<div class="row-fluid">
<div class="receivingReports form span12">

		<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed RECORD tablesorter canvasTable" id="ReceivingReportDetailTable" model="ReceivingReportDetail">
				<caption class="caption-bordered">Receiving Report Details</caption>
				<thead>
				<tr>
						<th><?php __('Receiving Report Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th><?php __('Price'); ?></th>
					<th class="actions">Actions</th>
				</tr>
				</thead>
				<tbody class="hide">
					<tr>
								<td><span data-field='ReceivingReportDetail.receiving_report_id'></span></td>
		<td><span data-field='ReceivingReportDetail.item_id'></span></td>
		<td><span data-field='ReceivingReportDetail.quantity'></span></td>
		<td><span data-field='ReceivingReportDetail.price'></span></td>
						<td>
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									  <li><a  href="#receiving-report-details-modal" data-toggle="modal" data-dismiss="modal" class="action-add"><i class="icon-plus"></i> Add</a></li>
									 <li><a  href="#receiving-report-details-modal" data-toggle="modal" data-dismiss="modal" class="action-edit"><i class="icon-edit"></i> Edit</a></li>
									 <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
								</ul>
							</div>
						</div>
						</td>
					</tr>
				</tbody>
					
				<tfoot>
					<tr class="no-details">
						<td colspan="7">
							<div class="well text-center">
								<button class="btn  btn-medium"  id="add-receiving-report-details" href="#receiving-report-details-modal" data-toggle="modal" data-dismiss="modal"><i class="icon-plus"></i> Receiving Report Details</button>
								<div class="muted">No Receiving Report Details found, click to add.</div>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
	</div>
</div>
	
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary intent-save" type="submit">Save</button>
    <button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
  </div>
  
</div>
<?php echo $this->Form->end();?>
<!-- CANVASFORM -->
<?php echo $this->Form->create('ReceivingReport',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'ReceivingReportCanvasForm',
															'model'=> 'ReceivingReport',
															'canvas'=>'#ReceivingReportTable'
														)
											);?>
<?php echo $this->Form->end();?>

	<?php echo $this->Form->create('ReceivingReportDetail',array('name'=>'ReceivingReportDetailModal','action'=>'add','class'=>'form-horizontal', 'model'=> 'receivingReportDetails', 'canvas'=>'#ReceivingReportDetailCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

		<div id="receiving-report-details-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
			<div class="modal-header">
				<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">ReceivingReportDetail</span></h3>
			</div>
			<div class="modal-body">
  
				<div class="row-fluid">
					<div class="receivingReportDetails form span12">
					
							<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('receiving_report_id',array('placeholder'=>'Receiving Report Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('item_id',array('placeholder'=>'Item Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('quantity',array('placeholder'=>'Quantity','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('price',array('placeholder'=>'Price','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
					</div>		
				</div>
			</div>
			 <div class="modal-footer">
				<button class="btn btn-primary intent-save" type="submit">Save</button>
				<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
			 </div>
		</div>
<?php echo $this->Form->end();?>
<?php echo $this->Form->create('ReceivingReportDetail',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'ReceivingReportDetailCanvasForm',
															'model'=> 'ReceivingReportDetail',
															'canvas'=>'#ReceivingReportDetailTable'
														)
											);?>
<?php $this->Form->input('receiving_report_id',array('type'=>'hidden','value'=>null,'role'=>'foreign-key')); ?>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>