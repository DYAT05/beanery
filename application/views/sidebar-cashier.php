<div class="nano">
	<div class="nano-content">
		<nav id="menu" class="nav-main" role="navigation">
			<ul class="nav nav-main">
				<?php 
					if($this->session->userdata('is_duty') == "1"){
				?>

				<li class="<?= ($this->uri->segment(2) == 'pos') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/pos', '<i class="fa fa-shopping-cart" aria-hidden="true"></i><span>POS</span>'); ?>
				</li>
				<?php
					}
				?>
				<li class="<?= ($this->uri->segment(2) == 'history') ? 'nav-active' : ''; ?>">
					<?php echo anchor($this->uri->segment(1).'/history', '<i class="fa fa-history" aria-hidden="true"></i><span>Transactions History</span>'); ?>
				</li>
			</ul>
		</nav>
	</div>
</div>