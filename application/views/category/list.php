<div class="container">
<div class="card">
  <div class="card-header">
    List Category
  </div>
  <div class="card-body">
	<a href="<?php echo base_url('category/create')?>" class="btn btn-primary">Add Category</a>
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
			<?php foreach ($categories as $category){  ?>
			<tr >
			<th scope="row"><?php echo $category->id?></th>
			<td><?php echo $category->title?></td>
			<td><?php echo $category->description?></td>
			<td><img src="<?php echo base_url('./uploads/category/'.$category->image)?>" width="150px" height="150px"></td>
			<td><?php if($category->status == 1){
						echo "Active";
					}else{
						echo "Inactive";
					}				
				?></td>
			<td>
				<a class = "btn btn-warning" href="<?php echo base_url('category/edit/'.$category->id)  ?>">EDIT</a>
				<a class = "btn btn-danger" onclick= "return confirm('Are you sure?')"  href="<?php  echo base_url('category/delete/'.$category->id)?>">DELETE</a>
			</td>
			</tr>
			<?php }?>
		</tbody>
		</table>
  </div>
</div>
</div>
