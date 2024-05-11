<div class="container">
<div class="card">
  <div class="card-header">
    List
  </div>
  <div class="card-body">
	<a href="<?php echo base_url('brand/create')?>" class="btn btn-primary">Add brand</a>
		<table class="table table-striped">
		<thead>
			<tr>
			<th scope="col">ID</th>
			<th scope="col">Title</th>
			<th scope="col">Description</th>
			<th scope="col">Image</th>
			<th scope="col">Status</th>
			<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($brands as $brand){  ?>
			<tr >
			<th scope="row"><?php echo $brand->id?></th>
			<td><?php echo $brand->title?></td>
			<td><?php echo $brand->description?></td>
			<td><img src="<?php echo base_url('./uploads/brand/'.$brand->image)?>" width="150px" height="150px"></td>
			<td><?php if($brand->status == 1){
						echo "Active";
					}else{
						echo "Inactive";
					}				
				?></td>
			<td>
				<a class = "btn btn-warning" href="<?php echo base_url('brand/edit/'.$brand->id)  ?>">EDIT</a>
				<a class = "btn btn-danger" onclick= "return confirm('Are you sure?')"  href="<?php  echo base_url('brand/delete/'.$brand->id)?>">DELETE</a>
			</td>
			</tr>
			<?php }?>
		</tbody>
		</table>
  </div>
</div>
</div>
