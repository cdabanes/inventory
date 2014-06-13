<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span8">		
				<div class="row-fluid">
					<div class="span2 module">
						<div class="module-wrap">
							<div class="module-name">
								<i class="icon-th-large"></i>
								Apps
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="span3 pull-right  " id="Login">
						<div id="simple-root"></div> 	
					</div>
		</div>
	</div>	
 </div>
 <!--Submodules-->
 <div class="row-fluid">
 	<div class="span12">
		<ul class="submodules">
			<li class="submodule">
				<div class="submodule-icon"><a href="#/"><i class="icon-plus-sign"></i></a></div>
				<span class="submodule-name">Add App</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/items"><i class="icon-briefcase"></i></a></div>
				<span class="submodule-name">Inventory Master</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/item_types"><i class="icon-briefcase"></i></a></div>
				<span class="submodule-name">Item Types</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/articles"><i class="icon-briefcase"></i></a></div>
				<span class="submodule-name">Article</span>
			</li>
			
	
			<!--
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/checklists"><i class="icon-check"></i></a></div>
				<span class="submodule-name">Checklist</span>
			</li>
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/invoices"><i class="icon-file"></i></a></div>
				<span class="submodule-name">Assessment</span>
			</li>
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/issue_outs"><i class="icon-shopping-cart "></i></a></div>
				<span class="submodule-name">Issue Out</span>
			</li>
	
			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/receiving_reports"><i class="icon-gift"></i></a></div>
				<span class="submodule-name">Receiving Reports</span>
			</li>

			<li class="submodule">
				<div class="submodule-icon"><a href="/inventory/vendors"><i class="icon-truck"></i></a></div>
				<span class="submodule-name">Vendors</span>
			</li>
			-->


			<?php for($i=1;$i<0;$i++): ?>
			<li class="submodule">
				<div class="submodule-icon"><a href="#/"><i class="icon-check-empty"></i></a></div>
				<span class="submodule-name">Empty App</span>
			</li>
			<?php endfor; ?>

		</ul>
	</div>
 </div>