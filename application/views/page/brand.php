<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
					<h2>CATEGORIES</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php foreach ( $categories as $category){?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="<?php echo base_url('danh-muc/' . $category->id)?>"><?php echo $category->title?></a>
									</h4>
								</div>
							</div>
							<?php }?>
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php foreach ($brands as $brand) {?>
									<li><a href="<?php echo base_url('thuong-hieu/' . $brand->id)?>"> <?php echo $brand->title ?></a></li>
									<?php }?>
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
								<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<img src="frontend/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $brandTitle->title ?></h2>
						<?php foreach ($brands_products as $brand_product) {?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url("./uploads/product/". $brand_product->image) ?>" alt="" width="100px" height="230px"/>
										<h2><?php echo number_format($brand_product->price, 0, '.', ',') . 'VNĐ'?></h2>
										<p><?php echo $brand_product->title?></p>
										<a href="<?php echo base_url('chi-tiet-san-pham/'. $brand_product->id) ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Details</a>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
