<div class="container">
<div class="card">
  <div class="card-header">
    List Category
  </div>
  <div class="card-body">
		<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Order code</th>
				<th scope="col">Product name</th>
				<th scope="col">Product image</th>
				<th scope="col">Product price</th>
				<th scope="col">Quantity</th>
				<th scope="col">Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($order_details as $order_detail){  ?>
			<tr >
				<td><?php echo $order_detail->order_code?></td>
				<td><?php echo $order_detail->title?></td>
				<td><img src="<?php echo base_url("./uploads/product/". $order_detail->image)?>" alt="" width="75px" height="50px"></td>
				<td><?php echo number_format($order_detail->price, 0, '.',',').'VNĐ';?></td>
				<td><?php echo $order_detail->qty?></td>
				<td><?php echo number_format($order_detail->qty*$order_detail->price, 0, '.', ','). 'VNĐ'?></td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="1">
						<select class="process form-control">
							<option id="<?php echo $order_detail->order_code ?>" value="0">Xử lý đơn hàng</option>
							<option id="<?php echo $order_detail->order_code ?>" value="1">Đơn hàng đang giao</option>
							<option id="<?php echo $order_detail->order_code ?>" value="2">Đơn hàng đã được giao</option>
							<option id="<?php echo $order_detail->order_code ?>" value="3">Đơn hàng đã hủy</option>
						</select>
				</td>
			</tr>
		</tbody>
		</table>
  </div>
</div>
</div>
