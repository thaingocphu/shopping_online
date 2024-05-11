<div class="container">
	<div class="card">
		<div class="card-header">
			Update Product
		</div>
		<?php if ($this->session->flashdata('success')) { ?>
			<div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
		<?php } elseif ($this->session->flashdata('error')) { ?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
		<?php } ?>
		<div class="card-body">
			<form action="<?php echo base_url('product/update/' . $product->id) ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="title">Tilte</label>
					<input name="title" type="text" class="form-control" value="<?php echo $product->title ?>" aria-describedby="emailHelp">
					<?php echo form_error('title'); ?>
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input name="slug" type="text" class="form-control" value="<?php echo $product->slug ?>" aria-describedby="emailHelp">
					<?php echo form_error('slug'); ?>
				</div>
				<div class="form-group">
					<label for="desc">Description</label>
					<input name="desc" type="text" class="form-control-file" value="<?php echo $product->description ?>">
					<?php echo form_error('desc'); ?>
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input name="image" type="file" class="form-control">
					<td><img src="<?php echo base_url('./uploads/product/' . $product->image) ?>" width="150px" height="150px"></td>
					<small><?php if (isset($error)) echo $error ?></small>
				</div>
				<div class="form-group">
					<label for="status"><S></S>Status</label>
					<select name="status" class="form-control">
						<?php if ($product->status == 1) { ?>
							<option selected value="1">Active</option>
							<option value="0">InActive</option>
						<?php } else { ?>
							<option selected value="0">InActive</option>
							<option value="1">Active</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="brand_id"><S></S>Brand</label>
					<select name="brand_id" class="form-control">
						<?php foreach ($brands as $brand) { ?>
							<option <?php echo $brand->id === $product->brand_id ? 'selected' : '' ?> value="<?php echo $brand->id; ?>"><?php echo $brand->title ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="category_id"><S></S>Category</label>
					<select name="category_id" class="form-control">
						<?php foreach ($categories as $category) { ?>
							<option <?php echo $category->id === $product->category_id ? 'selected' : '' ?> value="<?php echo $category->id; ?>"><?php echo $category->title ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="title">Quantity</label>
					<input name="quantity" type="number" class="form-control" value="<?php echo $product->quantity ?>" aria-describedby="emailHelp">
					<?php echo form_error('quantity'); ?>
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input name="price" type="number" class="form-control" value="<?php echo $product->price ?>" aria-describedby="emailHelp">
					<?php echo form_error('price'); ?>
				</div>
				<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
</div>
