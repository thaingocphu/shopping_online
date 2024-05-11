<div class="container">
<div class="card">
  <div class="card-header">
    Update Category
  </div>
	<?php if( $this->session->flashdata('success')){?>
			<div class="alert alert-success"><?php echo $this->session->flashdata('success')?></div>
		<?php }elseif( $this->session->flashdata('error')){?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('error')?></div>
			<?php }?>
  <div class="card-body">
  <form action="<?php echo base_url('category/update/'.$category->id)?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Tilte</label>
    <input name="title" type="text" class="form-control" value="<?php echo $category->title ?>" aria-describedby="emailHelp">
	<?php echo form_error('title'); ?>
	</div>
	<div class="form-group">
    <label for="slug">Slug</label>
    <input name="slug" type="text" class="form-control"  value="<?php echo $category->slug ?>" aria-describedby="emailHelp">
	<?php echo form_error('slug'); ?>
	</div>
  <div class="form-group">
    <label for="desc">Description</label>
    <input name = "desc" type="text" class="form-control-file"  value="<?php echo $category->description ?>">
	<?php echo form_error('desc'); ?>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input name = "image" type="file" class="form-control" >
		<td><img src="<?php echo base_url('./uploads/category/'.$category->image)?>" width="150px" height="150px"></td>
		<small><?php if(isset($error)) echo $error ?></small>
  </div>
<div class="form-group">
<label for="status"><S></S>Status</label>
	<select name="status" class="form-control">
		<?php if ( $category->status == 1){?>
  		<option selected value="1">Active</option>
		<option value="0">InActive</option>
		<?php }else{?>
			<option selected value="0">InActive</option>
			<option value="1">Active</option>
			<?php }?>
	</select>
</div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
  </div>
</div>
</div>
