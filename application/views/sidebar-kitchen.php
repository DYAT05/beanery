<div class="nano">
	<div class="nano-content">
		<nav id="menu" class="nav-main" role="navigation">
			<ul class="nav nav-main">

				<li class="<?= ($this->uri->segment(2) == 'index') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/index', '<i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span>'); ?>
				</li>
				<li class="<?= ($this->uri->segment(2) == 'history') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/history', '<i class="fa fa-history" aria-hidden="true"></i><span>Transactions History</span>'); ?>
				</li>
			</ul>
		</nav>
	</div>
</div>