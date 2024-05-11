<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
			<?php } ?>
			<a href="<?php echo base_url()?>" style ="text-align:center"><h4>Tiếp tục mua sắm</h4></a>
		</div>
	</div>
</section> <!--/#cart_items-->
