<div class="container">
<div class="card">
  <div class="card-header">
    Create Category
  </div>
	<?php if( $this->session->flashdata('success')){?>
			<div class="alert alert-success"><?php echo $this->session->flashdata('success')?></div>
		<?php }elseif( $this->session->flashdata('error')){?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('error')?></div>
			<?php }?>
  <div class="card-body">
  <form action="<?php echo base_url('category/store')?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Tilte</label>
    <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	<?php echo form_error('title'); ?>
	</div>
	<div class="form-group">
    <label for="slug">Slug</label>
    <input name="slug" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	<?php echo form_error('slug'); ?>
	</div>
  <div class="form-group">
    <label for="desc">Description</label>
    <input name = "desc" type="text" class="form-control-file" id="exampleInputPassword1">
	<?php echo form_error('desc'); ?>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input name = "image" type="file" class="form-control" id="exampleInputPassword1">
		<small><?php if(isset($error)) echo $error ?></small>
  </div>
<div class="form-group">
<label for="status"><S></S>Status</label>
	<select name="status" class="form-control">
  		<option value="1">Active</option>
		<option value="0">InActive</option>
	</select>
</div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
  </div>
</div>
</div>
