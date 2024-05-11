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
				<th scope="col">Customer</th>
				<th scope="col">Adress</th>
				<th scope="col">Number Phone</th>
				<th scope="col">Email</th>
				<th scope="col">Payment</th>
				<th scope="col">Status</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $order){  ?>
			<tr >
			<td><?php echo $order->order_code?></td>
			<td><?php echo $order->name?></td>
			<td><?php echo $order->address?></td>
			<td><?php echo $order->phone?></td>
			<td><?php echo $order->email?></td>
			<td><?php echo $order->method?></td>
			<td><?php if($order->status == 1){
						echo '<span class="text-primary">Đơn hàng đang chờ xử lý</span>';
					}elseif($order->status == 2){
						echo '<span class="text-success">Đã được xử lý</span>';
					}elseif($order->status == 3){
						echo '<span class="text-success">Đơn hàng đã được giao</span>';
					}else{
						echo '<span class="text-danger">Đơn hàng đã hủy</span>';
					}				
				?></td>
			<td>
				<a class = "btn btn-warning" href="<?php echo base_url('order/view/'.$order->order_code)  ?>">VIEW</a>
				<a class = "btn btn-danger" onclick= "return confirm('Are you sure?')"  href="<?php  echo base_url('order/delete/'.$order->order_code)?>">DELETE</a>
			</td>
			</tr>
			<?php }?>
		</tbody>
		</table>
  </div>
</div>
</div>
