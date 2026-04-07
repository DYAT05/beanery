<div class="nano">
	<div class="nano-content">
		<nav id="menu" class="nav-main" role="navigation">
			<ul class="nav nav-main">

				<li class="<?= ($this->uri->segment(2) == 'index') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/index', '<i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span>'); ?>
				</li>

				<li class="nav-parent <?= (strncmp($this->uri->segment(2), "inventory", 9) === 0) ? 'nav-expanded nav-active' : ''; ?>">
					<a>
						<i class="fa fa-database" aria-hidden="true"></i>
						<span>Inventory Maintenance</span>
					</a>
					<ul class="nav nav-children">
						<li class="<?= ($this->uri->segment(2) == 'inventoryPerishable') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventoryPerishable', 'Perishable'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'inventoryNonperishable') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventoryNonperishable', 'Non-Perishable'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'inventorySanitation') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventorySanitation', 'Cleaning & Sanitation'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'inventorySmallwares') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventorySmallwares', 'Smallwares'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'inventoryCookware') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventoryCookware', 'Cookware'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'inventoryEquipment') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/inventoryEquipment', 'Equipment'); ?>
						</li>
					</ul>
				</li>
                
				<li class="nav-parent <?= (strncmp($this->uri->segment(2), "modify", 6) === 0) ? 'nav-expanded nav-active' : ''; ?>">
					<a>
						<i class="fa fa-magic" aria-hidden="true"></i>
						<span>Update Inventory Stocks</span>
					</a>
					<ul class="nav nav-children">
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/perishable') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/perishable', 'Perishable'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/non-perishable') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/non-perishable', 'Non-Perishable'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/sanitation') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/sanitation', 'Cleaning & Sanitation'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/smallwares') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/smallwares', 'Smallwares'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/cookware') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/cookware', 'Cookware'); ?>
						</li>
						<li class="<?= ($this->uri->segment(2) == 'modifyInventory/equipment') ? 'nav-active' : ''; ?>">
							<?php echo anchor($this->uri->segment(1).'/modifyInventory/equipment', 'Equipment'); ?>
						</li>
					</ul>
				</li>
				
				<li class="<?= ($this->uri->segment(2) == 'restaurantReportSummary') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/restaurantReportSummary', '<i class="fa fa-dollar" aria-hidden="true"></i><span>Restaurant Report Summary</span>'); ?>
				</li>
			</ul>
		</nav>
	</div>
</div>