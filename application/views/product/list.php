<div class="container">
	<div class="card">
		<div class="card-header">
			List Product
		</div>
		<div class="card-body">
			<a href="<?php echo base_url('product/create') ?>" class="btn btn-primary">Add Product</a>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Quantity</th>
						<th scope="col">price</th>
						<th scope="col">brand</th>
						<th scope="col">category</th>
						<th scope="col">Description</th>
						<th scope="col">Image</th>
						<th scope="col">Status</th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $product) {  ?>
						<tr>
							<th scope="row"><?php echo $product->id ?></th>
							<td><?php echo $product->title ?></td>
							<td><?php echo $product->quantity ?></td>
							<td><?php echo number_format($product->price, 0, ".", ",") ?></td>
							<td><?php echo $product->btitle ?></td>
							<td><?php echo $product->ctitle ?></td>
							<td><?php echo $product->description ?></td>
							<td><img src="<?php echo base_url('./uploads/product/' . $product->image) ?>" width="150px" height="150px"></td>
							<td><?php if ($product->status == 1) {
									echo "Active";
								} else {
									echo "Inactive";
								}
								?></td>
							<td>
								<a class="btn btn-warning" href="<?php echo base_url('product/edit/' . $product->id)  ?>">EDIT</a>
							</td>
							<td>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="<?php echo base_url('product/delete/' . $product->id) ?>">DELETE</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
