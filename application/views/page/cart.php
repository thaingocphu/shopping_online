<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<?php if ($this->cart->contents()) { ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="image">Item</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = 0;
						$subtotal = 0 ?>
						<?php foreach ($this->cart->contents() as $item) {
							$subtotal += $item['price'] * $item['qty'];
						?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="<?php echo base_url('./uploads/product/' . $item['options']['image']) ?>" width="100px" height="100px" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $item['name'] ?></a></h4>
								</td>
								<td class="cart_price">
									<p><?php echo number_format($item['price'], 0, '.', ',') . 'VNĐ' ?></p>
								</td>
								<td>
									<form action="<?php echo base_url('update-cart-item') ?>" method="POST">
										<div class="cart_quantity_button">
											<input type="hidden" value="<?php echo $item['rowid'] ?>" name="rowid">
											<input type="number" class="cart_quantity_input" name="quantity" min="1" value="<?php echo $item['qty'] ?>" autocomplete="off" size="2">
											<input type="submit" value="update" class="btn">
										</div>
									</form>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?php echo number_format($subtotal, 0, '.', ',') . 'VNĐ'; ?></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="<?php echo base_url('delete-by-item/' . $item['rowid']) ?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php
							$total += $subtotal;
						}
						?>
						<tr>
							<td colspan="4">
								<p class="cart_total_price">TOTAL:  <?php echo number_format($total, 0, '.', ',') . 'VNĐ'; ?></p>
							</td>
							<td><a href="<?php echo base_url('delete-all-cart') ?>" class="btn btn-danger">Delete all</a></td>
							<td><a href="<?php echo base_url('checkout') ?>" class="btn btn-info">Pay</a></td>

						</tr>
					</tbody>
				</table>
			<?php } else {
				echo '<span class="text text-danger">Please returning to <a href ="http://localhost:8000/">home page</a> and adding items to cart!</span>';
			} ?>
		</div>
	</div>
</section> <!--/#cart_items-->
